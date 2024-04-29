<?php
class ProductModel
{
   private $conn;
   public function __construct($conn)
   {
      $this->conn = $conn;
   }
   public function all()
   {
      $sql = "SELECT * FROM giay 
      INNER JOIN loai ON giay.MaLoai = loai.MaLoai 
      INNER JOIN mausac ON giay.MaMau = mausac.MaMau 
      INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX 
      INNER JOIN size ON giay.MaSize = size.MaSize 
      INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu 
      LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
         ORDER BY giay.MaGiay DESC";
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
            $discount = array(
               'idDiscount' => $row['MaKM'],
               'percentDiscount' => $row['TiLeKMTheo'],

            );
            $product[] = array(
               'idProduct' => $row['MaGiay'],
               'nameProduct' => $row['Tengia'],
               'priceProduct' => $row['DonGia'],
               'collectionProduct' => $row['DoiTuongSuDung'],
               'materialProduct' => $row['DonGia'],
               'imgProduct' => $row['HinhAnh'],
               'originProduct' => $origin,
               'brandProduct' => $brand,
               'typeProduct' => $type,
               'sizeProduct' => $size,
               'discountProduct' => $discount,

            );
            $data = $product;
         }
      }
      return $data;
   }
   public function getbyid($id)
   {
      $sql = "SELECT *
                FROM giay
                INNER JOIN loai ON giay.MaLoai = loai.MaLoai
                INNER JOIN mausac ON giay.MaMau = mausac.MaMau
                INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX
                INNER JOIN giay_size ON giay.MaGiay = giay_size.MaGiaySize 
                INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
                LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
                WHERE giay.MaGiay = '$id'
                    
      ";
      $result = $this->conn->query($sql);
      $data = array();
      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            $origin = array(
               'idOrigin' => $row['MaXX'],
               'nameOrigin' => $row['TenNuoc'],
            );
            $color = array(
               'idColor' => $row['MaMau'],
               'nameColor' => $row['TenMau'],
            );
            $size[] = array(
               'idSize' => $row['MaSz'],
               'quantity' => $row['SoLuong'],
            );
            $brand = array(
               'idBrand' => $row['MaThuongHieu'],
               'nameBrand' => $row['TenThuongHieu'],
            );
            $type = array(
               'idType' => $row['MaLoai'],
               'nameType' => $row['TenLoai'],
            );
            $discount = array(
               'idDiscount' => $row['MaKM'],
               'percentDiscount' => $row['TiLeKMTheo'],

            );
            $product = array(
               'idProduct' => $row['MaGiay'],
               'nameProduct' => $row['Tengia'],
               'priceProduct' => $row['DonGia'],
               'collectionProduct' => $row['DoiTuongSuDung'],
               'materialProduct' => $row['ChatLieu'],
               'imgProduct' => $row['HinhAnh'],
               'originProduct' => $origin,
               'colorProduct' => $color,
               'brandProduct' => $brand,
               'typeProduct' => $type,
               'sizeProduct' => $size,
               'discountProduct' => $discount,

            );
            $data = $product;
         }
      }
      return $data;
   }
   public function filter($filter, $input, $page)
   {
      if ($filter == 'price') {
         $input = explode('-', $input);
         $from = isset($input[0]) ? $input[0] : null;
         $to = isset($input[1]) ? $input[1]  : null;
         $limit = 12;
         $offset = ($page - 1) * $limit;
         $sql = "SELECT * FROM giay 
      INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu 
      LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
      WHERE giay.DonGia BETWEEN $from AND $to
         ORDER BY giay.MaGiay DESC
         LIMIT $offset, $limit";
         $result = $this->conn->query($sql);
         $data = array();
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

               $brand = array(
                  'idBrand' => $row['MaThuongHieu'],
                  'nameBrand' => $row['TenThuongHieu'],
               );
               $discount = array(
                  'idDiscount' => $row['MaKM'],
                  'percentDiscount' => $row['TiLeKMTheo'],

               );
               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $discount,
               );
               $data = $product;
            }
         }
         return $data;
      }
      if ($filter == 'brand') {
         $limit = 12;
         $offset = ($page - 1) * $limit;
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
               WHERE thuonghieu.MaThuongHieu = '$input'    
               LIMIT $offset, $limit        
            ";
         $result = $this->conn->query($sql);
         $data = array();
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

               $brand = array(
                  'idBrand' => $row['MaThuongHieu'],
                  'nameBrand' => $row['TenThuongHieu'],
               );
               $discount = array(
                  'idDiscount' => $row['MaKM'],
                  'percentDiscount' => $row['TiLeKMTheo'],

               );

               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $discount,

               );
               $data = $product;
            }
         }
         return $data;
      }
      if ($filter == 'type') {
         $limit = 12;
         $offset = ($page - 1) * $limit;
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
               WHERE giay.MaLoai = '$input'    
               LIMIT $offset, $limit        
            ";
         $result = $this->conn->query($sql);
         $data = array();
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

               $brand = array(
                  'idBrand' => $row['MaThuongHieu'],
                  'nameBrand' => $row['TenThuongHieu'],
               );
               $discount = array(
                  'idDiscount' => $row['MaKM'],
                  'percentDiscount' => $row['TiLeKMTheo'],

               );
               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $discount,

               );
               $data = $product;
            }
         }
         return $data;
      }
      if ($filter == 'material') {
         $limit = 12;
         $offset = ($page - 1) * $limit;
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
               WHERE giay.ChatLieu = '$input'    
               LIMIT $offset, $limit        
            ";
         $result = $this->conn->query($sql);
         $data = array();
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

               $brand = array(
                  'idBrand' => $row['MaThuongHieu'],
                  'nameBrand' => $row['TenThuongHieu'],
               );
               $discount = array(
                  'idDiscount' => $row['MaKM'],
                  'percentDiscount' => $row['TiLeKMTheo'],

               );
               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $discount,

               );
               $data = $product;
            }
         }
         return $data;
      }
      if ($filter == 'color') {
         $limit = 12;
         $offset = ($page - 1) * $limit;
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
               WHERE giay.MaMau = '$input'    
               LIMIT $offset, $limit        
            ";
         $result = $this->conn->query($sql);
         $data = array();
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

               $brand = array(
                  'idBrand' => $row['MaThuongHieu'],
                  'nameBrand' => $row['TenThuongHieu'],
               );
               $discount = array(
                  'idDiscount' => $row['MaKM'],
                  'percentDiscount' => $row['TiLeKMTheo'],

               );

               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $discount,

               );
               $data = $product;
            }
         }
         return $data;
      }
      if ($filter == 'size') {
         $limit = 12;
         $offset = ($page - 1) * $limit;
         $sql = "SELECT * FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               INNER JOIN giay_size ON giay.MaGiay = giay_size.MaGiaySize
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
               WHERE giay_size.MaSz = '$input'    
               LIMIT $offset, $limit        
            ";
         $result = $this->conn->query($sql);
         $data = array();
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

               $brand = array(
                  'idBrand' => $row['MaThuongHieu'],
                  'nameBrand' => $row['TenThuongHieu'],
               );
               $discount = array(
                  'idDiscount' => $row['MaKM'],
                  'percentDiscount' => $row['TiLeKMTheo'],

               );
               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $discount,

               );
               $data = $product;
            }
         }
         return $data;
      }
      if ($filter == 'search') {
         $limit = 12;
         $offset = ($page - 1) * $limit;
         $sql = "SELECT *
                FROM giay
                INNER JOIN loai ON giay.MaLoai = loai.MaLoai
                INNER JOIN mausac ON giay.MaMau = mausac.MaMau
                INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX
                INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
                LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
                WHERE giay.Tengia LIKE N'%$input%' OR
                thuonghieu.TenThuongHieu LIKE N'%$input%' OR            
                loai.TenLoai LIKE N'%$input%' OR            
                giay.DoiTuongSuDung LIKE N'%$input%' OR            
                giay.ChatLieu LIKE N'%$input%'       
                LIMIT $offset,$limit
      ";
         $result = $this->conn->query($sql);
         $data = array();
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               $origin = array(
                  'idOrigin' => $row['MaXX'],
                  'nameOrigin' => $row['TenNuoc'],
               );

               $brand = array(
                  'idBrand' => $row['MaThuongHieu'],
                  'nameBrand' => $row['TenThuongHieu'],
               );
               $type = array(
                  'idType' => $row['MaLoai'],
                  'nameType' => $row['TenLoai'],
               );
               $discount = array(
                  'idDiscount' => $row['MaKM'],
                  'percentDiscount' => $row['TiLeKMTheo'],

               );
               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'originProduct' => $origin,
                  'brandProduct' => $brand,
                  'typeProduct' => $type,
                  'discountProduct' => $discount,
               );
               $data = $product;
            }
         }
         return $data;
      }
   }
}