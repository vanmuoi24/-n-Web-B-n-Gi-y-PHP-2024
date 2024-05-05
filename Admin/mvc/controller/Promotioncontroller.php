<?php
require_once "../model/Promotion.php";

class Promotioncontroller
{
    private $KhuyenMaiModel;

    public function __construct($conn)
    {
        $this->KhuyenMaiModel = new KhuyenMaiModel($conn);
    }
    public function LayDanhSachKhuyenMai()
    {
        $danhsach = $this->KhuyenMaiModel->laydanhsachKhuyenMai();
        return json_encode($danhsach);
    }
    public function themKhuyenMai($data)
    {
        $themPosi = $this->KhuyenMaiModel->themKhuyenMai($data);
        return json_encode($themPosi);
    }
}
