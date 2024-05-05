<?php

class KhuyenMaiModel
{

    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function laydanhsachKhuyenMai()
    {
        $sql = "SELECT * FROM chuongtrinhkhuyenmai";
        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }
    public function themKhuyenMai($data)
    {
        $tiLeKM = $data['TiLeKM'];
        $dieuKien = $data['DieuKien'];
        $ngayBatDau = $data['NgayBatDau'];
        $ngayKetThuc = $data['NgayKetThuc'];
        $maGiayArray = $data['MaGiay'];
        $loaiChuongTrinh = $data['Loai'];
        $tenchuongtrinh = $data["TenChuongTrinh"];

        $queryChuongTrinh = "INSERT INTO chuongtrinhkhuyenmai (LoaiChuongTrinh, DieuKien, NgayBatDau, NgayKetThuc,TenChuongTrinh) 
                                VALUES ('$loaiChuongTrinh', '$dieuKien', '$ngayBatDau', '$ngayKetThuc','$tenchuongtrinh')";

        $this->conn->query($queryChuongTrinh);


        $maKM = $this->conn->insert_id;
        foreach ($maGiayArray as $maGiay) {
            $queryChiTiet = "INSERT INTO chitietkhuyenmai (MaKM, MaGiayKM, TiLeKMTheo) 
                                VALUES ('$maKM', '$maGiay', '$tiLeKM')";
            // Thực hiện truy vấn INSERT cho Chi tiết khuyến mãi
            $this->conn->query($queryChiTiet);
        }
    }
}
