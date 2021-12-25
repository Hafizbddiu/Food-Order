<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include('partial/menu.php')
    ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br> <br>
            <?php
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            <br>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td> <input type="text" name="title" placeholder="Add your Title"></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td> <textarea name="description" rows="3" cols="30" placeholder="Description for Food"></textarea>

                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td> <input type="number" name="price" placeholder="Add your Price"></td>
                    </tr>
                    <tr>
                        <td>Select Image</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td> Category</td>
                        <td>
                            <select name="category">
                                <!-- get data  active category from database -->
                                <?php
                                $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                                //excecute Query
                                $res = mysqli_query($conn, $sql);

                                //count rows 
                                $count = mysqli_num_rows($res);
                                //Count is greter than zero we will find data other wise not
                                if ($count > 0) {
                                    //we have value
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        //get details of id
                                        $id = $row['id'];
                                        $title = $row['title'];
                                ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php

                                    }
                                } else {
                                    //we do not have value
                                    ?>
                                    <option value="0">No category found</option>
                                <?php
                                }

                                ?>
                                >

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td> Featured</td>
                        <td><input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td> Active</td>
                        <td><input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="add-food" class="btn-secondary">
                        </td>

                    </tr>

                </table>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                // echo "Clicked";
                // get the data from From
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // 1.check radio button for feature and active
                if (isset($_POST['featured'])) {
                    $featured=$_POST['featured'];
                   
                } else {
                    $featured="No";
                }
                if (isset($_POST['active'])) {
                    $active=$_POST['active'];
                } else {
                    $active="No";
                }
                //2. upload data if you wanted
                // check image is clicked or not
                if (isset($_FILES['image']['name'])) {
                    // get the details of image
                    $image_name = $_FILES['image']['name'];
                    // check image is selected or not ,upload image is selected or not
                    if ($image_name != "") {
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
                            header('location:' . SITEURL . 'admin/add-food.php');
                            die();
                        }
                    }
                } else {
                    $image_name = "";
                }


                // insert data into database
                // crete sql query
                $sql2 = "INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
                ";
                // execute the query
                $res2 = mysqli_query($conn, $sql2);
                // check data insert or not
                if ($res == true) {
                    // data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Add  data Successfully</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                } else {
                    //    data failed to insert
                    $_SESSION['add'] = "<div class='error'>failled to insert data</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                }

                // redirect  masage if you want
            }

            ?>

        </div>

    </div>


    <div class="clearfix"></div>
    <?php include('partial/footer.php')
    ?>

</body>

</html>