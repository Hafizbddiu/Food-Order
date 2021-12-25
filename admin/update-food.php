
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php
include('partial/menu.php');
?>
<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql2="SELECT * FROM tbl_food WHERE id=$id";
    $res2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($res2);
    $title=$row2['title'];
    $description=$row2['description'];
    $price=$row2['price'];
    $current_image=$row2['image_name'];
    $current_category=$row2['category_id'];
    $featured=$row2['featured'];
    $active=$row2['active'];
}
else {
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>
<div class="main-content">
    <div class="wrapper">
    <h1>Update Food</h1>
        <br><br>
    <form action="action/update-food-action.php" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
            </tr>
    <tr>
        <td>Description:</td>
        <td><textarea name="description" cols="30" rows="3"><?php echo $description; ?></textarea> </td>
    </tr>
    <tr>
        <td>Price</td>
        <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
    </tr>
    <tr>
        <td>Current Image</td>
        <td>
        <?php 
                    if($current_image!="")
                    {
                        ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>" width="150px">
                        <?php

                    }
                    else
                    {
                        echo "<div class='error'> Image not added</div>";
                    }
                    ?>
        </td>
    </tr>
    <tr>
        <td>Select new Image</td>
        <td><input type="file" name="image"></td>
    </tr>
    <tr>
        <td>Category</td>
        <td><select name="category" >
            <?php
            $sql="SELECT * FROM tbl_category WHERE active='yes'";
            //execute the query
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    $category_title=$row['title'];
                    $category_id=$row['id'];
                    // echo "<option value='category_id'>$category_title</option>";
                    $title = $row['title'];
                    ?>
                            <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                        <?php
                }

            }else {
                echo "<option value='0'>Category Not Available.</option>";
            }
            ?>
            <option value="0">test Category</option>
        </select></td>
    </tr>
    <tr>
        <td>Featured: </td>
        <td>
            <input <?php if($featured=="Yes"){echo"checked";} ?> type="radio" name="featured" value="Yes">Yes
            <input <?php if($featured=="No"){echo"checked";} ?> type="radio" name="featured" value="No">No
        </td>
    </tr>
    <tr>
        <td>Active:</td>
        <td>
            <input <?php if($active=="Yes"){echo"checked";} ?> type="radio" name="active" value="Yes">Yes
            <input <?php if($active=="No"){echo"checked";} ?> type="radio" name="active" value="No">No
        </td>
    </tr>
    <tr>
        <td>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
        </td>
    </tr>
        </table>
    </form>
    <?php
            if (isset($_POST['submit'])) {
                // echo "Clicked";
                // get the data from From
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image=$_POST['current_image'];
                $category = $_POST['category'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //2. upload data if you wanted
                // check image is clicked or not
                if (isset($_FILES['image']['name'])) {
                    // get the details of image
                    $image_name = $_FILES['image']['name'];
                    // check image is selected or not ,upload image is selected or not
                    if ($image_name!="") {
                        // get the image
                        // rename the img
                        // ext
                        $ext = end(explode('.', $image_name));
                        // create new name for image
                        $image_name = "Food-name" . rand(0000, 9999) . "." . $ext;
                        // upload the image
                        // get the source path and direction
                        $src = $_FILES['image']['tmp_name'];
                        // direction for new path
                        $dst = "../images/food/" . $image_name;
                        $upload = move_uploaded_file($src, $dst);
                        // check image upload or not
                        if ($upload == false) {
                            // print error message
                            // redirect add food page
                            // also finish this
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            die();
                        }
                        if($current_image="")
                        {
                            $remove_path="../image/food/".$current_image;
                            $remove=unlink($remove_path);
                            if($remove==false){
                                 // data inserted successfully
                    $_SESSION['remove-failed'] = "<div class='success'>Remove image failed</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    die();
                            }
                        }
                    }
                    else {
                        $image_name = $current_image;
                    }
                } 
                else {
                    $image_name = $current_image;
                }


                // insert data into database
                // crete sql query
                $sql3 = "UPDATE tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
                WHERE id=$id
                ";
                // execute the query
                $res3 = mysqli_query($conn, $sql3);
                // check data insert or not
                if ($res3 == true) {
                    // data inserted successfully
                    $_SESSION['update'] = "<div class='success'>Update  data Successfully</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                } else {
                    //    data failed to insert
                    $_SESSION['update'] = "<div class='error'>failled to update</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                }

                // redirect  masage if you want
            }

            ?>


    <div class="clearfix">
<?php
include('partial/footer.php');
?>

</div>
</body>
</html>