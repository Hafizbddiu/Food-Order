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

    <h1> Manage Food</h1>
    <br> 
        <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary"> Add Food</a>
        <br><br>

        <?php
          if(isset( $_SESSION['add']))
          {
              echo $_SESSION['add'];
              unset ($_SESSION['add']);
          }
          if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset( $_SESSION['delete']);
        }
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset( $_SESSION['remove']);
        }
        if(isset($_SESSION['unauthorize'])){
            echo $_SESSION['unauthorize'];
            unset( $_SESSION['unauthorize']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset( $_SESSION['update']);
        }
        if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];
            unset( $_SESSION['failed-remove']);
        }
       
        
           ?>
           <br>
        <table class="tbl-full">
            <tr>
                <th>S.I</th>
               
                <th>Title</th>
                <th>Price</th>
                <th>Image Name</th>
                <th>Featured</th>
                <th>Active</th>
                <th colspan="2">Action</th>
            </tr>

            <?php
            // Create sql query for all data
            $sql="SELECT * FROM tbl_food";
            // Execute query
            $res=mysqli_query($conn,$sql);
            // create serial number variable
            $sn=1;
            // Count check
            $count=mysqli_num_rows($res);
            if($count>0)
            {
                //we have food in database
                //get the data from database and display all
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the value from individual column
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                    ?>
                         <tr>
               <td><?php echo $sn++;?></td>
                <td><?php echo $title;?></td>
                <td><?php echo $price;?></td>
                <td>
                    
                <?php
                // check image add or not
                if($image_name=="")
                {
                    echo " <div class='error'>Image not added </div>";
                }
                else {
                    ?>
                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?> " width="150px" >

                    <?php
                }
                ?>
            </td>
                <td><?php echo $featured;?></td>
                <td><?php echo $active;?></td>
                <td>
                   <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a> 
               <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a> 
                </td>
               
            </tr>

                    <?php
                }
            }
            else
            {
                //food not added in database
                echo"<tr> <td colspan='7' class='error'> Food not added</td> </tr>";

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