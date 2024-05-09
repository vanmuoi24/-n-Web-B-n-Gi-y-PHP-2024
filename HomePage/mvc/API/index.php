<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ql_banhanggiay";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
   die("Kết nối thất bại: " . $conn->connect_error);
}
require_once '../controller/HomeController.php';
require_once '../controller/BrandController.php';
require_once '../controller/ProductController.php';
require_once '../controller/PaginationController.php';
require_once '../controller/AccountController.php';
require_once '../controller/OrderController.php';
$HomeController = new HomeController($conn);
$AccountController = new AccountController($conn);
$BrandController = new BrandController($conn);
$ProductController = new ProductController($conn);
$PaginationController = new PaginationController($conn);
$OrderController = new OrderController($conn);
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
   case 'pagination':
      $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
      $input = isset($_GET['input']) ? $_GET['input'] : '';
      echo $PaginationController->getPaginationByFilter($filter, $input);
      break;
   case 'orderDetailByID':
      $idAccount = isset($_GET['idaccount']) ? $_GET['idaccount'] : '';
      $idOrder = isset($_GET['idorder']) ? $_GET['idorder'] : '';
      echo $OrderController->getOrderDetailByID($idAccount, $idOrder);
      break;
   case 'productbyid':
      $id = isset($_GET['id']) ? $_GET['id'] : '';
      echo $ProductController->getProductByID($id);
      break;
   case 'cancelOrder':
      $id = isset($_GET['id']) ? $_GET['id'] : '';
      echo $OrderController->cancelOrder($id);
      break;
   case 'checkPromotion':
      $date = isset($_GET['date']) ? $_GET['date'] : '';
      echo $OrderController->checkPromotion($date);
      break;
   case 'checkQuantity':
      $size = isset($_GET['size']) ? $_GET['size'] : '';
      $id = isset($_GET['id']) ? $_GET['id'] : '';
      $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : '';
      echo $OrderController->checkQuantity($id, $size, $quantity);
      break;
   case 'reOrder':
      $id = isset($_GET['id']) ? $_GET['id'] : '';
      echo $OrderController->reOrder($id);
      break;
   case 'statusAll':
      echo $OrderController->getAllStatus();
      break;
   case 'orderByStatus':
      $idAccount = isset($_GET['idaccount']) ? $_GET['idaccount'] : '';
      $idStatus = isset($_GET['idstatus']) ? $_GET['idstatus'] : '';
      echo $OrderController->getOrderByStatus($idAccount, $idStatus);
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
   case 'confirmPay':
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $data = json_decode(file_get_contents("php://input"), true);
         echo  $OrderController->addOrder($data);
      } else {
         echo json_encode(array("error" => "Không nhận được dữ liệu từ client"));
      }
      break;
   default:
      echo json_encode(array('error' => 'Yêu cầu không hợp lệ'));
}


$conn->close();