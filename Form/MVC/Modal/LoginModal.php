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
        $sql_khachhang = "SELECT TenDN,MatKhau,nhomquyen FROM taikhoan WHERE TenDN = '" . $tendn . "' AND MatKhau = '" . $matkhau . "'  ";
        $result = $this->conn->query($sql_khachhang);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nhomquyen = $row['nhomquyen'];
            $response = array(
                'EM' => "Đăng Nhập Thành Công",
                'EC' => "1",
                'DT' => array(
                    "tendn" => $tendn,
                    "MatKhau" =>   $hashedPassword,
                    'nhomquyen' => $nhomquyen

                )
            );
            return json_encode($response);
        } else {
            $response = array(
                'EM' => "Đăng Nhập Thất Bại",
                'EC' => "-1",
                'DT' => ""
            );
            return json_encode($response);
        }
    }
}
