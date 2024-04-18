<?php
require_once '../model/HomeModel.php';

class HomeController
{
   private $HomeModel;
   public function __construct($conn)
   {
      $this->HomeModel = new HomeModel($conn);
   }
   public function getBrand()
   {
      $dataBrand = $this->HomeModel->getHomeBrand();

      return json_encode($dataBrand);
   }
   public function getProduct($page)
   {
      $dataBrand = $this->HomeModel->getHomeProduct($page);

      return json_encode($dataBrand);
   }
   public function getPagination()
   {
      $dataBrand = $this->HomeModel->getHomePagination();

      return json_encode($dataBrand);
   }
   public function getSidebar()
   {
      $dataBrand = $this->HomeModel->getHomeSidebar();

      return json_encode($dataBrand);
   }
   public function getProductByBrand($brand,  $page)
   {
      $dataProduct = $this->HomeModel->getHomeProductByBrand($brand, $page);

      return json_encode($dataProduct);
   }
}
