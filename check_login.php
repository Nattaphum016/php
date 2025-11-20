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
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// ตรวจสอบผลลัพธ์
if ($row = mysqli_fetch_assoc($result)) {

    // ✅ ตรวจสอบรหัสผ่าน: ถ้าใช้ password_hash ตอนสมัคร จะใช้ password_verify()
    // ถ้ายังเก็บแบบ plain text (เช่น admin/admin) ให้ใช้ == แทน
    if (password_verify($password, $row['password']) || $password == $row['password']) {

        // ตั้งค่า session
        $_SESSION['member_id'] = $row['member_id'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];

        echo "<script>
                alert('เข้าสู่ระบบสำเร็จ');
                window.location.href = 'profile.php';
              </script>";
        exit();
    } else {
        echo "<script>alert('รหัสผ่านไม่ถูกต้อง'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ไม่พบบัญชีผู้ใช้นี้ในระบบ'); window.history.back();</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>
