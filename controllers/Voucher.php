<?php
session_start();

class Voucher extends Controller
{
    function getAllVouchers()
    {
        $role = $_SESSION['user']['role'] ?? 'guest'; // Lấy role từ session (mặc định là guest)

        $obj = $this->model("VoucherModel");
        $data = $obj->getShowVoucher(); // Lấy danh sách vouchers

        if ($role === 'admin') {
            // Nếu role là admin, trả ra view quản lý voucher cho admin
            $this->view("AdminView", [
                "page" => "backend/VoucherView",
                "vouchers" => $data
            ]);
        } else {
            // Nếu không phải admin, trả ra view dành cho user hoặc guest
            $this->view("UserView", [
                "page" => "frontend/VoucherView_List",
                "vouchers" => $data
            ]);
        }
    }

    public function add()
    {
        // Kiểm tra nếu request là POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $voucher_code = trim($_POST['voucher_code']);
            $description = trim($_POST['description']);
            $discount_amount = (float) $_POST['discount_amount'];
            $min_order_value = (float) $_POST['min_order_value'];
            $valid_from = $_POST['valid_from'];
            $valid_until = $_POST['valid_until'];

            // Gọi model
            $voucherModel = $this->model('VoucherModel');

            // // Kiểm tra voucher_code đã tồn tại chưa
            // if ($voucherModel->isVoucherCodeExists($voucher_code)) {
            //     // Nếu đã tồn tại, hiển thị thông báo lỗi
            //     $this->view('Main_View', [
            //         "page" => "backend/VoucherView_Add",
            //         "error" => "Mã voucher đã tồn tại!"
            //     ]);
            //     return;
            // }

            // Chèn voucher mới vào cơ sở dữ liệu
            $result = $voucherModel->insertVoucher(
                $voucher_code,
                $description,
                $discount_amount,
                $min_order_value,
                $valid_from,
                $valid_until
            );

            if ($result > 0) {
                // Thành công, chuyển hướng hoặc thông báo
                header('Location: ' . BASE_URL . 'Voucher/getAllVouchers');
                exit();
            } else {
                echo "Error";
            }
        }
            // Hiển thị form nếu không phải POST
            $this->view('AdminView', ["page" => "backend/VoucherView_Add"]);
        
    }

    public function update($voucher_code)
    {
        $voucherModel = $this->model('VoucherModel');

        // Kiểm tra voucher_code đã tồn tại chưa
        $voucher = $voucherModel->getVoucherByCode($voucher_code);
        // echo "Voucher: ";
        // print_r($voucher);

        if ($voucher === null) {
            echo "Voucher không tồn tại!";
            return; // Tạm dừng nếu không tìm thấy voucher
        }

        // Kiểm tra nếu request là POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $description = trim($_POST['description']);
            $discount_amount = (float) $_POST['discount_amount'];
            $min_order_value = (float) $_POST['min_order_value'];
            $valid_from = $_POST['valid_from'];
            $valid_until = $_POST['valid_until'];

            // Gọi model

            // Chèn voucher mới vào cơ sở dữ liệu
            $result = $voucherModel->updateVoucher(
                $voucher_code,
                $description,
                $discount_amount,
                $min_order_value,
                $valid_from,
                $valid_until
            );

            if ($result > 0) {
                // Thành công, chuyển hướng hoặc thông báo
                header('Location: ' . BASE_URL . 'Voucher/getAllVouchers');
                exit();
            }
        }
        $this->view(
            "AdminView",
            [
                "page" => "backend/VoucherView_Update",
                "voucher" => $voucher
            ]
        );
    }
}
