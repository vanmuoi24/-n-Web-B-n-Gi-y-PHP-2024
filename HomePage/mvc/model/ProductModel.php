<?php
class ProductModel
{
   private $conn;
   public function __construct($conn)
   {
      $this->conn = $conn;
   }

   public function getbyid($id)
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



      $sql = "SELECT *
                FROM giay
                INNER JOIN loai ON giay.MaLoai = loai.MaLoai
                INNER JOIN mausac ON giay.MaMau = mausac.MaMau
                INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX
                INNER JOIN giay_size ON giay.MaGiay = giay_size.MaGiaySize 
                INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
                $sql_km 
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
               'idDiscount' => (!$flag) ? $row['MaKM'] : null,
               'percentDiscount' => (!$flag) ? $row['TiLeKMTheo'] : null,

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
         $limit = 12;
         $offset = ($page - 1) * $limit;
         $sql = "SELECT * FROM giay 
      INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu 
      $sql_km 
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
                  'idDiscount' => !$flag ? $row['MaKM'] : null,
                  'percentDiscount' => !$flag ? $row['TiLeKMTheo'] : null,

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
               $sql_km 
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
                  'idDiscount' => !$flag ? $row['MaKM'] : null,
                  'percentDiscount' => !$flag ? $row['TiLeKMTheo'] : null,

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
               $sql_km 
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
                  'idDiscount' => !$flag ? $row['MaKM'] : null,
                  'percentDiscount' => !$flag ? $row['TiLeKMTheo'] : null,

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
               $sql_km 
               WHERE giay.ChatLieu = '$input'    
               LIMIT $offset, $limit        
            ";
         $result = $this->conn->query($sql);
         $data = array();
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

               $brand = array(
                  'idBrand' => !$flag ? $row['MaKM'] : null,
                  'nameBrand' => !$flag ? $row['TiLeKMTheo'] : null,
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
               $sql_km 
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
                  'idDiscount' => !$flag ? $row['MaKM'] : null,
                  'percentDiscount' => !$flag ? $row['TiLeKMTheo'] : null,

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
               $sql_km 
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
                  'idDiscount' => !$flag ? $row['MaKM'] : null,
                  'percentDiscount' => !$flag ? $row['TiLeKMTheo'] : null,

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
                $sql_km 
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
                  'idDiscount' => !$flag ? $row['MaKM'] : null,
                  'percentDiscount' => !$flag ? $row['TiLeKMTheo'] : null,

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
