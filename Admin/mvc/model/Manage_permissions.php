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
        $tennhomquyen = $data['tennhomquyen'];
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
        $id = $data['id'];
        $tenNhomQuyen = $data['tennhomquyen'];
        $selecquyen = $data['selecquyen'];


        $sql_update_nhom_quyen = "UPDATE nhomquyen SET tennhomquyen = ? WHERE manhomquyen = ?";
        $stmt_update_nhom_quyen = $this->conn->prepare($sql_update_nhom_quyen);
        $stmt_update_nhom_quyen->bind_param('si', $tenNhomQuyen, $id);
        $stmt_update_nhom_quyen->execute();
        $stmt_update_nhom_quyen->close();

        $sql_delete_old = "DELETE FROM ctquyen WHERE ma_nhom_quyen = ?";
        $stmt_delete_old = $this->conn->prepare($sql_delete_old);
        $stmt_delete_old->bind_param('i', $id);
        $stmt_delete_old->execute();
        $stmt_delete_old->close();


        foreach ($selecquyen as $quyen) {
            $maChucNang = $quyen['maChucNang'];
            $hanhDong = $quyen['hanhDong'];
            $sql_insert_quyen = "INSERT INTO ctquyen (ma_nhom_quyen, ma_chuc_nang, hanh_dong) VALUES (?, ?, ?)";
            $stmt_insert_quyen = $this->conn->prepare($sql_insert_quyen);
            $stmt_insert_quyen->bind_param('iis', $id, $maChucNang, $hanhDong);
            $stmt_insert_quyen->execute();
            $stmt_insert_quyen->close();
        }

        $response = array(
            'EM' => "Cập Nhật Dữ Liệu Thành Công",
            'EC' => "0",
            'DT' => ""
        );
        return json_encode($response);
    }
}
