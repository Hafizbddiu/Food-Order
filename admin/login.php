
<?php
include('../config/constants.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset( $_SESSION['login']);
        }
        ?>

            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password:<br>
                <input type="text" name="password" placeholder="Enter Password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>

        </div>
    </div>
</body>
</html>

<?php 
if (isset($_POST['submit']))
{
   
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    $sql="SELECT * FROM tbl_admin WHERE user_name='$username' and password='$password' ";
   
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);

    if($count==1)
{
// echo "Admin Deleted";
$_SESSION['login']="<div class='success'>Admin Login Successfully</div>";
$_SESSION['user']=$username;
header('location:'.SITEURL.'admin/index.php');
}
else
{
    // echo" Fail To Delete";
    $_SESSION['login']="<div class='error'>admin failled To Login</div>";
    header('location:'.SITEURL.'admin/login.php');
}
}
?>