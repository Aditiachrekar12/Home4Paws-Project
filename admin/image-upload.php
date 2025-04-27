<?php
/*

 ///to upload image
 if(isset($_FILES['image']['name']))
 {
       // image name, source, destination
       $image_name = $_FILES['image']['name']; //this can be used in sql
       $source= $_FILES['image']['tmp_name'] ;
       $destination ="../images/category/".$image_name ;


       $upload = move_uploaded_file($source,$destination);
 }
 else
 {
   $image_name="" ; 
 }

  //checking upload
  if($upload==false)
  {
      $_SESSION['upload']= "<div class='error' >Spmething went wrong in image upload </div>" ;
      header('location:'.SITEURL.'admin/add-category.php');

  }



  //img delete
   if($img_name!="")
    {
        $path="../images/category/.$image_name" ; //img destination

    }
    remove= unlink($path);


*/

 ?>

 