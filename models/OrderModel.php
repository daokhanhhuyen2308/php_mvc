<?php
class OrderModel extends DB
{

    public function getShowOrder()
    {
        $sql = "SELECT * FROM orders";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $order = $stm->fetchAll();
        return $order;
    }


    public function insertOrder($username, $totalQuantity, $totalPrice, $voucherCode = null, $paymentMethod, $cardNumber, $cardName, $expiryDate, $cvv)
    {
        //totalQuantity và totalPrice tính dựa vào order_item, voucher_code 
        // Kiểm tra xem username có tồn tại trong bảng users không
        $sqlCheckUser = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmtCheckUser = $this->conn->prepare($sqlCheckUser);
        $stmtCheckUser->bindParam(':username', $username);
        $stmtCheckUser->execute();

        $userExists = $stmtCheckUser->fetchColumn(); // Trả về số lượng người dùng với username

        if ($userExists == 0) {
            // Nếu không có người dùng này, trả về false hoặc báo lỗi
            echo "<script>alert('Người dùng không tồn tại!');</script>";
            return false;
        }

        // Tạo mã đơn hàng ngẫu nhiên
        $orderCode = "ORD" . strtoupper(substr(md5(uniqid()), 0, 6));

        $sql = "INSERT INTO orders 
        (order_code, username, total_quantity, total_price, voucher_code, payment_method, payment_card_number, payment_card_name, payment_expiry_date, payment_cvv) 
        VALUES 
        (:order_code, :username, :total_quantity, :total_price, :voucher_code, :payment_method, :payment_card_number, :payment_card_name, :payment_expiry_date, :payment_cvv)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':order_code', $orderCode);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':total_quantity', $totalQuantity);
        $stmt->bindParam(':total_price', $totalPrice);
        $stmt->bindParam(':voucher_code', $voucherCode);
        $stmt->bindParam(':payment_method', $paymentMethod);
        $stmt->bindParam(':payment_card_number', $cardNumber);
        $stmt->bindParam(':payment_card_name', $cardName);
        $stmt->bindParam(':payment_expiry_date', $expiryDate);
        $stmt->bindParam(':payment_cvv', $cvv);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId(); // Trả về true nếu insert thành công
        }

        return false; // Nếu không thể thêm đơn hàng
    }

    public function insertOrderItem($orderId, $masp, $quantity, $price)
    {
        $sql = "INSERT INTO order_item (order_id, masp, quantity, price)
                 VALUES (:order_id, :masp, :quantity, :price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->bindParam(':masp', $masp);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }


    public function getOrderById($orderId)
    {
        $sql = "SELECT o.order_code, u.fullname, o.total_quantity, o.total_price, 
        o.payment_method, o.payment_card_number, o.payment_card_name, o.order_status, o.payment_cvv,
        o.payment_expiry_date, o.created_at AS payment_time
        FROM orders o
        INNER JOIN users u ON o.username = u.username
        WHERE o.order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderItemsByOrderId($orderId){
        $sql = "SELECT masp FROM order_item WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function updateOrderStatus($orderId, $orderStatus)
    {
        $sql = "UPDATE orders SET order_status = :order_status WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->bindParam(':order_status', $orderStatus);
        return $stmt->execute();
    }


    public function getCompletedCourses($username)
    {
        $query = "SELECT oi.masp, ap.tensp, oi.price, oi.quantity
        FROM orders o
        INNER JOIN order_item oi ON o.order_id = oi.order_id
        INNER JOIN ad_product ap ON oi.masp = ap.masp
        WHERE o.username = :username AND o.order_status = 'Completed'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrderDetail($orderId)
    {
        $sql = "SELECT * FROM orders WHERE order_id = :orderId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getMyOrderProduct($username)
    {
        $query = "SELECT 
        oi.masp, 
        ap.tensp, 
        oi.price, 
        oi.quantity, 
        o.created_at AS order_date, 
        o.updated_at AS last_updated, 
        o.order_status
    FROM orders o
    INNER JOIN order_item oi ON o.order_id = oi.order_id
    INNER JOIN ad_product ap ON oi.masp = ap.masp
    WHERE o.username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isProductPurchased($username, $masp)
    {
        $sql = "SELECT COUNT(*) FROM orders o
            INNER JOIN order_item oi ON o.order_id = oi.order_id
            WHERE o.username = :username AND oi.masp = :masp";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':masp', $masp);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    // thực hiện select cho phần doanh thu
    public function getRevenueByMonth($month, $year){
        $sql = "SELECT SUM(o.total_price) AS total_revenue, COUNT(order_id) AS total_orders
        FROM orders o
        WHERE MONTH(o.created_at) = :month AND YEAR(o.created_at) = :year";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':month', $month);
        $stmt->bindParam(':year', $year);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
