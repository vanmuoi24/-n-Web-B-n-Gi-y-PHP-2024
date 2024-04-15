<?php
    $localhost="localhost";
    $user="root";
    $password= "";
    $database="ql_banhanggiay";
    $conn = mysqli_connect($localhost,$user,$password,$database);
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . $conn->connect_error;
    }else {
        echo "";
    }
    require_once '../Controller/RegisterController.php';
    require_once '../Controller/LoginController.php';
    
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $loginController = new LoginController($conn);
    $registerController  = new RegisterController($conn);
    switch ($type) {
        case 'dangnhap':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = json_decode(file_get_contents("php://input"), true);
                $response = $loginController->Login($data);
                echo json_encode($response);
            } else {
                echo json_encode("Lỗi: Không nhận được dữ liệu từ client.");
            }
            break;
        case 'dangki':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = json_decode(file_get_contents("php://input"), true);
                $response = $registerController->Register($data);
                echo json_encode($response);
            } else {
                echo json_encode("Lỗi: Không nhận được dữ liệu từ client.");
            }
            break;
        default:
    }

?>