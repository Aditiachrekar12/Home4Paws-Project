<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home4Paws - Update Admin</title>
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
            <h1>Update Admin</h1>
            <br><br>

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_admin WHERE id=$id";
                $res = mysqli_query($conn, $sql);

                if ($res == true && mysqli_num_rows($res) == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['fname'];
                    $username = $row['uname'];
                } else {
                    header("location:" . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                header("location:" . SITEURL . 'admin/manage-admin.php');
            }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name </td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin Info" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php 
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $sql = "UPDATE tbl_admin SET fname='$full_name', uname='$username' WHERE id='$id'";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['update'] = "<div class='success'>Admin Updated</div>";
        } else {
            $_SESSION['update'] = "<div class='error'>Admin cannot be Updated</div>";
        }
        header("location:" . SITEURL . 'admin/manage-admin.php');
    }
    ?>


</body>
</html>
