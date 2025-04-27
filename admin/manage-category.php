<?php
include('../config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home4Paws - Manage Category</title>
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

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper text-center">
            <h3 class="text-center all-caps">Manage Category</h3>
            <br>
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br><br>

            <?php
            $session_keys = ['add-cat', 'delete', 'img-delete', 'update-cat'];
            foreach ($session_keys as $key) {
                if (isset($_SESSION[$key])) {
                    echo $_SESSION[$key];
                    unset($_SESSION[$key]);
                }
            }
            ?>
            <br>
            <div class="table-responsive">
                <table class="tbl-full">
                    <tr>
                        <th>SI</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM tbl_category";
                    $res = mysqli_query($conn, $sql);
                    if ($res == true) {
                        $count = mysqli_num_rows($res);
                        $sn = 1;
                        if ($count > 0) {
                            while ($rows = mysqli_fetch_assoc($res)) {
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $image_name = $rows['image_name'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php
                                        if ($image_name != "") {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="150px"
                                                height="100px">
                                            <?php
                                        } else {
                                            echo "<div class='error'>No image selected</div>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>"
                                            class="btn-secondary-category">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                            class="btn-ter-category">Delete Category</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">No category</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
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