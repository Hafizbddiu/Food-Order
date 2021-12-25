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
        <h1>Add Admin</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset( $_SESSION['add']);
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Fullname"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                    </tr>    
                    <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                    </tr>  
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>     
            </table>
        </form>
    
     
    
        <div class="clearfix">

        </div>
        </div>

    </div>

  <?php include('partial/footer.php')
  ?>
  <?php
  if(isset($_POST['submit']))
  {
        // echo"Button Clicked";
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        $sql=" INSERT INTO tbl_admin SET
        full_name='$full_name',
        user_name='$username',
        password='$password'

  ";

  $res=mysqli_query($conn, $sql);
   if($res==true){
       echo "Data Insert";

       $_SESSION['add']="ADMIN ADDED SUCCESSFULLY";
       header("location:".SITEURL.'admin/manage-admin.php');
   }
   else{
       echo "Data Not Insert";
       $_SESSION['add']="ADMIN Failed Insert Data SUCCESSFULLY";
       header("location:".SITEURL.'admin/manage-admin.php');
   }
  }

 
  ?>
    
</body>
</html>