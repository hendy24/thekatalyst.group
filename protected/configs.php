<?php
declare(strict_types=1);

/* ─────────────────────────────────────────────────────────────
   1) BASE CONSTANTS
───────────────────────────────────────────────────────────── */

if (!defined('DOC_ROOT')) {
    define('DOC_ROOT', realpath($_SERVER['DOCUMENT_ROOT'] ?? '') ?: '');
}

if (!defined('BASE_URL')) {
    $scheme = 'http';

    if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
        $scheme = $_SERVER['HTTP_X_FORWARDED_PROTO'];
    } elseif (
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
        (($_SERVER['SERVER_PORT'] ?? 80) == 443)
    ) {
        $scheme = 'https';
    }

    $host = $_SERVER['HTTP_HOST'] ?? '';

    define('BASE_URL', rtrim($scheme . '://' . $host, '/'));
}

if (!defined('IMAGES')) {
    define('IMAGES', BASE_URL . '/images');
}

/* ─────────────────────────────────────────────────────────────
   2) REQUEST SLUG (no .php / .json)
───────────────────────────────────────────────────────────── */

$rawPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '/';
$slug    = trim($rawPath, '/');
$slug    = basename($slug) ?: 'home';
$page    = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);

/* ─────────────────────────────────────────────────────────────
   3) SITE-SPECIFIC SETTINGS
───────────────────────────────────────────────────────────── */

if (!defined('COMPANY_NAME')) {
    define('COMPANY_NAME', 'TheKatalystGroup');
}

if (!defined('COMPANY_PHONE')) {
    define('COMPANY_PHONE', '(385) 323-2290');
}

if (!defined('CONTACT_EMAIL')) {
    define('CONTACT_EMAIL', 'admin@thekatalyst.group');
}

if (!defined('LACRM_API_KEY')) {
  $k = getenv('LACRM_API_KEY');
  if ($k === false || trim($k) === '') {
    $k = ''; // optional fallback: paste key here if you insist (not ideal)
  }
  define('LACRM_API_KEY', trim((string)$k));
}

if (!defined('LACRM_ASSIGNED_TO')) {
    define('LACRM_ASSIGNED_TO', getenv('LACRM_ASSIGNED_TO') ?: '');
}

if (!defined('SEND_TO_EMAIL')) {
    define('SEND_TO_EMAIL', [
        'admin@thekatalyst.group',
    ]);
}

if (!defined('SEND_TO_SMS')) {
    define('SEND_TO_SMS', [
        '2082502488@txt.att.net',
        '3857895030@txt.att.net',
    ]);
}

/* ─────────────────────────────────────────────────────────────
   4) ENVIRONMENT & DEBUG
───────────────────────────────────────────────────────────── */

if (!defined('APP_ENV')) {
    define('APP_ENV', getenv('APP_ENV') ?: 'production');
}

if (!defined('DEBUG')) {
    define('DEBUG', APP_ENV !== 'production');
}