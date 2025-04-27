<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Adopt Request</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
   <!-- Sidebar Section Starts -->
   <div class="menu">
        <h2 class="text-center">Admin Panel</h2>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="manage-admin.php"><i class="fas fa-user-shield"></i> Admin</a></li>
            <li><a href="manage-category.php"><i class="fas fa-list-alt"></i> Category</a></li>
            <li><a href="manage-pet.php"><i class="fas fa-paw"></i> Pet</a></li>
            <li><a href="manage-adopt.php" class="active"><i class="fas fa-heart"></i> Adopt</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <!-- Sidebar Section Ends -->

    <div class="main-content">
        <div class="wrapper">
            <h3>Update Adopt Request</h3>
            <br><br>

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_adopt WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                if ($res == true && mysqli_num_rows($res) == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $pet = $row['pet'];
                    $age = $row['age'];
                    $gender = $row['gender'];
                    $status = $row['status'];
                    $adoptee_name = $row['adoptee_name'];
                    $adoptee_contact = $row['adoptee_contact'];
                    $adoptee_email = $row['adoptee_email'];
                    $adoptee_address = $row['adoptee_address'];
                } else {
                    header('location:' . SITEURL . 'admin/manage-adopt.php');
                }
            } else {
                header('location:' . SITEURL . 'admin/manage-adopt.php');
            }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr><td>Pet Name</td><td><b><?php echo $pet; ?></b></td></tr>
                    <tr><td>Age</td><td><input type="text" name="age" value="<?php echo $age; ?>"></td></tr>
                    <tr><td>Gender</td><td><input type="text" name="gender" value="<?php echo $gender; ?>"></td></tr>
                    <tr><td>Adoptee Name:</td><td><input type="text" name="adoptee_name" value="<?php echo $adoptee_name; ?>"></td></tr>
                    <tr><td>Adoptee Contact:</td><td><input type="text" name="adoptee_contact" value="<?php echo $adoptee_contact; ?>"></td></tr>
                    <tr><td>Adoptee Email:</td><td><input type="text" name="adoptee_email" value="<?php echo $adoptee_email; ?>"></td></tr>
                    <tr><td>Adoptee Address:</td><td><textarea name="adoptee_address" cols="30" rows="5"><?php echo $adoptee_address; ?></textarea></td></tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status">
                                <option <?php if ($status == "Requested") echo "selected"; ?> value="requested">Requested</option>
                                <option <?php if ($status == "Approved") echo "selected"; ?> value="approved">Approved</option>
                                <option <?php if ($status == "Done") echo "selected"; ?> value="done">Done</option>
                                <option <?php if ($status == "Cancelled") echo "selected"; ?> value="cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Request" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $age = $_POST['age'];
                $gender = $_POST['gender'];
                $status = ucwords($_POST['status']);
                $adoptee_name = $_POST['adoptee_name'];
                $adoptee_contact = $_POST['adoptee_contact'];
                $adoptee_email = $_POST['adoptee_email'];
                $adoptee_address = $_POST['adoptee_address'];

                $sql2 = "UPDATE tbl_adopt SET age='$age',gender='$gender', status='$status', adoptee_name='$adoptee_name', adoptee_contact='$adoptee_contact', adoptee_email='$adoptee_email', adoptee_address='$adoptee_address' WHERE id=$id";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    $_SESSION['update'] = "<div class='success text-center'>Pet Adoption Request Updated Successfully.</div>";
                } else {
                    $_SESSION['update'] = "<div class='error text-center'>Failed To Update Pet Adoption Request.</div>";
                }
                header('location:' . SITEURL . 'admin/manage-adopt.php');
            }
            ?>
        </div>
    </div>

</body>
</html>
