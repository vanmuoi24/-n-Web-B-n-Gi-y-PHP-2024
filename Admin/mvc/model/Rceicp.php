<?php
class HoadonModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function layDanhSachHoaDon()
    {
        $sql = "SELECT MaHD, MaNV, MaKM, h.MaKH, NgayBan, TongTien, k.* 
                FROM hoadon h 
                INNER JOIN khachhang k ON h.MaKH = k.MaKH";
        $result = $this->conn->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $khachhang = array(
                    'MaKH' => $row['MaKH'],
                    'Loai' => $row['Loai'],
                    'TongChiTieu' => $row['TongChiTieu'],
                    'Ho' => $row['Ho'],
                    'Ten' => $row['Ten'],
                    'GioiTinh' => $row['GioiTinh'],
                    'DiaChi' => $row['DiaChi'],
                    'Email' => $row['Email']
                );
                $hoadon = array(
                    'MaHD' => $row['MaHD'],
                    'MaNV' => $row['MaNV'],
                    'MaKM' => $row['MaKM'],
                    'MaKH' => $khachhang,
                    'NgayBan' => $row['NgayBan'],
                    'TongTien' => $row['TongTien']
                );
                $data[] = $hoadon;
            }
        }
        return $data;
    }

    // Trong HoadonModel
    public function chitiethoadon($id)
    {
        $sql = "SELECT chitiethoadon.SoLuong, chitiethoadon.GiaBan, hoadon.MaHD, hoadon.MaNV, hoadon.MaKM, hoadon.MaKH, hoadon.NgayBan, hoadon.TongTien, khachhang.* , giay.Tengia
        FROM hoadon 
        INNER JOIN chitiethoadon ON hoadon.MaHD = chitiethoadon.MaHD
        INNER JOIN khachhang ON hoadon.MaKH = khachhang.MaKH
        INNER JOIN giay ON chitiethoadon.MaGiay = giay.MaGiay
    
        
        WHERE hoadon.MaHD = '$id'";
        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $chitietHD[] = array(

                    'so_soluong' => $row['SoLuong'],
                    'gia_ban' => $row['GiaBan'],
                    'TenGiay' => $row['Tengia']

                );

                $mahd = array(
                    'MaHD' => $row['MaHD'],
                    'MaNV' => $row['MaNV'],
                    'MaKM' => $row['MaKM'],
                    'MaKH' => array(
                        'MaKH' => $row['MaKH'],
                        'Loai' => $row['Loai'],
                        'TongChiTieu' => $row['TongChiTieu'],
                        'Ho' => $row['Ho'],
                        'Ten' => $row['Ten'],
                        'GioiTinh' => $row['GioiTinh'],
                        'DiaChi' => $row['DiaChi'],
                        'Email' => $row['Email']
                    ),
                    'NgayBan' => $row['NgayBan'],
                    'TongTien' => $row['TongTien']
                );
                $data['chitiethoadon'] = $chitietHD;
                $data['mahd'] = $mahd;
            }
        }
        return $data;
    }
}
