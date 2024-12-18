<?php
session_start();
class AdProduct extends Controller
{
    public function getShow()
    {
        $obj = $this->model("AdProductModel");
        $data = $obj->getAdProduct();
        $this->view("AdminView", [
            "page" => "backend/AdProductView_List",
            "product" => $data
        ]);
    }
    public function insert()
    {
        $obj = $this->model("AdProductModel");
        $ma_loaisp = $_POST["txt_maloaisp"] ?? "";
        $masp = $_POST["txt_masp"] ?? "";
        $tensp = $_POST["txt_tensp"] ?? "";
        $hinhanh = "";
        if (isset($_FILES['txt_hinhanh']) && $_FILES['txt_hinhanh']['error'] === 0) {
            $uploadDir = './public/images/'; // Thư mục lưu ảnh
            $fileName = basename($_FILES['txt_hinhanh']['name']);
            $targetFilePath = $uploadDir . $fileName;

            // Kiểm tra và di chuyển file
            if (move_uploaded_file($_FILES['txt_hinhanh']['tmp_name'], $targetFilePath)) {
                $hinhanh = $targetFilePath; // Lưu đường dẫn file
            } else {
                echo "Lỗi khi upload file.";
                return;
            }
        }
        $giaban = isset($_POST["txt_giaban"]) ? $_POST["txt_giaban"] : "";
        $khuyenmai = isset($_POST["txt_khuyenmai"]) ? $_POST["txt_khuyenmai"] : "";
        $mota = isset($_POST["txt_mota"]) ? $_POST["txt_mota"] : "";
        $create_date = isset($_POST["txt_create_date"]) ? $_POST["txt_create_date"] : "";
        $obj2 = $this->model("AdProductTypeModel");
        $productType = $obj2->getAdProductType();
        //var_dump($productType);
        $this->view("AdminView", ["page" => "backend/AdProductView_Add", "productType" => $productType]);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $obj->insertAdProduct($ma_loaisp, $masp, $tensp, $hinhanh, $giaban, $khuyenmai, $mota, $create_date);
            header("Location:..");
            exit();
        }
    }

    public function update($masp)
    {
        $productModel = $this->model("AdProductModel");

        // Lấy thông tin sản phẩm theo ID
        $product = $productModel->getAdProductID($masp);

        // Kiểm tra xem $product có tồn tại hay không
        if ($product === null) {
            echo "Sản phẩm không tồn tại!";
            return; // Tạm dừng nếu không tìm thấy sản phẩm
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý dữ liệu form
            $ma_loaisp = $_POST["txt_maloaisp"] ?? $product["ma_loaisp"];
            $tensp = $_POST["txt_tensp"] ?? $product["tensp"];
            $giaban = $_POST["txt_giaban"] ?? $product["giaban"];
            $khuyenmai = $_POST["txt_khuyenmai"] ?? $product["khuyenmai"];
            $mota = $_POST["txt_mota"] ?? $product["mota"];
            $create_date = $_POST["txt_create_date"] ?? $product["create_date"];

            // Xử lý ảnh
            $hinhanh = $product["hinhanh"]; // Giữ ảnh cũ
            if (isset($_FILES["txt_hinhanh"]) && $_FILES["txt_hinhanh"]["error"] == UPLOAD_ERR_OK) {
                $fileTmp = $_FILES["txt_hinhanh"]["tmp_name"];
                $fileName = time() . '_' . basename($_FILES["txt_hinhanh"]["name"]);
                $targetPath = "./public/images/" . $fileName;

                if (move_uploaded_file($fileTmp, $targetPath)) {
                    $hinhanh = $fileName; // Cập nhật ảnh mới
                }
            }

            // Cập nhật sản phẩm
            $updateSuccess = $productModel->updateAdProduct(
                $ma_loaisp,
                $masp,
                $tensp,
                $hinhanh,
                $giaban,
                $khuyenmai,
                $mota,
                $create_date
            );

            if ($updateSuccess) {
                header("Location: " . BASE_URL . "AdProduct/");
                exit();
            } else {
                // echo "Cập nhật sản phẩm thất bại!";
            }
        }

        // Truyền dữ liệu vào view
        $this->view("AdminView", ["page" => "backend/AdProductView_Update", "productID" => $product]);
        // $this->view("backend/AdProductView_Update", [
        //     "product" => $product, // Truyền thông tin sản phẩm vào view
        // ]);

    }


    public function delete($masp)
    {
        $obj = $this->model("AdProductModel");
        $obj->deleteAdProduct($masp);
        header("Location:..");
        exit();
    }

    public function viewDetail($masp)
    {
        $obj = $this->model("AdProductModel");
        $data = $obj->getAdProductID($masp);

        $obj1 = $this->model("ReviewModel");
        $reviewList = $obj1->getReviewByProductID($masp);

        // Kiểm tra role
        $role = $_SESSION['user']['role'] ?? 'guest';

        if ($role === 'admin') {
            $this->view("AdminView", [
                "page" => "frontend/AdProductView_Detail",
                "product" => $data,
                "cartCount" => $this->getCartCount()
            ]);
        } else {
            // User/Guest: Hiển thị UserView
            $cartCount = $this->getCartCount();


            $this->view("UserView", [
                "page" => ["frontend/AdProductView_Detail"],
                "role" => $role,
                "product" => $data,
                "reviewList" => $reviewList,
                "cartCount" => $cartCount,
            ]);
        }
    }
    public function search()
    {
        // Lấy giá trị tìm kiếm từ POST
        $key = $_POST['search'] ?? "";

        // Lấy trang hiện tại từ GET, mặc định là trang 1
        $currentPage = $_GET['page'] ?? 1;

        // Số sản phẩm mỗi trang
        $itemsPerPage = 10;

        // Gọi phương thức searchAdProduct để tìm sản phẩm
        $obj = $this->model("AdProductModel");
        $productList = $obj->searchAdProduct($key, $currentPage, $itemsPerPage);

        // Lấy tổng số sản phẩm để tính số trang
        $totalItems = $obj->countSearchAdProduct($key);

        // Tính tổng số trang
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Truyền dữ liệu vào view
        $role = $_SESSION['user']['role'] ?? 'guest'; // Lấy role từ session (mặc định là 'guest')

        if ($role === 'admin') {
            // Nếu role là admin, hiển thị view quản lý sản phẩm
            $this->view("AdminView", [
                "page" => "backend/AdProductView_List",
                "productList" => $productList,
                "searchTerm" => $key,
                "currentPage" => $currentPage,
                "totalPages" => $totalPages,
            ]);
        } else {
            // Nếu role là user hoặc guest, hiển thị view sản phẩm cho người dùng
            $this->view("UserView", [
                "page" => "frontend/AdProductView_List",
                "productList" => $productList,
                "cartCount" => $this->getCartCount(),
                "searchTerm" => $key,
                "currentPage" => $currentPage,
                "totalPages" => $totalPages,
            ]);
        }


        // Truyền dữ liệu vào view
        // $this->view("UserView", [
        //     "page" => "frontend/AdProductView",
        //     "productList" => $productList,
        //     "cartCount" => $this->getCartCount(),
        //     "searchTerm" => $key,
        //     "currentPage" => $currentPage,
        //     "totalPages" => $totalPages
        // ]);
    }


    // public function search() {
    //     $key = $_POST['search'] ?? ""; // Lấy giá trị tìm kiếm từ POST
    //     $obj = $this->model("AdProductModel");
    //     $productList = $obj->searchAdProduct($key); // Truyền $key vào phương thức tìm kiếm
    //     $this->view("Main_View", ["page" => "frontend/AdProductView",
    //      "productList" => $productList, "cartCount" => $this->getCartCount()]);
    // }

    public function addReview()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }

        // Lấy thông tin người dùng
        $username = $_SESSION['user']['username'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $masp = $_POST['masp'];
            $rating = (int)$_POST['rating'];
            $comment = $_POST['comment'];

            if ($username && $masp && $rating && $comment) {
                $reviewModel = $this->model("ReviewModel");
                $success = $reviewModel->addReview($username, $masp, $rating, $comment);

                if ($success) {
                    header("Location: " . BASE_URL . "AdProduct/viewDetail/$masp");
                }
            }
        }
    }

    public function updateReview()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewID = $_POST['review_id'];
            $masp = $_POST['masp'];
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];

            // Kiểm tra dữ liệu
            if (empty($reviewID) || empty($masp) || empty($rating) || empty($comment)) {
                $this->view('ProductView', [
                    'error' => 'Vui lòng điền đầy đủ thông tin.',
                    'product' => $this->model("ProductModel")->getProduct($masp),
                    'reviewList' => $this->model("ReviewModel")->getReviewsByProduct($masp)
                ]);
                return;
            }

            // Gọi model để cập nhật
            $reviewModel = $this->model("ReviewModel");
            $success = $reviewModel->updateReview($reviewID, $masp, $_SESSION['user']['username'], $comment, $rating);

            if ($success) {
                // Lấy lại danh sách đánh giá mới
                $reviewList = $reviewModel->getReviewsByProduct($masp);

                // Trả lại view sản phẩm với dữ liệu cập nhật
                $this->view('UserView', [
                    "page" => "frontend/AdProductView_Detail",
                    'reviewList' => $reviewList,
                    'product' => $this->model("ProductModel")->getProduct($masp)
                ]);
            }
        }
    }


    public function deleteReview()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }

        // Lấy thông tin người dùng
        $username = $_SESSION['user']['username'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewID = $_POST['review_id'];
            $masp = $_POST['masp'];

            $reviewModel = $this->model("ReviewModel");

            // Kiểm tra quyền: đánh giá này phải do người dùng hiện tại tạo ra
            $review = $reviewModel->getReviewByID($reviewID);
            if (!$review || $review['username'] !== $username) {
                echo "Bạn không có quyền xóa đánh giá này.";
                exit();
            }

            // Thực hiện xóa đánh giá
            $success = $reviewModel->deleteReview($reviewID, $username);

            if ($success) {
                header("Location: " . BASE_URL . "AdProduct/viewDetail/$masp");
            }
        }
    }
}
