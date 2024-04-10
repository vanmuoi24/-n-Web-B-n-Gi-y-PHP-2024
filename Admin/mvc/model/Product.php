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
                INNER JOIN size ON giay.MaSize = size.MaSize
                INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu";
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
                $giay[] = array(
                    'MaGiay' => $row['MaGiay'],
                    'Tengia' => $row['Tengia'],
                    'SoLuong' => $row['SoLuong'],
                    'DonGia' => $row['DonGia'],
                    'DoiTuongSuDung' => $row['DonGia'],
                    'ChatLieu' => $row['DonGia'],
                    'HinhAnh' => $row['HinhAnh'],
                    'XuatXu' => $xuatxu,
                    'ThuongHieu' => $thuonghieu,
                    'Loai' => $loai,
                    'Size' => $size,
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
            $sqlUpdateChiTietHoaDon = "UPDATE chitiethoadon SET MaGiay = NULL WHERE MaGiay = '$itemId'";
            $sqlUpdateChiTietPhieuNhap = "UPDATE chitietphieunhap SET MaGiay = NULL WHERE MaGiay = '$itemId'";
            if ($this->conn->query($sqlUpdateChiTietHoaDon) === TRUE && $this->conn->query($sqlUpdateChiTietPhieuNhap) === TRUE) {
                $sqlDeleteGiay = "DELETE FROM giay WHERE MaGiay = '$itemId'";
                if ($this->conn->query($sqlDeleteGiay) === TRUE) {
                    return array("success" => true);
                } else {
                    return array("success" => false, "error" => "Lỗi khi xóa sản phẩm từ bảng giay: " . $this->conn->error);
                }
            } else {
                return array("success" => false, "error" => "Lỗi khi cập nhật khóa ngoại: " . $this->conn->error);
            }
        }
    }

    public function layDanhSachGiayPhanTrang($limit, $offset)
    {
        $sqlCount = "SELECT COUNT(*) as total FROM giay"; // Query để đếm tổng số sản phẩm
        $resultCount = $this->conn->query($sqlCount);
        $totalRows = $resultCount->fetch_assoc()['total'];

        $totalPages = ceil($totalRows / $limit); // Tính tổng số trang

        $sql = "SELECT *
            FROM giay
            INNER JOIN loai ON giay.MaLoai = loai.MaLoai
            INNER JOIN mausac ON giay.MaMau = mausac.MaMau
            INNER JOIN xuatxu ON giay.MaXX = xuatxu.MaXX
            INNER JOIN size ON giay.MaSize = size.MaSize
            INNER JOIN thuonghieu ON giay.MaThuongHieu = thuonghieu.MaThuongHieu
            LIMIT $offset, $limit";

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
                );
                $data[] = $giay; // Thêm vào mảng $data
            }
        }

        return array('data' => $data, 'totalPages' => $totalPages); // Trả về cả dữ liệu và tổng số trang
    }
}
