<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home4Paws - Add Category</title>
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
            <li><a href="manage-category.php" class="active"><i class="fas fa-list-alt"></i> Category</a></li>
            <li><a href="manage-pet.php"><i class="fas fa-paw"></i> Pet</a></li>
            <li><a href="manage-adopt.php"><i class="fas fa-heart"></i> Adopt</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <!-- Sidebar Section Ends -->
    
    <div class="main-content">
        <div class="wrapper text-center">
            <h1 class="org-color">Add Category</h1>
            <br><br>
            <?php
            if (isset($_SESSION['add-cat1'])) {
                echo $_SESSION['add-cat1'];
                unset($_SESSION['add-cat1']);
            }
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Category Title</td>
                        <td><input type="text" name="title" placeholder="Enter Category Title"></td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="feature" value="Yes">Yes
                            <input type="radio" name="feature" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $featured = isset($_POST['feature']) ? $_POST['feature'] : "No";
        $active = isset($_POST['active']) ? $_POST['active'] : "No";
        $image_name = "";

        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $image_name = "Pet_Category" . rand(0, 9999) . '.' . $ext;
            $source = $_FILES['image']['tmp_name'];
            $destination = "../images/category/" . $image_name;
            
            if (!move_uploaded_file($source, $destination)) {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                header('location:' . SITEURL . 'admin/add-category.php');
                die();
            }
        }

        $sql = "INSERT INTO tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";
        $res = mysqli_query($conn, $sql);
        
        if ($res) {
            $_SESSION['add-cat'] = "<div class='success'>Category Added Successfully</div>";
            header("location:" . SITEURL . "admin/manage-category.php");
        } else {
            $_SESSION['add-cat1'] = "<div class='error'>Failed to Add Category</div>";
            header('location:' . SITEURL . 'admin/add-category.php');
        }
    }
    ?>

</body>
</html>
