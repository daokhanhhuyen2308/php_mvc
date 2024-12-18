<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Hàng</title>
    <style>
        .order-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
            padding: 0 20px;
            padding-bottom: 20px;
        }

        .payment-info,
        .order-summary {
            flex: 1;
            padding: 20px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .payment-info h2,
        .order-summary h2 {
            margin-bottom: 15px;
            font-size: 22px;
            color: #007bff;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }

        .product-info-horizontal {
            display: flex;
            align-items: center;
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
        }

        .product-info-horizontal .product-image img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }

        .product-info-horizontal .product-name {
            flex: 1;
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }

        .product-info-horizontal .product-price {
            font-size: 16px;
            font-weight: bold;
            color: #e53935;
        }

        .order-summary .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
            color: #555;
        }

        .order-summary .summary-row.total {
            font-weight: bold;
            font-size: 18px;
            color: #333;
            border-bottom: none;
        }

        .order-summary .checkout-button {
            display: block;
            text-align: center;
            padding: 12px 20px;
            margin-top: 15px;
            background: #007bff;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .order-summary .checkout-button:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đặt Hàng</title>
        <style>
            /* CSS của bạn giữ nguyên */
            .order-container {
                display: flex;
                justify-content: space-between;
                gap: 20px;
                margin-top: 20px;
                padding: 0 20px;
                padding-bottom: 20px;
            }

            .payment-info,
            .order-summary {
                flex: 1;
                padding: 20px;
                border-radius: 8px;
                background: #fff;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }

            .payment-info h2,
            .order-summary h2 {
                margin-bottom: 15px;
                font-size: 22px;
                color: #007bff;
                text-align: center;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                font-size: 14px;
                color: #555;
            }

            .form-group input,
            .form-group select {
                width: 100%;
                padding: 12px;
                font-size: 14px;
                border: 1px solid #ccc;
                border-radius: 4px;
                transition: border-color 0.3s;
            }

            .form-group input:focus,
            .form-group select:focus {
                border-color: #007bff;
                outline: none;
            }

            .product-info-horizontal {
                display: flex;
                align-items: center;
                margin-top: 15px;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                background: #f9f9f9;
            }

            .product-info-horizontal .product-image img {
                width: 80px;
                height: 80px;
                object-fit: cover;
                border-radius: 5px;
                margin-right: 15px;
            }

            .product-info-horizontal .product-name {
                flex: 1;
                font-size: 16px;
                font-weight: 500;
                color: #333;
            }

            .product-info-horizontal .product-price {
                font-size: 16px;
                font-weight: bold;
                color: #e53935;
            }

            .order-summary .summary-row {
                display: flex;
                justify-content: space-between;
                padding: 8px 0;
                border-bottom: 1px solid #ddd;
                font-size: 16px;
                color: #555;
            }

            .order-summary .summary-row.total {
                font-weight: bold;
                font-size: 18px;
                color: #333;
                border-bottom: none;
            }

            .order-summary .checkout-button {
                display: block;
                text-align: center;
                padding: 12px 20px;
                margin-top: 15px;
                background: #007bff;
                color: #fff;
                font-size: 16px;
                border-radius: 5px;
                text-decoration: none;
                font-weight: bold;
                transition: background-color 0.3s;
                width: 100%;
            }

            .order-summary .checkout-button:hover {
                background: #0056b3;
            }
        </style>
    </head>

    <body>
        <div class="order-container">
            <!-- Thông tin thanh toán -->
            <div class="payment-info">
                <h2>Thông tin thanh toán</h2>
                <form action="<?php echo BASE_URL . 'Order/checkout'; ?>" method="POST">
                    <div class="form-group">
                        <label for="payment_method">Phương thức thanh toán:</label>
                        <select id="payment_method" name="payment_method" required>
                            <option value="Visa">Visa</option>
                            <option value="MasterCard">MasterCard</option>
                            <option value="PayPal">PayPal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="card_number">Số thẻ:</label>
                        <input type="text" id="card_number" name="card_number" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Ngày hết hạn:</label>
                        <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVC/CVV:</label>
                        <input type="text" id="cvv" name="cvv" placeholder="XXX" required>
                    </div>
                    <div class="form-group">
                        <label for="card_name">Tên trên thẻ:</label>
                        <input type="text" id="card_name" name="card_name" placeholder="Nguyễn Văn A" required>
                    </div>

                    <h3>Thông tin đặt hàng</h3>
                    <?php if (!empty($data['products'])): ?>
                        <?php foreach ($data['products'] as $product): ?>
                            <div class="product-info-horizontal">
                                <div class="product-image">
                                    <img src="<?php echo isset($product['hinhanh']) ? BASE_URL . $product['hinhanh'] : 'default.jpg'; ?>" alt="Product Image">
                                </div>
                                <div class="product-name">
                                    <?php echo isset($product['tensp']) ? $product['tensp'] : ''; ?>
                                </div>
                                <div class="product-price">
                                    <?php
                                    $totalPrice = isset($product['giaban']) && isset($product['khuyenmai'])
                                        ? $product['giaban'] - $product['khuyenmai']
                                        : 0;
                                    echo number_format($totalPrice, 0, ',', '.') . " VNĐ";
                                    ?>
                                </div>

                                <!-- Thêm các trường ẩn cho masp và total_price -->
                                <input type="hidden" name="masp[]" value="<?php echo $product['masp']; ?>">
                                <input type="hidden" name="total_price[]" value="<?php echo $totalPrice; ?>">
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Không có sản phẩm nào để hiển thị.</p>
                    <?php endif; ?>

                    <h2>Tóm tắt đơn hàng</h2>
                    <div class="order-summary">
                        <?php
                        $tongGiaGoc = 0;
                        $tongChietKhau = 0;
                        $tongTien = 0;

                        // Tính toán tổng giá trị các sản phẩm
                        if (!empty($data['products'])) {
                            foreach ($data['products'] as $product) {
                                $giaGoc = isset($product['giaban']) ? $product['giaban'] : 0;
                                $chietKhau = isset($product['khuyenmai']) ? $product['khuyenmai'] : 0;
                                $giaSauChietKhau = $giaGoc - $chietKhau;

                                $tongGiaGoc += $giaGoc;
                                $tongChietKhau += $chietKhau;
                                $tongTien += $giaSauChietKhau;
                            }
                        }

                        // Lấy thông tin voucher (nếu có)
                        $voucherDiscount = 0;
                        if (isset($data['validVoucher'])) {
                            $voucherDiscount = isset($data['validVoucher']['discount_amount']) ? $data['validVoucher']['discount_amount'] : 0;
                        }

                        // Trừ giá trị voucher vào tổng tiền thanh toán
                        $tongTien -= $voucherDiscount;
                        ?>

                        <?php if (isset($data['validVoucher'])): ?>
                            <!-- Thêm trường ẩn cho mã voucher -->
                            <input type="hidden" name="voucher_code" value="<?php echo $data['validVoucher']['voucher_code']; ?>">
                        <?php endif; ?>

                        <?php if ($tongTien > 0): ?>
                            <div class="summary-row">
                                <span><strong>Tổng giá gốc:</strong></span>
                                <span><?php echo number_format($tongGiaGoc, 0, ',', '.') . " VNĐ"; ?></span>
                            </div>
                            <div class="summary-row">
                                <span><strong>Tổng chiết khấu:</strong></span>
                                <span><?php echo number_format($tongChietKhau, 0, ',', '.') . " VNĐ"; ?></span>
                            </div>
                            <div class="summary-row voucher">
                                <span><strong>Voucher:</strong></span>
                                <span><?php echo number_format($voucherDiscount, 0, ',', '.') . " VNĐ"; ?></span>
                            </div>
                            <div class="summary-row total">
                                <span><strong>Tổng tiền thanh toán:</strong></span>
                                <span><?php echo number_format($tongTien, 0, ',', '.') . " VNĐ"; ?></span>
                                <input type="hidden" name="final_price" value="<?php echo $tongTien ?>">
                                <?php
                                // echo "Tổng tiền $tongTien";
                                ?>
                            </div>
                            <!-- Truyền tổng tiền đã tính toán -->
                        <?php else: ?>
                            <p></p>
                        <?php endif; ?>
                        <button type="submit" class="checkout-button" style="border: none; cursor: pointer;">Thanh toán</button>
                    </div>
                </form>

            </div>
        </div>
    </body>

    </html>