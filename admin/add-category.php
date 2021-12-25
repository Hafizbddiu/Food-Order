<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php
    include('partial/menu.php');
    ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            <br>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" placeholder="Category Title"></td>

                    </tr>
                    <tr>
                        <td>Select Image</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td> Featured</td>
                        <td><input type="radio" name="featured" value="yes" checked>Yes
                            <input type="radio" name="featured" value="no"> No
                        </td>
                    </tr>
                    <tr>
                        <td> Active</td>
                        <td><input type="radio" name="active" value="yes" checked>Yes
                            <input type="radio" name="active" value="no"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="add-category" class="btn-secondary">
                        </td>

                    </tr>

                </table>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                // echo "Clicked";
                $title = $_POST['title'];
                if (isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    $featured = "no";
                }
                if (isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = "no";
                }
                // print_r($_FILES['image']);
                // die();
                if (isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];
                    if ($image_name != "") {
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_category" . rand(000, 999) . '.' . $ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/" . $image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);

                        if ($upload == false) {
                            $_SESSION['upload'] = "<div class='error'>failed to upload Image.</div>";
                            header('location:' . SITEURL . 'admin/add-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = " ";
                }
                $sql = "INSERT INTO tbl_category (id,title,image_name,featured,active)VALUES(null,'$title','$image_name','$featured','$active')";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div> ";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                } else {
                    $_SESSION['add'] = "<div class='error'>Category Added Failed.</div> ";
                    header('location:' . SITEURL . 'admin/add-category.php');
                }
            }
            ?>
        </div>

    </div>
    <div class="clearfix">
        <?php
        include('partial/footer.php');
        ?>

</body>

</html>