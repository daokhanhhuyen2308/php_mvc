<?php
// Kiểm tra xem $data có chứa khóa productID hay không
$productID = isset($data["productID"]) ? $data["productID"] : null;

if ($productID) {
    $txt_maloaisp = $productID["ma_loaisp"]; // Mã loại sản phẩm cố định
    $txt_masp = isset($_POST["txt_masp"]) ? $_POST["txt_masp"] : $productID["masp"];
    $txt_tensp = isset($_POST["txt_tensp"]) ? $_POST["txt_tensp"] : $productID["tensp"];
    $txt_hinhanh = isset($_POST["txt_hinhanh"]) ? $_POST["txt_hinhanh"] : $productID["hinhanh"];
    $txt_mota = isset($_POST["txt_mota"]) ? $_POST["txt_mota"] : $productID["mota"];
    $txt_giaban = isset($_POST["txt_giaban"]) ? $_POST["txt_giaban"] : $productID["giaban"];
    $txt_khuyenmai = isset($_POST["txt_khuyenmai"]) ? $_POST["txt_khuyenmai"] : $productID["khuyenmai"];
    $txt_create_date = isset($_POST["txt_create_date"]) ? $_POST["txt_create_date"] : $productID["create_date"];
} else {
    // Xử lý khi không tìm thấy sản phẩm
    $txt_maloaisp = "";
    $txt_masp = "";
    $txt_tensp = "";
    $txt_hinhanh = "";
    $txt_mota = "";
    $txt_giaban = "";
    $txt_khuyenmai = "";
    $txt_create_date = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
    <style>
        table {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        td {
            padding: 12px;
            border: 1px solid #ccc;
        }

        td:first-child {
            width: 35%;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            padding: 5px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }

        textarea {
            resize: vertical;
        }
    </style>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Mã loại sản phẩm</td>
                <td><input name="txt_maloaisp" type="text" value="<?php echo htmlspecialchars($txt_maloaisp); ?>" /></td>
            </tr>
            <tr>
                <td>Mã sản phẩm</td>
                <td><input name="txt_masp" type="text" readonly value="<?php echo htmlspecialchars($txt_masp); ?>" /></td>
            </tr>
            <tr>
                <td>Tên sản phẩm</td>
                <td><input name="txt_tensp" type="text" value="<?php echo htmlspecialchars($txt_tensp); ?>" /></td>
            </tr>
            <tr>
                <td>Hình ảnh</td>
                <td><input name="txt_hinhanh" type="file" />
                    <?php if (!empty($productID['hinhanh'])): ?>
                        <div>
                            <img src="<?php echo BASE_URL . $productID['hinhanh']; ?>" alt="Hình ảnh" style="width: 50px; height: 50px; object-fit: cover;">
                        </div>
                    <?php endif; ?>
                </td>

            </tr>
            <tr>
                <td>Giá bán</td>
                <td><input name="txt_giaban" type="text" value="<?php echo htmlspecialchars($txt_giaban); ?>" /></td>
            </tr>
            <tr>
                <td>Khuyến mãi</td>
                <td><input name="txt_khuyenmai" type="text" value="<?php echo htmlspecialchars($txt_khuyenmai); ?>" /></td>
            </tr>
            <tr>
                <td>Mô tả</td>
                <td><textarea name="txt_mota" cols="30" rows="6"><?php echo htmlspecialchars($txt_mota); ?></textarea></td>
            </tr>
            <tr>
                <td>Ngày tạo</td>
                <td><input name="txt_create_date" type="date" value="<?php echo htmlspecialchars($txt_create_date); ?>" /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="btn_submit" value="Update" />
                    <input type="reset" name="reset" value="Reset" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>