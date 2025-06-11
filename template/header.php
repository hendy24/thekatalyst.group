
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($metaTag); ?>">
    <?php if (isset($metaTag2)) echo $metaTag2; ?>

    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <link rel="icon" type="image/webp" href="/favicon.webp">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles/main.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HK63C8J5V5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-HK63C8J5V5');
    </script>
</head>

<body>
    <main>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-uppercase" href="<?php echo BASE_URL; ?>">
      <img src="<?php echo IMAGES; ?>/logo-white.webp" alt="Logo" height="95" class="me-2">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link px-3 fw-medium <?php echo ($requestPath == 'home') ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 fw-medium <?php echo ($requestPath == 'our-model') ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/our-model">Our Model</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 fw-medium <?php echo ($requestPath == 'services') ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/services">Services</a>
        </li>

        <li class="nav-item">
          <a class="nav-link px-3 fw-medium <?php echo ($requestPath == 'contact-us') ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/contact-us">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>