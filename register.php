<?php
include('config/constants.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); 

    // Check if email exists
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check_email);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "Email already registered!";
    } else {
        $query = "INSERT INTO users (full_name, email, password) VALUES ('$fullName', '$email', '$password')";
        
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Registration successful!";
            header("Location: register.php"); 
            exit();
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Home4Paws</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    <?php if (isset($_SESSION['error'])): ?>
        Swal.fire({
            title: "Error!",
            text: "<?php echo $_SESSION['error']; ?>",
            icon: "error",
            confirmButtonText: "OK"
        });
        <?php unset($_SESSION['error']); ?>
    <?php elseif (isset($_SESSION['success'])): ?>
        Swal.fire({
            title: "Success!",
            text: "<?php echo $_SESSION['success']; ?>",
            icon: "success",
            confirmButtonText: "OK"
        }).then(() => {
            window.location.href = "login.php"; 
        });
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
});
</script>

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
    <div class="register-container">
        <div class="register-card">
            <div class="form-header">
                <div class="pet-image">
                    <img src="images/download (3).jpeg" alt="Cute pet illustration" />
                </div>
                <h1>Create an Account</h1>
                <p>Join us and find your perfect furry companion</p>
            </div>

            <form method="POST" action="" class="register-form">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <div class="input-group">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="fullName" placeholder="Enter your full name" required>
                    </div>
                </div>

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
                        <input type="password" name="password" placeholder="Create a password" required>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Create Account</button>
            </form>

            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>
</main>

<script src="main.js"></script>
</body>
</html>