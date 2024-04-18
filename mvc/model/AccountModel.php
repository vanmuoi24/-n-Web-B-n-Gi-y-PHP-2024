<?php
class AccountModel
{
   private $conn;
   public function __construct($conn)
   {
      $this->conn = $conn;
   }
   public function getbyid($id)
   {
      $sql = "SELECT * FROM taikhoan WHERE taikhoan.TenDN = '$id'";
      $result = $this->conn->query($sql);
      $account = [];

      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            $account = [
               "id" => $row["TenDN"],
               "fullname" => $row["Ho"] . " " . $row['Ten'],
               "address" => $row["DiaChi"],
               "mail" => $row["Email"],
               "phone" => $row["SDT"],
            ];
         }
      }
      return $account;
   }
   public function update($data)
   {
      $TenDN = $data['id'];
      $Ho = $data['firstname'];
      $Ten = $data['lastname'];
      $SDT = $data['phone'];
      $DiaChi = $data['address'];
      $Email = $data['mail'];

      $sql_check = "SELECT * FROM taikhoan WHERE  taikhoan.TenDN != '$TenDN' AND (taikhoan.Email = '$Email' OR taikhoan.SDT = '$SDT')";
      $rsCheck = $this->conn->query($sql_check);
      if ($rsCheck->num_rows > 0)
         return array(
            'title' => 'Cập nhật thất bại',
            'msg' => 'Email hoặc số điện thoại đã tồn tại',
            'status' => -1
         );
      //
      $sql = " UPDATE taikhoan 
               SET `Ho`='$Ho',`Ten`='$Ten',`Email`='$Email',`DiaChi`='$DiaChi',`SDT`='$SDT' 
               WHERE TenDN = '$TenDN'
      ";
      $result = $this->conn->query($sql);
      return $result ?
         array(
            'title' => 'Cập nhật thành công',
            'msg' => 'Thông tin đã được cập nhật',
            'status' => 1
         ) : array(
            'title' => 'Cập nhật thất bại',
            'msg' => 'Xin lỗi, hệ thống đã gặp lỗi',
            'status' => 0
         );
   }
   public function password($data)
   {
      $TenDN = $data['id'];
      $MatKhau = md5($data['passwordOld']);
      $MatKhauMoi = md5($data['passwordNew']);
      $sql_check = "SELECT * FROM taikhoan WHERE  taikhoan.TenDN = '$TenDN' AND taikhoan.MatKhau = '$MatKhau'";

      $rsCheck = $this->conn->query($sql_check);
      if ($rsCheck->num_rows == 0)
         return array(
            'title' => 'Cập nhật thất bại',
            'msg' => 'Tên đăng nhập hoặc mật khẩu cũ không đúng',
            'status' => -1
         );
      $sql = " UPDATE taikhoan 
               SET `MatKhau`='$MatKhauMoi' 
               WHERE taikhoan.TenDN = '$TenDN'
      ";
      $result = $this->conn->query($sql);
      return $result ?
         array(
            'title' => 'Cập nhật thành công',
            'msg' => 'Thông tin đã được cập nhật',
            'status' => 1
         ) : array(
            'title' => 'Cập nhật thất bại',
            'msg' => 'Xin lỗi, hệ thống đã gặp lỗi',
            'status' => 0
         );
   }
}
