<?php
declare(strict_types=1);

// 1) Bootstrap
require_once __DIR__ . '/protected/functions.php';
require_once __DIR__ . '/protected/configs.php';  // defines $page from REQUEST_URI

// 2) Whitelist your slugs
$allowedPages = ['home','areas-we-serve','contact-us','for-builders','home-buyers','mail-form','404','our-services','priority-homes'];
if (!in_array($page, $allowedPages, true)) {
    http_response_code(404);
    $page = '404';
}

// 3) Render
require_once __DIR__ . '/template/header.php';

$content = __DIR__ . '/pages/' . $page . '.php';
if (is_readable($content)) {
    require $content;
} else {
    $alt = __DIR__ . '/builders/' . $page . '.php';
    if (is_readable($alt)) {
        require $alt;
    } else {
        require __DIR__ . '/pages/404.php';
    }
}

require_once __DIR__ . '/template/footer.php';