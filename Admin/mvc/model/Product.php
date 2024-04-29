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

    public function delete()
    {
        if (isset($_POST['item_id'])) {
            $itemId = $this->conn->real_escape_string($_POST['item_id']);
            $sqlCheckChiTietHoaDon = "SELECT * FROM chitiethoadon WHERE MaGiay = '$itemId'";
            $resultChiTietHoaDon = $this->conn->query($sqlCheckChiTietHoaDon);
            $sqlCheckChiTietPhieuNhap = "SELECT * FROM chitietphieunhap WHERE MaGiay = '$itemId'";
            $resultChiTietPhieuNhap = $this->conn->query($sqlCheckChiTietPhieuNhap);

            if ($resultChiTietHoaDon->num_rows > 0 || $resultChiTietPhieuNhap->num_rows > 0) {

                return array("success" => false, "error" => "Không thể xóa sản phẩm vì sản phẩm đang được sử dụng trong các phiếu nhập hoặc hóa đơn.");
            }

            $sqlDeleteGiay = "DELETE FROM giay WHERE MaGiay = '$itemId'";
            if ($this->conn->query($sqlDeleteGiay) === TRUE) {
                return array("success" => true);
            } else {
                return array("success" => false, "error" => "Lỗi khi xóa sản phẩm từ bảng giay: " . $this->conn->error);
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
                $data[] = $giay; // Thêm vào mảng $data
            }
        }

        return array('data' => $data, 'totalPages' => $totalPages); // Trả về cả dữ liệu và tổng số trang
    }
}