<?php
declare(strict_types=1);

error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '0');          // keep OFF (JSON endpoint)
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../configs.php';
require_once __DIR__ . '/../sendEmail.php';

/* -----------------------------
   Load Meta CAPI config (server-side only)
   meta_openhouse.php should return:
   return ['pixel_id' => '123...', 'access_token' => 'EAAB...'];
----------------------------- */
$META = null;
$metaPath = __DIR__ . '/../meta_openhouse.php'; // <-- ADJUST if needed
if (is_file($metaPath)) {
  $tmp = require $metaPath;
  if (is_array($tmp)) $META = $tmp;
} else {
  error_log("Meta config not found at: {$metaPath}");
}

/* -----------------------------
   Only allow POST
----------------------------- */
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
  http_response_code(405);
  echo json_encode(['ok' => false, 'error' => 'Method Not Allowed']);
  exit;
}

/* -----------------------------
   Read JSON body
----------------------------- */
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

/* -----------------------------
   Helpers
----------------------------- */
function str_clean($v): string {
  return trim((string)$v);
}

function is_valid_email(string $email): bool {
  return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
}

function client_ip(): string {
  $candidates = [
    $_SERVER['HTTP_CF_CONNECTING_IP'] ?? null, // Cloudflare
    $_SERVER['HTTP_X_REAL_IP'] ?? null,        // Nginx proxy
    $_SERVER['HTTP_X_FORWARDED_FOR'] ?? null,  // Proxy chain
    $_SERVER['REMOTE_ADDR'] ?? null,
  ];

  foreach ($candidates as $ip) {
    if (!$ip) continue;

    // X_FORWARDED_FOR can be "client, proxy1, proxy2"
    $ip = trim(explode(',', $ip)[0]);

    if (filter_var($ip, FILTER_VALIDATE_IP)) {
      return $ip;
    }
  }

  return 'unknown';
}

/* ---- Meta CAPI helpers ---- */
function tkg_norm_email(string $email): string {
  return strtolower(trim($email));
}

function tkg_norm_phone(string $phone): string {
  return preg_replace('/\D+/', '', $phone);
}

function tkg_sha256(string $v): string {
  return hash('sha256', $v);
}

function tkg_meta_cookie(string $name): ?string {
  $v = $_COOKIE[$name] ?? null;
  if (!$v) return null;
  $v = trim((string)$v);
  return $v !== '' ? $v : null;
}

/**
 * Send Conversions API event
 * Returns ['ok'=>bool,'http'=>int,'resp'=>string]
 */
function tkg_send_meta_capi(array $meta, array $event): array {
  $pixel_id = (string)($meta['pixel_id'] ?? '');
  $token    = (string)($meta['access_token'] ?? '');

  if ($pixel_id === '' || $token === '') {
    return ['ok' => false, 'http' => 0, 'resp' => 'Missing pixel_id or access_token'];
  }

  $url = "https://graph.facebook.com/v19.0/{$pixel_id}/events?access_token=" . urlencode($token);

  $ch = curl_init($url);
  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS     => json_encode(['data' => [$event]]),
    CURLOPT_TIMEOUT        => 10,
  ]);

  $resp = curl_exec($ch);
  $err  = curl_error($ch);
  $http = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  if ($resp === false) {
    return ['ok' => false, 'http' => $http, 'resp' => 'cURL error: ' . $err];
  }

  $ok = ($http >= 200 && $http < 300);
  return ['ok' => $ok, 'http' => $http, 'resp' => (string)$resp];
}

/* -----------------------------
   Extract fields
----------------------------- */
$first   = str_clean($data['firstName'] ?? '');
$last    = str_clean($data['lastName'] ?? '');
$email   = str_clean($data['email'] ?? '');
$phone   = str_clean($data['phone'] ?? '');
$message = str_clean($data['message'] ?? '');

$listingAddress = str_clean($data['listingAddress'] ?? '');
$mlsNumber      = str_clean($data['mlsNumber'] ?? '');
$listingPrice   = str_clean($data['listingPrice'] ?? '');

$name = trim($first . ' ' . $last);

/* -----------------------------
   Validation
----------------------------- */
if ($first === '' || $last === '' || $email === '') {
  http_response_code(422);
  echo json_encode(['ok' => false, 'error' => 'Missing required fields']);
  exit;
}

if (!is_valid_email($email)) {
  http_response_code(422);
  echo json_encode(['ok' => false, 'error' => 'Invalid email']);
  exit;
}

/* -----------------------------
   Honeypot
----------------------------- */
$honeypot = str_clean($data['website'] ?? '');
if ($honeypot !== '') {
  echo json_encode(['ok' => true]);
  exit;
}

/* -----------------------------
   Throttle (per IP + email, 1 per 5 sec)
----------------------------- */
$ip = client_ip();
$eventId = bin2hex(random_bytes(16)); // for Meta dedupe (browser + server)

$ipKey    = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $ip);
$emailKey = strtolower(preg_replace('/[^a-zA-Z0-9_.@-]/', '_', $email));
$key      = sys_get_temp_dir() . "/lead_{$ipKey}_{$emailKey}.txt";

$now    = time();
$lastTs = (int)@file_get_contents($key);

if ($lastTs > 0 && ($now - $lastTs) < 5) {
  http_response_code(429);
  echo json_encode(['ok' => false, 'error' => 'Too many requests']);
  exit;
}
@file_put_contents($key, (string)$now);

/* -----------------------------
   Load LACRM config
----------------------------- */
$LACRM_API_KEY     = defined('LACRM_API_KEY') ? (string)LACRM_API_KEY : '';
$LACRM_ASSIGNED_TO = defined('LACRM_ASSIGNED_TO') ? (string)LACRM_ASSIGNED_TO : '';

if ($LACRM_API_KEY === '' || $LACRM_ASSIGNED_TO === '') {
  http_response_code(500);
  echo json_encode(['ok' => false, 'error' => 'Server misconfigured']);
  exit;
}

$assignedTo = (int)$LACRM_ASSIGNED_TO;
if ($assignedTo <= 0) {
  http_response_code(500);
  echo json_encode(['ok' => false, 'error' => 'Invalid AssignedTo']);
  exit;
}

/* -----------------------------
   LACRM API Call
----------------------------- */
function lacrm_call(string $apiKey, string $function, array $parameters = []): array {
  $url = 'https://api.lessannoyingcrm.com/v2/';

  $payload = json_encode([
    'Function'   => $function,
    'Parameters' => $parameters,
  ]);

  $ch = curl_init($url);
  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_HTTPHEADER     => [
      'Content-Type: application/json',
      'Authorization: ' . $apiKey,
    ],
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_TIMEOUT        => 15,
  ]);

  $resp = curl_exec($ch);
  $err  = curl_error($ch);
  $http = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  if ($resp === false) {
    throw new Exception('cURL error: ' . $err);
  }

  $json = json_decode($resp, true);

  if ($http < 200 || $http >= 300) {
    $desc = $json['ErrorDescription'] ?? $resp;
    throw new Exception("LACRM HTTP $http: " . $desc);
  }

  if (!is_array($json)) return ['raw' => $resp];

  if (isset($json['ErrorCode']) || isset($json['ErrorDescription'])) {
    throw new Exception($json['ErrorDescription'] ?? 'LACRM error');
  }

  return $json;
}

/* -----------------------------
   Build LACRM Note
----------------------------- */
$noteParts = [
  'Website lead submission',
  'Name: ' . $name,
  'Email: ' . $email,
];

if ($phone !== '')          $noteParts[] = 'Phone: ' . $phone;
if ($listingAddress !== '') $noteParts[] = 'Listing: ' . $listingAddress;
if ($mlsNumber !== '')      $noteParts[] = 'MLS: ' . $mlsNumber;
if ($listingPrice !== '')   $noteParts[] = 'Price: ' . $listingPrice;
if ($message !== '')        $noteParts[] = 'Message: ' . $message;

$noteText = implode("\n", $noteParts);

/* -----------------------------
   Main Logic
----------------------------- */
try {
  $contactId = null;

  $searchResp = lacrm_call($LACRM_API_KEY, 'GetContacts', [
    'SearchTerms' => $email
  ]);

  $results = $searchResp['Results'] ?? [];

  foreach ($results as $contact) {
    $emails = $contact['Email'] ?? [];
    foreach ($emails as $emailObj) {
      if (strcasecmp($emailObj['Text'] ?? '', $email) === 0) {
        $contactId = (string)$contact['ContactId'];
        break 2;
      }
    }
  }

  if ($contactId === null) {
    $created = lacrm_call($LACRM_API_KEY, 'CreateContact', [
      'IsCompany'  => false,
      'AssignedTo' => $assignedTo,
      'Name'       => $name,
      'Email'      => [['Text' => $email, 'Type' => 'Work']],
      'Phone'      => $phone !== '' ? [['Text' => $phone, 'Type' => 'Mobile']] : []
    ]);

    $contactId = (string)($created['ContactId'] ?? '');
    if ($contactId === '') throw new Exception('CreateContact failed');
  }

  lacrm_call($LACRM_API_KEY, 'CreateNote', [
    'ContactId' => $contactId,
    'Note'      => $noteText,
  ]);

  // ---- Meta Conversions API: Lead (server-side) ----
  if (is_array($META)) {
    $normEmail = tkg_norm_email($email);
    $normPhone = tkg_norm_phone($phone);

    $user_data = array_filter([
      'em' => $normEmail !== '' ? [tkg_sha256($normEmail)] : null,
      'ph' => $normPhone !== '' ? [tkg_sha256($normPhone)] : null,
      'client_ip_address' => $ip !== 'unknown' ? $ip : null,
      'client_user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
      'fbp' => tkg_meta_cookie('_fbp'),
      'fbc' => tkg_meta_cookie('_fbc'),
    ]);

    // Prefer HTTP_REFERER as the landing page URL (more accurate than this endpoint URL)
    $event_source_url = $_SERVER['HTTP_REFERER'] ?? '';
    if ($event_source_url === '') {
      $event_source_url =
        (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://')
        . ($_SERVER['HTTP_HOST'] ?? '');
    }

    $event = [
      'event_name'       => 'Lead',
      'event_time'       => time(),
      'event_id'         => $eventId,
      'action_source'    => 'website',
      'event_source_url' => $event_source_url,
      'user_data'        => $user_data,
    ];

    $metaResp = tkg_send_meta_capi($META, $event);
    if (!$metaResp['ok']) {
      error_log("Meta CAPI error (HTTP {$metaResp['http']}): {$metaResp['resp']}");
    }

  }

  $subject = "New lead" . ($mlsNumber !== '' ? " (MLS {$mlsNumber})" : '');

  $html =
    "New lead submission<br><br>" .
    "Name: " . htmlspecialchars($name) . "<br>" .
    "Email: " . htmlspecialchars($email) . "<br>" .
    ($phone !== '' ? "Phone: " . htmlspecialchars($phone) . "<br>" : '') .
    ($listingAddress !== '' ? "Listing: " . htmlspecialchars($listingAddress) . "<br>" : '') .
    ($mlsNumber !== '' ? "MLS: " . htmlspecialchars($mlsNumber) . "<br>" : '') .
    ($listingPrice !== '' ? "Price: " . htmlspecialchars($listingPrice) . "<br>" : '') .
    ($message !== '' ? "Message:<br>" . nl2br(htmlspecialchars($message)) : '');

  // Plain SMS gateway text (no emojis)
  $sms =
    "NEW LEAD" . ($mlsNumber !== '' ? " (MLS {$mlsNumber})" : '') . "\n" .
    "Name: {$name}\n" .
    ($phone !== '' ? "Phone: {$phone}\n" : '') .
    "Email: {$email}\n" .
    ($listingAddress !== '' ? "Listing: {$listingAddress}\n" : '') .
    ($message !== '' ? "Msg: " . substr($message, 0, 200) : '');

  try {
    tkg_notify($email, $name, $subject, $html, $sms);
  } catch (Exception $notifyErr) {
    error_log("Notify error: " . $notifyErr->getMessage());
  }

  echo json_encode(['ok' => true, 'contactId' => $contactId, 'event_id' => $eventId]);
  exit;

} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
  exit;
}