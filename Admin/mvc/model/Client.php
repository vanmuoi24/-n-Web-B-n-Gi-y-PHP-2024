<?php

class KhachHangmodel
{

    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function dsKhachHang()
    {
        $sql = "SELECT * FROM khachhang";
        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
}
