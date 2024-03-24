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
}
