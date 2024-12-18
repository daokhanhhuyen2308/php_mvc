<?php
class DB {
    private $host = "localhost";
    private $dbname = "website5";
    private $username = "root";
    private $password = "";
    protected $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            $this->conn = new PDO($dns, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Để phát hiện lỗi
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
        }
    }
}
