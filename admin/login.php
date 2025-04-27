<?php
include('../config/constants.php');
?>
<html>
    <head>
        <title>Home4Paws-Admin Login</title>
        <link rel="stylesheet" href="../css/login-admin.css">
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="main">  	
            <div class="login">
                <form action="" method="POST">
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="text" name="username" placeholder="Username" required="">
                    <input type="password" name="password" placeholder="Password" required="">
                    <input type="submit" name="submit" value="Login" class="btn-pri">
                </form>
            </div>
        </div>
        <?php 
        if(isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login'])) {
            echo $_SESSION['no-login'];
            unset($_SESSION['no-login']);
        }
        ?>
        <script>
    // Wait for the DOM to fully load
    document.addEventListener("DOMContentLoaded", function() {
        // Select all elements with the class 'success' or 'error'
        const messages = document.querySelectorAll('.success, .error');
        
        // Loop through each message and set a timeout to fade them out
        messages.forEach(function(message) {
            setTimeout(function() {
                message.style.transition = "opacity 1s ease";
                message.style.opacity = "0";
                
                // Completely hide the element after the fade-out transition
                setTimeout(function() {
                    message.style.display = "none";
                }, 1000); // Matches the transition duration
            }, 3000); // 3 seconds before fading out
        });
    });
</script>

    </body>
</html>

<?php
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check admin login
    $sql = "SELECT * FROM tbl_admin WHERE uname = '$username' AND pw = '$password'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $_SESSION['admin'] = $username;
        $_SESSION['login'] = "<div class='success'>Admin Login Successful</div>";
        header("Location: " . SITEURL . "admin/index.php");
        exit();
    } else {
        $_SESSION['login'] = "<div class='error'>Invalid Username or Password</div>";
        header("Location: " . SITEURL . "admin/login.php");
        exit();
    }
}
?>
