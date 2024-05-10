<?php
class GiayModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function layDanhSachGiay()
    {
        $sql = "SELECT *
                FROM giay
                INNER JOIN loai ON giay.MaLoai = loai.MaLoai
                INNER JOIN mausac ON giay.MaMau = mausac.MaMau
                INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX
                INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu";
        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $xuatxu = array(
                    'MaXX' => $row['MaXX'],
                    'TenNuoc' => $row['TenNuoc'],
                );

                $thuonghieu = array(
                    'MaThuongHieu' => $row['MaThuongHieu'],
                    'TenThuongHieu' => $row['TenThuongHieu'],
                );
                $loai = array(
                    'MaLoai' => $row['MaLoai'],
                    'TenLoai' => $row['TenLoai'],
                );
                $giay[] = array(
                    'MaGiay' => $row['MaGiay'],
                    'Tengia' => $row['Tengia'],

                    'DonGia' => $row['DonGia'],
                    'DoiTuongSuDung' => $row['DonGia'],
                    'ChatLieu' => $row['DonGia'],
                    'HinhAnh' => $row['HinhAnh'],
                    'XuatXu' => $xuatxu,
                    'ThuongHieu' => $thuonghieu,
                    'Loai' => $loai,

                );
                $data = $giay;
            }
        }
        return $data;
    }

    public function delete($id)
    {


        $sqlCheckChiTietHoaDon = "SELECT * FROM chitiethoadon WHERE MaGiay = '$id'";
        $resultChiTietHoaDon = $this->conn->query($sqlCheckChiTietHoaDon);
        $sqlCheckChiTietPhieuNhap = "SELECT * FROM chitietphieunhap WHERE MaGiay = '$id'";
        $resultChiTietPhieuNhap = $this->conn->query($sqlCheckChiTietPhieuNhap);
        if ($resultChiTietHoaDon->num_rows > 0 || $resultChiTietPhieuNhap->num_rows > 0) {

            $response = array(
                'EM' => "Sản phẩm đã tồn ở phiếu nhập hoặc hóa  đơn",
                'EC' => "1",
                'DT' => ""
            );
            return json_encode($response);
        } else {
            $sqlDeleteGiaySize = "DELETE FROM giay_size WHERE MaGiaySize = '$id'";

            if ($this->conn->query($sqlDeleteGiaySize) === TRUE) {
                $sqlDeleteGiay = "DELETE FROM giay WHERE MaGiay = '$id'";

                $this->conn->query($sqlDeleteGiay);

                $response = array(
                    'EM' => "Xóa thành công ",
                    'EC' => "0",
                    'DT' => ""
                );
                return json_encode($response);
            }
        }
    }


    public function layDanhSachGiayPhanTrang($limit, $offset, $sortOrder)
    {
        $sqlCount = "SELECT COUNT(*) as total FROM giay";
        $resultCount = $this->conn->query($sqlCount);
        $totalRows = $resultCount->fetch_assoc()['total'];

        $totalPages = ceil($totalRows / $limit);

        $sql = "SELECT *
        FROM giay
        INNER JOIN loai ON giay.MaLoai = loai.MaLoai
        INNER JOIN mausac ON giay.MaMau = mausac.MaMau
        INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX

        INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
        ORDER BY Tengia $sortOrder
        LIMIT $offset, $limit";


        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $xuatxu = array(
                    'MaXX' => $row['MaXX'],
                    'TenNuoc' => $row['TenNuoc'],
                );

                $thuonghieu = array(
                    'MaThuongHieu' => $row['MaThuongHieu'],
                    'TenThuongHieu' => $row['TenThuongHieu'],
                );
                $loai = array(
                    'MaLoai' => $row['MaLoai'],
                    'TenLoai' => $row['TenLoai'],
                );
                $giay = array(
                    'MaGiay' => $row['MaGiay'],
                    'Tengia' => $row['Tengia'],

                    'DonGia' => $row['DonGia'],
                    'DoiTuongSuDung' => $row['DoiTuongSuDung'],
                    'ChatLieu' => $row['ChatLieu'],
                    'HinhAnh' => $row['HinhAnh'],
                    'XuatXu' => $xuatxu,
                    'ThuongHieu' => $thuonghieu,
                    'Loai' => $loai,

                );
                $data[] = $giay;
            }
        }

        return array('data' => $data, 'totalPages' => $totalPages);
    }

    public function viewctProduct($id)
    {
        $sql = "SELECT * FROM giay 
              INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu WHERE MaGiay = '$id'";
        $sql1 = "SELECT * FROM giay_size WHERE MaGiaySize = '$id' ";

        $result = $this->conn->query($sql);
        $result1 = $this->conn->query($sql1);

        $data = array();
        if ($result->num_rows > 0) {
            // Dùng fetch_assoc() để lấy một hàng dữ liệu
            $data["giay"] = $result->fetch_assoc();
        }

        if ($result1->num_rows > 0) {
            $sizes = array();
            while ($row = $result1->fetch_assoc()) {
                $sizeItem = array(
                    'SoLuong' => $row['SoLuong'],
                    'MaSz' => $row['MaSz'],
                );
                $sizes[] = $sizeItem;
            }
            $data["giaysize"] = $sizes;
        }

        foreach ($data["giaysize"] as &$item) {
            $maSz = $item['MaSz'];
            $sql2 = "SELECT * FROM size WHERE MaSize = '$maSz'";
            $result2 = $this->conn->query($sql2);
            if ($result2->num_rows > 0) {
                $sizes = array();
                while ($row = $result2->fetch_assoc()) {
                    $sizeItem = array(
                        'MaSz' => $row['MaSize'],
                        'KichThuoc' => $row['KichThuoc']
                    );
                    $sizes = $sizeItem;
                }
                $item['Sizes'] = $sizes;
            }
        }


        return $data;
    }
}
