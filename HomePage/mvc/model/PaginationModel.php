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
   public function pagination($page)
   {
      $offset = ($page - 1) * $this->limit;
      $sql = "SELECT * FROM giay
         INNER JOIN loai ON giay.MaLoai = loai.MaLoai
         INNER JOIN mausac ON giay.MaMau = mausac.MaMau
         INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX
         INNER JOIN size ON giay.MaSize = size.MaSize
         INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
         LIMIT $offset, $this->limit";
      $result = $this->conn->query($sql);
      $data = array();
      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            $origin = array(
               'idOrigin' => $row['MaXX'],
               'nameOrigin' => $row['TenNuoc'],
            );
            $size = array(
               'idSize' => $row['MaSize'],
               'nameSize' => $row['KichThuoc'],
            );
            $brand = array(
               'idBrand' => $row['MaThuongHieu'],
               'nameBrand' => $row['TenThuongHieu'],
            );
            $type = array(
               'idType' => $row['MaLoai'],
               'nameType' => $row['TenLoai'],
            );
            $product[] = array(
               'idProduct' => $row['MaGiay'],
               'nameProduct' => $row['TenGiay'],
               'quantityProduct' => $row['SoLuong'],
               'priceProduct' => $row['DonGia'],
               'collectionProduct' => $row['DoiTuongSuDung'],
               'materialProduct' => $row['DonGia'],
               'imgProduct' => $row['HinhAnh'],
               'originProduct' => $origin,
               'brandProduct' => $brand,
               'typeProduct' => $type,
               'sizeProduct' => $size,
            );
            $data = $product;
         }
      }
      return $data;
   }

   public function filter($filter, $input)
   {

      if ($filter == 'price') {
         $input = explode('-', $input);
         $from = isset($input[0]) ? $input[0] : null;
         $to = isset($input[1]) ? $input[1]  : null;
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM
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
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
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
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
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
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
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
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM
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
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM
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
                LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
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
