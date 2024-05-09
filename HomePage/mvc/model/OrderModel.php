<?php
class OrderModel
{
   private $conn;
   public function __construct($conn)
   {
      $this->conn = $conn;
   }
   public function add($data)
   {
      $MaKM = 'null';
      $sql_kmai = "SELECT * FROM chuongtrinhkhuyenmai WHERE LoaiChuongTrinh LIKE 'Khuyến mãi'";
      $rs_kmai = $this->conn->query($sql_kmai);
      $row_kmai = $rs_kmai->fetch_assoc();
      if (
         (int)$data['total'] >= (int)($row_kmai['DieuKien'])
         && strtotime($row_kmai['NgayKetThuc']) >= strtotime(date('Y-m-d'))
      ) {
         $MaKM = $row_kmai['MaKM'];
      }


      $stateInit = 1;
      $thueMacDinh = 8.00;

      //
      $MaKH = $data['id'];
      $NgayBan = $data['datePay'];
      $TongTien = $data['total'];
      $Thue = $thueMacDinh;
      $TrangThai = $stateInit;
      $LuuY = $data['note'];
      $GioHang = $data['carts'];



      //insert "hoadon"
      $sql_hoadon = "INSERT INTO hoadon(MaKM, MaKH, NgayBan, TongTien, Thue, trangthai, LuuY) VALUES ($MaKM,'$MaKH','$NgayBan','$TongTien','$Thue','$TrangThai','$LuuY')";

      // echo $sql_hoadon;
      // die();
      $hd_rs = $this->conn->query($sql_hoadon);
      //insert "cthoadon"
      $maHD = $this->conn->insert_id;

      foreach ($GioHang as $item) {
         $MaGiay = $item['idProduct'];
         $SoLuong = $item['quantity'];
         $Size = $item['idSize'];
         $GiaBan = $item['priceDiscountProduct'] ? $item['priceDiscountProduct'] : $item['priceProduct'];
         $GiaBan = (int) preg_replace('/\D/', '', $GiaBan);

         $sql_cthd = "
         INSERT INTO `chitiethoadon`(`MaHD`, `MaGiay`, `MaSizeGiay`,`SoLuongBan`, `GiaBan`) 
         VALUES ('$maHD','$MaGiay','$Size','$SoLuong','$GiaBan')";
         $cthd_rs = $this->conn->query($sql_cthd);
      }
      return $hd_rs && $cthd_rs  ?
         array(
            'title' => 'Thanh toán thành công',
            'msg' => 'Đơn hàng của bạn đã được thanh toán',
            'status' => 1
         ) : array(
            'title' => 'Thanh toán thất bại',
            'msg' => 'Xin lỗi, hệ thống đã gặp lỗi',
            'status' => 0
         );
   }
   public function filter($idAccount, $idStatus)
   {
      $sub_where = $idStatus != 0 ? "AND hoadon.trangthai = '$idStatus'" : '';
      $sql = "SELECT * FROM hoadon
                  INNER JOIN trangthaidonhang ON trangthaidonhang.id = hoadon.trangthai 
                  WHERE hoadon.MaKH = '$idAccount' 
                  $sub_where
      ";
      $result = $this->conn->query($sql);
      $data = [];

      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            $order = [
               "idOrder" => $row["MaHD"],
               "dateOrder" => $row["NgayBan"],
               "priceOrder" => $row["TongTien"],
               "statusOrder" => $row["tentrangthai"],
            ];
            $data[] = $order;
         }
      }
      return $data;
   }
   public function statusAll()
   {
      $sql = "SELECT * FROM trangthaidonhang";
      $result = $this->conn->query($sql);
      $data = [];

      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            $order = [
               "idStatus" => $row["id"],
               "nameStatus" => $row["tentrangthai"],

            ];
            $data[] = $order;
         }
      }
      return $data;
   }
   public function cancel($id)
   {
      $sql = "UPDATE `hoadon` SET `trangthai`='4' WHERE hoadon.MaHD = '$id'";
      $result = $this->conn->query($sql);

      if ($result)
         return $data = [
            'status' => 1,
            'title' => "Huỷ thành công",
            'msg' => "Đơn hàng của bạn hủy thành công",

         ];
      else
         return $data = [
            'status' => 0,
            'title' => "Huỷ thất bại",
            'msg' => "Xin lỗi, vui lòng hủy sau ít phút",
         ];
   }
   public function check($id, $size, $quantity)
   {
      $sql = "SELECT * FROM giay 
         INNER JOIN giay_size ON giay_size.MaGiaySize = giay.MaGiay
         WHERE giay.MaGiay = '$id' AND giay_size.MaSz = '$size'";
      $result = $this->conn->query($sql);

      if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         if ($row['SoLuong'] - $quantity >= 0) {
            return [
               'status' => 1,
            ];
         } else return [
            'status' => 0,
         ];
      }
   }
   public function promotion($date)
   {
      $isStillExp = false;
      $sql_kmai = "SELECT * FROM chuongtrinhkhuyenmai WHERE LoaiChuongTrinh LIKE 'Khuyến mãi'";
      $rs_kmai = $this->conn->query($sql_kmai);
      $row_kmai = $rs_kmai->fetch_assoc();
      if (
         strtotime($row_kmai['NgayKetThuc']) >= strtotime($date)
      )
         $isStillExp = !$isStillExp;


      if ($isStillExp) return ['status' => 1];
      else return ['status' => 0];
   }
   public function reorder($id)
   {
      $sql = "UPDATE `hoadon` SET `trangthai`='1' WHERE hoadon.MaHD = '$id'";
      $result = $this->conn->query($sql);

      if ($result)
         return $data = [
            'status' => 1,
            'title' => "Mua lại thành công",
            'msg' => "Đơn hàng của bạn đang chờ xử lí",

         ];
      else
         return $data = [
            'status' => 0,
            'title' => "Mua lại thất bại",
            'msg' => "Xin lỗi, vui lòng hủy sau ít phút",
         ];
   }
   public function orderdetail($idAccount, $idOrder)
   {
      $sql_hd = "SELECT * FROM hoadon 
               INNER JOIN khachhang ON khachhang.MaKH = hoadon.MaKH 
               WHERE hoadon.MaKH = '$idAccount' AND hoadon.MaHD = '$idOrder'
      ";

      $sql_cthd = "SELECT * FROM chitiethoadon
               INNER JOIN giay ON chitiethoadon.MaGiay = giay.MaGiay 
               LEFT JOIN chitietkhuyenmai ON chitiethoadon.MaGiay = chitietkhuyenmai.MaGiayKM 
               WHERE chitiethoadon.MaHD = '$idOrder'
      ";
      $result_cthd = $this->conn->query($sql_cthd);
      $result_hd = $this->conn->query($sql_hd);
      //
      $data = [];
      if ($result_hd->num_rows > 0) {
         while ($row = $result_hd->fetch_assoc()) {
            $orderDetail = [
               "id" => $row["MaHD"],
               "fullname" => $row["Ho"] . " " . $row['Ten'],
               "phone" => $row["SDT"],
               "address" => $row["DiaChi"],
               "note" => $row["LuuY"],
               "dateOrder" => $row["NgayBan"],
               "total" => $row["TongTien"],
               "status" => $row["trangthai"],
            ];
            $data['info'] = $orderDetail;
         }
      }
      //
      $carts = [];
      if ($result_cthd->num_rows > 0) {
         while ($row = $result_cthd->fetch_assoc()) {


            $cartDetail = [
               "img" => $row["HinhAnh"],
               "name" => $row["Tengia"],
               "size" => $row["MaSizeGiay"],
               "price" => $row["DonGia"],
               "quantity" => $row["SoLuongBan"],
               "percentDiscount" => $row["TiLeKMTheo"],
            ];
            $carts[] = $cartDetail;
         }
      }
      $data['carts'] = $carts;
      return $data;
   }
}
