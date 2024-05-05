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
    public function delete($id)
    {
        $result = $this->giayModel->delete($id);
        return json_encode($result);
    }
    public function layDanhSachGiayPhanTrang($limit, $offset, $sortOrder)
    {
        $dsphantrang = $this->giayModel->layDanhSachGiayPhanTrang($limit, $offset, $sortOrder);
        return json_encode($dsphantrang);
    }
    public function viewctProduct($id)
    {
        $dschitietsanpham = $this->giayModel->viewctProduct($id);
        return json_encode($dschitietsanpham);
    }
}