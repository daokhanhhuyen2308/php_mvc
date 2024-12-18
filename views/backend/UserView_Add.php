<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm người dùng</title>
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
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        td label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input.input-field {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            box-sizing: border-box;
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

        .user-table {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
            margin-top: 20px;
        }

        .user-table th,
        .user-table td {
            border: 1px solid #ccc;
        }

        .user-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-links {
            display: flex;
            justify-content: space-around;
        }

        .user-table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>

</body>

</html>

<div class="form-container">
    <h2 class="form-title">Thêm người dùng</h2>
    <form action="<?php echo BASE_URL ?>User/create" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td><input class="input-field" name="username" id="username" type="text" required /></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input class="input-field" name="email" id="email" type="email" required /></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input class="input-field" name="password" id="password" type="password" required /></td>
            </tr>
            <tr>
                <td><label for="fullname">Họ và tên</label></td>
                <td><input class="input-field" name="fullname" id="fullname" type="text" required /></td>
            </tr>
            <tr>
                <td><label for="avatar">Avatar</label></td>
                <td><input class="input-field" name="avatar" id="avatar" type="file" /></td>
            </tr>
            <tr>
                <td><label for="phone">Số điện thoại</label></td>
                <td><input class="input-field" name="phone" id="phone" type="tel" /></td>
            </tr>
            <tr>
                <td><label for="address">Địa chỉ</label></td>
                <td><input class="input-field" name="address" id="address" type="text" /></td>
            </tr>
            <tr>
                <td><label for="role">Vai trò</label></td>
                <td>
                    <select name="role" id="role" required>
                        <option value="user">Người dùng</option>
                        </option>
                        <option value="admin">Quản trị viên</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Thêm" />
                    <input type="reset" value="Reset" />
                </td>
            </tr>
        </table>
    </form>
</div>