<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ฟอร์มสมัครสมาชิก</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    form {
      background-color: #fff;
      padding: 20px 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 320px;
    }
    h2 {
      text-align: center;
      color: #333;
    }
    label {
      display: block;
      margin-top: 10px;
      color: #555;
    }
    input {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      width: 100%;
      margin-top: 15px;
      padding: 10px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    button:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>

  <form method="POST" action="register_save.php">
    <h2>สมัครสมาชิก</h2>
    
    <label for="username">ชื่อผู้ใช้ (Username):</label>
    <input type="text" id="username" name="username" required>

    <label for="email">อีเมล (Email):</label>
    <input type="email" id="email" name="email" required>

    <label for="full-name">ชื่อ-นามสกุล (Full Name):</label>
    <input type="text" id="full-name" name="full_name" required>

    <label for="password">รหัสผ่าน (Password):</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">ยืนยันรหัสผ่าน (Confirm Password):</label>
    <input type="password" id="confirm_password" name="confirm_password" required>

    <button type="submit">สมัครสมาชิก</button>
  </form>

</body>
</html>