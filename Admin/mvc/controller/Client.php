<?php
require_once "../model/Client.php";
class KhachHangController
{
    private $KhachHangModel;
    public function __construct($conn)
    {
        $this->KhachHangModel = new KhachHangmodel($conn);
    }
    public function dsKhachHang()
    {
        $dsKhachHang = $this->KhachHangModel->dsKhachHang();
        return json_encode($dsKhachHang);
    }
}
