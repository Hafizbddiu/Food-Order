<?php
session_start();


define('SITEURL','http://localhost/food/');
define('LOACLHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food_order');
  $conn=mysqli_connect(LOACLHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_connect());
  $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_connect());
  
     
?>