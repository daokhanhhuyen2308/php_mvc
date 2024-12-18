<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Voucher</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Container bao quanh form */
        .voucher-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f9;
            padding: 20px;
        }

        /* Khung chứa form */
        .voucher-form {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        /* Tiêu đề */
        .voucher-form h1 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        /* Group từng phần form */
        .form-group {
            margin-bottom: 15px;
        }

        /* Nhãn */
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #555555;
        }

        /* Input và Textarea */
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        /* Tập trung vào input */
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
            background-color: #ffffff;
        }

        /* Hành động nút */
        .form-actions {
            text-align: center;
        }

        .form-actions .btn-submit {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-actions .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="voucher-container">
        <div class="voucher-form">
            <h1>Thêm Voucher Mới</h1>
            <form action="<?php echo BASE_URL ?>Voucher/add" method="POST">
                <div class="form-group">
                    <label for="voucher_code">Mã Voucher</label>
                    <input type="text" id="voucher_code" name="voucher_code" required>
                </div>

                <div class="form-group">
                    <label for="description">Mô Tả</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="discount_amount">Số Tiền Giảm Giá (VNĐ)</label>
                    <input type="number" id="discount_amount" name="discount_amount" min="0" required>
                </div>

                <div class="form-group">
                    <label for="min_order_value">Giá Trị Đơn Hàng Tối Thiểu (VNĐ)</label>
                    <input type="number" id="min_order_value" name="min_order_value" min="0" required>
                </div>

                <div class="form-group">
                    <label for="valid_from">Ngày Bắt Đầu</label>
                    <input type="date" id="valid_from" name="valid_from" required>
                </div>

                <div class="form-group">
                    <label for="valid_until">Ngày Kết Thúc</label>
                    <input type="date" id="valid_until" name="valid_until" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Thêm Voucher</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>