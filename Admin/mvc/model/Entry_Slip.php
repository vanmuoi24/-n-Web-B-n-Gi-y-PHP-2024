<?php

class Entry_SlipModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function LayDanhSachPhieuNhap()
    {
        $sql = "SELECT * FROM phieunhap 
        INNER JOIN nhanvien ON phieunhap.MaNV = nhanvien.MaNV
        INNER JOIN nhacungcap ON phieunhap.MaNCC = nhacungcap.MaNCC";
        $result = $this->conn->query($sql);
        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $phieunhap = array(
                    'MaPN' => $row['MaPN'],
                    'NgayNhap' => $row['NgayNhap'],
                    'TongTien' => $row['TongTien'],
                    'MaNV' => array(
                        'Ho' => $row['Ho'],
                        'Ten' => $row['Ten'],
                        'GioiTinh' => $row['GioiTinh'],
                        'DiaChi' => $row['DiaChi'],
                        'Email' => $row['Email'],
                        'Luong' => $row['Luong']
                    ),
                    'MaNCC' => array(
                        'TenNCC' => $row['TenNCC'],
                        'DiaChi' => $row['DiaChi'],
                        'DienThoai' => $row['DienThoai']
                    )
                );
                $data[] = $phieunhap;
            }
        }
        return $data;
    }
    public function GiaTriSanPham($id)
    {
        $sql = " SELECT *
     FROM giay
     INNER JOIN loai ON giay.MaLoai = loai.MaLoai
     INNER JOIN mausac ON giay.MaMau = mausac.MaMau
     INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX
     INNER JOIN size ON giay.MaSize = size.MaSize
     INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu WHERE MaGiay = '$id'";

        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $xuatxu = array(
                    'MaXX' => $row['MaXX'],
                    'TenNuoc' => $row['TenNuoc'],
                );
                $size = array(
                    'MaSize' => $row['MaSize'],
                    'KichThuoc' => $row['KichThuoc'],
                );
                $thuonghieu = array(
                    'MaThuongHieu' => $row['MaThuongHieu'],
                    'TenThuongHieu' => $row['TenThuongHieu'],
                );
                $loai = array(
                    'MaLoai' => $row['MaLoai'],
                    'TenLoai' => $row['TenLoai'],
                );
                $mausac = array(
                    'MaMau' => $row['MaMau'],
                    'TenMau' => $row['TenMau'],
                );
                $giay = array(
                    'MaGiay' => $row['MaGiay'],
                    'Tengia' => $row['Tengia'],
                    'SoLuong' => $row['SoLuong'],
                    'DonGia' => $row['DonGia'],
                    'DoiTuongSuDung' => $row['DoiTuongSuDung'],
                    'ChatLieu' => $row['ChatLieu'],
                    'HinhAnh' => $row['HinhAnh'],
                    'XuatXu' => $xuatxu,
                    'ThuongHieu' => $thuonghieu,
                    'Loai' => $loai,
                    'Size' => $size,
                    'MauSac' => $mausac
                );

                $data = $giay;
            }
        }
        return $data;
    }

    public function get4table()
    { // 'TenLoai' => $row['TenLoai'],
        // 'MaXX' => $row['MaXX'],
        // 'TenNuoc' => $row['TenNuoc'],
        $sql = "SELECT * FROM loai";
        $sql1 = "SELECT * FROM xuatxu";
        $sql2 = "SELECT * FROM size";
        $sql3 = "SELECT * FROM thuonghieu";
        $sql4 = "SELECT * FROM mausac";
        $result = $this->conn->query($sql);
        $result1 = $this->conn->query($sql1);
        $result2 = $this->conn->query($sql2);
        $result3 = $this->conn->query($sql3);
        $result4 = $this->conn->query($sql4);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item[] = array(
                    'MaLoai' => $row['MaLoai'],
                    'TenLoai' => $row['TenLoai']
                );
                $data['loai'] = $item;
            }
        }
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $item1[] = array(
                    'MaXX' => $row['MaXX'],
                    'TenNuoc' => $row['TenNuoc'],
                );
                $data['xuatxu'] = $item1;
            }
        }
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $item2[] = array(
                    'MaSize' => $row['MaSize'],
                    'KichThuoc' => $row['KichThuoc'],
                );
                $data['size'] = $item2;
            }
        }
        if ($result3->num_rows > 0) {
            while ($row = $result3->fetch_assoc()) {
                $item3[] = array(
                    'MaThuongHieu' => $row['MaThuongHieu'],
                    'TenThuongHieu' => $row['TenThuongHieu'],
                    'DiaChi' => $row['DiaChi'],
                    'Email' => $row['Email']
                );
                $data['thuonghieu'] = $item3;
            }
        }
        if ($result4->num_rows > 0) {
            while ($row = $result4->fetch_assoc()) {
                $item4[] = array(
                    'MaMau' => $row['MaMau'],
                    'TenMau' => $row['TenMau'],
                );
                $data['mausac'] = $item4;
            }
        }

        return $data;
    }

    public function ChiTietPhieuNhap($id)
    {
        $sql = "SELECT * 
                FROM chitietphieunhap 
                INNER JOIN phieunhap ON phieunhap.MaPN = chitietphieunhap.MaPN 
                WHERE chitietphieunhap.MaPN = '$id'";
        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dataitem = array(
                    'MaGiay' => $row['MaGiay'],
                    'MaPN' => $row['MaPN'],
                    'SoLuong' => $row['SoLuong'],
                    'GiaNhap' => $row['GiaNhap']
                );
                $data[] = $dataitem;
            }
        }
        return $data;
    }
}
