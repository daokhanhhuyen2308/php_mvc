<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/form.css">
</head>

<body>
    <form action="<?php echo BASE_URL; ?>User/login" method="post" class="sign-in-form" id="sign-in">
        <h2 class="title" style="text-align: center;">Đăng nhập</h2>
        <div class="input-field">
            <i class="fa-solid fa-user"></i>
            <input type="text" id="username" name="username" placeholder="Tên đăng nhập" required>
        </div>
        <div class="input-field">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
        </div>
        <input type="submit" value="Đăng nhập" class="btn solid">
        <p class="register-prompt" style="text-align: center;">Chưa có tài khoản? <a href="<?php echo BASE_URL; ?>User/register" id="show-register-form" style="text-decoration: none;">Đăng ký ngay</a></p>
    </form>
</body>

</html> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/form.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #f8b400, #f85c42);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sign-in-form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .sign-in-form .title {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .avatar {
            margin-bottom: 20px;
        }

        .avatar img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 2px solid #f8b400;
        }

        .input-field {
            margin-bottom: 20px;
            position: relative;
        }

        .input-field i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .input-field input {
            width: 100%;
            padding: 12px 40px;
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

        .register-prompt {
            margin-top: 20px;
            font-size: 14px;
            color: #333;
        }

        .register-prompt a {
            color: #f8b400;
            text-decoration: none;
        }

        .register-prompt a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <form action="<?php echo BASE_URL; ?>User/login" method="post" class="sign-in-form" id="sign-in">
        <div class="avatar">
            <!-- Thêm avatar mặc định hoặc từ URL -->
            <img
        class="user"
        src="https://i.ibb.co/yVGxFPR/2.png"
        height="100px"
        width="100px"
       alt="Avatar" />
        </div>
        <h2 class="title">Đăng nhập</h2>
        <div class="input-field">
            <i class="fa-solid fa-user"></i>
            <input type="text" id="username" name="username" placeholder="Tên đăng nhập" required>
        </div>
        <div class="input-field">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
        </div>
        <input type="submit" value="Đăng nhập" class="btn solid">
        <p class="register-prompt">Chưa có tài khoản? <a href="<?php echo BASE_URL; ?>User/register" id="show-register-form">Đăng ký ngay</a></p>
    </form>
</body>

</html>
