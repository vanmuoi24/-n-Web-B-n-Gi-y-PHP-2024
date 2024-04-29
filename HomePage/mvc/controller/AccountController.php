<?php
require_once '../model/AccountModel.php';

class AccountController
{
   private $AccountModel;
   public function __construct($conn)
   {
      $this->AccountModel = new AccountModel($conn);
   }
   public function getAccountByID($id)
   {
      $accounts = $this->AccountModel->getbyid($id);
      return json_encode($accounts);
   }
   public function updateAccount($data)
   {
      $result = $this->AccountModel->update($data);
      return json_encode($result);
   }
   public function changePassword($data)
   {
      $result = $this->AccountModel->password($data);
      return json_encode($result);
   }
}
