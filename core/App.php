<?php
class App {
    protected $controller = "Home"; // Controller mặc định
    protected $action = "getShow"; // Action mặc định
    protected $param; // Tham số cho action

    function __construct() {
        if (isset($_GET["url"])) {
            $arr = $this->urlProcess();
            // Kiểm tra xem bộ điều khiển có tồn tại trong thư mục controller không
            if (file_exists("./controllers/" . $arr[0] . ".php")) {
                require_once "./controllers/" . $arr[0] . ".php";
                $this->controller = $arr[0]; // Lưu tên controller
                unset($arr[0]);
            } else {
                // Xử lý lỗi nếu controller không tồn tại
                die("Controller không tìm thấy: " . $arr[0]);
            }

            // Khởi tạo controller
            $this->controller = new $this->controller;

            // Kiểm tra xem action có tồn tại trong controller không
            if (isset($arr[1])) {
                if (method_exists($this->controller, $arr[1])) {
                    $this->action = $arr[1];
                }
            }
            unset($arr[1]);
            $this->param = $arr ? array_values($arr) : array();
            // Gọi action với các tham số
            call_user_func_array(array($this->controller, $this->action), $this->param);
        } else {
            // Chuyển hướng đến controller mặc định
            header("Location: " . BASE_URL . "Home/getShow");
            exit();
        }
    }

    // Hàm xử lý URL
    public function urlProcess() {
        if (isset($_GET["url"])) {
            return explode('/', filter_var(trim($_GET["url"], '/')));
        }
    }
}