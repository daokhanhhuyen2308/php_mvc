<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 5px;
    }

    .form-title {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    td label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .input-field,
    input[type="date"],
    select,
    textarea {
        width: calc(100% - 20px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
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
    </style>
</head>


<body>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-container">
        <h2 class="form-title">Thêm sản phẩm</h2>
        <table>
            <tr>
                <td><label for="txt_maloaisp">Mã loại sản phẩm</label></td>
                <td>
                    <select name="txt_maloaisp" id="txt_maloaisp" required>
                        <?php foreach ($data["productType"] as $k => $v) { ?>
                            <option value="<?php echo $v["ma_loaisp"]; ?>">
                                <?php echo $v["ma_loaisp"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="txt_masp">Mã sản phẩm</label></td>
                <td><input class="input-field" name="txt_masp" id="txt_masp" type="text" required /></td>
            </tr>
            <tr>
                <td><label for="txt_tensp">Tên sản phẩm</label></td>
                <td><input class="input-field" name="txt_tensp" id="txt_tensp" type="text" required /></td>
            </tr>
            <tr>
                <td><label for="txt_hinhanh">Hình ảnh</label></td>
                <td><input class="input-field" name="txt_hinhanh" id="txt_hinhanh" type="file" required /></td>
            </tr>
            <tr>
                <td><label for="txt_giaban">Giá bán</label></td>
                <td><input class="input-field" name="txt_giaban" id="txt_giaban" type="text" required /></td>
            </tr>
            <tr>
                <td><label for="txt_khuyenmai">Khuyến mại</label></td>
                <td><input class="input-field" name="txt_khuyenmai" id="txt_khuyenmai" type="text" /></td>
            </tr>
            <tr>
                <td><label for="txt_mota">Mô tả</label></td>
                <td>
                    <textarea name="txt_mota" id="txt_mota" rows="6" required></textarea>
                </td>
            </tr>
            <tr>
                <td><label for="txt_create_date">Ngày tạo</label></td>
                <td><input name="txt_create_date" id="txt_create_date" type="date" required /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="btn_submit" value="Add" />
                    <input type="reset" name="reset" value="Reset" />
                </td>
            </tr>
        </table>
    </div>
</form>

</body>

</html>