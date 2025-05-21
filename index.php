<?php
declare(strict_types=1);

// 1) Bootstrap
require_once __DIR__ . '/protected/functions.php';
require_once __DIR__ . '/protected/configs.php';  // defines $page from REQUEST_URI

// 2) Whitelist your slugs
$standardContent = __DIR__ . '/pages/' . $page . '.php';
$landingContent  = __DIR__ . '/landing_pages/' . $page . '.php';

if (!file_exists($standardContent) && !file_exists($landingContent)) {
    http_response_code(404);
    $page = '404';
}

// 3) Page Titles and Meta (optional)
switch ($page) {
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


// 4) Render
$landingContent = __DIR__ . '/landing_pages/' . $page . '.php';
$standardContent = __DIR__ . '/pages/' . $page . '.php';

if (is_readable($landingContent)) {
    require_once __DIR__ . '/template/landing-header.php';
    require $landingContent;
    require_once __DIR__ . '/template/landing-footer.php';
} else {
    require_once __DIR__ . '/template/header.php';
    require $standardContent;
    require_once __DIR__ . '/template/footer.php';
}