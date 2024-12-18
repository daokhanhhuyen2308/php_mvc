<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/profile.css"> -->
    <style>
        .profile-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            /* Màu nền với độ trong suốt */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            backdrop-filter: blur(30px);
            /* Hiệu ứng blur cho nền */
        }

        h2,
        h3 {
            text-align: center;
            color: #333;
        }

        .profile-info {
            display: flex;
            margin-bottom: 20px;
        }

        .profile-avatar {
            flex: 1;
            margin-right: 20px;
            text-align: center;
        }

        .profile-avatar img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid #007bff;
        }

        .profile-details {
            flex: 2;
        }

        .profile-details label {
            display: block;
            margin: 10px 0 5px;
        }

        .profile-details input[type="text"],
        .profile-details input[type="email"],
        .profile-details input[type="password"],
        .profile-details input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            /* Màu sắc của nút */
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            /* Để không có gạch chân */
        }

        .btn:hover {
            background-color: #0056b3;
            /* Màu khi hover */
        }

        .profile-settings {
            margin-top: 20px;
            text-align: center;
        }

        .profile-settings label {
            font-size: 14px;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <h2>Thông tin cá nhân</h2>

        <?php if (isset($_SESSION['user'])): ?>
            <!-- Form cập nhật thông tin người dùng -->
            <form action="<?php echo BASE_URL; ?>User/updateProfile" method="POST" enctype="multipart/form-data">
                <div class="profile-info">
                    <div class="profile-avatar">
                        <label for="avatar">Ảnh đại diện</label>
                        <img
                            src="<?php echo !empty($_SESSION['user']['avatar'])
                                        ? BASE_URL . $_SESSION['user']['avatar']
                                        : BASE_URL . 'public/images/default_avatar.jpg'; ?>"
                            alt="Avatar"
                            class="avatar">
                        <input type="file" id="avatar" name="avatar">
                    </div>

                    <div class="profile-details">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" value="<?php echo $_SESSION['user']['username']; ?>" readonly>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>">

                        <label for="password">Mật khẩu mới</label>
                        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu mới">

                        <label for="fullname">Tên đầy đủ</label>
                        <input type="text" id="fullname" name="fullname" value="<?php echo $_SESSION['user']['fullname']; ?>">

                        <label for="phone">Số điện thoại</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo $_SESSION['user']['phone']; ?>">

                        <label for="address">Địa chỉ</label>
                        <input type="text" id="address" name="address" value="<?php echo $_SESSION['user']['address']; ?>">
                    </div>
                </div>

                <a href="<?php echo BASE_URL ?>Home" class="btn cancel-btn" style="text-align: center; text-decoration: none; background: #007bff;">Trang chủ</a>
                <button type="submit" class="btn">Cập nhật thông tin</button>
            </form>


        <?php else: ?>
            <p>Không tìm thấy thông tin người dùng.</p>
        <?php endif; ?>

        <!-- Cài đặt thông báo -->
        <div class="profile-settings">
            <h3>Cài đặt thông báo</h3>
            <label>
                <input type="checkbox" name="notifications" checked> Nhận thông báo khi có thay đổi
            </label>
        </div>

    </div>

</body>

</html>