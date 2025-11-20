<?php
  $host = "localhost";
  $user = "root";
  $pass = "";
  $db = "cn68-016"; //ชื่อฐานข้อมูล
 $con = mysqli_connect($host, $user, $pass, $db);
  mysqli_set_charset($con, "utf8");
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
?>