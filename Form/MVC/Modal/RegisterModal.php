<?php

class RegisterModal
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function Register($data)

    {
        $hoten = $data["fullnameValue"];
        $sdt = $data["phoneValue"];
        $email = $data["emailValue"];
        $diachi = $data["addressValue"];
        $tendn = $data["usernameValue"];
        $matkhau = $data["passwordValue"];
        $xacnhanmk = $data["confirmPasswordValue"];
        $hoten = explode(" ",$hoten);
        $ho = $hoten[0];
        $ten = "";
        for($i = 1; $i < count($hoten); $i++)
            $ten.= $hoten[$i] . " ";
        $sql_khachhang = "INSERT INTO khachhang (MaKH,Ho,Ten,DiaChi,Email) VALUES (?,?,?,?,?)  ";
        $stmt = $this->conn->prepare($sql_khachhang);
            $stmt->bind_param('sssss', $tendn, $ho, $ten,$diachi,$email);

        // $sql_taikhoan = "INSERT INTO taikhoan (TenDN,MatKhau,NgayTao) VALUES (?,?,NOW())  ";
        // $stmt = $this->conn->prepare($sql_taikhoan);
        //     $stmt->bind_param('ss',$tendn,$matkhau );


    }
}
?>