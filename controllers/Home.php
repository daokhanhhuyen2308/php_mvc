<?php
session_start();
class Home extends Controller
{

    public function getShow($page = 1)
    {
        $itemsPerPage = 8; // Số sản phẩm mỗi trang
        $offset = ($page - 1) * $itemsPerPage;

        // Lấy model
        $productModel = $this->model("AdProductModel");

        // Lấy danh sách sản phẩm
        $productList = $productModel->getPaginatedProducts($offset, $itemsPerPage);

        // Đếm tổng số sản phẩm
        $totalProducts = $productModel->countProducts();
        $totalPages = ceil($totalProducts / $itemsPerPage);

        $voucherModel = $this->model("VoucherModel");
        $vouchers = $voucherModel->getShowVoucher();

        // Kiểm tra role
        $role = $_SESSION['user']['role'] ?? 'guest';

        if ($role === 'admin') {
            // Admin: Hiển thị AdminView
            $this->view("AdminView", [
                "page" => "backend/AdProductView_List",
                // "page" => "backend/AdProductView_List",
                // "vouchers" => $vouchers,
                "productList" => $productList,
                "currentPage" => $page,
                "totalPages" => $totalPages,
            ]);
        } else {
            // User/Guest: Hiển thị UserView
            $cartCount = $this->getCartCount();
            //"frontend/FeaturedProductView_List", 

            $this->view("UserView", [
                "page" => "frontend/AdProductView_List",
                // "frontend/VoucherView_List"],
                "role" => $role,
                "productList" => $productList,
                "vouchers" => $vouchers,
                "cartCount" => $cartCount,
                "currentPage" => $page,
                "totalPages" => $totalPages,
            ]);
        }
    }

}


    // public function getShow()
    // {
    //     $obj = $this->model("AdProductModel");
    //     $productList = $obj->getAdProduct();
    //     if (isset($_SESSION['user'])) {
    //         $role = $_SESSION['user']['role'];
    //     } else {
    //         $role = 'guest';
    //     }

    //     $cartModel = $this->model("CartModel");
    //     $cartCount = $cartModel->countCartItems("daokhanhhuyen");
    //     $this->view("Main_View", ["page" => "/frontend/AdProductView",
    //     "role" => $role, "productList" => $productList, "cartCount" => $cartCount]);
    // }

