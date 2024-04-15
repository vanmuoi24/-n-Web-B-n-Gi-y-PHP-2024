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
        $tendn = $data["usernameValue"]; // Mã khách hàng nhập từ người dùng
        $matkhau = $data["passwordValue"];
        $xacnhanmk = $data["confirmPasswordValue"];

        $hoten_arr = explode(" ", $hoten);
        $ho = $hoten_arr[0];
        $ten = implode(" ", array_slice($hoten_arr, 1));

        if ($matkhau !== $xacnhanmk) {
            return "Xác nhận mật khẩu không khớp";
        }

        // Kiểm tra tính duy nhất của TenDN
        $sql_check_tendn = "SELECT COUNT(*) AS total FROM taikhoan WHERE TenDN = ?";
        $stmt_check_tendn = $this->conn->prepare($sql_check_tendn);
        $stmt_check_tendn->bind_param('s', $tendn);
        $stmt_check_tendn->execute();
        $result_check_tendn = $stmt_check_tendn->get_result();
        $row_check_tendn = $result_check_tendn->fetch_assoc();

        if ($row_check_tendn['total'] > 0) {
            return "Tên đăng nhập đã tồn tại";
        }

        // Thêm thông tin khách hàng vào bảng khachhang
        $sql_khachhang = "INSERT INTO khachhang (MaKH, Ho, Ten, DiaChi, Email) VALUES (?, ?, ?, ?, ?)";
        $stmt_khachhang = $this->conn->prepare($sql_khachhang);
        $stmt_khachhang->bind_param('sssss', $tendn, $ho, $ten, $diachi, $email);
        $stmt_khachhang->execute();

        if ($stmt_khachhang->error) {
            return "Lỗi khi thêm thông tin khách hàng: " . $stmt_khachhang->error;
        }

        // Thêm thông tin tài khoản vào bảng taikhoan
        $sql_taikhoan = "INSERT INTO taikhoan ( TenDN, MatKhau, NgayTao) VALUES ( ?, ?, NOW())";
        $stmt_taikhoan = $this->conn->prepare($sql_taikhoan);
        $stmt_taikhoan->bind_param('ss', $tendn, $matkhau);
        $stmt_taikhoan->execute();

        if ($stmt_taikhoan->error) {
            return "Lỗi khi tạo tài khoản: " . $stmt_taikhoan->error;
        }

        return "Đăng ký thành công";
    }
}
