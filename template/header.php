<?php 
    $requestPath = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    
    if ($requestPath === '') {
        $requestPath = 'home';
    }

    switch ($requestPath) {
        case 'home':
            $pageTitle = 'Utah New Construction Experts';
            break;
        case 'services':
            $pageTitle = 'Our Services - Builder Marketing &amp; Sales';
            break;
        case 'pricing':
            $pageTitle = 'Pricing – Flat-Rate Builder Sales Model';
        break;
        case 'contact-us':
            $pageTitle = 'Contact The Katalyst Group';
            break;
        default:
            $pageTitle = 'The Katalyst Group';
            break;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    <link rel="stylesheet" type="text/css" href="styles/main.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script></head>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<body>
    <main>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-uppercase" href="/">
      <img src="/images/logo-white.webp" alt="Logo" height="95" class="me-2">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link px-3 fw-medium <?php echo ($requestPath == 'home') ? 'active' : ''; ?>" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 fw-medium <?php echo ($requestPath == 'services') ? 'active' : ''; ?>" href="/services">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 fw-medium <?php echo ($requestPath == 'pricing') ? 'active' : ''; ?>" href="/pricing">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 fw-medium <?php echo ($requestPath == 'contact-us') ? 'active' : ''; ?>" href="/contact-us">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>