<?php

class LoginModal
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function Login($data)
    {
        $tendn = $data["usernameValue"];
        $matkhau = $data["passwordValue"];
        $hashedPassword = password_hash($matkhau, PASSWORD_DEFAULT);
        $sql_khachhang = "SELECT * FROM taikhoan 
        INNER JOIN khachhang ON khachhang.MaKH = taikhoan.TenDN
        WHERE TenDN = '" . $tendn . "' AND MatKhau = '" . $matkhau . "'  ";

        $result = $this->conn->query($sql_khachhang);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nhomquyen = $row['nhomquyen'];
            $ho = $row['Ho'];
            $ten = $row['Ten'];
            $response = array(
                'EM' => "Đăng Nhập Thành Công",
                'EC' => "1",
                'DT' => array(

                    "tendn" => $tendn,
                    "tenkh" => $ten,
                    'hokh' => $ho,
                    "MatKhau" =>   $hashedPassword,
                    'nhomquyen' => $nhomquyen

                )
            );
            return ($response);
        } else {
            $response = array(
                'EM' => "Đăng Nhập Thất Bại",
                'EC' => "-1",
                'DT' => ""
            );
            return ($response);
        }
    }
}