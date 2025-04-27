<?php
include('config/constants.php');
 // Ensure session is started

// Check if user is logged in using the correct session key
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
$username = $isLoggedIn ? $_SESSION['user_name'] : '';
?>

<!-- contact.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Home4Paws</title>
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/style1.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script type="text/javascript"src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script>
   (function(){
      emailjs.init("3FUyGdYmMaBuecyKJ"); // Ensure this is your correct public key
   })();
</script>
<script src="email.js" defer></script>
</head>
<style>
    /* Footer Section */

    .footer-content {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
}

.footer-form form {
  border-radius: 10px;
  width: 100%; /* Change from 120% to 100% */
  max-width: 400px;
  padding: 20px;
  background-color: white;
  display: flex;
  flex-direction: column;
  box-sizing: border-box;
}

.footer-form input, .footer-form textarea {
  width: 100%; 
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid black;
  border-radius: 17px;
  font-size: 16px;
  box-sizing: border-box;
}

.footer-form button {
  width: 100%; /* Make button full width on smaller screens */
  max-width: 200px;
  background-color: black;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 25px;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
  align-self: center;
}

.footer-form button:hover {
  background-color: #333;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .footer-content {
    flex-direction: column;
    align-items: center;
  }

  .footer-form form {
    width: 90%;
  }

  .footer-form input, .footer-form textarea {
    width: 100%;
  }

  .footer-form button {
    width: 60%;
  }
}

</style>
<body class="with-background-images">
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
                    <?php if(isset($_SESSION['user_logged_in'])): ?>
                        <span class="username">Welcome, <?php echo $_SESSION['user_name']; ?>!</span>
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

    <section class="hero-about">
        <div class="container">
            <div class="hero-content">
                    <h1>About Us</h1>
                    <p>
                        Welcome to <b>Home4Paws</b>! Our mission is to help connect loving families with pets in need of a forever home. Whether you are looking for a specific breed or are interested in adopting a street dog or cat, we believe every pet deserves a chance at a happy life.
                    </p>
                    <p>
                        <b>Objective:</b> To promote pet adoption and raise awareness about the importance of adopting stray or abandoned pets, ensuring they receive the care, love, and safety they deserve.
                    </p>
                    <p>
                        By adopting pets, you not only save a life but also make room for shelters to help other animals in need. Let's make a difference together by choosing adoption and giving pets a second chance.
                    </p>
            </div>
            <div class="hero-image">
                <img src='images/cute.png'>
            </div>
        </div>
    </section>
</div>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <i class="fa-solid fa-paw"></i>Home4Paws</a>
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
                <div class="footer-form">
                <h3>Get in Touch 📧</h3>
                <form method="post">
    <input type="text" id="name" name="name" placeholder="Name" required autocomplete="name">
    <input type="email" id="email" name="email" placeholder="Email" required autocomplete="email">
    <textarea id="message" name="message" placeholder="Message" required autocomplete="off"></textarea>
    <button type="button" onclick="sendMail()">Submit</button>
</form>

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