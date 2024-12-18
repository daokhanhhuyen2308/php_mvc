<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Voucher</title>
    <style>
        h1 {
            text-align: center;
            color: #333;
        }

        .vouchers-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .voucher-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .voucher-card:hover {
            transform: scale(1.05);
        }

        .voucher-code {
            font-weight: bold;
            font-size: 18px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .save-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .save-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <h1>Danh sách Voucher</h1>

    <div class="vouchers-container">
        <?php foreach ($data["vouchers"] as $voucher): ?>
            <div class="voucher-card">
                <div class="voucher-code"><?php echo htmlspecialchars($voucher["voucher_code"]); ?></div>
                <div class="description"><?php echo htmlspecialchars($voucher["description"]); ?></div>
                <div class="discount-amount">Giảm giá: <?php echo htmlspecialchars($voucher["discount_amount"]); ?></div>
                <div class="valid-from">Từ: <?php echo htmlspecialchars($voucher["valid_from"]); ?></div>
                <div class="valid-until">Đến: <?php echo htmlspecialchars($voucher["valid_until"]); ?></div>
                <div class="button-container">
                    <button class="save-button" onclick="saveVouchers()">Lưu</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <script>
        function saveVouchers() {
            // Xử lý lưu voucher tại đây
            alert('Đã lưu thành công!');
        }
    </script>

</body>

</html>