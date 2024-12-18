<?php
// Kiểm tra và hiển thị thông tin nếu có
$orderID = isset($data["orderID"]) ? $data["orderID"] : null;
if ($orderID) {
    $orderCode = $orderID["order_code"];
    $fullname = $orderID["fullname"];
    $quantity = $orderID["total_quantity"];
    $totalPrice = number_format($orderID["total_price"], 2);
    $orderStatus = $orderID["order_status"];
    $paymentMethod = $orderID["payment_method"];
    $cardNumber = substr($orderID["payment_card_number"], 0, 4) . " **** **** ****";
    $cardName = $orderID["payment_card_name"];
    $expiryDate = $orderID["payment_expiry_date"];
    $paymentTime = $orderID["payment_time"];
    $paymentTime = date("d/m/Y H:i:s", strtotime($paymentTime));
    $paymentCvv = substr($orderID["payment_cvv"], 0, 2) . " ***";
    $paymentTime = date("d/m/Y H:i:s", strtotime($paymentTime));
    // Chuyển mảng mã sản phẩm thành một chuỗi, nối bằng dấu phẩy
    // $productCodes = array_map(fn($item) => htmlspecialchars($item['masp']), $orderItems);
    // $productList = implode(', ', $productCodes); // Nối mã sản phẩm thành chuỗi
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Hàng Thành Công</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            color: #28a745;
            text-align: center;
        }

        .order-info {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .order-info p {
            font-size: 16px;
            line-height: 1.6;
        }

        .order-info table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .order-info th,
        .order-info td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .order-info th {
            background-color: #007bff;
            color: white;
        }

        .order-info td {
            background-color: #f9f9f9;
        }

        .order-info td a {
            color: #007bff;
            text-decoration: none;
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
        <h2>Đặt hàng thành công!</h2>
        <div class="order-info">
            <p><strong>Mã đơn hàng:</strong> <?php echo htmlspecialchars($orderCode) ?></p>
            <p><strong>Tên người mua:</strong> <?php echo htmlspecialchars($fullname); ?></p>
            <p><strong>Mã sản phẩm:</strong>
            <ul>
                <?php foreach ($data["orderItems"] as $item): ?>
                    <?php echo htmlspecialchars($item['masp']); ?>
                <?php endforeach; ?>
            </ul>
            </p>
            <p><strong>Số lượng:</strong> <?php echo htmlspecialchars($quantity) ?></p>
            <p><strong>Tổng giá trị:</strong> <?php echo htmlspecialchars($totalPrice) ?> VNĐ</p>
            <p><strong>Trạng thái đơn hàng:</strong> <?php echo htmlspecialchars($orderStatus) ?></p>
            <p><strong>Phương thức thanh toán:</strong> <?php echo htmlspecialchars($paymentMethod) ?></p>
            <p><strong>Số thẻ:</strong> <?php echo htmlspecialchars($cardNumber) ?></p>
            <p><strong>Tên trên thẻ:</strong> <?php echo htmlspecialchars($cardName) ?></p>
            <p><strong>Thời gian thanh toán:</strong> <?php echo htmlspecialchars($paymentTime) ?></p>
        </div>
        <div class="back-btn">
            <a href="<?php echo BASE_URL; ?>Cart/getShow">Tiếp tục mua hàng</a>
        </div>
    </div>

</body>

</html>