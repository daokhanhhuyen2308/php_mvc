<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <style>
        .container {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .order-table th,
        .order-table td {
            border: 1px solid #ddd;
            padding: 10px 15px;
            text-align: left;
        }

        .order-table th {
            background-color: #007BFF;
            color: #fff;
            font-weight: bold;
        }

        .order-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .order-table tr:hover {
            background-color: #e9ecef;
        }

        .status-select {
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
        }

        .status-select:focus {
            border-color: #007BFF;
        }

        .btn {
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-update {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .btn-update:hover {
            background-color: #218838;
        }

        .btn-detail {
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
        }

        .btn-detail:hover {
            background-color: #0056b3;
        }

        .btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION['success_message'];
            unset($_SESSION['success_message']); // Xóa thông báo sau khi hiển thị
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
            <?php
            echo $_SESSION['error_message'];
            unset($_SESSION['error_message']); // Xóa thông báo sau khi hiển thị
            ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <h1>Danh sách đơn hàng</h1>
        <table class="order-table">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên người dùng</th>
                    <th>Tổng số lượng</th>
                    <th>Tổng giá</th>
                    <th>Mã voucher</th>
                    <th>Trạng thái</th>
                    <th>Phương thức thanh toán</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data["orders"] as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_code']); ?></td>
                        <td><?php echo htmlspecialchars($order['username']); ?></td>
                        <td><?php echo $order['total_quantity']; ?></td>
                        <td><?php echo number_format($order['total_price'], 2); ?> VNĐ</td>
                        <td><?php echo $order['voucher_code'] ?: 'Không'; ?></td>
                        <td>
                            <form method="POST" action="<?php echo BASE_URL . 'Order/updateOrder'; ?>">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <select name="order_status" class="status-select">
                                    <option value="Pending" <?php echo $order['order_status'] === 'Pending' ? 'selected' : ''; ?>>Chờ xử lý</option>
                                    <option value="Completed" <?php echo $order['order_status'] === 'Completed' ? 'selected' : ''; ?>>Hoàn thành</option>
                                    <option value="Cancelled" <?php echo $order['order_status'] === 'Cancelled' ? 'selected' : ''; ?>>Đã hủy</option>
                                </select>
                                <button type="submit" class="btn btn-update">Cập nhật</button>
                            </form>
                        </td>
                        <td><?php echo $order['payment_method']; ?></td>
                        <td>
                            <a href="<?php echo BASE_URL . 'Order/orderDetail/' . $order['order_id']; ?>" class="btn btn-detail">Chi tiết</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>