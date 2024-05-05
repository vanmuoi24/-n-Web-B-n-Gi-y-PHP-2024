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
require_once '../controller/Manage_permissionsController.php';
require_once '../controller/Stastiical.php';
require_once '../controller/Client.php';

$type = isset($_GET['type']) ? $_GET['type'] : '';
$giayController = new GiayController($conn);
$hoadonController  = new DonHangController($conn);
$khuyenmaiController = new KhuyenMaiModel($conn);
$phieunhapcontroller = new Entry_slipcontroller($conn);
$phanquyencontroller = new Manage_permissionsController($conn);
$thongke = new ThongKeController($conn);
$khachhang = new KhachHangController($conn);
switch ($type) {
    case 'giay':
        echo $giayController->layDanhSachGiay();
        break;

    case 'hoadon':
        echo $hoadonController->layDanhSachHoaDon();
        break;
    case 'xoa':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        echo json_encode($giayController->delete($id));
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
    case 'themsanphamoi':

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            $response = $phieunhapcontroller->themmoisanpham($data);
            echo json_encode($response);
        } else {
            echo json_encode("Lỗi: Không nhận được dữ liệu từ client.");
        }
        break;
    case 'dsnhomquyen':
        echo $phanquyencontroller->laydanhsachNhomQuyen();
        break;
    case 'dsaddquyen':
        echo $phanquyencontroller->addquyen();
        break;
    case 'dseditnhomquyen':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        echo json_encode($phanquyencontroller->editnhomquyen($id));
        break;
    case 'luuquyen':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            $response = $phanquyencontroller->luuquyen($data);
            echo json_encode($response);
        } else {
            echo json_encode("Lỗi: Không nhận được dữ liệu từ client.");
        }
        break;
    case 'updatequyen':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            $response = $phanquyencontroller->updatequyen($data);
            echo json_encode($response);
        } else {
            echo json_encode("Lỗi: Không nhận được dữ liệu từ client.");
        }
        break;
    case 'dsthongke':
        echo $thongke->DsThongKe();
        break;

    case 'dschitietHD':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        echo json_encode($thongke->chitietHD($id));
        break;
    case 'dsphantrang':
        $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
        $offset = isset($_POST['offset']) ? $_POST['offset'] : 0;
        $sortOrder = isset($_POST['sortOrder']) ? $_POST['sortOrder'] : 'asc';

        echo $giayController->layDanhSachGiayPhanTrang($limit, $offset, $sortOrder);
        break;

    case 'dsKhachHang':
        echo $khachhang->dsKhachHang();
        break;
    case 'searchday':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            $response = $hoadonController->searchday($data);
            echo json_encode($response);
        } else {
            echo json_encode("Lỗi: Không nhận được dữ liệu từ client.");
        }
        break;
    case 'searchdayTke':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            $response = $thongke->seacrchday($data);
            echo json_encode($response);
        } else {
            echo json_encode("Lỗi: Không nhận được dữ liệu từ client.");
        }
        break;
    case 'capnhattrangthai':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            $response = $hoadonController->capNhatTrangThaiDonHang($data);
            echo json_encode($response);
        } else {
            echo json_encode("Lỗi: Không nhận được dữ liệu từ client.");
        }
        break;
    case 'viewctProduct':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        echo json_encode($giayController->viewctProduct($id));
        break;

    case 'themKhuyenMai':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            $response = $khuyenmaiController->themKhuyenMai($data);
            echo json_encode($response);
        } else {
            echo json_encode("Lỗi: Không nhận được dữ liệu từ client.");
        }
        break;
    default:
        echo json_encode(array('error' => 'Yêu cầu không hợp lệ'));
}


$conn->close();
