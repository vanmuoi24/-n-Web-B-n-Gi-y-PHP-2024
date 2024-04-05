<?php
require_once '../model/Stastical.php';

class ThongKeController
{
    private $ThongKeModel;

    public function __construct($conn)
    {
        $this->ThongKeModel = new ThongKeModel($conn);
    }
    public function DsThongKe()
    {
        $dsThongKe = $this->ThongKeModel->DsThongKe();
        return json_encode($dsThongKe);
    }
    public function chitietHD($id)
    {
        $dschitietHD = $this->ThongKeModel->chitietHD($id);
        return json_encode($dschitietHD);
    }
}