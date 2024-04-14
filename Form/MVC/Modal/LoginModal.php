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
            $sql_khachhang = "SELECT TenDN,MatKhau FROM taikhoan WHERE TenDN = '".$tendn."' AND MatKhau = '".$matkhau."'  ";
            $result = $this->conn->query($sql_khachhang);
            if ($result->num_rows > 0) {
                echo json_encode(array(
                    "status"=> true,
                ));
            } else {
                    echo json_encode(array(
                    "status"=> false,
                    "error" => "Sai thông tin đăng nhập",
                    ));
                }
        }
    }
?>