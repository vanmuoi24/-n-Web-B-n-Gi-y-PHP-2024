<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "ql_banhang_giay";
$conn = new mysqli($servername, $username, $password, $database);
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

if (isset($_POST['item_id'])) {
    $itemId = $_POST['item_id'];
    echo $itemId;
    $sql = "SELECT * FROM giay WHERE MaGiay = '$itemId'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(array('error' => 'Không có mục nào được tìm thấy'));
    }
} else {
    echo json_encode(array('error' => 'Không có thông tin mục được cung cấp'));
}

$conn->close();
