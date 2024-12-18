<?php
// Kiểm tra xem $data có chứa khóa productID hay không
$userID = isset($data["userID"]) ? $data["userID"] : null;

if ($userID) {
    $username = $userID["username"]; // Mã loại sản phẩm cố định
    $email = isset($_POST["email"]) ? $_POST["email"] : $userID["email"];
    $password = isset($_POST["password"]) ? $_POST["password"] : $userID["password"];
    $fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : $userID["fullname"];
    $avatar = isset($_POST["avatar"]) ? $_POST["avatar"] : $userID["avatar"];
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : $userID["phone"];
    $address = isset($_POST["address"]) ? $_POST["address"] : $userID["address"];
    $role = isset($_POST["role"]) ? $_POST["role"] : $userID["role"];
} else {
    // Xử lý khi không tìm thấy sản phẩm
    $username = "";
    $email = "";
    $password = "";
    $fullname = "";
    $avatar = "";
    $phone = "";
    $address = "";
    $role = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Thông Tin Người Dùng</title>
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td {
            padding: 12px;
            border: 1px solid #ccc;
        }

        td:first-child {
            width: 35%;
            font-weight: bold;
            text-align: right;
            /* Center text to align better */
            padding-right: 10px;
            /* Add padding on the right */
        }

        
        input.input-field{
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input.input-field:focus,
        textarea:focus,
        select:focus {
            border-color: #4CAF50;
            /* Change border color on focus */
            outline: none;
            /* Remove the default outline */
        }

        input[type="file"] {
            padding: 5px;
            margin-top: 10px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }

        img {
            border-radius: 50%;
            /* Make avatar circular */
            margin-top: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>

<body>
    <h2>Cập Nhật Thông Tin Người Dùng</h2>
    <form method="post" enctype="multipart/form-data" class="form-container">
        <table>
            <tr>
                <td>Username</td>
                <td><input class="input-field" type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input class="input-field" name="email" type="email" value="<?php echo htmlspecialchars($email); ?>" required /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input class="input-field" name="password" type="password" value="<?php echo htmlspecialchars($password); ?>" required /></td>
            </tr>
            <tr>
                <td>Fullname</td>
                <td><input class="input-field" name="fullname" type="text" value="<?php echo htmlspecialchars($fullname); ?>" required /></td>
            </tr>
            <tr>
                <td>Hình ảnh</td>
                <td>
                    <input type="file" name="avatar" />
                    <?php if (!empty($userID['avatar'])): ?>
                        <div>
                            <img src="<?php echo BASE_URL . $userID['avatar']; ?>" alt="Avatar" style="width: 50px; height: 50px; object-fit: cover;">
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><input class="input-field" name="phone" type="tel" value="<?php echo htmlspecialchars($phone); ?>" required /></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input class="input-field" name="address" type="text" value="<?php echo htmlspecialchars($address); ?>" required /></td>
            </tr>
            <tr>
                <td>Vai trò</td>
                <td>
                    <select name="role" required>
                        <option value="admin" <?php echo $userID['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="user" <?php echo $userID['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="guest" <?php echo $userID['role'] === 'guest' ? 'selected' : ''; ?>>Guest</option>
                    </select>
                </td>
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