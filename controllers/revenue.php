    <?php

    // Kết nối cơ sở dữ liệu
    $pdo = new PDO('mysql:host=localhost;dbname=website5', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Kiểm tra nếu form đã được gửi
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy giá trị từ form
        $year = isset($_POST['year']) ? $_POST['year'] : date('Y');  // Năm mặc định là năm hiện tại
        $month = isset($_POST['month']) ? $_POST['month'] : date('m');  // Tháng mặc định là tháng hiện tại
    } else {
        // Nếu không có form gửi, mặc định là năm 2024 và tháng 12
        $year = 2024;
        $month = 12;
    }

    // Truy vấn SQL với tham số để lấy doanh thu và số lượng sản phẩm bán được
    $sql = "
        SELECT 
            SUM(total_price) AS total_revenue,
            COUNT(order_id) AS total_orders
        FROM orders
        WHERE YEAR(created_at) = :year
        AND MONTH(created_at) = :month
    ";

    // Chuẩn bị câu truy vấn
    $stmt = $pdo->prepare($sql);

    // Ràng buộc giá trị cho tham số
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':month', $month, PDO::PARAM_INT);

    // Thực thi câu truy vấn
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Lấy dữ liệu sản phẩm bán được để hiển thị biểu đồ đường
    $sql_products = "
        SELECT pt.ten_loaisp AS product_name, SUM(oi.quantity) AS total_quantity
        FROM order_item oi
        JOIN ad_product ap ON oi.masp = ap.masp  -- Liên kết với bảng ad_product qua cột masp
        JOIN producttype pt ON ap.ma_loaisp = pt.ma_loaisp  -- Liên kết với bảng producttype qua cột ma_loaisp
        JOIN orders o ON oi.order_id = o.order_id
        WHERE YEAR(o.created_at) = :year
        AND MONTH(o.created_at) = :month
        GROUP BY pt.ten_loaisp
        ORDER BY total_quantity DESC
    ";

    // Lấy dữ liệu sản phẩm
    $stmt_products = $pdo->prepare($sql_products);
    $stmt_products->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt_products->bindParam(':month', $month, PDO::PARAM_INT);
    $stmt_products->execute();

    $productNames = [];
    $productQuantities = [];

    // Lấy dữ liệu các sản phẩm và số lượng
    while ($row = $stmt_products->fetch(PDO::FETCH_ASSOC)) {
        $productNames[] = $row['product_name'];
        $productQuantities[] = $row['total_quantity'];
    }

    // Kiểm tra nếu không có sản phẩm bán ra, thì tạo dữ liệu mặc định cho biểu đồ
    if (empty($productNames)) {
        $productNames = ['Không có sản phẩm'];
        $productQuantities = [0];
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Báo cáo doanh thu</title>
        <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/admin.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />   
    
        <style>
            /* Tạo kiểu cho form */
    form {
        margin: 30px;
        display: flex;
        flex-direction: column;
    }

    /* Căn chỉnh các phần tử trên cùng một dòng */
    .form-row {
        display: flex;
        justify-content: space-between; /* Điều chỉnh khoảng cách giữa các phần tử */
        width: 65%;  /* Đảm bảo chiều rộng toàn bộ form */
    }

    .form-group {
        margin-bottom: 15px;
        flex: 1; /* Đảm bảo các input và select có chiều rộng đồng đều */
        padding-right: 10px; /* Khoảng cách giữa các phần tử */
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    input, select {
        width: 50%;
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 10px;
    }

    button.btn-submit {
        padding: 5px 10px;  /* Giảm padding để làm nút nhỏ lại */
        font-size: 14px;  /* Giảm kích thước font chữ */
        border-radius: 4px;
        cursor: pointer;
        margin-left: 10px;  /* Khoảng cách giữa các trường */

    }

    button.btn-submit:hover {
        background-color: #45a049;
    }

    /* CSS cho biểu đồ */
    .chart-container {
        width: 70%;  
        max-width: 1000px;  
        margin: 0 auto;  
    }

    #productChart {
        width: 100% !important;  
        height: 300px !important;  
    }
    /* Bố cục chính của container */
    .revenue-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start; /* Căn chỉnh các phần tử ở trên cùng */
        margin-top: 30px;
    }

    /* Bảng tổng doanh thu chiếm 30% */
    .revenue-section {
        width: 30%;
        padding: 20px;
        border: 2px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
        margin-right: 20px;
    }

    .revenue-section h3 {
        margin-bottom: 10px;
        font-size: 18px;
    }

    .revenue-section p {
        font-size: 16px;
        margin: 5px 0;
    }

    /* Biểu đồ đường chiếm 60% */
    .chart-section {
        width: 70%;
        padding: 20px;
    }

    /* Điều chỉnh kích thước biểu đồ */
    .chart-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }

    #productChart {
        width: 100% !important;
        height: 400px !important;
    }


    /* Tạo hiệu ứng màu chuyển động cho bảng lọc */
@keyframes gradientAnimation {
    0% {
        background: linear-gradient(-45deg, tomato, lightgreen, pink, orange);
    }
    50% {
        background: linear-gradient(-45deg, lightgreen, pink, orange, tomato);
    }
    100% {
        background: linear-gradient(-45deg, pink, orange, tomato, lightgreen);
    }
}

.filter-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    border: 2px solid #ccc;
    border-radius: 10px;
    overflow: hidden;
    animation: gradientAnimation 6s ease infinite; /* Áp dụng hiệu ứng chuyển động */
}

.filter-table td {
    padding: 10px;
    text-align: center;
}

.filter-table td input, .filter-table td select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

.filter-table td button {
    padding: 8px 15px;
    font-size: 14px;
    border-radius: 5px;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
    border: none;
}

.filter-table td button:hover {
    background-color: #45a049;
}

.filter-table label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

    select {
        width: 100%; /* Đảm bảo thẻ select chiếm đầy không gian */
        padding: 10px;
        border-radius: 10px;
        border: 2px solid #ccc;
        font-size: 14px;
        background-color: #fff;
        cursor: pointer;
    }

        </style>
    </head>
    <body>

    <div class="admin-container">
        <header class="admin-header">
            <a href="<?php echo BASE_URL?>Home" class="logo-link">
                <h2>Báo cáo doanh thu</h2>
            </a>
        </header>

        <main class="admin-content">
            <form action="revenue.php" method="POST">
                <table class="filter-table">
                    <tr>
                        <td>
                            <label for="year">Năm:</label>
                            <input type="number" name="year" id="year" value="<?php echo $year; ?>" min="2000" max="2100" required>
                        </td>
                        <td>
        <label for="month">Tháng:</label>
        <select name="month" id="month" required>
            <option value="1" <?php echo ($month == 1) ? 'selected' : ''; ?>>Tháng 1</option>
            <option value="2" <?php echo ($month == 2) ? 'selected' : ''; ?>>Tháng 2</option>
            <option value="3" <?php echo ($month == 3) ? 'selected' : ''; ?>>Tháng 3</option>
            <option value="4" <?php echo ($month == 4) ? 'selected' : ''; ?>>Tháng 4</option>
            <option value="5" <?php echo ($month == 5) ? 'selected' : ''; ?>>Tháng 5</option>
            <option value="6" <?php echo ($month == 6) ? 'selected' : ''; ?>>Tháng 6</option>
            <option value="7" <?php echo ($month == 7) ? 'selected' : ''; ?>>Tháng 7</option>
            <option value="8" <?php echo ($month == 8) ? 'selected' : ''; ?>>Tháng 8</option>
            <option value="9" <?php echo ($month == 9) ? 'selected' : ''; ?>>Tháng 9</option>
            <option value="10" <?php echo ($month == 10) ? 'selected' : ''; ?>>Tháng 10</option>
            <option value="11" <?php echo ($month == 11) ? 'selected' : ''; ?>>Tháng 11</option>
            <option value="12" <?php echo ($month == 12) ? 'selected' : ''; ?>>Tháng 12</option>
        </select>
    </td>

                        <td>
                            <label for="day">Ngày:</label>
                            <input type="number" name="day" id="day" value="8" min="1" max="31" required>
                        </td>
                        <td>
                            <button type="submit" class="btn-submit"><i class="fa-solid fa-magnifying-glass"></i> Tìm</button>
                        </td>
                    </tr>
                </table>
            </form>

            <div class="revenue-container">
                <!-- Bảng tổng doanh thu chiếm 30% -->
                <div class="revenue-section">
                    <h3>Tổng doanh thu tháng: <?php echo $month; ?>/<?php echo $year; ?></h3>
                    <p><strong><?php echo number_format($result['total_revenue'], 0, ',', '.'); ?> VND</strong></p>
                    <p><strong>Đơn hàng:</strong> <?php echo $result['total_orders']; ?></p>
                </div>

                <!-- Biểu đồ đường chiếm 60% -->
                <div class="chart-section">
                    <?php if (!empty($productNames) && !empty($productQuantities)): ?>
                        <div class="chart-container">
                            <canvas id="productChart"></canvas>
                        </div>
                        <script>
                            var ctx = document.getElementById('productChart').getContext('2d');
                            var productChart = new Chart(ctx, {
                                type: 'line',  // Biểu đồ đường
                                data: {
                                        labels: <?php echo json_encode($productNames); ?>,  // Nhãn sản phẩm
                                    datasets: [{
                                        label: 'Số lượng sản phẩm bán ra',
                                        data: <?php echo json_encode($productQuantities); ?>,  // Số lượng sản phẩm bán ra
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 2,
                                        tension: 0.4  // Điều chỉnh độ cong của đường
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,  // Đảm bảo trục Y bắt đầu từ 0
                                            ticks: {
                                                stepSize: 1  // Chỉnh kích thước bước của trục Y
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    <?php else: ?>
                        <p>Không có sản phẩm bán được trong tháng <?php echo $month; ?>/<?php echo $year; ?>.</p>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
    </body>

    </html>