<?php

require_once "../model/Manage_permissions.php";
class Manage_permissionsController
{

    private $Manage_permission;
    public function __construct($conn)
    {
        $this->Manage_permission = new PhanQuyenModel($conn);
    }
    public function laydanhsachNhomQuyen()
    {
        $danhsachnhomquyen = $this->Manage_permission->laydanhsachNhomQuyen();
        return json_encode(($danhsachnhomquyen));
    }

    public function addquyen()
    {
        $dsdanhmucchucnang  = $this->Manage_permission->addquyen();
        return json_encode($dsdanhmucchucnang);
    }
    public function editnhomquyen($id)
    {
        $dseditnhomquyen = $this->Manage_permission->editnhomquyen($id);
        return json_encode($dseditnhomquyen);
    }

    public function luuquyen($data)
    {
        $dsluuquyen = $this->Manage_permission->luuquyen($data);
        return json_encode($dsluuquyen);
    }
    public function updatequyen($data)
    {
        $dsupdate = $this->Manage_permission->updatequyen($data);
        return json_encode($dsupdate);
    }
}