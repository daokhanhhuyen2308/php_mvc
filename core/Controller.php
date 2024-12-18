<?php 
class Controller{
    function model($model){
        require_once "./models/".$model.".php";
        return new $model;
    }
    public function view($view, $data = []) {
        if (file_exists("./views/" . $view . ".php")) {
            require_once "./views/" . $view . ".php";
        } else {
            die("View không tìm thấy: " . $view);
        }
    }


    public function getCartCount()
    {
        if (isset($_SESSION['user']['username'])) {
            $cartModel = $this->model("CartModel");
            return $cartModel->countCartItems($_SESSION['user']['username']);
        }
        return 0;
    }
}