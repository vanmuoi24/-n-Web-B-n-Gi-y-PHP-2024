<?php   
require_once '../Modal/LoginModal.php';

    class LoginController
    {
        private $LoginModal;
        public function __construct($conn)
        {
            $this->LoginModal = new LoginModal($conn);
        }
        public function Login($data)
        {
            $login = $this->LoginModal->Login($data);
            return json_encode($login);
        }
    }
?>