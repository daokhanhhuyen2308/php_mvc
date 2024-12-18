<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <style>
        .product-detail {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: transparent;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: row;
        }

        .product-card {
            display: flex;
            flex: 1;
        }

        .product-image {
            flex: 1;
            /* Allow image to take proportionate width */
            padding-right: 20px;
            /* Space between image and info */
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            /* Rounded corners */
            transition: transform 0.3s ease;
            /* Animation */
        }

        .product-image img:hover {
            transform: scale(1.05);
            /* Zoom effect on hover */
        }

        .product-info {
            flex: 2;
            /* Allow info to take more width */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .info-row {
            margin-bottom: 10px;
        }

        .info-row strong {
            font-weight: bold;
            color: #333;
        }

        /* Căn chỉnh bố cục nhóm nút */
        .button-group {
            display: flex;
            /* Thay grid bằng flex để chia đều khoảng cách giữa các nút */
            gap: 10px;
            /* Khoảng cách giữa các nút */
        }

        .button-group a {
            margin: 0;
        }

        /* Kiểu chung cho các nút */
        .button-group a {
            padding: 10px 10px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            /* Bo góc */
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
            display: inline-block;
            width: 230px;
            text-transform: uppercase;
        }

        .addToCart {
            background-color: tomato;
            color: white;
            border: 2px solid #FF9800;
        }

        .addToCart:hover {
            background-color: pink;
            border-color: #FF5722;
            color: black;
            transform: translateY(-2px);
        }

        .buy-now {
            background-color: #4CAF50;
            color: white;
            border: 2px solid #4CAF50;
        }

        .buy-now:hover {
            background-color: #ddd;
            border-color: #388E3C;
            color: black;
            transform: translateY(-2px);
        }

        .description {
            margin-top: 20px;
        }

        /* Định dạng chung */
        #review-list {
            list-style-type: none;
            padding: 0;
        }

        #review-list li {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #review-list li strong {
            font-size: 1.2rem;
            color: #333;
        }

        #review-list li span {
            font-size: 1rem;
            color: #555;
            margin-left: 10px;
        }

        #review-list li p {
            margin: 10px 0;
            font-size: 1rem;
            color: #666;
        }

        #review-list li small {
            display: block;
            font-size: 0.9rem;
            color: #999;
        }

        .review-action-form,
        .review-edit-form {
            display: inline-block;
            margin-top: 10px;
        }

        .delete-review-btn,
        .update-review-btn {
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .update-review-btn {
            background-color: #4CAF50;
            margin-left: 5px;
        }

        .delete-review-btn:hover,
        .update-review-btn:hover {
            opacity: 0.8;
        }

        #review-form {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #review-form h4 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 15px;
        }

        #review-form label {
            font-size: 1rem;
            color: #555;
            display: block;
            margin-top: 10px;
        }

        #review-form input,
        #review-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        #review-form textarea {
            height: 100px;
        }

        #review-form .submit-review-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 15px;
            font-size: 1rem;
            cursor: pointer;
        }

        #review-form .submit-review-btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <div class="product-detail">
        <div class="product-card">
            <div class="product-image">
                <img src="<?php echo BASE_URL . $data['product']['hinhanh']; ?>" alt="<?php echo $data['product']['tensp']; ?>" />
            </div>
            <div class="product-info">
                <h2><?php echo $data['product']['tensp']; ?></h2>
                <div class="info-row">
                    <strong>Mã loại sản phẩm:</strong> <span><?php echo $data['product']['ma_loaisp']; ?></span>
                </div>
                <div class="info-row">
                    <strong>Mã sản phẩm:</strong> <span><?php echo $data['product']['masp']; ?></span>
                </div>
                <div class="info-row">
                    <strong>Giá bán:</strong> <span><?php echo number_format($data['product']['giaban'], 0, ',', '.'); ?> VND</span>
                </div>
                <div class="info-row">
                    <strong>Giảm giá:</strong> <span><?php echo number_format($data['product']['khuyenmai'], 0, ',', '.'); ?> VND</span>
                </div>
                <div class="info-row">
                    <strong>Tổng tiền:</strong>
                    <span>
                        <?php
                        // Calculate the total price after discount
                        $total_price = $data['product']['giaban'] - $data['product']['khuyenmai'];
                        echo number_format($total_price, 0, ',', '.');
                        ?> VND
                    </span>
                </div>

                <?php if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'user')): ?>
                    <div class="button-group">
                        <a href="<?php echo BASE_URL . 'Cart/addToCart/' . $data['product']['masp']; ?>" class="addToCart">
                            <i class="fas fa-shopping-cart"></i> Thêm giỏ hàng
                        </a>
                        <a href="<?php echo BASE_URL . 'Order/order/' . $data['product']['masp']; ?>" class="buy-now">
                            <i class="fas fa-shopping-basket"></i> Mua ngay
                        </a>
                    </div>
                <?php endif; ?>

                <div class="info-row description">
                    <strong>Mô tả:</strong>
                    <p><?php echo $data['product']['mota']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Danh sách đánh giá -->
    <h2>Đánh giá</h2>
    <ul id="review-list">
        <?php foreach ($data["reviewList"] as $review): ?>
            <li id="review-<?php echo $review['review_id']; ?>">
                <strong><?php echo htmlspecialchars($review['fullname']); ?></strong>
                <span>(<?php echo htmlspecialchars($review['rating']); ?>/5)</span>
                <p><?php echo htmlspecialchars($review['comment']); ?></p>
                <small>Vào lúc: <?php echo date("d/m/Y H:i", strtotime($review['created_at'])); ?></small>

                    <!-- Form xóa đánh giá -->
                    <form method="POST" action="<?php echo BASE_URL ?>AdProduct/deleteReview" class="review-action-form">
                        <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                        <input type="hidden" name="masp" value="<?php echo $data['product']['masp']; ?>">
                        <button type="submit" class="delete-review-btn">Xóa</button>
                    </form>

                    <!-- Form sửa đánh giá -->
                    <form method="POST" action="<?php echo BASE_URL ?>AdProduct/updateReview" class="review-edit-form">
                        <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                        <input type="hidden" name="masp" value="<?php echo $data['product']['masp']; ?>">
                        <label for="rating">Đánh giá (1-5):</label>
                        <input type="number" name="rating" value="<?php echo $review['rating']; ?>" min="1" max="5" required>
                        <label for="comment">Bình luận:</label>
                        <textarea name="comment" required><?php echo $review['comment']; ?></textarea>
                        <button type="submit" class="update-review-btn">Cập nhật</button>
                    </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Form thêm đánh giá -->
    <div id="review-form" class="add-review-form">
        <h4>Thêm đánh giá</h4>
        <form method="POST" action="<?php echo BASE_URL ?>AdProduct/addReview">
            <input type="hidden" name="masp" value="<?php echo $data['product']['masp']; ?>">
            <label for="rating">Đánh giá (1-5):</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>
            <label for="comment">Bình luận:</label>
            <textarea id="comment" name="comment" required></textarea>
            <button type="submit" class="submit-review-btn">Gửi đánh giá</button>
        </form>
    </div>

</body>

</html>