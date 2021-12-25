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
        <h1>Dashboard</h1>
        <br><br>
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset( $_SESSION['login']);
        }
        ?>
        <div class="col-4 text-center">

        <?php
        $sql="SELECT * FROM tbl_category";
        $res=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($res);
        ?>
            <h1><?php echo $count?></h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
        <?php
        $sql2="SELECT * FROM tbl_food";
        $res2=mysqli_query($conn,$sql2);
        $count=mysqli_num_rows($res2);
        ?>
            <h1><?php echo $count?></h1>
            <br>
            Foods
        </div>
        <div class="col-4 text-center">
        <?php
        $sql3="SELECT * FROM tble_order";
        $res3=mysqli_query($conn,$sql3);
        $count=mysqli_num_rows($res3);
        ?>
            <h1> <?php echo $count?></h1>
            <br>
            Total Orders
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Revenue Genarated
        </div>
    
        <div class="clearfix">

        </div>
        </div>

    </div>

  <?php include('partial/footer.php')
  ?>
    
</body>
</html>