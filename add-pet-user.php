<?php
    ob_start(); // Start output buffering
    include('config/constants.php');
?>

<style>

</style>

<div class="main-content">
    <div class="wrapper text-center">
        <h1 class="org-color">Add Pet</h1>
        <br><br><br>
        <?php
        if(isset($_SESSION['add-pet1'])) {
            echo $_SESSION['add-pet1'];
            unset($_SESSION['add-pet1']);
        }
        ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Pet Title </td>
                    <td><input type="text" name="title" placeholder="Enter Pet Title"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td> <input type="text" name="description" cols="30" rows="7" placeholder="Pet Description"> </td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td> <input type="file" name="image"> </td>
                </tr>
                <tr>
                    <td>Location </td>
                    <td><input type="text" name="location" placeholder="Enter Pet Location"></td>
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
                    <td>Active</td>
                    <td><input type="radio" name="active" value="Yes">Yes
                         <input type="radio" name="active" value="No">No</td>
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
    $description = $_POST['description'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
    $active = isset($_POST['active']) ? $_POST['active'] : "No";

    // Image Upload
    if(isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if($image_name != "") {
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_name = "Pet_name" . rand(0, 99999) . '.' . $ext;
            $source = $_FILES['image']['tmp_name'];
            $destination = "../images/pet/" . $image_name;
            $upload = move_uploaded_file($source, $destination);
            if($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Please Select an Image</div>";
                header('location:' . SITEURL . 'admin/add-pet-user.php');
                die();
            }
        }
    } else {
        $image_name = "";
    }

    // SQL Insert
    $sql2 = "INSERT INTO tbl_pet SET 
                title='$title', location='$location', description='$description', 
                image_name='$image_name', category_id=$category, featured='$featured', active='$active'";
    $res2 = mysqli_query($conn, $sql2);
    if($res2 == true) {
        $_SESSION['add-pet'] = "<div class='success'>Pet Added</div>";
        header("location:" . SITEURL . 'admin/add-pet-user.php');
    } else {
        $_SESSION['add-pet1'] = "<div class='error'>Something went wrong</div>";
        header("location:" . SITEURL . 'admin/add-pet-user.php');
    }
}
?>

<?php
    include("partials-front/footer.php");
    ob_end_flush(); // End output buffering
?>
