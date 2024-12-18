<?php
$txt_maloaisp = isset($_POST["txt_maloaisp"]) ? $_POST["txt_maloaisp"] : $data["productType"]["ma_loaisp"];
$txt_tenloaisp = isset($_POST["txt_tenloaisp"]) ? $_POST["txt_tenloaisp"] : $data["productType"]["ten_loaisp"];
$txt_motaloaisp = isset($_POST["txt_motaloaisp"]) ? $_POST["txt_motaloaisp"] : $data["productType"]["mota_loaisp"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật loại sản phẩm</title>
    <style>
        table {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden; /* Bo tròn góc */
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td:first-child {
            width: 40%; /* Đặt chiều rộng cho cột nhãn */
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Để đảm bảo padding không ảnh hưởng đến chiều rộng */
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }

        textarea {
            resize: vertical; /* Cho phép kéo dài chiều cao */
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Cập nhật thông tin loại sản phẩm</h2>
    <form method="post">
        <table>
            <tr>
                <td>Mã loại sản phẩm</td>
                <td>
                    <input type="text" name="txt_maloaisp" readonly value="<?php echo htmlspecialchars($txt_maloaisp); ?>" />
                </td>
            </tr>
            <tr>
                <td>Tên loại sản phẩm</td>
                <td>
                    <input type="text" name="txt_tenloaisp" value="<?php echo htmlspecialchars($txt_tenloaisp); ?>" />
                </td>
            </tr>
            <tr>
                <td>Mô tả sản phẩm</td>
                <td>
                    <textarea name="txt_motaloaisp" cols="30" rows="6"><?php echo htmlspecialchars($txt_motaloaisp); ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" name="btn_submit" value="Cập nhật"/>
                    <input type="reset" name="reset" value="Reset"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>