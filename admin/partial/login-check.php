<?php
if(!isset($_SESSION['user']))
{
    $_SESSION['no-login-message']="<div class='error'> Please login to access Admin pannel. </div>";
    header('location:'.SITEURL.'admin/login.php');
}
?>