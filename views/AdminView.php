<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản trị</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/admin.css">
    <style>
        .admin-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .admin-avatar:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            padding: 10px 0;
        }

        .pagination a,
        .pagination span {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            font-size: 16px;
            color: #3498db;
            text-decoration: none;
            border: 2px solid #3498db;
            border-radius: 50%;
            background-color: #fff;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .pagination a:hover {
            background-color: #3498db;
            color: #fff;
            transform: translateY(-2px);
        }

        .pagination a.disabled,
        .pagination span {
            color: #ccc;
            border-color: #ccc;
            background-color: #f9f9f9;
            cursor: not-allowed;
        }

        .pagination a.active {
            background-color: #3498db;
            color: #fff;
            border-color: #3498db;
            transform: scale(1.1);
            pointer-events: none;
        }

        .pagination a svg {
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <header class="admin-header">
            <div class="header-container">
                <a href="<?php echo BASE_URL?>Home" class="logo-link">
                    <img src="<?php echo BASE_URL ?>public/images/logo.png" alt="Logo" class="logo">
                </a>
                <form action="<?php echo BASE_URL; ?>AdProduct/search" method="POST" class="search-form">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." required>
                    <button type="submit" class="search-btn">Search</button>
                </form>
                <nav class="admin-nav">
                    <ul>
                        <!-- <li><a href="<?php echo BASE_URL; ?>AdProduct/getShow">Sản phẩm</a></li> -->
                        <li><a href="<?php echo BASE_URL; ?>AdProductType/">Danh mục sản phẩm</a></li>
                        <li><a href="<?php echo BASE_URL . 'NewsController/getShow/' . $news['id']; ?>" class="btn btn-primary">Tin tức</a>
                        <li><a href="<?php echo BASE_URL; ?>User/getAllUsers">Người dùng</a></li>
                        <li><a href="<?php echo BASE_URL; ?>Order/getAllOrders">Đơn hàng</a></li>
                        <li><a href="<?php echo BASE_URL; ?>Voucher/getAllVouchers">Vouchers</a></li>
                        <li><a href="<?php echo BASE_URL; ?>revenue/getShow">Doanh thu</a></li>
                        <li><a href="<?php echo BASE_URL; ?>User/logout">Đăng xuất</a></li>
                    </ul>
                    <a href="<?php echo BASE_URL; ?>User/profile" class="admin-avatar-link">
                        <img
                            src="<?php echo !empty($_SESSION['user']['avatar'])
                                        ? BASE_URL . $_SESSION['user']['avatar']
                                        : BASE_URL . 'public/images/default_avatar.jpg'; ?>"
                            alt="Avatar"
                            class="admin-avatar"
                            id="admin-avatar" style="width: 50px; height: 50px; border-radius: 10px;">
                    </a>
                </nav>
            </div>
        </header>

        <main class="admin-content">
            <?php
            // if (isset($data['page'])) {
            //     require_once "./views/" . $data['page'] . ".php";
            // }

            if (isset($data['page'])) {
                // Nếu $data['page'] là mảng, lặp qua từng phần tử và nhúng view
                if (is_array($data['page'])) {
                    foreach ($data['page'] as $page) {
                        require_once "./views/" . $page . ".php";
                    }
                } else {
                    // Nếu $data['page'] là chuỗi, chỉ nhúng 1 view
                    require_once "./views/" . $data['page'] . ".php";
                }
            }
            ?>

        </main>
    </div>

</body>

</html>