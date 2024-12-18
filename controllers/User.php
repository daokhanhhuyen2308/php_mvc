<?php
session_start();
class User extends Controller
{

    //DDDaaa000@@@
    public function login()
    {
        // Kiểm tra nếu yêu cầu là POST (khi người dùng submit form)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Kiểm tra thông tin người dùng với model UserModel
            $userModel = $this->model("UserModel");
            $user = $userModel->login($username, $password);

            // Kiểm tra nếu thông tin đăng nhập đúng
            if ($user) {
                $_SESSION['user'] = [
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'email' => $user['email'],
                    'password' => $user['passsword'],
                    'fullname' => $user['fullname'],
                    'avatar' => $user['avatar'],
                    'phone' => $user['phone'],
                    'address' => $user['address']
                ];

                // Điều hướng dựa trên role
                if ($user['role'] === 'admin') {
                    header("Location: " . BASE_URL . "Home");
                } else {
                    header("Location: " . BASE_URL . "Home");
                }
                exit();
                // Chuyển hướng tới trang Home/getShow
                // header("Location: " . BASE_URL . "Home");
                // exit();
            } else {
                // Nếu thông tin đăng nhập sai, trả về form login với thông báo lỗi
                $data['error'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
                $this->view('frontend/LoginView', $data);
            }
        } else {
            // Nếu không phải POST, chỉ hiển thị form login
            $this->view('frontend/LoginView');
        }
    }
    public function logout()
    {
        // Xóa tất cả session và chuyển hướng về trang login
        session_start();
        session_unset();
        session_destroy();
        header("Location: " . BASE_URL . "User/login");
        exit();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $avatar = $_FILES['avatar'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];

            $data = [
                'username' => $username,
                'email' => $email,
                'fullname' => $fullname,
                'address' => $address,
                'phone' => $phone,
            ];

            if (!$this->isStrongPassword($password)) {
                $data['error'] = "Mật khẩu không đủ mạnh!";
                // $this->view('frontend/RegisterView', $data);
                echo "<script>
                alert('Password không hợp lệ!');
                </script>";
                return;
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            if (isset($avatar) && $avatar['error'] === 0) {
                $avatarPath = $this->uploadAvatar($avatar);
                if (!$avatarPath) {
                    $data['error'] = "Ảnh không hợp lệ. Vui lòng thử lại!";
                    // $this->view('frontend/RegisterView', $data);
                    echo "<script>
                    alert('Ảnh không hợp lệ!');
                    </script>";
                    return;
                }
            } else {
                $data['error'] = "Bạn chưa chọn ảnh hoặc ảnh không hợp lệ!";
                // $this->view('frontend/RegisterView', $data);
                echo "<script>
                alert('Ảnh không hợp lệ!');
                </script>";
                return;
            }

            $userModel = $this->model("UserModel");
            $result = $userModel->register($username, $email, $passwordHash, $fullname, $avatarPath, $address, $phone);

            if ($result) {

                echo "<script>
                alert('Đăng ký thành công!');
                </script>";
                // window.location.href = '" . BASE_URL . "User/login';
                header("Location: " . BASE_URL . "User/login");
                exit();
            } else {
                $data['error'] = "Đã xảy ra lỗi trong quá trình đăng ký!";
                // $this->view('frontend/RegisterView', $data);
            }
        } else {
            $this->view('frontend/RegisterView');
        }
    }

    // Hàm kiểm tra mật khẩu mạnh
    private function isStrongPassword($password)
    {
        // Kiểm tra mật khẩu có đủ 12 ký tự không
        if (strlen($password) < 12) {
            return false;
        }

        // Kiểm tra mật khẩu có ít nhất 3 ký tự chữ hoa, 3 chữ thường, 3 số và 3 ký tự đặc biệt
        if (!preg_match('/[A-Z].*[A-Z].*[A-Z]/', $password)) {
            return false; // ít nhất 3 ký tự chữ hoa
        }
        if (!preg_match('/[a-z].*[a-z].*[a-z]/', $password)) {
            return false; // ít nhất 3 ký tự chữ thường
        }
        if (!preg_match('/\d.*\d.*\d/', $password)) {
            return false; // ít nhất 3 ký tự số
        }
        if (!preg_match('/[\W_].*[\W_].*[\W_]/', $password)) {
            return false; // ít nhất 3 ký tự đặc biệt
        }

        return true; // Mật khẩu mạnh
    }

    // Hàm xử lý upload ảnh đại diện
    private function uploadAvatar($avatar)
    {
        $uploadDir = 'public/images/'; // Thư mục lưu ảnh
        $fileName = uniqid() . '_' . basename($avatar['name']);
        $targetFile = $uploadDir . $fileName;

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if (!in_array($avatar['type'], $allowedTypes)) {
            throw new Exception("Chỉ chấp nhận các định dạng ảnh JPG, PNG, GIF.");
        }

        if ($avatar['size'] > 2 * 1024 * 1024) { // Giới hạn kích thước 2MB
            throw new Exception("File quá lớn. Kích thước tối đa là 2MB.");
        }

        if (move_uploaded_file($avatar['tmp_name'], $targetFile)) {
            return $targetFile;
        } else {
            throw new Exception("Lỗi khi tải lên ảnh đại diện.");
        }
    }


    public function profile()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa (kiểm tra session)
        // if (isset($_SESSION['user'])) {
        //     // Nếu đã đăng nhập, chỉ cần hiển thị view thông tin người dùng
        //     $this->view('Main_View', [
        //         'page' => 'backend/ProfileView',
        //         "cartCount" => $this->getCartCount(),
        //         'user' => $_SESSION['user'], // Truyền thông tin người dùng vào view
        //     ]);
        // } else {
        //     // Nếu chưa đăng nhập, chuyển hướng về trang login
        //     header("Location: " . BASE_URL . "User/login");
        //     exit();
        // }
        // Kiểm tra xem người dùng đã đăng nhập hay chưa (kiểm tra session)
        if (isset($_SESSION['user'])) {
            // Lấy thông tin người dùng từ session
            $user = $_SESSION['user'];
            $role = $user['role'] ?? 'guest'; // Lấy vai trò, mặc định là guest nếu không có

            if ($role === 'admin') {
                // Nếu là admin, hiển thị AdminView
                $this->view('AdminView', [
                    'page' => 'backend/ProfileView',
                    'user' => $user, // Thông tin người dùng
                ]);
            } else {
                // Nếu là user, hiển thị UserView
                $this->view('UserView', [
                    'page' => 'backend/ProfileView',
                    "cartCount" => $this->getCartCount(),
                    'user' => $user, // Thông tin người dùng
                ]);
            }
        } else {
            // Nếu chưa đăng nhập, chuyển hướng về trang login
            header("Location: " . BASE_URL . "User/login");
            exit();
        }
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin người dùng từ session
            $currentUser = $_SESSION['user'];

            // Kiểm tra từng trường, nếu không có thay đổi thì giữ nguyên giá trị cũ
            $username = $currentUser['username']; // Không cho phép thay đổi username
            $email = !empty($_POST['email']) ? $_POST['email'] : $currentUser['email'];
            $fullname = !empty($_POST['fullname']) ? $_POST['fullname'] : $currentUser['fullname'];
            $phone = !empty($_POST['phone']) ? $_POST['phone'] : $currentUser['phone'];
            $address = !empty($_POST['address']) ? $_POST['address'] : $currentUser['address'];

            // Xử lý mật khẩu
            if (!empty($_POST['password'])) {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mã hóa mật khẩu
            } else {
                $password = $currentUser['password']; // Giữ nguyên mật khẩu cũ
            }

            // Xử lý ảnh đại diện bằng uploadAvatar
            try {
                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                    $avatarName = $this->uploadAvatar($_FILES['avatar'], $currentUser['avatar']);
                } else {
                    $avatarName = $currentUser['avatar']; // Giữ nguyên avatar cũ nếu không upload
                }
            } catch (Exception $e) {
                echo "<script>alert('Lỗi ảnh: " . $e->getMessage() . "');</script>";
                $avatarName = $currentUser['avatar']; // Giữ nguyên avatar cũ nếu xảy ra lỗi
            }

            // Cập nhật thông tin vào cơ sở dữ liệu
            $userModel = $this->model('UserModel');
            $updateSuccess = $userModel->updateUserProfile($username, $email, $password, $fullname, $phone, $address, $avatarName);

            if ($updateSuccess) {
                // Cập nhật session với đường dẫn ảnh đầy đủ
                $_SESSION['user'] = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'fullname' => $fullname,
                    'phone' => $phone,
                    'address' => $address,
                    'avatar' => $avatarName, // Cập nhật avatar mới hoặc giữ nguyên cũ
                    'role' => $currentUser['role'], // Đảm bảo role được giữ nguyên
                ];

                // Kiểm tra vai trò người dùng để trả về view phù hợp
                if ($_SESSION['user']['role'] === 'admin') {
                    // Trả về view cho admin
                    $this->view('AdminView', [
                        'page' => 'backend/ProfileView',
                        // 'user' => $_SESSION['user'],
                    ]);
                } else {
                    // Trả về view cho người dùng thường
                    $this->view('UserView', [
                        'page' => 'backend/ProfileView',
                        // 'user' => $_SESSION['user'],
                        'cartCount' => $this->getCartCount(),
                    ]);
                }
            } else {
                // Trả về view profile với thông báo lỗi
                $this->view('UserView', [
                    'page' => 'backend/ProfileView',
                    'user' => $_SESSION['user'],
                    'error' => 'Cập nhật thất bại!',
                    'cartCount' => $this->getCartCount(),
                ]);
            }
        }
    }


    public function getAllUsers()
    {
        $obj = $this->model('UserModel');
        $users = $obj->getAllUsers();
        $this->view("AdminView", [
            "page" => "backend/ListUserView",
            "users" => $users
        ]);
    }

    public function deleteUser($username)
    {
        $obj = $this->model('UserModel');
        $obj->deleteUserById($username);
        header("Location: " . BASE_URL . "User/getAllUsers");
        exit();
    }


    public function update($username)
    {
        $userModel = $this->model("UserModel");

        // Lấy thông tin người dùng từ model
        $user = $userModel->getUserByUsername($username);

        // Kiểm tra nếu không tìm thấy người dùng
        if ($user === null) {
            error_log("Người dùng không tồn tại với username: " . $username);
            echo "Người dùng không tồn tại!";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];


            $address = $_POST['address'];
            $role = $_POST['role'];

            // Xử lý avatar
            $avatar = $user['avatar']; // Giữ nguyên avatar cũ nếu không upload mới
            if (!empty($_FILES['avatar']['name'])) {
                try {
                    $avatar = $this->uploadAvatar($_FILES['avatar']); // Sử dụng phương thức uploadAvatar
                } catch (Exception $e) {
                    echo "Lỗi khi tải lên ảnh: " . $e->getMessage();
                    return;
                }
            }

            // Gọi model để cập nhật dữ liệu
            $updateSuccess = $userModel->updateUser($username, $email, $password, $fullname, $avatar, $phone, $address, $role);

            if ($updateSuccess) {
                header("Location: " . BASE_URL . "User/getAllUsers"); // Chuyển hướng sau khi cập nhật thành công
                exit();
            } else {
                error_log("Cập nhật không thành công cho người dùng: " . $username); // Log nếu cập nhật không thành công 
                echo "Cập nhật thất bại!";
            }
        }

        // Truyền dữ liệu vào view
        $this->view("AdminView", [
            "page" => "backend/UserView_Update",
            "userID" => $user,
        ]);
    }

    public function create()
    {
        $userModel = $this->model("UserModel");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mã hóa mật khẩu
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $role = $_POST['role'];
            $avatar = null;

            // Xử lý avatar (nếu có)
            if (!empty($_FILES['avatar']['name'])) {
                try {
                    $avatar = $this->uploadAvatar($_FILES['avatar']); // Sử dụng phương thức uploadAvatar
                } catch (Exception $e) {
                    echo "Lỗi khi tải lên ảnh: " . $e->getMessage();
                    return;
                }
            }

            // Gọi model thêm người dùng
            $result = $userModel->createUser($username, $email, $password, $fullname, $avatar, $phone, $address, $role);

            if ($result > 0) {
                header("Location: " . BASE_URL . "User/getAllUsers");
                exit();
            } else {
                echo "Thêm người dùng thất bại!";
            }
        }

        // Hiển thị form thêm mới
        $this->view("AdminView", ["page" => "backend/UserView_Add"]);
    }

    //sản phẩm đã mua
    public function getMyProduct()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }

        $username = $_SESSION['user']['username'];
        // $productModel = $this->model("AdProductModel");
        $productModel = $this->model("OrderModel");
        $completedCourses  = $productModel->getCompletedCourses($username);

        $this->view("UserView", [
            "page" => "backend/MyProductView",
            "completedCourses" => $completedCourses,
            'cartCount' => $this->getCartCount()
        ]);
    }

    //đơn hàng của người mua
    public function getMyOrder()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "User/login");
            exit();
        }

        // Lấy thông tin username từ session
        $username = $_SESSION['user']['username'];

        // Gọi đến model để lấy thông tin đơn hàng
        $orderModel = $this->model("OrderModel");
        $orders = $orderModel->getMyOrderProduct($username);

        // Truyền dữ liệu vào view
        $this->view("UserView", [
            "page" => "backend/MyOrdersView",
            "orders" => $orders,
            "cartCount" => $this->getCartCount(),
        ]);
    }
}
