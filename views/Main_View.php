<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/style.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            background: linear-gradient(-45deg, tomato, lightgreen, pink, orange);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 30%;
            }

            30% {
                background-position: 30% 60%;
            }

            60% {
                background-position: 60% 100%;
            }

            100% {
                background-position: 100% 0%;
            }
        }

        /* Bố cục danh sách sản phẩm */
        .list-product {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            /* Chia 5 cột */
            gap: 20px;
            margin: 10px 0;
            overflow: hidden;
            padding: 20px;
        }

        .item {
            /* flex: 0 0 20%; */
            /* 5 sản phẩm trên một hàng */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
            transition: transform 0.8s;

        }

        .item:hover {
            transform: scale(1.05);
        }

        .item img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 5px;
            object-fit: cover;
        }

        .item h2 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .price {
            font-size: 14px;
            color: #e74c3c;
            margin-bottom: 15px;
            display: block;
        }

        .discount {
            color: #27ae60;
            font-size: 12px;
            margin-left: 10px;
        }


        /* Nút "Add to Cart" */
        .item .addToCart {
            display: inline-block;
            padding: 5px 10px;
            font-size: 0.9rem;
            color: #333;
            background-color: transparent;
            border: 1px solid lightcoral;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            margin-top: 10px;
        }

        .item .addToCart:hover {
            background-color: tomato;
            color: #fff;
        }

        /* Link "Detail" */
        .item .detail {
            display: inline-block;
            margin-top: 10px;
            font-size: 0.85rem;
            color: #3498db;
            text-decoration: none;
            border: 1px solid #3498db;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .item .detail:hover {
            background-color: #3498db;
            color: #fff;
        }

        .search-form {
            display: flex;
            align-items: center;
            margin-left: auto;
            /* Đẩy form tìm kiếm sang bên phải */
        }

        .search-form input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            outline: none;
        }

        .search-form button {
            padding: 6px 10px;
            background-color: #007bff;
            border: none;
            border-radius: 10px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        .nav__links li {
            position: relative;
            /* Đặt vị trí tương đối để con số có thể căn chỉnh đúng */
        }

        .nav__links .quantity {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 5px;
            font-size: 12px;
            line-height: 1;
            text-align: center;
        }


        /* toast */

        .toast {
            width: 400px;
            height: 80px;
            background-color: #fff;
            font-weight: 500;
            margin: 15px 0;
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            display: flex;
            align-items: center;
            border-right: 5px solid green;
            /* border-bottom: 4px solid var(--success); */
            position: fixed;
            left: -400px;
            bottom: 0;
            transition: 0.2s ease;

        }

        .show-toast {
            left: 10px;
            transition: 0.2s ease;
        }

        .toast .content {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .toast .content svg {
            margin: 0 10px;
        }

        .move {
            animation: ring-animation 0.2s ease;
        }

        @keyframes ring-animation {
            0% {
                transform: rotate(-20deg);
            }

            50% {
                transform: rotate(20deg);
            }

            100% {
                transform: rotate(-20deg);
            }
        }

        /* css pagination */

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .pagination a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            font-size: 18px;
            color: #3498db;
            text-decoration: none;
            border: 2px solid #3498db;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background-color: #3498db;
            color: #fff;
            transform: scale(1.1);
        }

        .pagination a.disabled {
            color: #ccc;
            border-color: #ccc;
            pointer-events: none;
            /* Không cho phép click */
        }

        .pagination a.active {
            background-color: #3498db;
            color: #fff;
            border-color: #3498db;
            transform: scale(1.1);
        }

        .pagination a svg {
            width: 20px;
            height: 20px;
        }

        /* css feature courses */

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
    <div class="container">
        <header>
            <img src="<?php echo BASE_URL ?>public/images/logo.png" alt="" class="logo">
            <form action="<?php echo BASE_URL; ?>AdProduct/search" method="POST" class="search-form">
                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." required>
                <button type="submit">Search</button>
            </form>
            <nav>
                <ul class="nav__links">
                    <li><a href="<?php echo BASE_URL; ?>Home">Trang chủ</a></li>
                    <li><a href="<?php echo BASE_URL; ?>services">Dịch vụ</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Contact"><i class="fa-solid fa-phone-volume"></i> Liên hệ</a></li>
                    <?php if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin'): ?>
                        <li><a href="<?php echo BASE_URL; ?>Cart/getShow"><i class="fa-solid fa-cart-shopping"></i><span class="quantity"><?php echo $data["cartCount"]; ?></span></a></li>
                    <?php endif; ?>

                    <?php
                    // Kiểm tra role và hiển thị menu tương ứng
                    if (isset($_SESSION['user'])) {
                        $role = $_SESSION['user']['role'];
                        if ($role === 'admin') {
                            require_once "./views/pages/MenuAdminView.php";
                        } else {
                            require_once "./views/pages/MenuUserView.php";
                        }
                    }
                    ?>
                </ul>
            </nav>

            <?php if (!isset($_SESSION['user'])): ?>
                <a href="<?php echo BASE_URL; ?>User/login" style="margin-left: 20px;"><i class="fas fa-user"></i></a>
            <?php endif; ?>
        </header>
        <section>
            <div class="content">
                <!-- Kiểm tra nếu người dùng là guest hoặc user -->

                <?php
                if (isset($data['page'])) {
                    require_once "./views/" . $data['page'] . ".php";
                }
                ?>

            </div>

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
        </section>
        <script>

        </script>
        <script type="module" src="<?php echo BASE_URL ?>js/app.js"></script>
</body>

</html>