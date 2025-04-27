<?php
    include('config/constants.php');


    // Check if user is logged in
    $isLoggedIn = isset($_SESSION['user']);
    $username = $isLoggedIn ? $_SESSION['user']['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home4Paws - Find Your Perfect Pet</title>
  <link rel="stylesheet" href="css/style1.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="icon" href="images/favicon.png" />
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <a href="<?php echo SITEURL; ?>" class="logo"><i class="fa-solid fa-paw"></i>Home4Paws</a>
            <nav class="nav">
                <ul class="nav-links">
                    <li><a href="<?php echo SITEURL; ?>" class="active">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>pets.php">Pets</a></li>
                    <li><a href="<?php echo SITEURL; ?>vet-community.php">Services</a></li>
                    <li><a href="<?php echo SITEURL; ?>about.php">About Us</a></li>
                </ul>
                <div class="auth-buttons">
                    <?php if ($isLoggedIn): ?>
                        <span class="username">Welcome, <?php echo htmlspecialchars($username); ?>!</span>
                        <a href="logout.php" class="btn btn-ghost">Log Out</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-ghost">Log in</a>
                        <a href="register.php" class="btn btn-primary">Sign up</a>
                    <?php endif; ?>
                </div>
            </nav>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Adopt, <span>Don't Shop.</span></h1>
                <p>Find your perfect companion and give them a forever home. Our adoption process is simple, transparent, and focused on both pet and adopter happiness.</p>
                <div class="hero-buttons">
                    <a href="pets.php" class="btn btn-primary">Find a Pet</a>
                    <a href="vet-community.php" class="btn btn-outline">Our Services</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="images/menu-dog-6.png" alt="Hero Dog">
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <div class="container">
            <h2>How It Works</h2>
            <div class="steps">
                <div class="step">
                    <div class="step-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Find Your Pet</h3>
                    <p>Select a pet from our adoption list.</p>
                </div>
                <div class="step">
                    <div class="step-icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <h3>Know Your Pet</h3>
                    <p>Schedule a visit with the chosen one.</p>
                </div>
                <div class="step">
                    <div class="step-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3>Take Your Pet Home</h3>
                    <p>Follow the adoption process.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <i class="fa-solid fa-paw"></i>Home4Paws
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                        <li><a href="<?php echo SITEURL; ?>pets.php">Pets</a></li>
                        <li><a href="<?php echo SITEURL; ?>vet-community.php">Services</a></li>
                        <li><a href="<?php echo SITEURL; ?>about.php">About Us</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact Us</h3>
                    <p>Address: Mumbai, India</p>
                    <p>Phone: 673-241-333</p>
                    <p>Email: home4pawsinfo@gmail.com</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Home4Paws. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="main.js"></script>
</body>
</html>
