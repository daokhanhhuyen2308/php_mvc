<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa học nổi bật</title>
    <style>
        .featured-courses {
            margin: 40px 0;
            position: relative;
        }

        .featured-courses h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .slider-container {
            position: relative;
            overflow: hidden;
            padding: 10px 0;
        }

        .feature-course {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* Chia thành 2 cột cho 2 sản phẩm */
            gap: 20px;
            /* Khoảng cách giữa các sản phẩm */
            padding: 20px;
        }

        .item {
            display: flex;
            /* Sử dụng flexbox để sắp xếp hình ảnh và thông tin */
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            gap: 15px;
            /* Khoảng cách giữa hình ảnh và thông tin */
        }

        .course-image {
            width: 120px;
            /* Chiều rộng cố định cho ảnh */
            height: auto;
            border-radius: 5px;
        }

        .course-info {
            flex: 1;
            /* Chiếm hết không gian còn lại */
        }

        .course-info h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #555;
        }

        .course-info p {
            margin: 5px 0;
            /* Đặt khoảng cách giữa các đoạn văn */
        }

        .course-info .original-price {
            text-decoration: line-through;
            /* Gạch ngang giá gốc */
            color: #999;
        }

        .course-info .discount-price {
            font-weight: bold;
            color: #e74c3c;
            /* Màu đỏ cho giá khuyến mãi */
        }

        .course-info .final-price {
            font-weight: bold;
            color: #2ecc71;
            /* Màu xanh cho giá sau khuyến mãi */
        }

        .actions {
            margin-top: 10px;
        }

        .actions a {
            margin-right: 10px;
            /* Khoảng cách giữa các nút */
            text-decoration: none;
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
            opacity: 0.8;
            transition: opacity 0.3s;
        }

        .slider-btn:hover {
            opacity: 1;
        }

        .slider-btn.prev {
            left: 10px;
        }

        .slider-btn.next {
            right: 10px;
        }
    </style>
</head>

<body>
    <div class="featured-courses">
        <h2>Khóa học nổi bật</h2>
        <div class="slider-container">
            <button class="slider-btn prev">&lt;</button>
            <div class="feature-course">
                <?php foreach ($data['productList'] as $course): ?>
                    <div class="item">
                        <img src="<?php echo BASE_URL . $course['hinhanh']; ?>" alt="<?php echo $course['tensp']; ?>" class="course-image" />
                        <div class="course-info">
                            <h2><?php echo $course['tensp']; ?></h2>

                            <p class="original-price">Giá gốc: <span><?php echo number_format($course['giaban'], 0, ',', '.'); ?> VND</span></p>
                            <p class="discount-price">Khuyến mãi: <span><?php echo number_format($course['khuyenmai'], 0, ',', '.'); ?> VND</span></p>
                            <p class="final-price">Giá bán: <span><?php echo number_format($course['giaban'] - $course['khuyenmai'], 0, ',', '.'); ?> VND</span></p>

                            <div class="actions">
                                    <a href="<?php echo BASE_URL . 'AdProduct/edit/' . $course['masp']; ?>" class="edit">
                                        <i class="fas fa-edit"></i> Sửa</a>
                                    <a href="<?php echo BASE_URL . 'AdProduct/delete/' . $course['masp']; ?>" class="delete" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                        <i class="fas fa-trash"></i> Xóa</a>
                                    <a href="<?php echo BASE_URL . 'AdProduct/viewDetail/' . $course['masp']; ?>" class="view-detail">
                                        <i class="fas fa-info-circle"></i> Xem chi tiết</a>
                            </div>
                            <!-- <a href="<?php echo BASE_URL . 'Cart/addToCart/' . $course['masp']; ?>" class="add-to-cart">
                                    <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                                <a href="<?php echo BASE_URL . 'AdProduct/viewDetail/' . $course['masp']; ?>" class="view-detail">
                                    <i class="fas fa-info-circle"></i> Xem chi tiết</a> -->
                        </div>
                    </div>
            </div>
        <?php endforeach; ?>
        </div>
        <button class="slider-btn next">&gt;</button>
    </div>
    </div>

    <div class="pagination">
        <?php if ($data['currentPage'] > 1): ?>
            <a href="<?php echo BASE_URL . 'AdProduct/featuredCourses/' . ($data['currentPage'] - 1); ?>" class="prev">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        <?php else: ?>
            <a class="prev disabled">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        <?php endif; ?>

        <?php if ($data['currentPage'] < $data['totalPages']): ?>
            <a href="<?php echo BASE_URL . 'AdProduct/featuredCourses/' . ($data['currentPage'] + 1); ?>" class="next">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        <?php else: ?>
            <a class="next disabled">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        <?php endif; ?>
    </div>
</body>

</html>