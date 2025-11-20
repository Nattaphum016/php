<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-KyZXEJX3Kx7p1d1d7N6tH3dY6NseYmOgQzT1h0zZBx9T4efm5aaPsmG6qaZ85f8F" 
          crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            justify-content: center;   /* จัดแนวนอนตรงกลาง */
            align-items: center;       /* จัดแนวตั้งตรงกลาง */
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-70%);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .form-label {
            font-weight: 500;
        }
        .mb-3 {
            margin-bottom: 1rem !important; /* เพิ่มช่องว่างระหว่างช่องกรอก */
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form action="check_login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter your username" required name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" required name="password">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-custom">Login</button>
            </div>
            <div class="mt-3 text-center">
                <a href="register_form.php">New register?</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" 
            integrity="sha384-oBqDVmMz4fnFO9gybC3fWxF4YpV9lM3D2Y0n4VfZoYVkBi3V7Rkl5y9kmE8s9g5E" 
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" 
            integrity="sha384-pzjw8f+ua7Kw1TIq0v8Fq6EKwBy9w72S5C+4Ybq8RZ9iW6R4x2mF9Z0YjQdIhlFzQ" 
            crossorigin="anonymous"></script>

</body>
</html>
