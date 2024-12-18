<?php
class NewsController extends Controller
{

    public function getShow(){
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }
        
        $role = $_SESSION['user']['role']; // Lấy vai trò từ session
        
        if ($role === 'admin') {
            // Admin: Hiển thị AdminView
            $this->view('AdminView', ['page' => 'backend/NewsForm']);
        } else {
            // Người dùng khác: Hiển thị UserView
            $this->view('UserView', ['page' => 'frontend/NewsForm']);
        }
    }

    public function saveNews(){
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category = $_POST['category'];
            $publish_date = $_POST['publish_date'];
        
            // Xử lý upload ảnh đại diện
            $thumbnail = null;
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                try {
                    $thumbnail = $this->uploadThumbnail($_FILES['thumbnail']);
                } catch (Exception $e) {
                    $this->view('AdminView', [
                        'page' => 'backend/NewsForm',
                        'error' => 'Lỗi upload ảnh: ' . $e->getMessage()
                    ]);
                    return;
                }
            }
        
            // Gọi model để lưu tin tức
            $newsModel = $this->model('NewsModel');
            $success = $newsModel->saveNews($title, $content, $thumbnail, $category, $publish_date);
        
            // Kiểm tra vai trò người dùng
            $role = $_SESSION['user']['role']; // Lấy vai trò từ session
        
            if ($success) {
                if ($role === 'admin') {
                    // Admin: Hiển thị AdminView
                    $this->view("AdminView", [
                        "page" => "backend/NewsForm",
                        "newsList" => $newsModel->getAllNews()
                    ]);
                } else {
                    // User: Hiển thị UserView
                    $this->view("UserView", [
                        "page" => "frontend/NewsForm",
                        "newsList" => $newsModel->getAllNews(),
                        "cartCount" => $this->getCartCount()
                    ]);
                }
            }
        }

    }
    // Kiểm tra xem người dùng đã đăng nhập chưa


    

    private function uploadThumbnail($file)
    {
        $targetDir = "uploads/news/";
        $fileName = time() . "_" . basename($file['name']);
        $targetFilePath = $targetDir . $fileName;

        // Kiểm tra và di chuyển file
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            return $targetFilePath;
        } else {
            throw new Exception("Không thể upload file ảnh.");
        }
    }
}
