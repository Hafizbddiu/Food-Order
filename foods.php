<?php  include('partial-front/menu.php')
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php
    // Create sql query to display categories from database
    $sql="SELECT * FROM tbl_food ";
    // EXecute Query
    $res=mysqli_query($conn,$sql);
    //count to check where category available or not
    $count=mysqli_num_rows($res);
    if($count>0){
        //category available
        while($row=mysqli_fetch_assoc($res))
        {
            //get the value like title images
            $id=$row['id'];
            $title=$row['title'];
            $price=$row['price'];
            $description=$row['description'];
            $image_name=$row['image_name'];
            ?>
                     <div class="food-menu-box">
                <div class="food-menu-img">

                <?php
                if($image_name=="")
                {
                    //Display message
                    echo "<div class='error'>Image not available</div>";
                }
                else {
                   //image name is available
                   ?>
                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                   <?php
                }
                ?>
               
                    
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price">$<?php echo $price;?></p>
                    <p class="food-detail">
                    <?php echo $description;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo$id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php
        }
    }
    else {
        //category not available
        echo"<div class='error'> Food Not Available</div>";
    }
    ?>





            
         

        
          

       

         

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php  include('partial-front/footer.php')
?>