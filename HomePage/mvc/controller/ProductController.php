<?php
require_once '../model/ProductModel.php';

class ProductController
{
   private $ProductModel;
   public function __construct($conn)
   {
      $this->ProductModel = new ProductModel($conn);
   }
   public function getAll()
   {
      $products = $this->ProductModel->all();

      return json_encode($products);
   }
   public function getProductByFilter($filter, $input, $page)
   {
      $products = $this->ProductModel->filter($filter, $input, $page);
      if (!$products) return json_encode(['notFound' => 'KHÔNG TÌM THẤY SẢN PHẨM!!!']);
      return json_encode($products);
   }
   public function getProductByID($id)
   {
      $products = $this->ProductModel->getbyid($id);
      return json_encode($products);
   }
}
