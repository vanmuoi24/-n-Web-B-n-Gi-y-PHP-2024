<?php
    class LoginModal{
        private $conn;
        public function __construct($conn)
        {
            $this->conn = $conn;
        }
    
        public function Login($data)
        {
            $tendn = $data["usernameValue"];
            $matkhau = $data["passwordValue"];

            $sql = "SELECT TenDN,MatKhau FROM taikhoan WHERE TenDN = '$tendn' AND MatKhau = '$matkhau' ";
            $result = $this->conn->query($sql);
            if ($result) {
                echo json_encode(array(
                    "status"=> true,
                    "message" => "Đăng nhập thành công",
                ));
            } else {
                    echo json_encode(array(
                    "status"=> false,
                    "message" => "Sai thông tin đăng nhập",
                    ));
                }
        }
    }
?>