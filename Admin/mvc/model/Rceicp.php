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
        $sql = "SELECT MaHD, MaNV, MaKM, h.MaKH, NgayBan, TongTien, k.* ,h.trangthai
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
                    'TongTien' => $row['TongTien'],
                    'trangthai' => $row['trangthai']

                );
                $data[] = $hoadon;
            }
        }
        return $data;
    }

    // Trong HoadonModel
    public function chitiethoadon($id)
    {
        $sql = "SELECT chitiethoadon.SoLuong, chitiethoadon.GiaBan, hoadon.MaHD, hoadon.MaNV, hoadon.MaKM, hoadon.MaKH, hoadon.NgayBan, hoadon.TongTien, khachhang.* , giay.Tengia,hoadon.trangthai
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
                    'TongTien' => $row['TongTien'],
                    'trangthai' => $row['trangthai']

                );
                $data['chitiethoadon'] = $chitietHD;
                $data['mahd'] = $mahd;
            }
        }
        return $data;
    }
    public function searchday($data)
    {
        $dayfrist = $data['dayfrist'];
        $daylast = $data['daylast'];
        $sql = "SELECT * , khachhang.*
        FROM hoadon 
        INNER JOIN khachhang ON hoadon.MaKH = khachhang.MaKH
        WHERE hoadon.NgayBan >= '$dayfrist' AND hoadon.NgayBan <= ' $daylast' ";
        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
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
                    'TongTien' => $row['TongTien'],
                    'trangthai' => $row['trangthai']

                );

                $data[] = $mahd;
            }
        }
        return $data;
    }
}