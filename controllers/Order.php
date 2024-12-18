<?php
session_start();
class Order extends Controller
{
    public function getAllOrders()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }

        $username = $_SESSION['user']['username'];
        $role = $_SESSION['user']['role'];

        $orderModel = $this->model("OrderModel");
        $orders = $orderModel->getShowOrder($username);

        if ($role === 'admin') {
            // Nếu là admin, lấy tất cả đơn hàng và hiển thị view ListOrderView
            $this->view("AdminView", [
                "page" => "backend/ListOrderView",
                "orders" => $orders
            ]);
        }
    }

    public function order($masp = null)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }

        // Lấy thông tin người dùng
        $username = $_SESSION['user']['username'];

        $products = []; // Khởi tạo mảng chứa sản phẩm

        if ($masp) {
            // Trường hợp có truyền mã sản phẩm -> Lấy thông tin sản phẩm cụ thể
            $productModel = $this->model("AdProductModel");
            $product = $productModel->getAdProductID($masp);

            if (!$product) {
                echo "Sản phẩm không tồn tại!";
                return;
            }

            // Định dạng lại dữ liệu sản phẩm (nếu cần)
            $products[] = $product;
        } else {
            // Trường hợp không truyền mã sản phẩm -> Lấy tất cả sản phẩm trong giỏ hàng
            $cartModel = $this->model("CartModel");
            $products = $cartModel->getAllProductsInCart($username);

            if (empty($products)) {
                echo "Giỏ hàng trống hoặc không tìm thấy dữ liệu!";
                // var_dump($username); // Kiểm tra username
                return;
            }
        }

        // Tính tổng giá trị các sản phẩm
        $totalPrice = 0;
        $voucherModel = $this->model("VoucherModel");
        $validVoucher = null;

        if (!empty($products)) {
            foreach ($products as $product) {
                $price = isset($product['giaban']) && isset($product['khuyenmai'])
                    ? $product['giaban'] - $product['khuyenmai']
                    : 0;
                $totalPrice += $price;
            }

            // Kiểm tra voucher hợp lệ
            $validVoucher = $voucherModel->getValidVoucherForOrder($totalPrice);

            // Nếu có voucher hợp lệ, áp dụng giảm giá
            if ($validVoucher) {
                $totalPrice -= $validVoucher['discount_amount']; // Giảm giá theo voucher
            }
        }

        // Trả về view với dữ liệu sản phẩm và thông tin voucher
        $this->view("UserView", [
            "page" => "backend/OrderView", // Trang hiển thị form thanh toán
            "products" => $products,       // Danh sách sản phẩm
            "totalPrice" => $totalPrice,   // Tổng giá trị sau khi áp dụng voucher
            "validVoucher" => $validVoucher, // Voucher hợp lệ
            "cartCount" => $this->getCartCount()
        ]);
    }

    //Thanh toán
    public function checkout()
    {

        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }

        // Lấy thông tin người dùng
        // $username = $_SESSION['user']['username'];
        // echo $username;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $username = $_SESSION['user']['username']; // Lấy từ session
            $maspArray = $_POST['masp']; // Mảng mã sản phẩm
            $totalPriceArray = $_POST['total_price']; // Mảng tổng giá
            $finalPrice = $_POST['final_price'];
            // echo "Final total price $finalPrice";
            // Lấy mã voucher từ form (nếu có)
            $voucherCode = isset($_POST['voucher_code']) ? $_POST['voucher_code'] : null;
            $paymentMethod = $_POST['payment_method'];
            $cardNumber = $_POST['card_number'];
            $cardName = strtoupper($_POST['card_name']); // Chuyển tên thẻ sang chữ hoa
            $expiryDate = $_POST['expiry_date'];
            $cvv = $_POST['cvv'];

            // Kiểm tra dữ liệu nhập
            if (empty($cardNumber) || !ctype_digit($cardNumber) || strlen($cardNumber) != 16) {
                echo "<script>alert('Số thẻ phải là 16 chữ số.');</script>";
                return;
            }
            if (!preg_match('/^\d{2}\/\d{2}$/', $expiryDate)) {
                echo "<script>alert('Ngày hết hạn phải có định dạng MM/YY.');</script>";
                return;
            }


            // echo "Mã voucher $voucherCode";

            // Mô hình đơn hàng và giỏ hàng
            $orderModel = $this->model("OrderModel");
            $cartModel = $this->model("CartModel");

            // $totalPrice = array_sum($totalPriceArray); // Tổng giá trị toàn bộ sản phẩm
            $totalQuantity = count($maspArray);       // Tổng số lượng sản phẩm

            $orderId = $orderModel->insertOrder(
                $username,
                $totalQuantity,
                $finalPrice,
                $voucherCode,
                $paymentMethod,
                $cardNumber,
                $cardName,
                $expiryDate,
                $cvv
            );

            // Thêm tất cả các sản phẩm vào đơn hàng
            foreach ($maspArray as $index => $masp) {
                $masp = $maspArray[$index];
                $price = $totalPriceArray[$index];

                $orderModel->insertOrderItem($orderId, $masp, 1, $price);

                // Xóa sản phẩm khỏi giỏ hàng sau khi insert vào bảng orders và order_item
                $cartModel->deleteProductFromCart($username, $masp);
            }

            $orderData = $orderModel->getOrderById($orderId);
            // var_dump($orderData); // Kiểm tra dữ liệu trả về từ model

            $orderItems = $orderModel->getOrderItemsByOrderId($orderId);

            // Truyền dữ liệu vào view OrderSuccess
            $this->view("UserView", [
                "page" => "backend/OrderSuccess",
                "orderID" => $orderData,
                "orderItems" => $orderItems,
                "cartCount" => $this->getCartCount()
            ]);
        }
    }

    public function updateOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['order_id'];
            $newStatus = $_POST['order_status'];

            $orderModel = $this->model("OrderModel");

            // Cập nhật trạng thái đơn hàng
            $isUpdated = $orderModel->updateOrderStatus($orderId, $newStatus);

            if ($isUpdated) {
                // Chuyển hướng về danh sách đơn hàng với thông báo thành công
                $_SESSION['success_message'] = "Cập nhật trạng thái đơn hàng thành công!";
            } else {
                // Thông báo lỗi nếu cập nhật không thành công
                $_SESSION['error_message'] = "Cập nhật trạng thái đơn hàng thất bại!";
            }

            header("Location: " . BASE_URL . "Order/getAllOrders");
            exit();
        }
    }
}
