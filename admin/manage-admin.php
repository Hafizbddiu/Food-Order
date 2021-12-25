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
        <h1>Manage Admin</h1>
        <br> <br>
                <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
                
                ?>
                <br>
                <br>
        <a href="add-admin.php" class="btn-primary"> Add Admin</a>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.I</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th colspan="2">Action</th>
            </tr>
<?php
$sql="SELECT * FROM tbl_admin";


$res=mysqli_query($conn,$sql);
if($res==true){
    $count=mysqli_num_rows($res);
   
    $sn=1;
    if($count>0)
    {
        while($rows=mysqli_fetch_assoc($res))
        {
            $id=$rows['id'];
            $full_name=$rows['full_name'];
            $user_name=$rows['user_name'];
            ?>
              <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $user_name; ?></td>
                <td>
                   <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a> 
               <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a> 
                </td>
               
            </tr>

            <?php
        }

    }
    else
    {

    }

}
?>

           
        </table>
        
        <div class="clearfix">

        </div>
        </div>

    </div>

    <?php include('partial/footer.php')
  ?>
    
</body>
</html>