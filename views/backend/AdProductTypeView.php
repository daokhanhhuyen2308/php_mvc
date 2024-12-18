<?php
$obj = new AdProductType;
$ma_loaisp = "";
$ten_loaisp = "";
$mota_loaisp = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj->insert();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý loại sản phẩm</title>
    <style>
        table {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
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

        .form-container {
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
        }

        .form-container input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="title" style="font-weight: bold;">Quản lý loại sản phẩm</div>
    
    <div class="form-container">
        <form action="" method="post">
            <label>Mã loại sản phẩm</label>
            <input name="txt_maloaisp" type="text" value="<?php echo $ma_loaisp; ?>" required />
            
            <label>Tên loại sản phẩm</label>
            <input name="txt_tenloaisp" type="text" value="<?php echo $ten_loaisp; ?>" required />
            
            <label>Mô tả loại sản phẩm</label>
            <input name="txt_motaloaisp" type="text" value="<?php echo $mota_loaisp; ?>" required />
            
            <input type="submit" name="btn_submit" value="Thêm loại sản phẩm" />
        </form>
    </div>
    
    <table>
        <tr>
            <th>Mã loại sản phẩm</th>
            <th>Tên loại sản phẩm</th>
            <th>Mô tả loại sản phẩm</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        <?php foreach ($data["productType"] as $v) { ?>
            <tr>
                <td><?php echo $v["ma_loaisp"]; ?></td>
                <td><?php echo $v["ten_loaisp"]; ?></td>
                <td><?php echo $v["mota_loaisp"]; ?></td>
                <td>
                    <a href="<?php echo BASE_URL; ?>AdProductType/update/<?php echo $v["ma_loaisp"]; ?>" style="color: #3498db; text-decoration: none">Update</a>
                </td>
                <td>
                    <a href="<?php echo BASE_URL; ?>AdProductType/delete/<?php echo $v["ma_loaisp"]; ?>" style="color: red; text-decoration: none">Xóa</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>