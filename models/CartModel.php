<?php
class CartModel extends DB
{

    private function getOrCreateCartId($username)
    {
        // Kiểm tra xem người dùng đã có giỏ hàng chưa
        $sql = "SELECT cart_id FROM carts WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Nếu đã tồn tại giỏ hàng, trả về `cart_id`
            return $result['cart_id'];
        } else {
            // Nếu chưa có giỏ hàng, tạo mới và trả về `cart_id`
            $sql = "INSERT INTO carts (username) VALUES (:username)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return $this->conn->lastInsertId(); // Lấy ID vừa được tạo
        }
    }

    // function getCartIdByUsername($username)
    // {
    //     $sql = "SELECT cart_id FROM carts WHERE username = :username";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':username', $username);
    //     $stmt->execute();
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $result['cart_id'];
    // }

    public function getShowCart($username)
    {
        // Lấy cart_id của người dùng từ phương thức getOrCreateCartId
        $cart_id = $this->getOrCreateCartId($username);

        // Truy vấn thông tin các sản phẩm trong giỏ hàng của người dùng
        $sql = "SELECT 
                ci.masp,
                p.tensp,
                p.hinhanh,
                ci.original_price,
                ci.discount,
                ci.price
            FROM 
                cart_item AS ci
            JOIN 
                ad_product AS p ON ci.masp = p.masp
            WHERE 
                ci.cart_id = :cart_id";

        $stm = $this->conn->prepare($sql);
        $stm->bindParam(':cart_id', $cart_id);
        $stm->execute();

        $cart = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $cart;
    }

    //check xem sản phẩm này đã tồn tại trong giỏ hàng hay chưa dựa vào username và mã sản phẩm
    public function checkProductInCart($username, $masp)
    {
        $sql = "SELECT ci.* FROM cart_item ci INNER JOIN carts c ON ci.cart_id = c.cart_id
                 WHERE username = :username AND masp = :masp";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':masp', $masp);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm mới vào giỏ hàng
    public function addProductToCart($username, $masp)
    {
        $cartId = $this->getOrCreateCartId($username);

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $existingProduct = $this->checkProductInCart($username, $masp);

        if ($existingProduct) {
            // Nếu sản phẩm đã có trong giỏ hàng, không thêm nữa và trả về false
            return false;
        } else {
            // Lấy giá gốc và khuyến mãi từ bảng ad_product
            $sqlProduct = "SELECT giaban AS original_price, khuyenmai AS discount 
        FROM ad_product WHERE masp = :masp";
            $stmt = $this->conn->prepare($sqlProduct);
            $stmt->bindParam(':masp', $masp);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            $price = $product['original_price'] - $product['discount'];

            // Thêm sản phẩm vào bảng cart_item
            $sqlInsert = "INSERT INTO cart_item (cart_id, masp, quantity, price, discount, original_price) 
       VALUES (:cart_id, :masp, 1, :price, :discount, :original_price)";
            $stmt = $this->conn->prepare($sqlInsert);
            $stmt->bindParam(':cart_id', $cartId);
            $stmt->bindParam(':masp', $masp);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':discount', $product['discount']);
            $stmt->bindParam(':original_price', $product['original_price']);
            $stmt->execute();

            // Cập nhật tổng số lượng và tổng giá trị trong bảng carts
            $sqlUpdateCart = "UPDATE carts 
           SET total_quantity = total_quantity + 1, 
               total_price = total_price + :price
           WHERE cart_id = :cart_id";
            $stmt = $this->conn->prepare($sqlUpdateCart);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':cart_id', $cartId);
            return $stmt->execute();
        }
    }

    // public function deleteProductFromCart($username, $masp)
    // {
    //     // Lấy cart_id từ phương thức getOrCreateCartId
    //     $cart_id = $this->getCartIdByUsername($username);

    //     // Truy vấn để xóa sản phẩm trong cart_item dựa trên cart_id và masp
    //     $sql = "DELETE FROM cart_item WHERE cart_id = :cart_id AND masp = :masp";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':cart_id', $cart_id);
    //     $stmt->bindParam(':masp', $masp);

    //     return $stmt->execute();
    // }

    public function deleteProductFromCart($username, $masp)
    {
        $cartId = $this->getOrCreateCartId($username);

        // Lấy giá trị sản phẩm và số lượng từ cart_item
        $sqlItem = "SELECT quantity, price FROM cart_item 
                WHERE cart_id = :cart_id AND masp = :masp";
        $stmt = $this->conn->prepare($sqlItem);
        $stmt->bindParam(':cart_id', $cartId);
        $stmt->bindParam(':masp', $masp);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$item) {
            // Nếu sản phẩm không tồn tại, trả về false
            return false;
        }

        $totalPriceReduction = $item['quantity'] * $item['price'];

        // Xóa sản phẩm khỏi bảng cart_item
        $sqlDelete = "DELETE FROM cart_item WHERE cart_id = :cart_id AND masp = :masp";
        $stmt = $this->conn->prepare($sqlDelete);
        $stmt->bindParam(':cart_id', $cartId);
        $stmt->bindParam(':masp', $masp);
        $stmt->execute();

        // Cập nhật tổng số lượng và tổng giá trị trong bảng carts
        $sqlUpdateCart = "UPDATE carts 
                      SET total_quantity = total_quantity - :quantity, 
                          total_price = total_price - :price
                      WHERE cart_id = :cart_id";
        $stmt = $this->conn->prepare($sqlUpdateCart);
        $stmt->bindParam(':quantity', $item['quantity']);
        $stmt->bindParam(':price', $totalPriceReduction);
        $stmt->bindParam(':cart_id', $cartId);

        return $stmt->execute();
    }


    public function countCartItems($username)
    {
        // Lấy cart_id từ phương thức getOrCreateCartId
        $cart_id = $this->getOrCreateCartId($username);

        // Truy vấn cơ sở dữ liệu để đếm số lượng sản phẩm trong giỏ hàng của người dùng
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM cart_item WHERE cart_id = :cart_id");
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->execute();

        $result = $stmt->fetchColumn();
        return $result ? $result : 0; // Nếu không có sản phẩm thì trả về 0
    }

    // public function calculateTotal($cart_id)
    // {
    //     // Truy vấn tính tổng số lượng và tổng giá trị của giỏ hàng từ cart_item
    //     $sql = "SELECT 
    //             SUM(ci.quantity) AS total_quantity, 
    //             SUM(ci.price) AS total_price
    //         FROM 
    //             cart_item AS ci
    //         WHERE 
    //             ci.cart_id = :cart_id";

    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':cart_id', $cart_id);
    //     $stmt->execute();

    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //     return $result;
    // }

    public function getAllProductsInCart($username)
    {
        // $sql = "SELECT * FROM cart_item ci
        // INNER JOIN carts c ON c.cart_id = ci.cart_id WHERE username = :username";

        $sql = "SELECT ci.masp, ci.quantity, p.tensp, p.hinhanh, p.giaban, p.khuyenmai
            FROM cart_item ci
            INNER JOIN carts c on c.cart_id = ci.cart_id
            INNER JOIN ad_product p ON ci.masp = p.masp
            WHERE c.username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);

        // echo "Tên người dùng $username </br>";

        $stmt->execute();

        // Debugging: Lấy kết quả và kiểm tra
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // if (empty($result)) {
        //     echo "Giỏ hàng trống hoặc không tìm thấy dữ liệu!<br>";
        // } else {
        //     echo "Dữ liệu giỏ hàng:<br>";
        //     // print_r($result); // Hiển thị kết quả để kiểm tra
        // }

        return $result;
    }
}
