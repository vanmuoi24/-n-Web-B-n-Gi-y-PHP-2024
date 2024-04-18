<?php
class BrandModel
{
   private $conn;
   public function __construct($conn)
   {
      $this->conn = $conn;
   }
   public function all()
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
}
