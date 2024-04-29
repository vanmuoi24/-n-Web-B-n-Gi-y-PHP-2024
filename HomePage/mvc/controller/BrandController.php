<?php
require_once '../model/BrandModel.php';

class BrandController
{
   private $BrandModel;
   public function __construct($conn)
   {
      $this->BrandModel = new BrandModel($conn);
   }
   public function getAll()
   {
      $brands = $this->BrandModel->all();

      return json_encode($brands);
   }
}