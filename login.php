<?php
include('config/constants.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); 

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($password === $row['password']) { 
            $_SESSION['user_logged_in'] = true;  
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_name'] = $row['full_name'];
            
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password!";
        }
    } else {
        $_SESSION['error'] = "No account found with that email!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Home4Paws</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 -->
</head>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector(".login-form");

    loginForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission

        Swal.fire({
            title: "Signing in...",
            text: "Please wait while we verify your credentials.",
            icon: "info",
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();

                // Simulate server processing time
                setTimeout(() => {
                    fetch("", {
                        method: "POST",
                        body: new FormData(loginForm),
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data.includes("Invalid password!") || data.includes("No account found")) {
                            Swal.fire({
                                title: "Login Failed!",
                                text: "Invalid email or password. Please try again.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Success!",
                                text: "You have logged in successfully.",
                                icon: "success",
                                confirmButtonColor: '#8B7355',
                                confirmButtonText: "OK"
                            }).then(() => {
                                window.location.href = "index.php"; 
                            });
                        }
                    });
                }, 1500); 
            }
        });
    });
});
</script>

<body>

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
                <a href="login.php" class="btn btn-ghost">Log in</a>
                <a href="register.php" class="btn btn-primary">Sign up</a>
            </div>
        </nav>
        <button class="mobile-menu-btn">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<main class="main-content">
    <div class="login-container">
        <div class="login-card">
            <div class="form-header">
                <div class="pet-image">
                    <img src="images/download (3).jpeg" alt="Cute pet illustration" />
                </div>
                <h1>Welcome Back!</h1>
                <p>Sign in to find your perfect furry friend</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <p class="error-msg"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
            <?php endif; ?>

            <form method="POST" action="" class="login-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Sign In</button>
            </form>

            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </div>
</main>

<script src="main.js"></script>
</body>
</html>
