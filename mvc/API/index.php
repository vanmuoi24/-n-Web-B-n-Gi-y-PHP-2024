<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "web_bangiay";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
   die("Kết nối thất bại: " . $conn->connect_error);
}
require_once '../controller/HomeController.php';
require_once '../controller/BrandController.php';
require_once '../controller/ProductController.php';
require_once '../controller/PaginationController.php';
require_once '../controller/AccountController.php';
$HomeController = new HomeController($conn);
$AccountController = new AccountController($conn);
$BrandController = new BrandController($conn);
$ProductController = new ProductController($conn);
$PaginationController = new PaginationController($conn);
$type = isset($_GET['type']) ? $_GET['type'] : '';

switch ($type) {
   case 'brandsHome':
      echo $HomeController->getBrand();
      break;
   case 'productsHome':
      $page = isset($_GET['page']) ? $_GET['page'] : '';
      echo $HomeController->getProduct($page);
      break;
   case 'paginationHome':
      echo $HomeController->getPagination();
      break;
   case 'sidebarHome':
      echo $HomeController->getSidebar();
      break;
   case 'product':
      $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
      $input = isset($_GET['input']) ? $_GET['input'] : '';
      $page = isset($_GET['page']) ? $_GET['page'] : '';
      echo $ProductController->getProductByFilter($filter, $input, $page);
      break;
   case 'search':
      $key = isset($_GET['key']) ? $_GET['key'] : '';
      $limit = isset($_GET['limit']) ? $_GET['limit'] : '';
      $page = isset($_GET['page']) ? $_GET['page'] : '';
      echo $ProductController->getProductByKeySearch($key, $limit, $page);
      break;
   case 'pagination':
      $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
      $input = isset($_GET['input']) ? $_GET['input'] : '';
      echo $PaginationController->getPaginationByFilter($filter, $input);
      break;
   case 'productbyid':
      $id = isset($_GET['id']) ? $_GET['id'] : '';
      echo $ProductController->getProductByID($id);
      break;
   case 'getAccount':
      $id = isset($_GET['id']) ? $_GET['id'] : '';
      echo $AccountController->getAccountByID($id);
      break;
   case 'updateAccount':
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $data = json_decode(file_get_contents("php://input"), true);
         echo  $AccountController->updateAccount($data);
      } else {
         echo json_encode(array("error" => "Không nhận được dữ liệu từ client"));
      }
      break;
   case 'changePassword':
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $data = json_decode(file_get_contents("php://input"), true);
         echo  $AccountController->changePassword($data);
      } else {
         echo json_encode(array("error" => "Không nhận được dữ liệu từ client"));
      }
      break;
   default:
      echo json_encode(array('error' => 'Yêu cầu không hợp lệ'));
}


$conn->close();
