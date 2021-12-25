
<?php 
include('../config/constants.php');
//echo "Delete Page"
if(isset($_GET['id']) && isset($_GET['image_name']))
{
   // echo "Get value and Delete";
//    Get id and image name
   $id = $_GET['id'];
   $image_name= $_GET['image_name'];
//    2.remove the image name
   if($image_name!="")
   {
       $path ="../images/food/".$image_name;
       $remove= unlink($path);
       if($remove==false)
       {
           $_SESSION['remove']="<div class='error'> Fail to remove Food image</div>";
           header('location:'.SITEURL.'admin/manage-food.php');
           die();
       }
   }
//    delete food from data
   $sql="DELETE FROM tbl_food WHERE id=$id";
   $res=mysqli_query($conn,$sql);
   if($res==true)
   {
       $_SESSION['delete']="<div class='success'> Food Delated Successfully</div>";
       header('location:'.SITEURL.'admin/manage-food.php');
   }
   else{
    $_SESSION['delete']="<div class='error'> Food Delated Failled</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
   }
}


 
else{
    $_SESSION['unauthorize']="<div class='error> Unauthorize access</div>";
    header("location:".SITEURL."admin/manage-food.php");
}
?>

