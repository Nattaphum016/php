<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['member_id'])) {
    echo "กรุณาล็อกอินก่อนครับ<br>";
    echo "<a href='login.php'>ไปหน้าล็อกอิน</a>";
    exit();
}

require 'connect.php';

// ---------------------- CRUD ACTIONS ----------------------

// เพิ่มสมาชิก
if (isset($_POST['add_member'])) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $position = $_POST['position'];

    mysqli_query($con, "INSERT INTO member (username, fullname, email, position)
                        VALUES ('$username', '$fullname', '$email', '$position')");
}

// แก้ไขสมาชิก
if (isset($_POST['edit_member'])) {
    $id = $_POST['edit_id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $position = $_POST['position'];

    mysqli_query($con, "UPDATE member SET 
                        username='$username',
                        fullname='$fullname',
                        email='$email',
                        position='$position'
                        WHERE member_id='$id'");
}

// ลบสมาชิก
if (isset($_POST['delete_member'])) {
    $id = $_POST['delete_id'];
    mysqli_query($con, "DELETE FROM member WHERE member_id='$id'");
}

?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>หน้า Home (Admin) - ระบบจัดการสมาชิก</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Panel</a>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <?= htmlspecialchars($_SESSION['fullname']); ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="logout.php">ออกจากระบบ</a></li>
          </ul>
        </li>
      </ul>
    </div>

  </div>
</nav>

<div class="container mt-5">
  <div class="card shadow p-4">
    <h2 class="text-center mb-4">ระบบจัดการสมาชิก</h2>

    <div class="text-end mb-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
            + เพิ่มสมาชิก
        </button>
    </div>

    <?php
    $sql = "SELECT member_id, username, fullname, email, position FROM member";
    $result = mysqli_query($con, $sql);
    ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>ชื่อ-นามสกุล</th>
                <th>Email</th>
                <th>ตำแหน่ง</th>
                <th width="180">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['member_id'] ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['fullname']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['position']) ?></td>
                <td>
                    <button class="btn btn-warning btn-sm"
                        onclick="editMember('<?= $row['member_id'] ?>',
                                            '<?= $row['username'] ?>',
                                            '<?= $row['fullname'] ?>',
                                            '<?= $row['email'] ?>',
                                            '<?= $row['position'] ?>')"
                        data-bs-toggle="modal" data-bs-target="#editModal">
                        แก้ไข
                    </button>

                    <button class="btn btn-danger btn-sm"
                        onclick="deleteMember('<?= $row['member_id'] ?>')"
                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                        ลบ
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

  </div>
</div>

<!-- ------------------------------- Modal เพิ่มสมาชิก ------------------------------- -->
<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST">
        <div class="modal-header">
          <h5 class="modal-title">เพิ่มสมาชิก</h5>
        </div>

        <div class="modal-body">
            <input type="text" class="form-control mb-2" name="username" placeholder="Username" required>
            <input type="text" class="form-control mb-2" name="fullname" placeholder="ชื่อ-นามสกุล" required>
            <input type="email" class="form-control mb-2" name="email" placeholder="Email" required>
            <input type="text" class="form-control mb-2" name="position" placeholder="ตำแหน่ง" required>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <button class="btn btn-success" name="add_member">บันทึก</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- ------------------------------- Modal แก้ไขสมาชิก ------------------------------- -->
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST">
        <div class="modal-header">
          <h5 class="modal-title">แก้ไขข้อมูลสมาชิก</h5>
        </div>

        <div class="modal-body">
            <input type="hidden" id="edit_id" name="edit_id">

            <input type="text" class="form-control mb-2" id="edit_username" name="username" required>
            <input type="text" class="form-control mb-2" id="edit_fullname" name="fullname" required>
            <input type="email" class="form-control mb-2" id="edit_email" name="email" required>
            <input type="text" class="form-control mb-2" id="edit_position" name="position" required>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <button class="btn btn-warning" name="edit_member">อัปเดต</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- ------------------------------- Modal ลบสมาชิก ------------------------------- -->
<div class="modal fade" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST">
        <div class="modal-header">
          <h5 class="modal-title text-danger">ยืนยันการลบ</h5>
        </div>

        <div class="modal-body">
            <p>คุณต้องการลบสมาชิกคนนี้หรือไม่?</p>
            <input type="hidden" id="delete_id" name="delete_id">
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <button class="btn btn-danger" name="delete_member">ลบ</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
function editMember(id, username, fullname, email, position) {
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_username").value = username;
    document.getElementById("edit_fullname").value = fullname;
    document.getElementById("edit_email").value = email;
    document.getElementById("edit_position").value = position;
}

function deleteMember(id) {
    document.getElementById("delete_id").value = id;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
