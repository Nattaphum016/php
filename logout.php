<?php
session_start();
session_unset();    // ล้างค่าทุก session
session_destroy();  // ทำลาย session ทั้งหมด

// ส่งกลับไปหน้า login
header('Location: login.php');
exit();
?>
