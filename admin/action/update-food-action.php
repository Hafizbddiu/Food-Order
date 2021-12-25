

<?php
include('../../config/constants.php');

  if (isset($_POST['submit'])) {
      // echo "Clicked";
      // get the data from From
    //   print_r($_REQUEST);
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
              $dst = "../../images/food/" . $image_name;
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

