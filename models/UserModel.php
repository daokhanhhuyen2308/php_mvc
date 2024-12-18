<?php
class UserModel extends DB
{

    public function login($username, $password)
    {
        try {
            // Truy vấn tìm người dùng theo tên đăng nhập
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            // Lấy dữ liệu người dùng
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Kiểm tra nếu người dùng tồn tại và mật khẩu khớp
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            } else {
                // Nếu mật khẩu không đúng hoặc người dùng không tồn tại
                throw new Exception("Tên đăng nhập hoặc mật khẩu không đúng");
            }
        } catch (PDOException $e) {
            // Xử lý lỗi kết nối cơ sở dữ liệu
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Có lỗi xảy ra trong quá trình đăng nhập");
        } catch (Exception $e) {
            // Xử lý các lỗi khác
            error_log("Login error: " . $e->getMessage());
            throw $e;
        }
    }
    public function register($username, $email, $password, $fullname, $avatar, $address, $phone)
    {

        $checkSql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->bindParam(':username', $username);
        $checkStmt->execute();
        $userCount = $checkStmt->fetchColumn();

        if ($userCount > 0) {
            return false;
        }

        $sql = "INSERT INTO users (username, email, password, fullname, avatar, address, phone, role) 
                VALUES (:username, :email, :password, :fullname, :avatar, :address, :phone, 'user')";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        } else {
            return false;
        }
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUserById($username)
    {
        $sql = "DELETE FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }


    public function updateUserProfile($username, $email, $password, $fullname, $phone, $address, $avatar)
    {
        $sql = "UPDATE users SET 
                email = :email, 
                fullname = :fullname, 
                phone = :phone, 
                address = :address";

        // Nếu mật khẩu được cung cấp, thêm vào câu lệnh SQL
        if (!empty($password)) {
            $sql .= ", password = :password";
        }

        // Nếu avatar được cung cấp, thêm vào câu lệnh SQL
        if (!empty($avatar)) {
            $sql .= ", avatar = :avatar";
        }

        $sql .= " WHERE username = :username";

        $stmt = $this->conn->prepare($sql);

        // Gắn các tham số vào câu lệnh SQL
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);

        if (!empty($password)) {
            $stmt->bindParam(':password', $password);
        }

        if (!empty($avatar)) {
            $stmt->bindParam(':avatar', $avatar);
        }

        return $stmt->execute();
    }

    public function createUser($username, $email, $password, $fullname, $avatar, $phone, $address, $role)
    {
        $checkSql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->bindParam(':username', $username);
        $checkStmt->execute();
        $userCount = $checkStmt->fetchColumn();

        if ($userCount > 0) {
            return false;
        }

        $sql = "INSERT INTO users (username, email, password, fullname, avatar, phone, address, role) 
            VALUES (:username, :email, :password, :fullname, :avatar, :phone, :address, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function updateUser($username, $email, $password, $fullname, $avatar, $phone, $address, $role)
    {
        $sql = "UPDATE users SET 
            email = :email, 
            password = :password, 
            fullname = :fullname, 
            avatar = :avatar,
            phone = :phone, 
            address = :address, 
            role = :role 
            WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin người dùng hoặc null nếu không tìm thấy
    }
}
