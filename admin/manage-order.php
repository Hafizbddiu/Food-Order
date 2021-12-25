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
    <h1> Manage Order</h1>

        <table class="tbl-full">
            <tr>
                <th>S.I</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th colspan="2">Action</th>
            </tr>
            <tr>
                <td>1</td>
                <td>hafiz Dewan</td>
                <td>hafiz</td>
                <td>
                   <a href="#" class="btn-secondary">Update Admin</a> 
               <a href="#" class="btn-danger">Delete Admin</a> 
                </td>
               
            </tr>
        </table>
        <div class="clearfix">

        </div>
        </div>

    </div>

  <?php include('partial/footer.php')
  ?>
    
</body>
</html>