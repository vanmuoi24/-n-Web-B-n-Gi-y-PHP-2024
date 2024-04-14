<?php
class ThongKeModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function DsThongKe()
    {
        $sql = "SELECT * FROM hoadon";
        $sql1 = " SELECT * FROM chitiethoadon 
        INNER JOIN giay s ON chitiethoadon.MaGiay = s.MaGiay";

        $result = $this->conn->query($sql);
        $result1 = $this->conn->query($sql1);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item[] = array(
                    'MaHD' => $row['MaHD'],
                    'TongTien' => $row['TongTien'],
                    'NgayBan' => $row['NgayBan'],
                );
                $data['hoadon'] = $item;
            }
        }
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $item1[] = array(
                    'MaGiay' => $row['MaGiay'],
                    'SoLuong' => $row['SoLuong'],
                    'GiaBan' => $row['GiaBan'],
                    'Tengia' => $row['Tengia'],
                    'MaHD' => $row['MaHD'],
                    'HinhAnh' => $row['HinhAnh']
                );
                $data['chitiet'] = $item1;
            }
        }
        return $data;
    }
    public function chitietHD($id)
    {
        $sql = "SELECT c.MaGiay, c.SoLuong, dh.MaHD,dh.NgayBan
        FROM chitiethoadon c
        JOIN hoadon dh ON c.MaHD = dh.MaHD
        
        WHERE c.MaGiay = '$id'";
        $result = $this->conn->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item[] = array(
                    'MaHD' => $row['MaHD'],
                    'NgayBan' => $row['NgayBan'],
                );
                $data['hoadon'] = $item;
            }
        }
        return $data;
    }
    public function seacrchday($data)
    {
        $dayfrist = $data['dayfrist'];
        $daylast = $data['daylast'];
        $sql = "SELECT * FROM hoadon";
        $sql1 = "SELECT * 
        FROM chitiethoadon 
        INNER JOIN giay s ON chitiethoadon.MaGiay = s.MaGiay
        INNER JOIN hoadon ON chitiethoadon.MaHD = hoadon.MaHD
        WHERE hoadon.NgayBan >= '$dayfrist' AND hoadon.NgayBan <= ' $daylast'";
        $result = $this->conn->query($sql);
        $result1 = $this->conn->query($sql1);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item[] = array(
                    'MaHD' => $row['MaHD'],
                    'TongTien' => $row['TongTien'],
                    'NgayBan' => $row['NgayBan'],
                );
                $data['hoadon'] = $item;
            }
        }
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $item1[] = array(
                    'MaGiay' => $row['MaGiay'],
                    'SoLuong' => $row['SoLuong'],
                    'GiaBan' => $row['GiaBan'],
                    'Tengia' => $row['Tengia'],
                    'MaHD' => $row['MaHD'],
                    'HinhAnh' => $row['HinhAnh']
                );
                $data['chitiet'] = $item1;
            }
        }
        return $data;
    }
}
