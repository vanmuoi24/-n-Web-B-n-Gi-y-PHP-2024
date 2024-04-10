<?php
require_once '../model/Product.php';

class GiayController
{
    private $giayModel;

    public function __construct($conn)
    {
        $this->giayModel = new GiayModel($conn);
    }

    public function layDanhSachGiay()
    {
        $danhSachGiay = $this->giayModel->layDanhSachGiay();
        return json_encode($danhSachGiay);
    }
    public function delete()
    {
        $result = $this->giayModel->delete();
        return json_encode($result);
    }
    public function layDanhSachGiayPhanTrang($limit, $offset)
    {
        $dsphantrang = $this->giayModel->layDanhSachGiayPhanTrang($limit, $offset);
        return json_encode($dsphantrang);
    }
}
