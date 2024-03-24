<?php

class KhuyenMaiModel
{

    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function laydanhsachKhuyenMai()
    {
        $sql = "SELECT * FROM chuongtrinhkhuyenmai";
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
