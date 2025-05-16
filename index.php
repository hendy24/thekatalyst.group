<?php
declare(strict_types=1);

// 1) Bootstrap
require_once __DIR__ . '/protected/functions.php';
require_once __DIR__ . '/protected/configs.php';  // defines $page from REQUEST_URI

// 2) Whitelist your slugs
$allowedPages = ['home','contact-us','services', 'pricing', 'mail-form','404','priority-homes', 'our-model'];
if (!in_array($page, $allowedPages, true)) {
    http_response_code(404);
    $page = '404';
}

$requestPath = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

if ($requestPath === '') {
    $requestPath = 'home';
}

switch ($requestPath) {
    case 'home':
        $pageTitle = 'Utah\'s Premier Real Estate Marketing & Sales Partner for Home Builders';
        $metaTag = 'Explore our range of services designed to enhance your home building business, from branding to sales strategy, all tailored for the Utah market.';
        break;
    case 'services':
        $pageTitle = 'Comprehensive Marketing & Sales Services for Utah Home Builders';
        $metaTag = 'Comprehensive Marketing & Sales Services for Utah Home Builders';
        break;
    case 'pricing':
        $pageTitle = 'Transparent, Flat-Fee Pricing for Home Builder Marketing Services';
        $metaTag = 'Understand our straightforward pricing model designed to provide maximum value for Utah home builders seeking marketing and sales support.';
    break;
    case 'contact-us':
        $pageTitle = 'Connect with TheKatalyst.Group - Your Utah Home Builder Partner';
        $metaTag = 'Reach out to discuss how our marketing and sales solutions can elevate your home building business in Utah.';
        break;
    default:
        $pageTitle = 'TheKatalyst.Group';
        break;
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