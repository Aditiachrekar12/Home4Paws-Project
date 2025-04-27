<?php
session_start();
unset($_SESSION['admin']); // Remove only admin session
$_SESSION['login'] = "<div class='success'>Admin Logout Successful</div>";
header("Location: login.php");
exit();
?>
