<?php
$obj = new AdProduct();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
            font-size: 18px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            max-width: 100px;
            height: auto;
        }

        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .add-link {
            display: block;
            text-align: center;
            margin-bottom: 20px;
        }

        .detail {
            display: inline-block;
            margin-top: 10px;
            font-size: 0.85rem;
            color: #3498db;
            text-decoration: none;
            border: 1px solid #3498db;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .detail:hover {
            background-color: #3498db;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="title" style="font-weight: bold;">Quản lý sản phẩm</div>
    <div class="add-link">
        <a href="<?php echo BASE_URL ?>AdProduct/insert/" style="color: #3498db">Thêm sản phẩm</a>
    </div>
    <form action="" method="post">
        <table>
            <tr>
                <th>Mã loại</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá bán</th>
                <th>Khuyến mại</th>
                <th>Mô tả</th>
                <th>Nổi bật</th>
                <th>Ngày đăng</th>
                <th>Chi tiết</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            <?php foreach ($data["product"] as $v) { ?>
                <tr>
                    <td><?php echo $v["ma_loaisp"]; ?></td>
                    <td><?php echo $v["masp"]; ?></td>
                    <td><?php echo $v["tensp"]; ?></td>
                    <td>
                        <img src="<?php echo BASE_URL ?><?php echo $v["hinhanh"]; ?>" alt="Hình ảnh sản phẩm" />
                    </td>
                    <td><?php echo number_format($v["giaban"], 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo $v["khuyenmai"]; ?></td>
                    <td><?php echo $v["mota"]; ?></td>
                    <td><?php echo $v["is_feature"]; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($v["create_date"])); ?></td>
                    
                    <td>
                        <a href="<?php echo BASE_URL ?>AdProduct/viewDetail/<?php echo $v["masp"]; ?>" class="detail">Detail</a>
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL ?>AdProduct/update/<?php echo $v["masp"]; ?>" style="color: #3498db; text-decoration: none">Update</a>
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL ?>AdProduct/delete/<?php echo $v["masp"]; ?>" style="color: red; text-decoration: none">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </form>
</body>

</html>