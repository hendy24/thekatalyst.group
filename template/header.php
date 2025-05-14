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
    <title>TBC Real Estate | <?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles/main.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="../images/tbcrealestate_logo.webp" height="95px" alt="TBC Real Estate Logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo ($page == 'home.php') ? 'active' : '';?>">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item <?php echo ($page == 'for-builders.php') ? 'active' : '';?>">
                        <a class="nav-link" href="/for-builders">For Builders</a>
                    </li>
                    <!-- Nav Item with Dropdown -->
                    <li class="nav-item dropdown">
                        <span class="nav-link dropdown-toggle" id="navbarDropdown" role="button">
                            Our Communities
                        </span>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/priority-homes">Loveless Estates</a></li>
                        </ul>
                    </li>
                    <li class="nav-item <?php echo ($page == 'home-buyers.php') ? 'active' : '';?>">
                        <a class="nav-link" href="/home-buyers">Home Buyers</a>
                    </li>
                    <li class="nav-item <?php echo ($page == 'areas-we-serve.php') ? 'active' : '';?>">
                        <a class="nav-link" href="/areas-we-serve">Areas We Serve</a>
                    </li>
                    <li class="nav-item <?php echo ($page == 'contact-us.php') ? 'active' : '';?>">
                        <a class="nav-link" href="/contact-us">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
