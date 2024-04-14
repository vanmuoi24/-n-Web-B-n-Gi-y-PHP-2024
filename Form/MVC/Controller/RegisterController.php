<?php   
    require_once '../Modal/RegisterModal.php';

    class RegisterController
    {
        private $RegisterModal;
        public function __construct($conn)
        {
            $this->RegisterModal = new RegisterModal($conn);
        }
        public function Register($data)
        {
            $register = $this->RegisterModal->Register($data);
            return json_encode($register);
        }
    }
?>