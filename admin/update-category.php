<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home4Paws - Update Category</title>
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
            <li><a href="manage-category.php" class="active"><i class="fas fa-list-alt"></i> Category</a></li>
            <li><a href="manage-pet.php"><i class="fas fa-paw"></i> Pet</a></li>
            <li><a href="manage-adopt.php"><i class="fas fa-heart"></i> Adopt</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <!-- Sidebar Section Ends -->

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br>

            <?php
            if(isset($_GET['id'])) {
                $id= $_GET['id'];
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                $res= mysqli_query($conn, $sql);
                if($res==true) {
                    $count = mysqli_num_rows($res);
                    if($count==1) {
                        $row= mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $featured = $row['featured'];
                        $active= $row['active'];
                        $cur_image_name=$row['image_name'];
                    } else {
                        header("location:".SITEURL.'admin/manage-category.php');
                    }
                }
            } else {
                header("location:".SITEURL.'admin/manage-category.php');
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Category Title</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>
                    <tr>
                        <td>Current Image</td>
                        <td>
                            <?php if($cur_image_name!="") { ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $cur_image_name; ?>" width="150px" height="100px">
                            <?php } else { echo "<div class='error'>No Image is selected</div>"; } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes") { echo "checked"; } ?> type="radio" name="feature" value="Yes">Yes
                            <input <?php if($featured=="No") { echo "checked"; } ?> type="radio" name="feature" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active=="Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No") { echo "checked"; } ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>"> 
                            <input type="hidden" name="cur_image" value="<?php echo $cur_image_name; ?>"> 
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $featured = isset($_POST['feature']) ? $_POST['feature'] : "No";
        $active = isset($_POST['active']) ? $_POST['active'] : "No";
        $image_name = $_POST['cur_image'];

        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            $new_image_name = $_FILES['image']['name'];
            $ext = end(explode('.', $new_image_name));
            $image_name = "Pet_Category".rand(0,9999).'.'.$ext;
            $source = $_FILES['image']['tmp_name'];
            $destination = "../images/category/".$image_name;
            
            $upload = move_uploaded_file($source, $destination);
            if(!$upload) {
                $_SESSION['upload'] = "<div class='error'>Please Select an Image</div>";
                header('location:'.SITEURL.'admin/add-category.php');
                die();
            }
            if($_POST['cur_image'] != "") {
                unlink("../images/category/".$_POST['cur_image']);
            }
        }

        $sql = "UPDATE tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active' WHERE id='$id'";
        $res = mysqli_query($conn, $sql);
        $_SESSION['update-cat'] = $res ? "<div class='success'>Category Updated</div>" : "<div class='error'>Category cannot be Updated</div>";
        header("location:".SITEURL.'admin/manage-category.php');
    }
    ?>


</body>
</html>
