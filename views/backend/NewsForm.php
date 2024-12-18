<div class="news-container">
    <h2>Quản lý Tin tức</h2>
    
    <!-- Form tạo/cập nhật tin tức -->
    <form action="<?php echo BASE_URL; ?>NewsController/saveNews" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Tiêu đề tin tức</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Nhập tiêu đề tin tức" required>
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea id="content" name="content" class="form-control" rows="10" placeholder="Nhập nội dung tin tức" required></textarea>
        </div>

        <div class="form-group">
            <label for="thumbnail">Ảnh đại diện</label>
            <input type="file" id="thumbnail" name="thumbnail" class="form-control">
        </div>

        <div class="form-group">
            <label for="category">Thể loại</label>
            <select id="category" name="category" class="form-control" required>
                <option value="">-- Chọn thể loại --</option>
                <option value="education">Giáo dục</option>
                <option value="technology">Công nghệ</option>
                <option value="health">Sức khỏe</option>
                <option value="lifestyle">Phong cách sống</option>
            </select>
        </div>

        <div class="form-group">
            <label for="publish_date">Ngày đăng</label>
            <input type="date" id="publish_date" name="publish_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Lưu tin tức</button>
        <a href="<?php echo BASE_URL; ?>NewsController" class="btn btn-secondary">Hủy</a>
    </form>
</div>
