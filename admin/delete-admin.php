<?php
include('../config/constants.php');
$id= $_GET['id'];

$sql = "DELETE FROM tbl_admin WHERE id=$id" ;

$res= mysqli_query($conn,$sql); //$conn is described in constants

if($res==true)
{

    //query is successful
   $_SESSION['delete']="<div class='success'>Admin is Deleted.</div>";
  
   //redirect
   header("location:".SITEURL.'admin/manage-admin.php');


}
else
{
     //query is NOT successful
   $_SESSION['delete']="<div class='error'>Admin is not deleted.</div>";
   //redirect
   header("location:".SITEURL.'admin/manage-admin.php');
}



?>