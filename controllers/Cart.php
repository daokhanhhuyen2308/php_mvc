<?php
session_start();
class Cart extends Controller
{

    public function getShow()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }

        $username = $_SESSION['user']['username'];
        $cartModel = $this->model("CartModel");
        $cartItems = $cartModel->getShowCart($username);

        // $cartCount = $cartModel->countCartItems($username);

        // Lấy số lượng sản phẩm trong giỏ hàng từ phương thức của Controller
        $cartCount = $this->getCartCount();
        // Truyền dữ liệu vào view
        $this->view("UserView", [
            "page" => "backend/CartProductView",
            "cartItems" => $cartItems,
            "cartCount" => $cartCount
        ]);
    }


    public function addToCart($masp)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }

        // Lấy thông tin người dùng
        $username = $_SESSION['user']['username'];

        // Tạo đối tượng mô hình Order để kiểm tra sản phẩm đã mua
        $orderModel = $this->model("OrderModel");

        // Kiểm tra xem sản phẩm này người dùng đã mua hay chưa
        if ($orderModel->isProductPurchased($username, $masp)) {
            // Nếu sản phẩm đã được mua, thông báo cho người dùng và không thêm vào giỏ hàng
            echo "<script>alert('Bạn đã mua khóa học này rồi. Vui lòng kiểm tra trong danh mục khóa học của bạn.'); window.history.back();</script>";
            // header("Location: " . BASE_URL . "Cart/viewCart");
            exit();
        }

        // Tạo đối tượng mô hình Cart
        $cartModel = $this->model("CartModel");

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $existingProduct = $cartModel->checkProductInCart($username, $masp);

        if ($existingProduct) {
            // Nếu sản phẩm đã có trong giỏ hàng, chuyển hướng tới giỏ hàng
            $_SESSION['toastMessage'] = 'Bạn đã thêm sản phẩm thành công';
            header("Location: " . BASE_URL . "Cart/viewCart");
            exit();
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm vào giỏ hàng
            $cartModel->addProductToCart($username, $masp);
            $_SESSION['message'] = "Khóa học đã được thêm vào giỏ hàng!";
            header("Location: " . BASE_URL . "Cart/viewCart");
            exit();
        }
    }

    public function deleteFromCart($masp)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }

        // Lấy thông tin người dùng
        $username = $_SESSION['user']['username'];

        // Tạo đối tượng mô hình Cart
        $cartModel = $this->model("CartModel");

        // Xóa sản phẩm khỏi giỏ hàng
        $cartModel->deleteProductFromCart($username, $masp);

        // Chuyển hướng về trang giỏ hàng sau khi xóa sản phẩm
        $_SESSION['toastMessage'] = 'Bạn đã xóa sản phẩm khỏi giỏ hàng';
        header("Location: " . BASE_URL . "Cart/viewCart");
        exit();
    }
}
