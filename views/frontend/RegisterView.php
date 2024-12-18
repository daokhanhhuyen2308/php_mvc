<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/form.css">
</head>
<body>
<form action="<?php echo BASE_URL?>User/register" method="post" class="registration-form" enctype="multipart/form-data">
    <h2 class="title" style="text-align: center;">Đăng Ký</h2>
    <div class="input-field">
        <label for="username">Tên đăng nhập</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="input-field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="input-field">
        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div class="input-field">
        <label for="fullname">Tên</label>
        <input type="text" id="fullname" name="fullname" required>
    </div>
    <div class="input-field">
        <label for="avatar">Ảnh</label>
        <input type="file" id="avatar" name="avatar" required>
    </div>

    <div class="input-field">
        <label for="phone">Số điện thoại</label>
        <input type="tel" id="phone" name="phone" required>
    </div>
    <div class="input-field">
        <label for="address">Địa chỉ</label>
        <input type="text" id="address" name="address" required>
    </div>
    <input type="submit" value="Đăng Ký" class="btn">
    <p class="login-prompt" style="text-align: center;"><a href="<?php echo BASE_URL?>User/login" id="show-login-form" style="text-decoration: none;">Đăng nhập</a></p>
</form>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/form.css">
</head>
<style>
    .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-bottom: 15px;
            text-align: center;
            border-radius: 5px;
    }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #f8b400, #f85c42);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Điều chỉnh để form không quá sát dưới */
            padding-top: 50px; /* Thêm khoảng cách từ trên xuống */
        }

        .registration-form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
            margin-top: 20px; /* Thêm margin-top để tránh form quá gần phần trên */
        }

        .registration-form .title {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .input-field {
            margin-bottom: 20px;
            position: relative;
        }

        .input-field label {
            font-size: 16px;
            color: #333;
            text-align: left;
            display: block;
            margin-bottom: 5px;
        }

        .input-field input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-field input:focus {
            border-color: #f8b400;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #f8b400;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #f85c42;
        }

        .login-prompt {
            margin-top: 20px;
            font-size: 14px;
            color: #333;
        }

        .login-prompt a {
            color: #f8b400;
            text-decoration: none;
        }

        .login-prompt a:hover {
            text-decoration: underline;
        }
    </style>
<body>
<form action="<?php echo BASE_URL?>User/register" method="post" class="registration-form" enctype="multipart/form-data">
    <h2 class="title" style="text-align: center;">Đăng Ký</h2>
       <!-- Hiển thị thông báo nếu có -->
       <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
    <div class="input-field">
        <label for="username">Tên đăng nhập</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="input-field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="input-field">
        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div class="input-field">
        <label for="fullname">Tên</label>
        <input type="text" id="fullname" name="fullname" required>
    </div>
    <div class="input-field">
        <label for="avatar">Ảnh</label>
        <input type="file" id="avatar" name="avatar" required>
    </div>

    <div class="input-field">
        <label for="phone">Số điện thoại</label>
        <input type="tel" id="phone" name="phone" required>
    </div>
    <div class="input-field">
        <label for="address">Địa chỉ</label>
        <input type="text" id="address" name="address" required>
    </div>
    <input type="submit" value="Đăng Ký" class="btn">
    <p class="login-prompt" style="text-align: center;"><a href="<?php echo BASE_URL?>User/login" id="show-login-form" style="text-decoration: none;">Đăng nhập</a></p>
</form>


</body>
</html>
<style>
  
