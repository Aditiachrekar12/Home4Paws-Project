 <?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home4Paws - Update Pet</title>
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
            <li><a href="manage-pet.php"  class="active"><i class="fas fa-paw"></i> Pet</a></li>
            <li><a href="manage-adopt.php"><i class="fas fa-heart"></i> Adopt</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <!-- Sidebar Section Ends -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Pet Details</h1>
        <br> <br>


        <?php
        //step1
        //get the id
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //sql query
            //step2
            $sql = "SELECT * FROM tbl_pet WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {

                //query is successful
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    //step3
                    //get row
                    $rows = mysqli_fetch_assoc($res);
                    $id = $rows['id'];
                    $gender = $rows['gender'];
                    $age = $rows['age'];
                    $title = $rows['title'];
                    $cur_image_name = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];
                } else {
                    //redirect
                    header("location:" . SITEURL . 'admin/manage-pet.php');
                }
            }
        } else {
            header("location:" . SITEURL . 'admin/manage-pet.php');
        }

        ?>


        <?php
        //step 4 form part
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Pet Title </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>



                </tr>
                <tr>
                    <td>Age</td>
                    <td><input type="text" name="age" value="<?php echo $age; ?>"></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><input type="text" name="gender" value="<?php echo $gender; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                        if ($cur_image_name != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/pet/<?php echo $cur_image_name; ?>" width="150px"
                                height="100px">

                            <?php

                        } else {
                            echo "<div class='error' >No Image was updated before </div>";
                        }


                        ?>
                    </td>



                </tr>


                <tr>
                    <td>New Image</td>
                    <td> <input type="file" name="image"> </td>



                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="feature"
                            value="Yes">Yes
                        <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="feature"
                            value="No">No
                    </td>
                </tr>




                <tr>
                    <td>Active</td>
                    <td><input <?php if ($active == "Yes") {
                        echo "checked";
                    } ?> type="radio" name="active"
                            value="Yes">Yes
                        <input <?php if ($active == "No") {
                            echo "checked";
                        } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="cur_image" value="<?php echo $cur_image_name; ?>">
                        <input type="submit" name="submit" value="Update Pet" class="btn-secondary">
                    </td>
                </tr>

            </table>



        </form>


    </div>

</div>

<?php

//After form comes its submission file
//step5
//updating in dbms
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    if (isset($_POST['feature'])) {
        $featured = $_POST['feature'];
    } else {
        $featured = "No";
    }

    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "No";
    }

    //if image is selected
    if (isset($_FILES['image']['name'])) {
        // image name, source, destination
        $new_image_name = $_FILES['image']['name'];


        //we can add category even if we don't upload an image
        if ($new_image_name != "") {
            //this means image is available
            //get extention
            $ext2 = explode('.', $new_image_name); //jpg,png
            $ext = end($ext2);
            $image_name = "Pet_Category" . rand(0, 9999) . '.' . $ext;
            $source = $_FILES['image']['tmp_name'];
            $destination = "../images/pet/" . $image_name;

            $upload = move_uploaded_file($source, $destination);

            //checking upload
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error' >Please Select an Image </div>";
                header('location:' . SITEURL . 'admin/add-pet.php');
                die(); //process will be stopped

            }
            if ($_POST['cur_image'] != "") {
                //current image has an image
                $remove_path = "../images/pet/" . $_POST['cur_image'];
                $remove = unlink($remove_path);
            }
        } else {
            $image_name = $_POST['cur_image']; // default image when image is not selected MAS
        }
    } else {
        $image_name = $_POST['cur_image']; // default image when button is not clicked MAS
    }


    $sql1 = "UPDATE tbl_pet SET
            title ='$title', image_name='$image_name',age='$age',gender='$gender',
           featured='$featured', active='$active'  where id='$id' ";

    //Execute query
    $res1 = mysqli_query($conn, $sql1);
    if ($res1 == true) {
        $_SESSION['update-pet'] = "<div class='success'>Pet info Updated </div>";
        header("location:" . SITEURL . 'admin/manage-pet.php');
    } else {
        $_SESSION['update-pet'] = "<div class='error'>Pet info can not be Updated </div>";
        header("location:" . SITEURL . 'admin/manage-pet.php');
    }
}



?>
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



<?php
include("partials/footer.php");
?>