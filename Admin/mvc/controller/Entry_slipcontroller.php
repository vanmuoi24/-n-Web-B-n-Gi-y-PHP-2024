<?php

require_once '../model/Entry_Slip.php';
class Entry_slipcontroller
{
    private $Entry_SlipModel;
    public function __construct($conn)
    {
        $this->Entry_SlipModel = new Entry_SlipModel($conn);
    }
    public function LayDanhSachPhieuNhap()
    {
        $dsphieunhap = $this->Entry_SlipModel->LayDanhSachPhieuNhap();
        return json_encode($dsphieunhap);
    }
    public function GiaTriSanPham($id)
    {
        $dssanpahm = $this->Entry_SlipModel->GiaTriSanPham($id);
        return json_encode($dssanpahm);
    }

    public function get4table()
    {
        $ds4table = $this->Entry_SlipModel->get4table();
        return json_encode($ds4table);
    }
    public function ChiTietPhieuNhap($id)
    {
        $dschitiethd = $this->Entry_SlipModel->ChiTietPhieuNhap($id);
        return json_encode($dschitiethd);
    }
    public function themmoisanpham($data)
    {
        $dsthemsanpham = $this->Entry_SlipModel->themmoisanpham($data);
        return json_encode($dsthemsanpham);
    }
}