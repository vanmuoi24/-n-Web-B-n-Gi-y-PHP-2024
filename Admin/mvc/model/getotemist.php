<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ql_banhang_giay";

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $database);
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$sql = "SELECT * FROM giay";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<div class='table_product'><table id='table_product'><tr><th>STT</th><th>Tên Sản Phẩm</th><th>Thương Hiệu</th><th>Số Lượng</th><th>Hình Ảnh</th><th>Giá Tiền</th><th>Hành Động</th></tr>";
    $dem = 0;
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $dem++ . "</td><td>" . $row["Tengia"] . "</td><td>" . $row["SoLuong"] . "</td><td>" . $row["DonGia"] . "</td><td><img src='" . $row["HinhAnh"] . "'></td><td>" . $row["DonGia"] . "</td><td><i class='fa-solid fa-eye' style='color: #0078ff' onclick='view_product()'></i><i class='fa-solid fa-pen' style='color: #25bad8'></i><i class='fa-solid fa-trash-can' style='color: red' onclick='handleDeleteItem(\"" . $row["MaGiay"] . "\")'></i></td></tr>";
    }
    echo "</table></div>";
} else {
    echo "Không có sản phẩm nào.";
}
$conn->close();
