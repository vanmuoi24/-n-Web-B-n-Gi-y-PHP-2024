<?php
class PhanQuyenModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function laydanhsachNhomQuyen()
    {
        $sql = "SELECT * FROM nhomquyen";
        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nhomquyen = array(
                    'manhomquyen' => $row['manhomquyen'],
                    'tennhomquyen' => $row['tennhomquyen']
                );
                $data[] = $nhomquyen;
            }
        }
        return $data;
    }
    public function addquyen()
    {
        $sql = "SELECT * FROM danhmucchucnang";
        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $danhmuchucnang = array(
                    'ma_chuc_nang' => $row['ma_chuc_nang'],
                    'ten_chuc_nang' => $row['ten_chuc_nang']
                );
                $data[] = $danhmuchucnang;
            }
        }
        return $data;
    }
    public function editnhomquyen($id)
    {
        $sql = "SELECT ct.hanh_dong, dn.ten_chuc_nang, q.tennhomquyen,ct.ma_chuc_nang
                FROM ctquyen ct 
                INNER JOIN danhmucchucnang dn ON ct.ma_chuc_nang = dn.ma_chuc_nang 
                INNER JOIN nhomquyen q ON ct.ma_nhom_quyen = q.manhomquyen
                WHERE ct.ma_nhom_quyen = '$id'";
        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            $data['tenquyen'] = array();
            $data['data'] = array();
            while ($row = $result->fetch_assoc()) {
                $data['tenquyen'] = $row['tennhomquyen'];
                $data['data'][] = $row;
                $data['id'] = $id;
            }
        }
        return $data;
    }

    public function luuquyen($data)
    {
        $tennhomquyen = $data['tenquyen'];
        $selecquyen = $data['selecquyen'];
        $sql_insert_nhomquyen = "INSERT INTO nhomquyen (tennhomquyen) VALUES (?)";
        $stmt = $this->conn->prepare($sql_insert_nhomquyen);
        $stmt->bind_param('s', $tennhomquyen);
        $stmt->execute();
        $nhomquyen_id = $this->conn->insert_id;
        foreach ($selecquyen as $quyen) {
            $maChucNang = $quyen['maChucNang'];
            $hanhDong = $quyen['hanhDong'];
            $sql_insert_chitietquyen = "INSERT INTO ctquyen (ma_nhom_quyen, ma_chuc_nang, hanh_dong) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql_insert_chitietquyen);
            $stmt->bind_param('iis', $nhomquyen_id, $maChucNang, $hanhDong);
            $stmt->execute();
        }
    }

    public function updatequyen($data)
    {
        // Lấy dữ liệu từ biến $data
        $id = $data['id'];
        $selecquyen = $data['selecquyen'];

        // Duyệt qua từng cặp maChucNang và hanhDong
        foreach ($selecquyen as $quyen) {
            $maChucNang = $quyen['maChucNang'];
            $hanhDong = $quyen['hanhDong'];

            // Kiểm tra xem có tồn tại bản ghi trong bảng ctquyen hay không
            $sql_check_existence = "SELECT COUNT(*) AS count FROM ctquyen WHERE ma_nhom_quyen = ? AND ma_chuc_nang = ?";
            $stmt = $this->conn->prepare($sql_check_existence);
            $stmt->bind_param('ii', $id, $maChucNang);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            $count = $result['count'];
            $stmt->close();

            if ($count == 0) {
                // Nếu không tồn tại, thêm bản ghi mới vào bảng ctquyen
                $sql_insert_quyen = "INSERT INTO ctquyen (ma_nhom_quyen, ma_chuc_nang, hanh_dong) VALUES (?, ?, ?)";
                $stmt = $this->conn->prepare($sql_insert_quyen);
                $stmt->bind_param('iis', $id, $maChucNang, $hanhDong);
                $stmt->execute();
                $stmt->close();
            } else {
                // Nếu tồn tại, kiểm tra trạng thái của hanhDong
                $sql_check_hanhDong = "SELECT COUNT(*) AS count FROM ctquyen WHERE ma_nhom_quyen = ? AND ma_chuc_nang = ? AND hanh_dong = ?";
                $stmt = $this->conn->prepare($sql_check_hanhDong);
                $stmt->bind_param('iis', $id, $maChucNang, $hanhDong);
                $stmt->execute();
                $result = $stmt->get_result()->fetch_assoc();
                $count = $result['count'];
                $stmt->close();

                if ($count == 0) {
                    // Nếu hanhDong không tồn tại, xóa bản ghi cũ
                    $sql_delete_quyen = "DELETE FROM ctquyen WHERE ma_nhom_quyen = ? AND ma_chuc_nang = ?";
                    $stmt = $this->conn->prepare($sql_delete_quyen);
                    $stmt->bind_param('ii', $id, $maChucNang);
                    $stmt->execute();
                    $stmt->close();

                    // Thêm bản ghi mới với hanhDong mới
                    $sql_insert_quyen = "INSERT INTO ctquyen (ma_nhom_quyen, ma_chuc_nang, hanh_dong) VALUES (?, ?, ?)";
                    $stmt = $this->conn->prepare($sql_insert_quyen);
                    $stmt->bind_param('iis', $id, $maChucNang, $hanhDong);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
    }
}