<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home4Paws - Add Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Sidebar Section Starts -->
    <div class="menu">
        <h2 class="text-center">Admin Panel</h2>
        <ul>
            <li><a href="index.php" ><i class="fas fa-home"></i> Home</a></li>
            <li><a href="manage-admin.php" class="active"><i class="fas fa-user-shield"></i> Admin</a></li>
            <li><a href="manage-category.php"><i class="fas fa-list-alt"></i> Category</a></li>
            <li><a href="manage-pet.php"><i class="fas fa-paw"></i> Pet</a></li>
            <li><a href="manage-adopt.php"><i class="fas fa-heart"></i> Adopt</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <!-- Sidebar Section Ends -->
    
    <div class="main-content">
        <div class="wrapper text-center">
            <h1>Add Admin</h1>
            <br>
            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // Display session message
                unset($_SESSION['add']);
            }
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name </td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    // Processing form data when submitted
    if(isset($_POST['submit']))
    {
        // Get data from form
        $full_name = $_POST["full_name"];
        $username = $_POST["username"];
        $password = $_POST["password"]; // Store password in plain text


        // Insert query
        $sql = "INSERT INTO tbl_admin SET fname='$full_name', uname='$username', pw='$password'";

        
        // Execute query
        $res = mysqli_query($conn, $sql);

        // Data insertion checking
        if($res == true)
        {
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
    ?>

</body>
</html>
