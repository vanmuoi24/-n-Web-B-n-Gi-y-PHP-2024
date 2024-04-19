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
        $xacnhanmk = $data["confirmPasswordValue"];
        $hoten = explode(" ", $hoten);
        $ho = $hoten[0];
        $ten = "";
        for ($i = 1; $i < count($hoten); $i++)
            $ten .= $hoten[$i] . " ";
        $sql_khachhang = "INSERT INTO khachhang (MaKH,Ho,Ten,DiaChi,Email) VALUES (?,?,?,?,?)  ";
        $stmt = $this->conn->prepare($sql_khachhang);
        $stmt->bind_param('sssss', $tendn, $ho, $ten, $diachi, $email);
        $sql_check_tendn = "SELECT COUNT(*) AS total FROM taikhoan WHERE TenDN = ?";
        $stmt_check_tendn = $this->conn->prepare($sql_check_tendn);
        $stmt_check_tendn->bind_param('s', $tendn);
        $stmt_check_tendn->execute();
        $result_check_tendn = $stmt_check_tendn->get_result();
        $row_check_tendn = $result_check_tendn->fetch_assoc();

        if ($row_check_tendn['total'] > 0) {
            $response = array(
                'EM' => "Tên Đăng Nhập Đã Tồn Tại",
                'EC' => "0",
                'DT' => ""
            );
            return json_encode($response);
        }

        $sql_khachhang = "INSERT INTO khachhang (MaKH, Ho, Ten, DiaChi, Email) VALUES (?, ?, ?, ?, ?)";
        $stmt_khachhang = $this->conn->prepare($sql_khachhang);
        $stmt_khachhang->bind_param('sssss', $tendn, $ho, $ten, $diachi, $email);
        $stmt_khachhang->execute();

        if ($stmt_khachhang->error) {
            return "Lỗi khi thêm thông tin khách hàng: " . $stmt_khachhang->error;
        }

        $sql_taikhoan = "INSERT INTO taikhoan ( TenDN, MatKhau, NgayTao) VALUES ( ?, ?, NOW())";
        $stmt_taikhoan = $this->conn->prepare($sql_taikhoan);
        $stmt_taikhoan->bind_param('ss', $tendn, $xacnhanmk);
        $stmt_taikhoan->execute();

        if ($stmt_taikhoan->error) {
            $response = array(
                'EM' => "Tạo Tài Khoàn Thành Công",
                'EC' => "1",
                'DT' => $data
            );
            return json_encode($response);
        }
    }
}