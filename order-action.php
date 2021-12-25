<?php

include('config/constants.php');

            if(isset($_POST['submit']))
            {
                $food=$_POST['food'];
                $price=$_POST['price'];
                 $qty=$_POST['qty'];
                 $total=(float)$price*(int)$qty;
               
                 $status="ordered";
                  $customer_name=$_POST['full-name'];
               $customer_contact=$_POST['contact'];
                $customer_email=$_POST['email'];
               $customer_address=$_POST['address'];
             $order_date=date("y-m-d h:i:sa");

                $sql2="INSERT INTO tble_order (id,food,price,qty,total,status,customer_name,customer_contact,customer_email,customer_address)VALUES(null,'$food','$price','$qty','$total','$status','$customer_name','$customer_contact','$customer_email','$customer_address') ";
                  $res2=mysqli_query($conn,$sql2);
                  if($res2==true)
                  {
                    $_SESSION['order']="<div class='success'>Order save successfully </div>";
                    header('location:'.SITEURL);
                  }
                  else {
                    $_SESSION['order']="<div class='error'>Order save Failled </div>";
                    header('location:'.SITEURL);
                  }
                
            }
          
               
           
            ?>
