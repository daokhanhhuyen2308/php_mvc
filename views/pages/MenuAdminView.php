<li class="dropdown">
    <a href=""><img
            src="<?php echo !empty($_SESSION['user']['avatar'])
                        ? BASE_URL . $_SESSION['user']['avatar']
                        : BASE_URL . 'public/images/default_avatar.jpg'; ?>"
            alt="Avatar"
            class="user-avatar"
            id="user-avatar" style="width: 50px; height: 50px; border-radius: 10px;"></a>
            <ul class="dropdown-content">
        <li><a href="<?php echo BASE_URL; ?>User/profile"><i class="fa-solid fa-info"></i> Thông tin</a></li>
        <li><a href="<?php echo BASE_URL; ?>AdProduct/"><i class="fa-solid fa-box"></i> Quản lý sản phẩm</a></li>
        <li><a href="<?php echo BASE_URL; ?>AdProductType/"><i class="fa-solid fa-tags"></i> Quản lý loại sản phẩm</a></li>
        <li><a href="<?php echo BASE_URL; ?>User/getAllUsers"><i class="fa-solid fa-users"></i> Quản lý người dùng</a></li>
        <li><a href="<?php echo BASE_URL; ?>Order/"><i class="fa-solid fa-clipboard"></i> Quản lý đơn hàng</a></li>
        <li><a href="<?php echo BASE_URL; ?>Voucher/getShow"><i class="fa-solid fa-percent"></i> Quản lý vouchers</a></li>
        <li><a href="<?php echo BASE_URL; ?>Customer/"><i class="fa-solid fa-user-check"></i> Quản lý khách hàng</a></li>
        <li><a href="<?php echo BASE_URL; ?>User/logout"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
    </ul>
</li>