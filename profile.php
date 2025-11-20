<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['member_id'])) { // ✅ ชื่อต้องตรงกับใน check_login.php
    echo "กรุณาล็อกอินก่อนครับ<br>";
    echo "<a href='login.php'>ไปหน้าล็อกอิน</a>";
    exit();
}

// ถ้าโค้ดมาถึงตรงนี้ แสดงว่าล็อกอินแล้ว
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>โปรไฟล์ของคุณ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">

      <!-- เมนูซ้าย -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="register_form">สมัครสมาชิก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
      </ul>

      <!-- เมนูขวา (Dropdown) -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo htmlspecialchars($_SESSION['fullname']); ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>

<div class="container mt-5">
  <div class="card shadow p-4">
    <h2 class="text-center mb-4">ข้อมูลสมาชิก</h2>

    <p><strong>ชื่อผู้ใช้:</strong> <?= htmlspecialchars($_SESSION['username']); ?></p>
    <p><strong>ชื่อ-นามสกุล:</strong> <?= htmlspecialchars($_SESSION['fullname']); ?></p>

    <?php if (isset($_SESSION['email'])): ?>
      <p><strong>อีเมล:</strong> <?= htmlspecialchars($_SESSION['email']); ?></p>
    <?php endif; ?>

    <hr>
    <div class="text-center">
      <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>