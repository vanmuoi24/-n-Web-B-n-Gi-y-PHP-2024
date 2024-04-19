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
        $reconfirmpassword = $data["reconfirmpasswordValue"];
        $otp = $data["otpValue"];


        $sql_khachhang = "SELECT SDT,Email,OTP FROM taikhoan WHERE SDT = '".$phone."' AND Email = '".$email."' AND OTP = '".$otp."'  ";
        $result = $this->conn->query($sql_khachhang);
        if ($result->num_rows = 0) {
            echo json_encode(array(
                "status"=> false,
                "message" => "Sai thông tin đăng nhập",
            ));
        } else {
            $sql_update = "UPDATE taikhoan SET MatKhau = '".$repassword."', OTP = '".NULL."' WHERE Email = '".$email."' AND SDT = '".$phone."' ";
            $update = $this->conn->query($sql_update);
                echo json_encode(array(
                "status"=> true,
                "message" => "Đổi mật khẩu thành công",
                )); 
            }
}

    public function SendOTp($data){
        $otp = $data["otpTo"];
        $email = $data["emailTo "];
        $phone = $data["phoneTo"];

        $sql_otp = "SELECT SDT,Email FROM taikhoan WHERE SDT = '".$phone."' AND Email = '".$email."' ";
        $result = $this->conn->query($sql_otp);
        if($result->num_rows = 0){
            echo json_encode(array(
                "status"=> false,
                "message" => "Sai thông tin đăng nhập",
            ));
        } else{
            $otp_result = sendMail($data['otpTo'],$data['emailTo']);
            return array(
                "status"=> $otp_result,

            );
        }
    }
}
?>