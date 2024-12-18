<div class="list-product">
    <?php if (!empty($data['productList'])): ?>
        <?php foreach ($data['productList'] as $product): ?>
            <div class="item" data-id="<?php echo $product['masp']; ?>">
                <img src="<?php echo BASE_URL . $product['hinhanh']; ?>" alt="<?php echo $product['tensp']; ?>" />
                <h2><?php echo $product['tensp']; ?></h2>
                <div class="price">
                    <?php echo number_format($product['giaban'], 0, ',', '.'); ?> VND
                    <?php if (!empty($product['khuyenmai'])): ?>
                        <span class="discount">(-<?php echo number_format($product['khuyenmai'], 0, ',', '.'); ?> VND)</span>
                    <?php endif; ?>
                </div>
                <div class="button-group">
                    <a href="<?php echo BASE_URL . 'Cart/addToCart/' . $product['masp']; ?>" class="addToCart">
                        <i class="fas fa-shopping-cart"></i> Giỏ hàng
                    </a>
                    <a href="<?php echo BASE_URL . 'AdProduct/viewDetail/' . $product['masp']; ?>" class="detail">
                        <i class="fas fa-info-circle"></i> Chi tiết
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có khóa học nào để hiển thị.</p>
    <?php endif; ?>
</div>

<div class="pagination">
    <?php if ($data['currentPage'] > 1): ?>
        <a href="<?php echo BASE_URL . 'Home/getShow/' . ($data['currentPage'] - 1); ?>" class="prev">
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
        <a href="<?php echo BASE_URL . 'Home/getShow/' . ($data['currentPage'] + 1); ?>" class="next">
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