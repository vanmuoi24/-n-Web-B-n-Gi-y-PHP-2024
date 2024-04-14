<?php   
require_once '../Modal/LoginModal.php';

    class DangNhapController
    {
        private $DangNhapModal;
        public function __construct($conn)
        {
            $this->DangNhapModal = new LoginModal($conn);
        }
        public function DangNhap()
        {
            $login = $this->DangNhapModal->Login();
            return json_encode($login);
        }
    }
?>