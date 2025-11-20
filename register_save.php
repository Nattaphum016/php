<?php
include_once 'connect.php';

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$fullname = $_POST['full_name'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (empty($username) || empty($email) || empty($fullname) || empty($password) || empty($confirm_password)) {
    echo "<script>alert('กรุณากรอกข้อมูลให้ครบ'); window.history.back();</script>";
    exit();
}

if ($password !== $confirm_password) {
    echo "<script>alert('รหัสผ่านไม่ตรงกัน'); window.history.back();</script>";
    exit();
}

// เข้ารหัสรหัสผ่าน
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// ✅ แก้ให้ใช้ $con แทน $connect
$sql = "INSERT INTO member (username, email, fullname, password) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $fullname, $hashed_password);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "<script>alert('สมัครสมาชิกสำเร็จ!'); window.location.href='login.php';</script>";
} else {
    echo "<script>alert('สมัครไม่สำเร็จ กรุณาลองใหม่'); window.history.back();</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>
