<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa học của tôi</title>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/css/style.css'; ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f5f5f5;
            color: #555;
        }
        .btn-learn {
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            display: inline-block;
            text-align: center;
        }
        .btn-learn:hover {
            background-color: #218838;
        }
        .no-courses {
            text-align: center;
            color: #777;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Khóa học của tôi</h1>
        <?php if (!empty($data['completedCourses'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên khóa học</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['completedCourses'] as $course): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($course['masp']); ?></td>
                            <td><?php echo htmlspecialchars($course['tensp']); ?></td>
                            <td><?php echo number_format($course['price'], 2); ?> VNĐ</td>
                            <td><?php echo htmlspecialchars($course['quantity']); ?></td>
                            <td>
                                <a href="<?php echo BASE_URL . 'Course/view/' . $course['masp']; ?>" class="btn-learn">Xem khóa học</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-courses">Bạn chưa có khóa học nào. Hãy mua khóa học để bắt đầu học tập!</p>
        <?php endif; ?>
    </div>
</body>
</html>
