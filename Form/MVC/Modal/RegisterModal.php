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

        $hoten_arr = explode(" ", $hoten);
        $ho = $hoten_arr[0];
        $ten = implode(" ", array_slice($hoten_arr, 1));

        if ($matkhau !== $xacnhanmk) {
            return "Xác nhận mật khẩu không khớp";
        }

        // Thêm thông tin khách hàng vào bảng khachhang
        $sql_khachhang = "INSERT INTO khachhang (Ho, Ten, DiaChi, Email,MaKH) VALUES (?, ?, ?, ?,?)";
        $stmt_khachhang = $this->conn->prepare($sql_khachhang);
        $stmt_khachhang->bind_param('sssss', $ho, $ten, $diachi, $email, $tendn);
        $stmt_khachhang->execute();

        if ($stmt_khachhang->error) {
            return "Lỗi khi thêm thông tin khách hàng: " . $stmt_khachhang->error;
        }

        // Thêm thông tin tài khoản vào bảng taikhoan
        $sql_taikhoan = "INSERT INTO taikhoan (TenDN, MatKhau, NgayTao) VALUES (?, ?, NOW())";
        $stmt_taikhoan = $this->conn->prepare($sql_taikhoan);
        $stmt_taikhoan->bind_param('ss', $tendn, $matkhau);
        $stmt_taikhoan->execute();

        if ($stmt_taikhoan->error) {
            return "Lỗi khi tạo tài khoản: " . $stmt_taikhoan->error;
        }

        return "Đăng ký thành công";
    }
}
