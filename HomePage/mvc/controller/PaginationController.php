<?php
require_once '../model/PaginationModel.php';

class PaginationController
{
   private $PaginationModel;
   public function __construct($conn)
   {
      $this->PaginationModel = new PaginationModel($conn);
   }


   public function getPaginationByFilter($filter, $input)
   {
      $pagination = $this->PaginationModel->filter($filter, $input);

      return json_encode($pagination);
   }
}