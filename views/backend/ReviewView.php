<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/user.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            line-height: 1.6;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            background: linear-gradient(-45deg, tomato, lightgreen, pink, orange);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .container {
            display: flex;
            gap: 20px;
            width: 100%;
            max-width: 1200px;
        }

        .form-container {
            flex: 3;
            /* 30% chiều rộng */
            background: Orange;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .reviews-container {
            flex: 7;
            /* 70% chiều rộng */
            background: Orange;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #e74c3c;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #555;
        }

        input,
        textarea {
            width: 90%;
            padding: 11px;
            margin-top: 1px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        button {
            background-color: #D2691E;
            color: black;
            border: none;
            padding: 9px 10px;
            border-radius: 5px;
            font-size: 13px;
            cursor: pointer;
            width: 97%;
        }

        button a {
            text-decoration: none;
            /* Loại bỏ gạch chân */
            background-color: #D2691E;
            color: black;
            border: none;
            padding: 9px 10px;
            border-radius: 5px;
            font-size: 13px;
            cursor: pointer;
            width: 97%;
        }


        button:hover {
            background-color: #D2691E;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
            color: #333;
        }

        table th {
            background-color: #D2691E;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #D2691E;
        }

        table th:last-child,
        table td:last-child {
            text-align: center;
            /* Canh giữa */
            font-style: italic;
            /* Nghiêng chữ */
            color: #555;
            /* Màu chữ nhạt hơn */
        }

        .login-prompt {
            margin-top: 20px;
            font-size: 14px;
            color: #333;
        }

        .login-prompt a {
            color: black;
            text-decoration: none;
        }

        .login-prompt a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Form đánh giá -->
        <div class="form-container">
            <h2>Đánh Giá<i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></h2>
            <form action="<?php echo BASE_URL; ?>contact/store" method="POST">
                <label for="name">Tên:</label>
                <input type="text" id="name" name="name" placeholder="Nhập tên của bạn" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Nhập email của bạn" required>

                <label for="message">Bình luận:</label>
                <textarea id="message" name="message" placeholder="Nhập lời nhắn của bạn" required></textarea>

                <button type="submit">Gửi </button>
                <p class="login-prompt" style="text-align: center;"><a href="<?php echo BASE_URL ?>Home/getShow" id="show-login-form" style="text-decoration: none;">Quay lại</a></p>

            </form>
        </div>

        <!-- Bảng đánh giá -->
        <div class="reviews-container">
            <h2> Đánh giá từ Khách Hàng</h2>
            <?php if (!empty($reviews)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Bình luận</th>
                            <th>Thời gian</th> <!-- Cột mới -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reviews as $review): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($review['name']); ?></td>
                                <td><?php echo htmlspecialchars($review['email']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($review['message'])); ?></td>
                                <td><?php echo htmlspecialchars(date('d-m-Y H:i:s', strtotime($review['created_at']))); ?></td> <!-- Hiển thị thời gian -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php else: ?>
                <p>Chưa có đánh giá nào.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>