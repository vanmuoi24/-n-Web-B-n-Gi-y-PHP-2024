<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ql_banhanggiay";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
require_once '../model/Promotion.php';
require_once '../model/Entry_Slip.php';
require_once '../controller/Productcontroller.php';
require_once '../controller/Reciept.php';
require_once '../controller/Promotioncontroller.php';
require_once '../controller/Entry_slipcontroller.php';
$type = isset($_GET['type']) ? $_GET['type'] : '';

$giayController = new GiayController($conn);
$hoadonController  = new DonHangController($conn);
$khuyenmaiController = new KhuyenMaiModel($conn);
$phieunhapcontroller = new Entry_slipcontroller($conn);
switch ($type) {
    case 'giay':
        echo $giayController->layDanhSachGiay();
        break;

    case 'hoadon':
        echo $hoadonController->layDanhSachHoaDon();
        break;
    case 'xoa':
        echo $giayController->delete();
        break;
    case 'cthoadon':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        echo json_encode($hoadonController->chitiethoadon($id));
        break;
    case 'danhsachKM':
        echo  json_encode($khuyenmaiController->LayDanhSachKhuyenMai());
        break;

    case 'dsphieunhap':
        echo  $phieunhapcontroller->LayDanhSachPhieuNhap();
        break;
    case 'dssanpham':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        echo json_encode($phieunhapcontroller->GiaTriSanPham($id));
        break;
    case 'ds4table':
        echo $phieunhapcontroller->get4table();
        break;
    case 'dschitiethd':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        echo json_encode($phieunhapcontroller->ChiTietPhieuNhap($id));
        break;
    default:
        echo json_encode(array('error' => 'Yêu cầu không hợp lệ'));
}


$conn->close();
