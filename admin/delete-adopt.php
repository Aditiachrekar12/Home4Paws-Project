<?php
include('../config/constants.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the adoption record
    $sql = "DELETE FROM tbl_adopt WHERE id = $id";
    
    $res = mysqli_query($conn, $sql);

    if ($res) {
        // Set success message in session
        $_SESSION['delete'] = "<div class='success'>Adoption record deleted successfully.</div>";
    } else {
        // Set error message in session
        $_SESSION['delete'] = "<div class='error'>Failed to delete adoption record. Please try again.</div>";
    }

    // Redirect back to manage adoption page
    header("Location: " . SITEURL . "admin/manage-adopt.php");
} else {
    // Redirect if no ID is provided
    $_SESSION['delete'] = "<div class='error'>Unauthorized access.</div>";
    header("Location: " . SITEURL . "admin/manage-adopt.php");
}
?>