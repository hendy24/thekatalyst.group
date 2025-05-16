<?php 
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($currentPage == 'index.php') {
        $pageTitle = 'Utah New Construction Experts';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>the katalyst group | <?php echo $pageTitle; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    <link rel="stylesheet" type="text/css" href="styles/main.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script></head>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<body>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="../images/logo-white.webp" height="95px" alt="the katalyst group Logo">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item <?php echo ($page == 'home.php') ? 'active' : '';?>">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item <?php echo ($page == 'services.php') ? 'active' : '';?>">
                            <a class="nav-link" href="/services">Services</a>
                        </li>
                        <li class="nav-item <?php echo ($page == 'pricing.php') ? 'active' : '';?>">
                            <a class="nav-link" href="/pricing">Pricing</a>
                        </li>
                        <li class="nav-item <?php echo ($page == 'contact-us.php') ? 'active' : '';?>">
                            <a class="nav-link" href="/contact-us">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>