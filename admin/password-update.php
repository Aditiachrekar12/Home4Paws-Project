<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update Password</title>
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
        <div class="wrapper">
            <h1>Update Password</h1>
            <br><br>

            <?php if(isset($_GET['id'])) { $id = $_GET['id']; } ?>
            
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password</td>
                        <td><input type="password" name="cur_password" placeholder="Current password"></td>
                    </tr>
                    <tr>
                        <td>New Password</td>
                        <td><input type="password" name="new_password" placeholder="New password"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    
    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $cur_password = md5($_POST['cur_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$cur_password'";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                if ($confirm_password == $new_password) {
                    $sql_pass = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                    $res_pass = mysqli_query($conn, $sql_pass);

                    if ($res_pass == true) {
                        $_SESSION['password_user'] = "<div class='success'>Password Updated</div>";
                        header("location:" . SITEURL . 'admin/manage-admin.php');
                    }
                } else {
                    $_SESSION['password_user2'] = "<div class='error'>Passwords do not match. Try Again.</div>";
                    header("location:" . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                $_SESSION['no_user'] = "<div class='error'>Information Incorrect</div>";
                header("location:" . SITEURL . 'admin/manage-admin.php');
            }
        }
    }
    ?>
    

</body>
</html>
