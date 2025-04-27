<?php
//session
session_start();

//dbms connection
define('SITEURL','http://localhost/Pet-Adoption-main/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','home4paws_db');
    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) ;
    $db_select= mysqli_select_db($conn,'home4paws_db');

    ?>