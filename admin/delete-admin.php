<?php
include('../config/constants.php');

 $id=$_GET['id'];
 $sql="DELETE FROM tbl_admin where id=$id";
$res=mysqli_query($conn,$sql);
if($res==true)
{
// echo "Admin Deleted";
$_SESSION['delete']="<div class='success'>Admin Delete Successfully</div>";
header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    // echo" Fail To Delete";
    $_SESSION['delete']="<div class='error'>admin failled To Delete</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
?>