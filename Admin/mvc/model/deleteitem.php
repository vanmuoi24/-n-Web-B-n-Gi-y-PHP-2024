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

$conn->close();
