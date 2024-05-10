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
        $sql = "SELECT h.MaHD, h.MaNV, h.MaKM, h.MaKH, h.NgayBan, h.TongTien, k.*, t.tentrangthai 
                FROM hoadon h 
                INNER JOIN khachhang k ON h.MaKH = k.MaKH 
                INNER JOIN trangthaidonhang t ON h.trangthai = t.id";

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

                    'tentrangthai' => $row['tentrangthai']
                );
                $data[] = $hoadon;
            }
        }
        return $data;
    }

    // Trong HoadonModel
    public function chitiethoadon($id)
    {
        $sql = "SELECT chitiethoadon.SoLuongBan, chitiethoadon.GiaBan, hoadon.MaHD, hoadon.MaNV, hoadon.MaKM, hoadon.MaKH, hoadon.NgayBan, hoadon.TongTien, khachhang.* , giay.Tengia,hoadon.trangthai
        FROM hoadon 
        INNER JOIN chitiethoadon ON hoadon.MaHD = chitiethoadon.MaHD
        INNER JOIN khachhang ON hoadon.MaKH = khachhang.MaKH
        INNER JOIN giay ON chitiethoadon.MaGiay = giay.MaGiay
    
        
        WHERE hoadon.MaHD = '$id'";


        $sql1 = "SELECT * FROM trangthaidonhang";
        $result = $this->conn->query($sql);
        $result1 = $this->conn->query($sql1);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $chitietHD[] = array(
                    'gia_ban' => $row['GiaBan'],
                    'TenGiay' => $row['Tengia'],
                    'SoLuong' => $row['SoLuongBan']

                );

                $mahd = array(
                    'MaHD' => $row['MaHD'],
                    'MaNV' => $row['MaNV'],
                    'MaKM' => $row['MaKM'],
                    'TrangThai' => $row['trangthai'],
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


                );
                $data['chitiethoadon'] = $chitietHD;
                $data['mahd'] = $mahd;
            }
            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    $itemtrangthai[] = array(
                        'id' => $row['id'],
                        'tentrangthai' => $row['tentrangthai']

                    );
                    $data["trangtahi"] = $itemtrangthai;
                }
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
        INNER JOIN trangthaidonhang t ON hoadon.trangthai = t.id
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
                    'tentrangthai' => $row['tentrangthai']

                );

                $data[] = $mahd;
            }
        }
        return $data;
    }
    public function capNhatTrangThaiDonHang($data)
    {
        $trangThaiMoi = $data['select'];
        $maHD = $data['mahd'];


        $sqlUpdateHoaDon = "UPDATE hoadon SET trangthai = '$trangThaiMoi' WHERE MaHD = '$maHD'";
        $updateHoaDonResult = $this->conn->query($sqlUpdateHoaDon);

        if ($updateHoaDonResult === TRUE) {
            if ($trangThaiMoi == '3') {

                $sqlUpdateChiTietHoaDon = "UPDATE chitiethoadon 
                                     
                                       INNER JOIN giay_size ON chitiethoadon.MaSizeGiay = giay_size.MaSz 
                                       SET giay_size.SoLuong =  giay_size.SoLuong - chitiethoadon.SoLuongBan
                                       WHERE chitiethoadon.MaHD = '$maHD'";
                $updateChiTietHoaDonResult = $this->conn->query($sqlUpdateChiTietHoaDon);

                if ($updateChiTietHoaDonResult === FALSE) {
                    return false;
                }
            }

            return true;
        } else {
            return false;
        }
    }
}
