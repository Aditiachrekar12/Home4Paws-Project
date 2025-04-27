<?php

//check user is logged in or not

    if(!isset($_SESSION['admin']))
    {
        //user is not logged in and trying to access admin.php
        $_SESSION['no-login'] = "<div class='error'>Please Login </div>" ;
        //send him to login page
        header("location:".SITEURL.'admin/login.php');
    }


?>