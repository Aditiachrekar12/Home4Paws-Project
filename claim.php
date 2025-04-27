<?php
include('config/constants.php');
?>
<?php
$name = $_POST['full-name'];
$phone_number = $_POST['contact'];
$email = $_POST['email'];
$pet_type = $_POST['pet-type'];
$address = $_POST['address'];

// save the data into database
$sql2 = "INSERT INTO tbl_vc SET
    name = '$name',
    phone_number = '$phone_number',
    email = '$email',
    pet_type = '$pet_type',
    address = '$address'
";

$res2 = mysqli_query($conn, $sql2);
// check whether query is executed successfully or not
if ($res2 == true) {
    // query executed
    $_SESSION['rooms'] = "<div class='success text-center'>Connection Established</div>";
    header('location:' . SITEURL . 'rooms.php?phone_number=' . $phone_number);
} else {
    // failed to exectute
    $_SESSION['vet-community'] = "<div class='error text-center'>Connection Failed</div>";
    header('location:' . SITEURL. 'vet-community.php');
}
