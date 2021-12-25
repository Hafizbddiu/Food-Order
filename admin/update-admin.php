<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food order Website</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
   <?php include('partial/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
    <h1> Update Admin</h1>
<br> <br>
    <?php
     $id=$_GET['id'];
     $sql="SELECT * FROM tbl_admin WHERE id=$id";
     $res=mysqli_query($conn,$sql);
     if($res==true)
     {
        $count=mysqli_num_rows($res);
        if($count==1){
            // echo "admin avaiable";
            $row=mysqli_fetch_assoc($res);
            $full_name=$row['full_name'];
            $user_name=$row['user_name'];
            $password=$row['password'];
        }
        else
        {
            header('location'.SITEURL.'admin/manage-admin');
        }
     }
    ?>
      <form action="" method="POST">
      <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="user_name" value="<?php echo $user_name?>"></td>
                    </tr>    
                    <tr>
                    <td>Current Password</td>
                    <td><input type="text" name="current_password" ></td>
                    </tr>
                    <tr>
                    <td>New Password</td>
                    <td><input type="text" name="new_password" ></td>
                    </tr>
                    <tr>
                    <td>Confirm Password</td>
                    <td><input type="text" name="confirm_password" ></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>     
            </table>
      </form>
        <div class="clearfix">

        </div>
        </div>

    </div>
    <?php
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
      $full_name=$_POST['full_name'];
        $user_name=$_POST['user_name'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);

       $sql="UPDATE tbl_admin SET
       full_name='$full_name',
       user_name='$user_name',
       password='$password'
       WHERE id='$id'
       ";
       $res=mysqli_query($conn,$sql);
       if($res==true){

        $_SESSION['update']="<div class='success'>ADMIN UPDATED SUCCESSFULLY</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
       }
       else
       {
        $_SESSION['update']="<div class='error'>ADMIN Fail To UPDATED </div>";
        header("location:".SITEURL.'admin/manage-admin.php');
       }
    }
    ?>

  <?php include('partial/footer.php')
  ?>
    
</body>
</html>