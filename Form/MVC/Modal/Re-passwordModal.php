<?php
include('../../public/mail/SendOTP.php');
class RepasswordModal
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    public function Repassword($data)
    {
        $phone = $data["phoneValue"];
        $email = $data["emailValue"];
        $repassword = $data["repasswordValue"];
        echo $repassword;
        $otp = $data["otpValue"];

        $sql_khachhang = "SELECT SDT,Email,OTP FROM khachhang WHERE SDT = '$phone' AND Email = '$email' AND OTP = '$otp' ";
        $result = $this->conn->query($sql_khachhang);
        if ($result->num_rows == 0) {
            echo json_encode(array(
                "status"=> false,
                "message" => "Sai thông tin đăng nhập",
            ));
        } else {
            $sql_update_kh = "UPDATE khachhang SET OTP = 'NULL' WHERE SDT = '$phone' AND Email = '$email' ";
            $sql_update_tk = "UPDATE taikhoan SET OTP = 
                            (SELECT OTP FROM khachhang WHERE khachhang.MaKH = taikhoan.TenDN), taikhoan.MatKhau = '$repassword' ";
            $update_kh = $this->conn->query($sql_update_kh);
            $update_tk = $this->conn->query($sql_update_tk);

            if($update_kh && $update_tk){
                echo json_encode(array(
                    "status"=> true,
                    "message" => "Đổi mật khẩu thành công",
                    )); 
                }
            }
}

    public function SendOTp($data_otp){
        $otp = $data_otp['otpTo'];
        $email = $data_otp['emailTo'];
        $phone = $data_otp['phoneTo'];

        $sql_otp = "SELECT SDT,Email FROM khachhang WHERE SDT = '".$phone."' AND Email = '".$email."' ";
        $result = $this->conn->query($sql_otp);
        if($result->num_rows == 0){
            echo json_encode(array(
                "status"=> false,
                "message" => "Sai thông tin đăng nhập",
            ));
        } else{
            $otp_result = sendMail($otp,$email);
            $otp_update_kh = "UPDATE khachhang SET OTP ='$otp' WHERE SDT = '".$phone."' AND Email = '".$email."' ";
            $otp_update_tk = " UPDATE taikhoan SET OTP = 
                                (SELECT OTP FROM khachhang WHERE khachhang.MaKH = taikhoan.TenDN)  ";
            $result_update_kh = $this->conn->query($otp_update_kh);
            $result_update_tk = $this->conn->query($otp_update_tk);

            if($result_update_kh && $result_update_tk){
                echo json_encode(array(
                    "status" => true,
                    "message" => "Cập nhật OTP thành công",
                ));
            } else{
                echo json_encode(array(
                    "status" => false,
                    "message" => "Cập nhật OTP thất bại",
                )); 
            }
            return array(
                "status"=> $otp_result,

            );
        }
    }
}
?>