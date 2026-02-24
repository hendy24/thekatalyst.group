<?php
declare(strict_types=1);

error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

require_once __DIR__ . '/../configs.php';

/**
 * protected/api/lead.php
 *
 * Receives JSON from the listing landing page and creates/updates a contact in Less Annoying CRM.
 * Flow:
 *  - Validate required fields
 *  - Search contact by email (dedupe)
 *  - If exists: add note
 *  - Else: create contact -> add note
 *
 * IMPORTANT:
 *  - Do NOT expose your API key in client-side code.
 *  - Store secrets outside web root or in environment variables.
 */

header('Content-Type: application/json; charset=utf-8');

// --- CORS (optional)
// If your form posts from the same domain, you don't need this.
// Uncomment + set your domain if you're posting cross-domain.
/*
$allowedOrigin = 'https://thekatalyst.group';
if (!empty($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] === $allowedOrigin) {
  header("Access-Control-Allow-Origin: $allowedOrigin");
  header("Vary: Origin");
}
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  header('Access-Control-Allow-Methods: POST, OPTIONS');
  header('Access-Control-Allow-Headers: Content-Type');
  exit;
}
*/

// --- Only allow POST
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
  http_response_code(405);
  echo json_encode(['ok' => false, 'error' => 'Method Not Allowed']);
  exit;
}

// --- Read JSON body
$raw = file_get_contents('php://input');
if ($raw === false || trim($raw) === '') {
  http_response_code(400);
  echo json_encode(['ok' => false, 'error' => 'Empty request body']);
  exit;
}

$data = json_decode($raw, true);
if (!is_array($data)) {
  http_response_code(400);
  echo json_encode(['ok' => false, 'error' => 'Invalid JSON']);
  exit;
}

// --- Helpers
function str_clean($v): string {
  return trim((string)$v);
}

function is_valid_email(string $email): bool {
  return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
}

// --- Extract fields from payload
$first = str_clean($data['firstName'] ?? '');
$last  = str_clean($data['lastName'] ?? '');
$email = str_clean($data['email'] ?? '');
$phone = str_clean($data['phone'] ?? '');
$message = str_clean($data['message'] ?? '');

$listingAddress = str_clean($data['listingAddress'] ?? '');
$mlsNumber = str_clean($data['mlsNumber'] ?? '');
$listingPrice = str_clean($data['listingPrice'] ?? '');

// --- Basic validation
if ($first === '' || $last === '' || $email === '') {
  http_response_code(422);
  echo json_encode(['ok' => false, 'error' => 'Missing required fields: firstName, lastName, email']);
  exit;
}
if (!is_valid_email($email)) {
  http_response_code(422);
  echo json_encode(['ok' => false, 'error' => 'Invalid email address']);
  exit;
}

// --- Honeypot (optional anti-spam)
// Add <input type="text" name="website" style="display:none"> to your form
$honeypot = str_clean($data['website'] ?? '');
if ($honeypot !== '') {
  http_response_code(200);
  echo json_encode(['ok' => true]); // silently accept spam bots
  exit;
}

// --- Load secrets 
$LACRM_API_KEY = defined('LACRM_API_KEY') ? (string)LACRM_API_KEY : '';
$LACRM_ASSIGNED_TO = defined('LACRM_ASSIGNED_TO') ? (string)LACRM_ASSIGNED_TO : '';

if ($LACRM_API_KEY === '' || $LACRM_ASSIGNED_TO === '') {
  http_response_code(500);
  echo json_encode(['ok' => false, 'error' => 'Server not configured (missing LACRM_API_KEY or LACRM_ASSIGNED_TO)']);
  exit;
}

$assignedTo = (int)$LACRM_ASSIGNED_TO;
if ($assignedTo <= 0) {
  http_response_code(500);
  echo json_encode(['ok' => false, 'error' => 'Invalid LACRM_ASSIGNED_TO value']);
  exit;
}

// --- LACRM API caller
function lacrm_call(string $apiKey, string $function, array $parameters = []): array {
  $url = 'https://api.lessannoyingcrm.com/v2/';
  $payload = json_encode([
    'Function' => $function,
    'Parameters' => $parameters,
  ]);

  $ch = curl_init($url);
  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
      'Content-Type: application/json',
      'Authorization: ' . $apiKey, // IMPORTANT: no "Bearer"
    ],
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_TIMEOUT => 15,
  ]);

  $resp = curl_exec($ch);
  $err  = curl_error($ch);
  $http = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);

  if ($resp === false) {
    throw new Exception('cURL error: ' . $err);
  }

  $json = json_decode($resp, true);

  // LACRM returns structured errors in JSON; treat non-2xx as error.
  if ($http < 200 || $http >= 300) {
    $desc = is_array($json) && isset($json['ErrorDescription']) ? $json['ErrorDescription'] : $resp;
    throw new Exception("LACRM HTTP $http: " . $desc);
  }

  // Some successful responses might be non-array (rare); normalize
  if (!is_array($json)) {
    return ['raw' => $resp];
  }

  // If an error was returned in a 200 response (rare), catch it
  if (isset($json['ErrorCode']) || isset($json['ErrorDescription'])) {
    $desc = $json['ErrorDescription'] ?? 'Unknown error';
    throw new Exception('LACRM error: ' . $desc);
  }

  return $json;
}

// --- Build note text
$name = $first . ' ' . $last;

$noteParts = [];
$noteParts[] = 'Website lead form submission';
$noteParts[] = 'Name: ' . $name;
$noteParts[] = 'Email: ' . $email;
if ($phone !== '') $noteParts[] = 'Phone: ' . $phone;
if ($listingAddress !== '') $noteParts[] = 'Listing: ' . $listingAddress;
if ($mlsNumber !== '') $noteParts[] = 'MLS: ' . $mlsNumber;
if ($listingPrice !== '') $noteParts[] = 'Price: ' . $listingPrice;
if ($message !== '') $noteParts[] = 'Message: ' . $message;

$noteText = implode("\n", $noteParts);

try {
  // --- Dedupe by email using GetContacts (LACRM v2 tutorial pattern)
  $contactId = null;

  $searchResp = lacrm_call($LACRM_API_KEY, 'GetContacts', [
    'SearchTerms' => $email
  ]);

  $results = $searchResp['Results'] ?? [];
  if (is_array($results)) {
    foreach ($results as $contact) {
      if (!is_array($contact)) continue;

      $emails = $contact['Email'] ?? [];
      if (!is_array($emails)) continue;

      foreach ($emails as $emailObj) {
        $existing = trim((string)($emailObj['Text'] ?? ''));
        if ($existing !== '' && strcasecmp($existing, $email) === 0) {
          $cid = (string)($contact['ContactId'] ?? '');
          if ($cid !== '') {
            $contactId = $cid;
            break 2;
          }
        }
      }
    }
  }

  // --- Create contact if not found
  if ($contactId === null) {
    $created = lacrm_call($LACRM_API_KEY, 'CreateContact', [
      'IsCompany'  => false,
      'AssignedTo' => $assignedTo,
      'Name'       => $name,
      'Email'      => [
        ['Text' => $email, 'Type' => 'Work']
      ],
      'Phone'      => $phone !== '' ? [
        ['Text' => $phone, 'Type' => 'Mobile']
      ] : []
    ]);

    $contactId = isset($created['ContactId']) ? (string)$created['ContactId'] : '';
    if ($contactId === '') {
      throw new Exception('CreateContact did not return ContactId');
    }
  }

  // --- Always add a note for this inquiry
  lacrm_call($LACRM_API_KEY, 'CreateNote', [
    'ContactId' => (string)$contactId,
    'Note'      => $noteText,
  ]);

  echo json_encode([
    'ok'        => true,
    'contactId' => (string)$contactId,
    'deduped'   => ($contactId !== null && !empty($results) && (isset($created) === false)),
  ]);
  exit;

} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
  exit;
}