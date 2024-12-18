<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Hàng Thất Bại</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            color: #dc3545;
            text-align: center;
        }

        .error-info {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .error-info p {
            font-size: 16px;
            line-height: 1.6;
            color: #dc3545;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 30px;
        }

        .back-btn a {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Đặt hàng thất bại!</h2>
        <div class="error-info">
            <p><strong>Lỗi:</strong> <?php echo $data['error_message']; ?></p>
        </div>
        <div class="back-btn">
            <a href="<?php echo BASE_URL; ?>Home">Quay lại trang chủ</a>
        </div>
    </div>
</body>

</html>
