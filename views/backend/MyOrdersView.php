<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .container {
        margin-top: 20px;
        padding: 10px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f4f4f4;
    }

    .text-center {
        text-align: center;
        font-style: italic;
    }
    </style>
</head>
<body>
    
</body>
</html>
<div class="container">
    <h2 style="text-align: center;">Danh sách đơn đặt hàng của bạn</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Ngày đặt hàng</th>
                <th>Ngày cập nhật</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['orders'])): ?>
                <?php foreach ($data['orders'] as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['masp']); ?></td>
                        <td><?php echo htmlspecialchars($order['tensp']); ?></td>
                        <td><?php echo number_format($order['price'], 2); ?> VNĐ</td>
                        <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td><?php echo htmlspecialchars($order['last_updated']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Bạn chưa có đơn đặt hàng nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


