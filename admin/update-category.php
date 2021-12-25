
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
<div class="main-content">
    <div class="wrapper">
    <h1>Update Category</h1>
        <br><br>
        <?php
        if(isset($_GET['id']))
        {
            // echo "Getting Back";
            $id=$_GET['id'];
            $sql="SELECT * FROM tbl_category WHERE id=$id";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count==1){

                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];

            }
            else
            {
                $_SESSION['no-category-found']="<div class='error'> Category Not Found. </div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        else
        {
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" value="<?php echo $title; ?>"></td>

            </tr>
            <tr>
                <td>Current Image</td>
                <td>
                    <?php 
                    if($current_image!="")
                    {
                        ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="150px">
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
                <td>New Image </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td> Featured: </td>
               <td><input <?php if($featured=="yes"){echo"checked";} ?> type="radio" name="featured" value="yes" >Yes
               <input <?php if($featured=="no"){echo"checked";} ?> type="radio" name="featured" value="no"> No</td>
            </tr>
            <tr>
                <td> Active: </td>
               <td><input <?php if($active=="yes"){echo"checked";} ?> type="radio" name="active" value="yes" >Yes
               <input <?php if($active=="no"){echo"checked";} ?> type="radio" name="active" value="no"> No</td>
            </tr>
            <tr>
                <td >
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="update-category" class="btn-secondary">
                </td>

            </tr>

            </table>

        </form>
        <?php
        
        if(isset($_POST['submit']))
        {
      
         
            // echo "Clicked";
            $id=$_POST['id'];
            $title=$_POST['title'];
            $current_image=$_POST['current_image'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];
          
if(isset($_FILES['image']['name']))
{
    $image_name= $_FILES['image']['name'];
    if($image_name != "")
    {
        $ext=end(explode('.',$image_name));
        $image_name="Food_category".rand(000,999).'.'.$ext;
        $source_path=$_FILES['image']['tmp_name'];
        $destination_path="../images/category/".$image_name;
        $upload=move_uploaded_file($source_path,$destination_path);

        if($upload==false)
        {
            $_SESSION['upload']="<div class='error'>failed to upload Image.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }
        if($current_image!="")
        {
        $remove_path="../images/category/".$current_image;
        $remove=unlink($remove_path);
        if($remove==false)
        {
            $_SESSION['failed-remove'] ="<div class='error'> Failed to remove current Image.</div>";
            header ('location:'.SITEURL.'admin/manage-category.php');
            die();
        }
    }
    }
    else{
        $image_name=$current_image;
    }
}

            $sql2="UPDATE tbl_category SET 
            title='$title',
            image_name='$image_name',
             featured='$featured',
              active='$active'
               WHERE id=$id";
            $res2=mysqli_query($conn,$sql2) OR die(mysqli_error($conn));
            
            if($res2==true){
                $_SESSION['update']="<div class='success'>Category Updated Successfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');

            }
            else{
              
                $_SESSION['update']="<div class='error'>Category Updated Failled</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        }
        ?>
    </div>

    </div>


    <div class="clearfix">
<?php
include('partial/footer.php');
?>

</div>
</body>
</html>