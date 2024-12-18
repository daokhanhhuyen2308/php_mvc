<?php
class VoucherModel extends DB
{
    public function getShowVoucher()
    {
        $sql = "SELECT * FROM vouchers ";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $voucher = $stm->fetchAll();
        return $voucher;
    }


    public function insertVoucher($voucher_code, $description, $discount_amount, $min_order_value, $valid_from, $valid_until)
    {
        // Kiểm tra xem voucher_code đã tồn tại hay chưa
        $checkSql = "SELECT COUNT(*) FROM vouchers WHERE voucher_code = :voucher_code";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->bindParam(':voucher_code', $voucher_code);
        $checkStmt->execute();
        $exists = $checkStmt->fetchColumn();

        if ($exists > 0) {
            // Nếu đã tồn tại, trả về thông báo lỗi
            echo "<script>alert('Mã voucher đã tồn tại! Vui lòng chọn mã khác.');</script>";
            return false; // Trả về false để báo lỗi
        }

        // Nếu không tồn tại, thực hiện chèn dữ liệu mới
        $sql = "INSERT INTO vouchers (voucher_code, description, discount_amount, min_order_value, valid_from, valid_until)
            VALUES (:voucher_code, :description, :discount_amount, :min_order_value, :valid_from, :valid_until)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':voucher_code', $voucher_code);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':discount_amount', $discount_amount);
        $stmt->bindParam(':min_order_value', $min_order_value);
        $stmt->bindParam(':valid_from', $valid_from);
        $stmt->bindParam(':valid_until', $valid_until);
        $stmt->execute();

        return $stmt->rowCount();
    }


    public function getVoucherByCode($voucher_code)
    {
        $sql = "SELECT * FROM vouchers WHERE voucher_code = :voucher_code";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':voucher_code', $voucher_code);
        $stmt->execute();
        // return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về dữ liệu chi tiết
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Lấy kết quả

        // Debug
        // var_dump($result);
    
        return $result;
    }

    public function getValidVoucherForOrder($totalPrice)
    {
        $sql = "SELECT * FROM vouchers WHERE CURDATE() BETWEEN valid_from AND valid_until
         AND min_order_value <= :totalPrice ORDER BY discount_amount DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':totalPrice', $totalPrice);
        $stmt->execute();

        $voucher = $stmt->fetch();

        // Nếu không có voucher hợp lệ
        if (empty($voucher)) {
            return null;
        }

        // Chọn voucher có mức giảm cao nhất từ danh sách đã sắp xếp (voucher đầu tiên trong danh sách)
        return $voucher;
    }

    public function updateVoucher($voucher_code, $description, $discount_amount, $min_order_value, $valid_from, $valid_until)
    {
        $sql = "UPDATE vouchers SET 
                description = :description, 
                discount_amount = :discount_amount, 
                min_order_value = :min_order_value, 
                valid_from = :valid_from, 
                valid_until = :valid_until 
            WHERE voucher_code = :voucher_code";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':voucher_code', $voucher_code);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':discount_amount', $discount_amount);
        $stmt->bindParam(':min_order_value', $min_order_value);
        $stmt->bindParam(':valid_from', $valid_from);
        $stmt->bindParam(':valid_until', $valid_until);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function deleteVoucher($voucher_code)
    {
        $sql = "DELETE FROM vouchers WHERE voucher_code = :voucher_code";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':voucher_code', $voucher_code);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
