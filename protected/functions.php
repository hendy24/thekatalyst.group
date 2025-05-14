<?php
declare(strict_types=1);

// ============================================================================
// BASE PATH (adjust as needed to point at your project root)
// ============================================================================
if (!defined('BASE_PATH')) {
    define('BASE_PATH', realpath(__DIR__ . '/..'));
}

// ============================================================================
// getPost()
//   — Loads a post’s data from a JSON file (posts/{slug}.json).
//   — Throws if the file doesn’t exist or JSON is invalid.
// ============================================================================
function getPost(string $postSlug): array
{
    // only allow alphanumeric, dash, underscore in filenames
    $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $postSlug);
    $file = BASE_PATH . '/data/posts/' . $slug . '.json';

    if (!is_readable($file)) {
        throw new RuntimeException("Post '{$slug}' not found at {$file}");
    }

    $json = file_get_contents($file);
    try {
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
        throw new RuntimeException("Error parsing JSON for post '{$slug}': " . $e->getMessage());
    }

    return $data;
}



/**
 * pr()
 *
 * Nicely dump the contents of any array (or other variable) wrapped in <pre> tags.
 *
 * @param mixed $var      The variable to dump (typically an array).
 * @param bool  $halt     If true, exits immediately after printing.
 * @return void
 */
function pr($var, bool $halt = false): void
{
    echo '<div class="debug" style="background:#f5f5f5;padding:10px;margin:10px 0;font-family:monospace;">';
    echo '<pre>';
    // Use print_r’s return parameter to capture output, then escape it
    $output = print_r($var, true);
    echo htmlspecialchars($output, ENT_QUOTES);
    echo '</pre>';
    echo '</div>';

    if ($halt) {
        exit;
    }
}

// ============================================================================
// debug()
//   — Nicely dump any variable for debugging.
//   — Automatically disabled in production (APP_ENV=production).
//   — Pass true as 2nd arg to exit immediately after printing.
// ============================================================================
function debug($var, bool $halt = false): void
{
    if (getenv('APP_ENV') === 'production') {
        return;
    }

    echo '<div style="background:#f5f5f5;padding:10px;margin:10px 0;font-family:monospace;">';
    echo '<strong>DEBUG:</strong><pre>' . htmlspecialchars(print_r($var, true), ENT_QUOTES) . '</pre>';
    echo '</div>';

    if ($halt) {
        exit;
    }
}

// ============================================================================
// getInput()
//   — Returns sanitized request data (POST preferred, falls back to GET).
//   — Uses FILTER_SANITIZE_FULL_SPECIAL_CHARS for each value.
// ============================================================================
function getInput(): array
{
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    $type   = ($method === 'POST') ? INPUT_POST : INPUT_GET;

    // sanitize all incoming scalar values; nested arrays pass through untouched
    $raw = filter_input_array($type, FILTER_DEFAULT, false) ?? [];
    $clean = [];

    array_walk_recursive($raw, function ($value, $key) use (&$clean) {
        $clean[$key] = is_string($value)
            ? filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS)
            : $value;
    });

    return $clean;
}


/**
 * Load and decode JSON from a file.
 *
 * @param  string  $filePath  Absolute or relative path to the JSON file.
 * @return array              The decoded JSON data as an associative array.
 *
 * @throws InvalidArgumentException If the file doesn’t exist or isn’t readable.
 * @throws RuntimeException         If the JSON is invalid or can’t be decoded.
 */
function getJsonData(string $filePath): array
{
    // 1) Resolve real path for better error messages
    $realPath = realpath($filePath) ?: $filePath;

    // 2) Ensure file exists and is readable
    if (!is_readable($realPath)) {
        throw new InvalidArgumentException("JSON file not found or not readable: {$realPath}");
    }

    // 3) Fetch contents
    $json = file_get_contents($realPath);
    if ($json === false) {
        throw new RuntimeException("Failed to read file contents: {$realPath}");
    }

    // 4) Decode with exceptions on error
    try {
        return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
        throw new RuntimeException("Error decoding JSON from {$realPath}: " . $e->getMessage(), 0, $e);
    }
}