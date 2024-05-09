<?php
class PaginationModel
{
   private $conn;
   private $limit = 12;

   private $page = 1; // trang hiện tại
   private $total = 0; // tổng trang
   private $perProducts = []; // sp trên trang hiện tai
   //
   public function __construct($conn)
   {
      $this->conn = $conn;
   }

   public function filter($filter, $input)
   {
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      //check date khuyen mai
      $flag = true; // mac dinh la het han
      $id_km = 4; //ma khuyen mai co dinh
      $sql_check = "SELECT * FROM chuongtrinhkhuyenmai WHERE MaKM = $id_km";
      $result_check = $this->conn->query($sql_check);
      $row_check = $result_check->fetch_assoc();
      //
      $nowDate =  date('Y-m-d');
      $overDate = $row_check['NgayKetThuc'];



      $sql_km = '';
      if (strtotime($overDate) >= strtotime($nowDate)) {
         $sql_km .= "LEFT JOIN chitietkhuyenmai ON giay.MaGiay = chitietkhuyenmai.MaGiayKM";
         $flag = !$flag;
      }


      if ($filter == 'price') {
         $input = explode('-', $input);
         $from = isset($input[0]) ? $input[0] : null;
         $to = isset($input[1]) ? $input[1]  : null;
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               $sql_km
               WHERE giay.DonGia BETWEEN $from AND $to
            ";
         $result = mysqli_query($this->conn, $sql);
         $total_records = mysqli_num_rows($result);
         $this->total = ceil($total_records / $this->limit);
         $data = [
            "totalPage" => $this->total,
         ];

         return $data;
      }
      if ($filter == 'brand') {
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               $sql_km 
               WHERE thuonghieu.MaThuongHieu = '$input'    
            ";
         $result = mysqli_query($this->conn, $sql);
         $total_records = mysqli_num_rows($result);
         $this->total = ceil($total_records / $this->limit);
         $data = [
            "totalPage" => $this->total,
         ];
         return $data;
      }
      if ($filter == 'type') {
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               $sql_km 
               WHERE giay.MaLoai = '$input'    
            ";
         $result = mysqli_query($this->conn, $sql);
         $total_records = mysqli_num_rows($result);
         $this->total = ceil($total_records / $this->limit);
         $data = [
            "totalPage" => $this->total,
         ];
         return $data;
      }
      if ($filter == 'material') {
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               $sql_km 
               WHERE giay.ChatLieu = '$input'    
            ";
         $result = mysqli_query($this->conn, $sql);
         $total_records = mysqli_num_rows($result);
         $this->total = ceil($total_records / $this->limit);
         $data = [
            "totalPage" => $this->total,
         ];
         return $data;
      }
      if ($filter == 'size') {
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               INNER JOIN giay_size ON giay.MaGiay = giay_size.MaGiaySize
               $sql_km
               WHERE giay_size.MaSz = '$input'    
            ";
         $result = mysqli_query($this->conn, $sql);
         $total_records = mysqli_num_rows($result);
         $this->total = ceil($total_records / $this->limit);
         $data = [
            "totalPage" => $this->total,
         ];
         return $data;
      }
      if ($filter == 'color') {
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               $sql_km
               WHERE giay.MaMau = '$input'    
            ";
         $result = mysqli_query($this->conn, $sql);
         $total_records = mysqli_num_rows($result);
         $this->total = ceil($total_records / $this->limit);
         $data = [
            "totalPage" => $this->total,
         ];
         return $data;
      }
      if ($filter == 'search') {
         $sql = "SELECT *
                FROM giay
                INNER JOIN loai ON giay.MaLoai = loai.MaLoai
                INNER JOIN mausac ON giay.MaMau = mausac.MaMau
                INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX
                $sql_km 
                INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
                WHERE giay.Tengia LIKE N'%$input%' OR
                thuonghieu.TenThuongHieu LIKE N'%$input%' OR            
                loai.TenLoai LIKE N'%$input%' OR            
                giay.DoiTuongSuDung LIKE N'%$input%' OR            
                giay.ChatLieu LIKE N'%$input%'       
      ";
         $result = mysqli_query($this->conn, $sql);
         $total_records = mysqli_num_rows($result);
         $this->total = ceil($total_records / $this->limit);
         $data = [
            "totalPage" => $this->total,
         ];
         return $data;
      }
   }
}