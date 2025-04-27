<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home4Paws - Manage Adoption</title>
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
            <li><a href="manage-pet.php"><i class="fas fa-paw"></i> Pet</a></li>
            <li><a href="manage-adopt.php" class="active"><i class="fas fa-heart"></i> Adopt</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <!-- Sidebar Section Ends -->

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper text-center">
            <h3 class="text-center all-caps">Manage Adopt</h3>
            <br><br>
            <?php
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>
            <br><br>
            <div class="table-responsive">
                <table class="tbl">
                    <tr>
                        <th>SI</th>
                        <th>Pet</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Adoption Date</th>
                        <th>Status</th>
                        <th>Adoptee Name</th>
                        <th>Adoptee Contact</th>
                        <th>Adoptee Email</th>
                        <th>Adoptee Address</th>
                        <th>Actions</th>

                    </tr>
                    <?php
                    $sql = "SELECT * FROM tbl_adopt ORDER BY id DESC";
                    $res = mysqli_query($conn, $sql);
                    $sn = 1;
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                            <tr>
                                <td class="tbl-adopt"><?php echo $sn++; ?></td>
                                <td class="tbl-adopt"><?php echo $row['pet']; ?></td>
                                <td class="tbl-adopt"><?php echo $row['age']; ?></td>
                                <td class="tbl-adopt"><?php echo $row['gender']; ?></td>
                                <td class="tbl-adopt"><?php echo $row['adoption_date']; ?></td>
                                <td class="tbl-adopt">
                                    <?php
                                    $status = $row['status'];
                                    $status_colors = [
                                        "Requested" => "blue",
                                        "Approved" => "orangered",
                                        "Cancelled" => "red",
                                        "Done" => "green"
                                    ];
                                    echo "<label style='color:" . $status_colors[$status] . "'>$status</label>";
                                    ?>
                                </td>
                                <td class="tbl-adopt"><?php echo $row['adoptee_name']; ?></td>
                                <td class="tbl-adopt"><?php echo $row['adoptee_contact']; ?></td>
                                <td class="tbl-adopt"><?php echo $row['adoptee_email']; ?></td>
                                <td class="tbl-adopt"><?php echo $row['adoptee_address']; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-adopt.php?id=<?php echo $row['id']; ?>"
                                        class="btn_update"> Update </a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-adopt.php?id=<?php echo $row['id']; ?>"
                                        class="btn_update"> Delete </a>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='10' class='error'>No Adoption Requests Found</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <!-- Main Content Section Ends -->
</body>
</html>