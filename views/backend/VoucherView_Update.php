<?php
// Kiểm tra xem $data có chứa khóa productID hay không
$voucherID = isset($data["voucher"]) ? $data["voucher"] : null;

if ($voucherID) {
    $voucher_code = $voucherID["voucher_code"]; // Mã loại sản phẩm cố định
    $description = isset($_POST["description"]) ? $_POST["description"] : $voucherID["description"];
    $discount_amount = isset($_POST["discount_amount"]) ? $_POST["discount_amount"] : $voucherID["discount_amount"];
    $min_order_value = isset($_POST["min_order_value"]) ? $_POST["min_order_value"] : $voucherID["min_order_value"];
    $valid_from = isset($_POST["valid_from"]) ? $_POST["valid_from"] : $voucherID["valid_from"];
    $valid_until = isset($_POST["valid_until"]) ? $_POST["valid_until"] : $voucherID["valid_until"];
} else {
    // Xử lý khi không tìm thấy sản phẩm
    $voucher_code = "";
    $description = "";
    $discount_amount = "";
    $min_order_value = "";
    $valid_from = "";
    $valid_until = "";
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Voucher</title>
    <style>
        .voucher-update-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #4CAF50;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-field{
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .input-field:focus
        {
            border-color: #4CAF50;
            outline: none;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 10px 15px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-update {
            background-color: #4CAF50;
            font-size: 16px;
            font-weight: 550;
            /* Màu xanh lá cây */
        }

        .btn-cancel {
            background-color: #f44336;
            text-decoration: none;
            /* Màu đỏ */
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="voucher-update-container">
        <h2>Cập Nhật Voucher</h2>
        <form action="<?php echo BASE_URL; ?>Voucher/update/<?php echo htmlspecialchars($voucher_code); ?>" method="POST">
            <div class="form-group">
                <label for="voucher_code">Mã Voucher</label>
                <input type="text" class="input-field" id="voucher_code" name="voucher_code" value="<?php echo htmlspecialchars($voucher_code); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="description">Mô tả Voucher</label>
                <input type="text" class="input-field" id="description" name="description" value="<?php echo htmlspecialchars($description) ?>" required>
            </div>
            <div class="form-group">
                <label for="discount_amount">Giá Trị Voucher</label>
                <input type="number" class="input-field" id="discount_amount" name="discount_amount" value="<?php echo htmlspecialchars($discount_amount) ?>" required>
            </div>
            <div class="form-group">
                <label for="min_order_value">Giá Trị Voucher</label>
                <input type="number" class="input-field" id="min_order_value" name="min_order_value" value="<?php echo htmlspecialchars($min_order_value) ?>" required>
            </div>
            <div class="form-group">
                <label for="valid_from">Ngày Bắt Đầu</label>
                <input type="date" class="input-field" id="valid_from" name="valid_from" value="<?php echo htmlspecialchars($valid_from) ?>" required>
            </div>
            <div class="form-group">
                <label for="valid_until">Ngày Kết Thúc</label>
                <input type="date" class="input-field" id="valid_until" name="valid_until" value="<?php echo htmlspecialchars($valid_until) ?>" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-update">Update</button>
                <a href="Voucher" class="btn btn-cancel">Reset</a>
            </div>
        </form>
    </div>
</body>

</html>