<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Người Dùng</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/user.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Search Form */
        .search-form {
            display: flex;
            align-items: center;
            flex: 1;
            margin: 0 20px;
            max-width: 500px;
        }

        .search-form input {
            width: 50%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 20px 0 0 20px;
            outline: none;
            font-size: 14px;
        }

        .search-form .search-btn {
            padding: 13.5px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 0 20px 20px 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-form .search-btn:hover {
            background-color: #2980b9;
        }

        /* Đặt font Poppins cho toàn bộ trang */
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

        .featured-courses {
            margin: 40px 0;
            position: relative;
        }

        .featured-courses h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .featured-courses .slider-container {
            position: relative;
            overflow: hidden;
            padding: 10px 0;
        }

        .featured-courses .feature-product {
            display: flex;
            transition: transform 0.5s ease-in-out;
            overflow: hidden;
        }

        .featured-courses .feature-product .item {
            flex: 0 0 50%;
            /* Chỉ 2 sản phẩm */
            max-width: 50%;
            text-align: center;
            padding: 15px;
            margin: 0 10px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .featured-courses .feature-product .item img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .featured-courses .feature-product .item h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #555;
        }

        .featured-courses .feature-product .item p.price {
            font-size: 16px;
            color: #e74c3c;
        }

        .featured-courses .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
            opacity: 0.8;
            transition: opacity 0.3s;
        }

        .featured-courses .slider-btn:hover {
            opacity: 1;
        }

        .featured-courses .slider-btn.prev {
            left: 10px;
        }

        .featured-courses .slider-btn.next {
            right: 10px;
        }
    </style>
</head>

<body>
    <div class="user-container">
        <header class="user-header">
            <div class="header-container">
                <!-- Logo -->
                <a href="<?php echo BASE_URL; ?>Home" class="logo-link">
                    <img src="<?php echo BASE_URL ?>public/images/logo.png" alt="Logo" class="logo">
                </a>

                <!-- Thanh tìm kiếm -->
                <form action="<?php echo BASE_URL; ?>AdProduct/search" method="POST" class="search-form">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." required>
                    <button type="submit" class="search-btn">Search</button>
                </form>

                <!-- Navigation -->
                <nav class="user-nav">
                    <ul>
                        <li><a href="<?php echo BASE_URL; ?>User/getMyProduct">Khóa học của tôi</a></li>
                        <li><a href="<?php echo BASE_URL; ?>NewsController/getShow" class="btn btn-primary">Tin tức</a>
                            </a></li>
                        <!-- <li><a href="<?php echo BASE_URL; ?>Voucher/getShow">Vouchers</a></li> -->
                        <li><a href="<?php echo BASE_URL; ?>User/getMyOrder">Đơn hàng của tôi</a></li>
                        <li><a href="<?php echo BASE_URL; ?>User/logout">Đăng xuất</a></li>
                    </ul>
                </nav>

                <!-- Giỏ hàng -->
                <a href="<?php echo BASE_URL; ?>Cart/showCart" class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">
                        <?php echo $data["cartCount"]; ?>
                    </span>
                </a>

                <!-- Avatar người dùng -->
                <a href="<?php echo BASE_URL; ?>User/profile" class="user-avatar-link">
                    <img
                        src="<?php echo !empty($_SESSION['user']['avatar'])
                                    ? BASE_URL . $_SESSION['user']['avatar']
                                    : BASE_URL . 'public/images/default_avatar.jpg'; ?>"
                        alt="Avatar"
                        class="user-avatar">
                </a>
            </div>
        </header>

        <main class="user-content">
            <?php if (isset($_SESSION['toastMessage'])): ?>
                <script type="text/javascript">
                    console.log("Toast message: <?php echo $_SESSION['toastMessage']; ?>");
                    showToast("<?php echo $_SESSION['toastMessage']; ?>");
                </script>
                <?php unset($_SESSION['toastMessage']); // Xóa thông báo sau khi hiển thị 
                ?>
            <?php endif; ?>
            <div class="toast">
                <div class="content">
                    <div class="icon">
                        <!-- <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.193-.538 1.193H5.538c-.538 0-.538-.6-.538-1.193 0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365Zm-8.134 5.368a8.458 8.458 0 0 1 2.252-5.714m14.016 5.714a8.458 8.458 0 0 0-2.252-5.714M8.54 17.901a3.48 3.48 0 0 0 6.92 0H8.54Z" />
                </svg> -->
                    </div>
                    <!-- <div class="title">Bạn đã thêm giỏ hàng thành công</div> -->
                </div>
            </div>
            <?php
            // if (isset($data['page'])) {
            //     require_once "./views/" . $data['page'] . ".php";
            // }
            if (isset($data['page'])) {
                // Kiểm tra nếu $data['page'] là mảng
                if (is_array($data['page'])) {
                    foreach ($data['page'] as $page) {
                        // Nhúng từng view trong mảng
                        require_once "./views/" . $page . ".php";
                    }
                } else {
                    // Nếu $data['page'] là chuỗi
                    require_once "./views/" . $data['page'] . ".php";
                }
            } else {
                echo "<p>No page found!</p>";
            }
            ?>
        </main>
    </div>
    <script src="<?php echo BASE_URL ?>js/app.js"></script>
</body>

</html>