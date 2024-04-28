<?php
require_once '../model/Rceicp.php';

class DonHangController
{
    private $DonHangModel;

    public function __construct($conn)
    {
        $this->DonHangModel = new HoadonModel($conn);
    }

    public function layDanhSachHoaDon()
    {
        $danhHoadon = $this->DonHangModel->layDanhSachHoaDon();
        return json_encode($danhHoadon);
    }
    public function chitiethoadon($id)
    {
        $chiTietHoaDon = $this->DonHangModel->chitiethoadon($id);
        return json_encode($chiTietHoaDon);
    }
    public function searchday($data)
    {
        $searchday = $this->DonHangModel->searchday($data);
        return json_encode($searchday);
    }
    public function capNhatTrangThaiDonHang($data)
    {
        $data = $this->DonHangModel->capNhatTrangThaiDonHang($data);
        return json_encode($data);
    }
}
