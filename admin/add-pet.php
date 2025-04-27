<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home4Paws - Add Pet</title>
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
            <li><a href="manage-admin.php"><i class="fas fa-user-shield"></i> Admin</a></li>
            <li><a href="manage-category.php"><i class="fas fa-list-alt"></i> Category</a></li>
            <li><a href="manage-pet.php" class="active"><i class="fas fa-paw"></i> Pet</a></li>
            <li><a href="manage-adopt.php"><i class="fas fa-heart"></i> Adopt</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <!-- Sidebar Section Ends -->

    <div class="main-content">
        <div class="wrapper text-center">
            <h1 class="org-color">Add Pet</h1>
            <br><br>
            
            <?php
            if(isset($_SESSION['add-pet1'])) {
                echo $_SESSION['add-pet1'];
                unset($_SESSION['add-pet1']);
            }
            ?>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Pet Title</td>
                        <td><input type="text" name="title" placeholder="Enter Pet Title"></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><input type="text" name="gender" placeholder="Pet Gender"></td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td><input type="text" name="age" placeholder="Enter Pet Age"></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">
                                <?php
                                $sql = "SELECT * FROM tbl_category";
                                $res = mysqli_query($conn, $sql);
                                if($res == true) {
                                    $count = mysqli_num_rows($res);
                                    if($count > 0) {
                                        while($row = mysqli_fetch_assoc($res)) {
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            echo "<option value='$id'>$title</option>";
                                        }
                                    } else {
                                        echo "<option value='0'>No Category</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
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
                            <input type="submit" name="submit" value="Add Pet" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['submit'])) {
        $title = $_POST['title'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $category = $_POST['category'];
        $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
        $active = isset($_POST['active']) ? $_POST['active'] : "No";

        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            $image_name = $_FILES['image']['name'];
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_name = "Pet_name" . rand(0,99999) . '.' . $ext;
            $source = $_FILES['image']['tmp_name'];
            $destination = "../images/pet/" . $image_name;
            $upload = move_uploaded_file($source, $destination);
            if($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Please Select an Image</div>";
                header('location:' . SITEURL . 'admin/add-pet.php');
                die();
            }
        } else {
            $image_name = "";
        }

        $sql2 = "INSERT INTO tbl_pet SET title='$title', age='$age', gender='$gender', image_name='$image_name', category_id=$category, featured='$featured', active='$active'";
        $res2 = mysqli_query($conn, $sql2);
        if($res2 == true) {
            $_SESSION['add-pet'] = "<div class='success'>Pet Added</div>";
            header("location:" . SITEURL . "admin/manage-pet.php");
        } else {
            $_SESSION['add-pet1'] = "<div class='error'>Something went wrong</div>";
            header("location:" . SITEURL . "admin/add-pet.php");
        }
    }
    ?>

</body>
</html>
