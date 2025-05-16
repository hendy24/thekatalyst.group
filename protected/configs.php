<?php
declare(strict_types=1);

// ───────────────────────────────────────────────────────────────────────────────
// 1) BASE CONSTANTS
// ───────────────────────────────────────────────────────────────────────────────
define('DOC_ROOT',           realpath($_SERVER['DOCUMENT_ROOT']) ?: '');
define('BASE_URL',           rtrim(
    (
        // behind proxies?
        (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])
            ? $_SERVER['HTTP_X_FORWARDED_PROTO']
            : (($_SERVER['HTTPS'] ?? 'off') !== 'off' || $_SERVER['SERVER_PORT'] == 443
                ? 'https'
                : 'http')
        )
        . '://' . ($_SERVER['HTTP_HOST'] ?? '')
    ),
    '/'
));
define('IMAGES', BASE_URL . '/images');

// ───────────────────────────────────────────────────────────────────────────────
// 2) REQUEST SLUG (no “.php” or “.json” — let your front-controller decide)
// ───────────────────────────────────────────────────────────────────────────────
$rawPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '/';
$slug    = trim($rawPath, '/');           // "/about/team/" → "about/team"
$slug    = basename($slug) ?: 'home';      // keep only last segment, default to home
// sanitize to letters, numbers, dash, underscore
$page    = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);

// expose $page for index.php
// ───────────────────────────────────────────────────────────────────────────────

// ───────────────────────────────────────────────────────────────────────────────
// 3) SITE-SPECIFIC SETTINGS
// ───────────────────────────────────────────────────────────────────────────────
define('COMPANY_NAME',       'TheKatalystGroup');
define('COMPANY_PHONE',      '(385) 323-2290');
define('CONTACT_EMAIL',      'kemish@tbcutah.com');

// ───────────────────────────────────────────────────────────────────────────────
// 4) (Optional) Environment & debug flags
// ───────────────────────────────────────────────────────────────────────────────
if (!defined('APP_ENV')) {
    define('APP_ENV', getenv('APP_ENV') ?: 'production');
}
define('DEBUG', APP_ENV !== 'production');