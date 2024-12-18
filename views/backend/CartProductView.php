<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-top: 20px;
        }

        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            width: 70px;
            height: auto;
            border-radius: 8px;
            transition: transform 0.3s;
        }

        img:hover {
            transform: scale(1.1);
        }

        .total-price {
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
            text-align: right;
        }

        .btn {
            display: inline-block;
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #218838;
        }

        .remove-btn {
            background-color: #dc3545;
            color: #fff;
            border-radius: 4px;
            padding: 5px 10px;
            text-decoration: none;
        }

        .remove-btn:hover {
            background-color: #c82333;
        }

        .update-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .update-btn:hover {
            background-color: #0056b3;
        }

        .checkout-row {
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <h1>Giỏ Hàng Của Bạn</h1>
    <table>
        <tr>
            <th>Tên Sản Phẩm</th>
            <th>Hình Ảnh</th>
            <th>Mã Sản Phẩm</th>
            <th>Giá Gốc</th>
            <th>Giá Giảm</th>
            <th>Thành Tiền</th>
            <th>Thao Tác</th>
        </tr>
        <?php
        $grandTotal = 0; // Biến tổng giá trị giỏ hàng
        foreach ($data["cartItems"] as $v) {
            // Tính giá sau khuyến mãi
            $grandTotal += $v['price'];
        ?>
            <tr>
                <td><?php echo $v["tensp"]; ?></td>
                <td>
                    <img src="<?php echo BASE_URL ?><?php echo $v["hinhanh"]; ?>" alt="Hình ảnh sản phẩm" />
                </td>
                <td><?php echo $v["masp"]; ?></td>
                <td><?php echo number_format($v["original_price"], 0, ',', '.'); ?> VNĐ</td>
                <td><?php echo number_format($v["discount"], 0, ',', '.'); ?> VNĐ</td> <!-- Khuyến mãi (tiền) -->
                <td><?php echo number_format($v["price"], 0, ',', '.'); ?> VNĐ</td> <!-- Giá sau khuyến mãi -->
                <td>
                    <a href="<?php echo BASE_URL ?>Cart/deleteFromCart/<?php echo $v["masp"]; ?>" class="remove-btn">Xóa</a>
                    <a href="<?php echo BASE_URL ?>Order/order/<?php echo $v["masp"]; ?>" class="update-btn">Đặt hàng</a>
                </td>
            </tr>
        <?php } ?>
        <tr class="checkout-row">
            <td colspan="6" style="text-align: right;">Tổng Giỏ Hàng: <?php echo number_format($grandTotal, 0, ',', '.'); ?> VNĐ</td>
            <td>
                <!-- Nút mua hàng -->
                <a href="<?php echo BASE_URL ?>Order/order" class="btn" style="width: 100%; text-align: center">Mua Hàng</a>
                <!-- <form action="<?php echo BASE_URL ?>Order/order" method="POST">
                    <input type="submit" value="Mua Hàng" class="btn">
                </form> -->
            </td>
        </tr>
    </table>
</body>

</html>