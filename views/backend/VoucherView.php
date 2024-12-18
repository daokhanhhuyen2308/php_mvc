<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Voucher</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .voucher-container {
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .voucher-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .voucher-table th,
        .voucher-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .voucher-table th {
            background-color: #009688;
            /* Màu teal */
            color: white;
            font-weight: bold;
        }

        .voucher-table tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 5px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-add {
            background-color: #007BFF;
            /* Màu xanh dương */
        }

        .btn-update {
            background-color: #4CAF50;
            /* Màu xanh lá cây */
        }

        .btn-delete {
            background-color: #f44336;
            /* Màu đỏ */
        }

        /* Hiệu ứng hover cho các nút */
        .btn:hover {
            opacity: 0.9;
            transform: scale(1.05);
            /* Tăng kích thước nhẹ khi hover */
        }

        /* Định dạng cột hành động */
        .voucher-table td:last-child {
            display: flex;
            justify-content: space-evenly;
            /* Căn giữa và phân bổ đều */
        }
    </style>
</head>

<body>
    <div class="voucher-container">
        <h1 style="text-align: center; margin-bottom: 20px;">Quản Lý Voucher</h1>
        <a href="<?php echo BASE_URL ?>Voucher/add" class="btn btn-add">Thêm Voucher</a>
        <table class="voucher-table">
            <thead>
                <tr>
                    <th>Mã Voucher</th>
                    <th>Mô Tả</th>
                    <th>Số Tiền Giảm Giá</th>
                    <th>Giá Trị Đơn Hàng Tối Thiểu</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Kết Thúc</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data["vouchers"] as $voucher): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($voucher['voucher_code']); ?></td>
                        <td><?php echo htmlspecialchars($voucher['description']); ?></td>
                        <td><?php echo number_format($voucher['discount_amount'], 0, ',', '.') . ' VNĐ'; ?></td>
                        <td><?php echo number_format($voucher['min_order_value'], 0, ',', '.') . ' VNĐ'; ?></td>
                        <td><?php echo htmlspecialchars($voucher['valid_from']); ?></td>
                        <td><?php echo htmlspecialchars($voucher['valid_until']); ?></td>
                        <td>
                            <a href="<?php echo BASE_URL ?>Voucher/update/<?php echo $voucher['voucher_code']; ?>" class="btn btn-update">Update</a>
                            <a href="./delete/<?php echo $voucher['voucher_code']; ?>" class="btn btn-delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>