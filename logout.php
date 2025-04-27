<?php
session_start();
unset($_SESSION['user_logged_in']); // Remove only user session
header("Location: index.php");
exit();
?>