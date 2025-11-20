<?php
session_start();
include_once 'connect.php';

// รับค่าจากฟอร์ม
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// ตรวจสอบการกรอกข้อมูล
if (empty($username) || empty($password)) {
    echo "<script>alert('กรุณากรอกชื่อผู้ใช้และรหัสผ่านให้ครบ'); window.history.back();</script>";
    exit();
}

// ค้นหาข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM member WHERE username = ?";
$stmt = mysqli_prepare($con, $sql);
if (!$stmt) {
    // prepare failed
    echo "<script>alert('เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล'); window.history.back();</script>";
    exit();
}
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// ตรวจสอบผลลัพธ์
if ($row = mysqli_fetch_assoc($result)) {

    // ตรวจสอบรหัสผ่าน
    if (password_verify($password, $row['password']) || $password == $row['password']) {

        // ตั้งค่า session
        $_SESSION['member_id'] = $row['member_id'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];

        if ($row['position'] === 'Admin') {
            header('Location: admin/index.php');
            exit();
        } elseif ($row['position'] === 'User') {
            header('Location: profile.php');
            exit();
        } else {
            header('Location: profile.php');
            exit();
        }

    } else {
        echo "<script>alert('รหัสผ่านไม่ถูกต้อง'); window.history.back();</script>";
        exit();
    }
} else {
    echo "<script>alert('ไม่พบบัญชีผู้ใช้นี้ในระบบ'); window.history.back();</script>";
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>
