<?php
class HomeModel
{
   private $conn;
   private $limit = 12;
   public function __construct($conn)
   {
      $this->conn = $conn;
   }
   public function getHomeBrand()
   {
      $sql = "SELECT * FROM thuonghieu";
      $result = $this->conn->query($sql);
      $data = [];

      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            $brands = [
               "id" => $row["MaThuongHieu"],
               "name" => $row["TenThuongHieu"],
               "address" => $row["DiaChi"],
               "email" => $row["Email"],
            ];
            $data[] = $brands;
         }
      }
      return $data;
   }
   public function getHomeProduct($page = 1)
   {

      $offset = ($page - 1) * $this->limit;
      $sql = " SELECT * FROM giay 
      INNER JOIN loai ON giay.MaLoai = loai.MaLoai 
      INNER JOIN mausac ON giay.MaMau = mausac.MaMau 
      INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX 
      INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu 
      LEFT JOIN chitietchuongtrinhkhuyenmai ON giay.MaGiay = chitietchuongtrinhkhuyenmai.MaGiayKM 
         ORDER BY giay.MaGiay DESC
         LIMIT $offset, $this->limit";
      $result = $this->conn->query($sql);
      //
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
               'nameProduct' => $row['Tengia'],
               'priceProduct' => $row['DonGia'],
               'collectionProduct' => $row['DoiTuongSuDung'],
               'materialProduct' => $row['DonGia'],
               'discountProduct' => $discount,
               'imgProduct' => $row['HinhAnh'],
               'originProduct' => $origin,
               'brandProduct' => $brand,
               'typeProduct' => $type,
               'idProduct' =>  $row['MaGiay'],

            );
            $data = $product;
         }
      }
      return $data;
   }
   public function getHomeSidebar()
   {
      $sql_type = "SELECT * FROM loai";
      $sql_material = "SELECT DISTINCT giay.ChatLieu FROM giay";
      $sql_size = "SELECT * FROM size";
      $sql_color = "SELECT * FROM mausac";
      //
      $result_type = mysqli_query($this->conn, $sql_type);
      $result_material = mysqli_query($this->conn, $sql_material);
      $result_size = mysqli_query($this->conn, $sql_size);
      $result_color = mysqli_query($this->conn, $sql_color);
      //
      $dataTypes = [];
      $dataMaterials = [];
      $dataSizes = [];
      $dataColors = [];
      if ($result_type->num_rows > 0) {
         while ($row = $result_type->fetch_assoc()) {
            $types = [
               "id" => $row["MaLoai"],
               "name" => $row["TenLoai"],
            ];
            $dataTypes[] = $types;
         }
      }
      if ($result_material->num_rows > 0) {
         while ($row = $result_material->fetch_assoc()) {
            $materials = [
               "name" => $row["ChatLieu"],
            ];
            $dataMaterials[] = $materials;
         }
      }
      if ($result_size->num_rows > 0) {
         while ($row = $result_size->fetch_assoc()) {
            $sizes = [
               "id" => $row["MaSize"],
               "name" => $row["KichThuoc"],

            ];
            $dataSizes[] = $sizes;
         }
      }
      if ($result_color->num_rows > 0) {
         while ($row = $result_color->fetch_assoc()) {
            $color = [
               "id" => $row["MaMau"],
               "name" => $row["TenMau"],
            ];
            $dataColors[] = $color;
         }
      }

      $data = [
         "type" => $dataTypes,
         "material" => $dataMaterials,
         "size" => $dataSizes,
         "color" => $dataColors,
      ];
      return $data;
   }
   public function getHomePagination()
   {
      $sql = "SELECT * FROM giay";
      $result = mysqli_query($this->conn, $sql);
      $total_records = mysqli_num_rows($result);
      $total_page = ceil($total_records / $this->limit);
      $data = [
         "totalPage" => $total_page,
      ];
      return $data;
   }
}
