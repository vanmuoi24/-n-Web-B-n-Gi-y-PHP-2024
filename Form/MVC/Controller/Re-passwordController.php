<?php   
    require_once '../Modal/Re-passwordModal.php';

    class RepasswordController
    {
        private $RepasswordModal;
        public function __construct($conn)
        {
            $this->RepasswordModal = new RepasswordModal($conn);
        }
        // public function __construct()
        // {
        //     $this->RepasswordModal = new RepasswordModal();

        // }
        public function Repassword($data)
        {
            $repassword = $this->RepasswordModal->Repassword($data);
            return json_encode($repassword);
        }
        public function SendOTP($data)
        {
            $data = $this->RepasswordModal->SendOTp($data);
            return json_encode($data);
        }
    }   
?>