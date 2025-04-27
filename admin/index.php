<?php
include('../config/constants.php');
if (!isset($_SESSION['admin'])) {
    $_SESSION['no-login'] = "<div class='error'>Please login to access Admin Panel.</div>";
    header("Location: " . SITEURL . "admin/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home4Paws - Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <!-- Sidebar Section Starts -->
    <div class="menu">
        <h2 class="text-center">Admin Panel</h2>
        <ul>
            <li><a href="index.php" class="active"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="manage-admin.php"><i class="fas fa-user-shield"></i> Admin</a></li>
            <li><a href="manage-category.php"><i class="fas fa-list-alt"></i> Category</a></li>
            <li><a href="manage-pet.php"><i class="fas fa-paw"></i> Pet</a></li>
            <li><a href="manage-adopt.php"><i class="fas fa-heart"></i> Adopt</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <!-- Sidebar Section Ends -->
    <!-- Main Content Section Starts -->
    <div class="main-content">
        <h3>Dashboard</h3>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']); // Clear the message once shown
        }
        ?>
        <div class="dashboard-cards">
            <div class="dashboard-card">
                <i class="fa fa-th-large"></i>
                <h2>
                    <?php
                    $sql = "SELECT * FROM tbl_category ";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    echo $count;
                    ?>
                </h2>
                <p>Categories</p>
            </div>
            <div class="dashboard-card">
                <i class="fa fa-paw"></i>
                <h2>
                    <?php
                    $sql2 = "SELECT * FROM tbl_pet ";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    echo $count2;
                    ?>
                </h2>
                <p>Pets</p>
            </div>
            <div class="dashboard-card">
                <i class="fa fa-list"></i>
                <h2>
                    <?php
                    $sql3 = "SELECT * FROM tbl_category WHERE featured='yes' ";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);
                    echo $count3;
                    ?>
                </h2>
                <p>Featured Categories</p>
            </div>
            <div class="dashboard-card">
                <i class="fa fa-star"></i>
                <h2>
                    <?php
                    $sql4 = "SELECT * FROM tbl_pet WHERE featured='yes' ";
                    $res4 = mysqli_query($conn, $sql4);
                    $count4 = mysqli_num_rows($res4);
                    echo $count4;
                    ?>
                </h2>
                <p>Featured Pets</p>
            </div>
        </div>
    </div>
    <!-- Main Content Section Ends -->
    <script>
        // Wait for the DOM to fully load
        document.addEventListener("DOMContentLoaded", function () {
            // Select all elements with the class 'success' or 'error'
            const messages = document.querySelectorAll('.success, .error');

            // Loop through each message and set a timeout to fade them out
            messages.forEach(function (message) {
                setTimeout(function () {
                    message.style.transition = "opacity 1s ease";
                    message.style.opacity = "0";

                    // Completely hide the element after the fade-out transition
                    setTimeout(function () {
                        message.style.display = "none";
                    }, 1000); // Matches the transition duration
                }, 3000); // 3 seconds before fading out
            });
        });
    </script>
</body>

</html>