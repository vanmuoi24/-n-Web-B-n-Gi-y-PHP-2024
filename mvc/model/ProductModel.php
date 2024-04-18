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
      LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiay 
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
            $product[] = array(
               'idProduct' => $row['MaGiay'],
               'nameProduct' => $row['Tengia'],
               'quantityProduct' => $row['SoLuong'],
               'priceProduct' => $row['DonGia'],
               'collectionProduct' => $row['DoiTuongSuDung'],
               'materialProduct' => $row['DonGia'],
               'imgProduct' => $row['HinhAnh'],
               'originProduct' => $origin,
               'brandProduct' => $brand,
               'typeProduct' => $type,
               'sizeProduct' => $size,
               'discountProduct' => $row['GiamGia'],
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
                INNER JOIN size ON giay.MaSize = size.MaSize
                INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
                WHERE giay.MaGiay = '$id'
                LIMIT 1          
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
            $product = array(
               'idProduct' => $row['MaGiay'],
               'nameProduct' => $row['Tengia'],
               'quantityProduct' => $row['SoLuong'],
               'priceProduct' => $row['DonGia'],
               'collectionProduct' => $row['DoiTuongSuDung'],
               'materialProduct' => $row['ChatLieu'],
               'imgProduct' => $row['HinhAnh'],
               'originProduct' => $origin,
               'colorProduct' => $color,
               'brandProduct' => $brand,
               'typeProduct' => $type,
               'sizeProduct' => $size,
               'discountProduct' => $row['GiamGia'],
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
      LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiay 
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

               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'quantityProduct' => $row['SoLuong'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $row['TiLeKMTheo'] ? $row['TiLeKMTheo'] : 0,
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
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiay 
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

               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'quantityProduct' => $row['SoLuong'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $row['TiLeKMTheo'] ? $row['TiLeKMTheo'] : 0,

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
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiay 
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

               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'quantityProduct' => $row['SoLuong'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $row['TiLeKMTheo'] ? $row['TiLeKMTheo'] : 0,

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
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiay 
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

               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'quantityProduct' => $row['SoLuong'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $row['TiLeKMTheo'] ? $row['TiLeKMTheo'] : 0,

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
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiay 
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

               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'quantityProduct' => $row['SoLuong'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $row['TiLeKMTheo'] ? $row['TiLeKMTheo'] : 0,

               );
               $data = $product;
            }
         }
         return $data;
      }
      if ($filter == 'size') {
         $limit = 12;
         $offset = ($page - 1) * $limit;
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiay 
               WHERE giay.Masize = '$input'    
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

               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'quantityProduct' => $row['SoLuong'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $row['TiLeKMTheo'] ? $row['TiLeKMTheo'] : 0,

               );
               $data = $product;
            }
         }
         return $data;
      }
      if ($filter == 'orderby') {
         $inputArr = explode(',', $input);

         $subWhere = '';
         switch ($inputArr[1]) {
            case 'price':
               $rangePrice = explode('-', $inputArr[2]);
               $from = isset($rangePrice[0]) ? $rangePrice[0] : null;
               $to = isset($rangePrice[1]) ? $rangePrice[1]  : null;
               $subWhere = " WHERE giay.DonGia BETWEEN $from AND $to ";
               break;
            case 'brand':
               $subWhere = " WHERE thuonghieu.MaThuongHieu = '$inputArr[2]'  ";
               break;
            case 'type':
               $subWhere = " WHERE giay.MaLoai = '$inputArr[2]' ";
               break;
            case 'material':
               $subWhere = " WHERE giay.ChatLieu = '$inputArr[2]'  ";
               break;
            case 'color':
               $subWhere = " WHERE giay.MaMau = '$inputArr[2]'  ";
               break;
            case 'size':
               $subWhere = " WHERE giay.MaSize = '$inputArr[2]'  ";
               break;
            default:
               $subWhere = '';
               break;
         }
         $orderby = '';
         switch ($inputArr[0]) {
            case 'tang-dan':
               $orderby = ' ORDER BY giay.DonGia ASC ';
               break;
            case 'giam-dan':
               $orderby = ' ORDER BY giay.DonGia DESC ';
               break;
            case 'moi-nhat':
               $orderby = ' ORDER BY giay.MaGiay DESC ';
               break;
            default:
               $orderby = '';
               break;
         }

         $limit = 12;
         $offset = ($page - 1) * $limit;
         $sql = "SELECT *
               FROM giay
               INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
               LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiay 
               $subWhere
               $orderby    
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

               $product[] = array(
                  'idProduct' => $row['MaGiay'],
                  'nameProduct' => $row['Tengia'],
                  'quantityProduct' => $row['SoLuong'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'brandProduct' => $brand,
                  'discountProduct' => $row['TiLeKMTheo'] ? $row['TiLeKMTheo'] : 0,

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
                INNER JOIN size ON giay.MaSize = size.MaSize
                INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
                LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiay 
                WHERE giay.Tengia LIKE '%$input%' OR
                thuonghieu.TenThuongHieu LIKE '%$input%' OR            
                loai.TenLoai LIKE '%$input%' OR            
                giay.DoiTuongSuDung LIKE '%$input%' OR            
                giay.ChatLieu LIKE '%$input%'       
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
                  'nameProduct' => $row['Tengia'],
                  'quantityProduct' => $row['SoLuong'],
                  'priceProduct' => $row['DonGia'],
                  'collectionProduct' => $row['DoiTuongSuDung'],
                  'materialProduct' => $row['DonGia'],
                  'imgProduct' => $row['HinhAnh'],
                  'originProduct' => $origin,
                  'brandProduct' => $brand,
                  'typeProduct' => $type,
                  'sizeProduct' => $size,
                  'discountProduct' => $row['TiLeKMTheo'] ? $row['TiLeKMTheo'] : 0,
               );
               $data = $product;
            }
         }
         return $data;
      }
   }
   public function search($key, $limit, $page)
   {
      $offset = ($page - 1) * $limit;
      $sql = "SELECT *
                FROM giay
                INNER JOIN loai ON giay.MaLoai = loai.MaLoai
                INNER JOIN mausac ON giay.MaMau = mausac.MaMau
                INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX
                INNER JOIN size ON giay.MaSize = size.MaSize
                INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
                LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiay 
                WHERE giay.Tengiay LIKE '%$key%' OR
                thuonghieu.TenThuongHieu LIKE '%$key%' OR            
                loai.TenLoai LIKE '%$key%' OR            
                giay.DoiTuongSuDung LIKE '%$key%' OR            
                giay.ChatLieu LIKE '%$key%'       
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
               'nameProduct' => $row['Tengia'],
               'quantityProduct' => $row['SoLuong'],
               'priceProduct' => $row['DonGia'],
               'collectionProduct' => $row['DoiTuongSuDung'],
               'materialProduct' => $row['DonGia'],
               'imgProduct' => $row['HinhAnh'],
               'originProduct' => $origin,
               'brandProduct' => $brand,
               'typeProduct' => $type,
               'sizeProduct' => $size,
               'discountProduct' => $row['TiLeKMTheo'] ? $row['TiLeKMTheo'] : 0,
            );
            $data = $product;
         }
      }
      return $data;
   }
}
