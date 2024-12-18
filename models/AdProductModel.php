<?php
// ob_start();
class AdProductModel extends DB
{
    //hiển thị  dữ liệu
    public function getAdProduct()
    {
        $sql = "SELECT * FROM ad_product ";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $product = $stm->fetchAll();
        return $product;
    }

    public function getMyProduct($username){
        $sql = "SELECT * FROM ad_product WHERE username = '$username'";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $product = $stm->fetchAll();
        return $product;
    }
    public function insertAdProduct($ma_loaisp, $masp, $tensp, $hinhanh, $giaban, $khuyenmai, $mota, $create_date)
    {
        $sql = "INSERT INTO ad_product (ma_loaisp, masp, tensp, hinhanh, giaban, khuyenmai, mota, create_date) ";
        $sql .= "VALUES ('$ma_loaisp', '$masp', '$tensp', '$hinhanh', '$giaban', '$khuyenmai', '$mota', '$create_date')";
        $this->conn->exec($sql);
    }
    public function getAdProductID($masp)
    {
        $sql = "SELECT * FROM ad_product WHERE masp='$masp'";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $productID = $stm->fetch();
        return $productID;
    }
    public function deleteAdProduct($masp)
    {
        $sql = "DELETE FROM ad_product WHERE masp='$masp'";
        $this->conn->exec($sql);
    }
    public function updateAdProduct($ma_loaisp, $masp, $tensp, $hinhanh, $giaban, $khuyenmai, $mota, $create_date)
    {
        $sql = "UPDATE ad_product SET ";
        $sql .= "ma_loaisp ='$ma_loaisp', tensp ='$tensp', hinhanh ='$hinhanh', giaban ='$giaban', khuyenmai ='$khuyenmai', mota ='$mota', create_date ='$create_date'";
        $sql .= "WHERE masp='$masp'";
        $this->conn->exec($sql);
    }
    public function checkProductTypeExists($ma_loaisp)
    {
        $sql = "SELECT COUNT(*) FROM producttype WHERE ma_loaisp = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ma_loaisp]);
        return $stmt->fetchColumn() > 0;
    }

    public function searchAdProduct($key, $currentPage, $itemsPerPage)
    {
        // Tính offset cho phân trang
        $offset = ($currentPage - 1) * $itemsPerPage;

        // SQL truy vấn tìm sản phẩm với từ khóa
        $sql = "SELECT * FROM ad_product WHERE tensp LIKE :search LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);

        $search = "%" . $key . "%";
        $stmt->bindParam(':search', $search);
        $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        $product = $stmt->fetchAll();
        return $product;
    }

    public function countSearchAdProduct($key)
    {
        // SQL truy vấn đếm tổng số sản phẩm khớp với từ khóa
        $sql = "SELECT COUNT(*) FROM ad_product WHERE tensp LIKE :search";
        $stmt = $this->conn->prepare($sql);

        $search = "%" . $key . "%";
        $stmt->bindParam(':search', $search);
        $stmt->execute();

        return $stmt->fetchColumn(); // Trả về số lượng sản phẩm khớp
    }


    // public function searchAdProduct($key)
    // {
    //     $sql = "SELECT * FROM ad_product WHERE tensp LIKE :search";
    //     $stmt = $this->conn->prepare($sql);
    //     $search = "%" . $key . "%";
    //     $stmt->bindParam(':search', $search);
    //     $stmt->execute();
    //     $product = $stmt->fetchAll();
    //     return $product;
    // }

    public function getPaginatedProducts($offset, $limit)
    {
        $sql = "SELECT * FROM ad_product LIMIT :offset, :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countProducts()
    {
        $sql = "SELECT COUNT(*) AS total FROM ad_product";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

}
// ob_end_flush();