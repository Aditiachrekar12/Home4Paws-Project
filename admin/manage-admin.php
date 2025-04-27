<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home4Paws - Manage Admin</title>
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
            <li><a href="manage-admin.php" class="active"><i class="fas fa-user-shield"></i> Admin</a></li>
            <li><a href="manage-category.php"><i class="fas fa-list-alt"></i> Category</a></li>
            <li><a href="manage-pet.php"><i class="fas fa-paw"></i> Pet</a></li>
            <li><a href="manage-adopt.php"><i class="fas fa-heart"></i> Adopt</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <!-- Sidebar Section Ends -->

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper text-center">
            <h3 class="text-center all-caps">Manage Admin</h3>
            <br>
            <br>
            <!-- Button for new admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br>
            <br>

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if (isset($_SESSION['no_user'])) {
                echo $_SESSION['no_user'];
                unset($_SESSION['no_user']);
            }
            if (isset($_SESSION['password_user2'])) {
                echo $_SESSION['password_user2'];
                unset($_SESSION['password_user2']);
            }
            if (isset($_SESSION['password_user'])) {
                echo $_SESSION['password_user'];
                unset($_SESSION['password_user']);
            }
            ?>
            <br>
            <div class="table-responsive">
                <table class="tbl-full">
                    <tr>
                        <th>SI</th>
                        <th>FullName</th>
                        <th>UserName</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM tbl_admin";
                    $res = mysqli_query($conn, $sql);
                    if ($res == true) {
                        $count = mysqli_num_rows($res);
                        $sn = 1;
                        if ($count > 0) {
                            while ($rows = mysqli_fetch_assoc($res)) {
                                $id = $rows['id'];
                                $full_name = $rows['fname'];
                                $username = $rows['uname'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/password-update.php?id=<?php echo $id; ?>"
                                            class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                                            class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                                            class="btn-ter">Delete Admin</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
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