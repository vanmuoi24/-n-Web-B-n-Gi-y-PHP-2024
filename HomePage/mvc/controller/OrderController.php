<?php
require_once '../model/OrderModel.php';

class OrderController
{
   private $OrderModel;
   public function __construct($conn)
   {
      $this->OrderModel = new OrderModel($conn);
   }
   public function addOrder($data)
   {
      $result = $this->OrderModel->add($data);

      return json_encode($result);
   }
   public function getOrderByStatus($idAccount, $idStatus)
   {
      $result = $this->OrderModel->filter($idAccount, $idStatus);
      return json_encode($result);
   }
   public function getAllStatus()
   {
      $result = $this->OrderModel->statusAll();
      return json_encode($result);
   }
   public function getOrderDetailByID($idAccount, $idOrder)
   {
      $result = $this->OrderModel->orderdetail($idAccount, $idOrder);
      return json_encode($result);
   }
   public function cancelOrder($id)
   {
      $result = $this->OrderModel->cancel($id);
      return json_encode($result);
   }
   public function reOrder($id)
   {
      $result = $this->OrderModel->reorder($id);
      return json_encode($result);
   }
   public function checkQuantity($id, $size, $quantity)
   {
      $result = $this->OrderModel->check($id, $size, $quantity);
      return json_encode($result);
   }
}
