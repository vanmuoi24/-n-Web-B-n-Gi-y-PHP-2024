<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../public/css/index.css" />
    <title>Document</title>
</head>
<style>
/* Reset CSS */



.thong-ke ul {
    list-style: none;
    padding: 0;
}

.thong-ke ul li {
    font-size: 1.2rem;

    color: white;
    padding: 30px 30px 30px 30px;
    border-radius: 5px;
    display: inline-block;
    margin-right: 20px;

}

.thong-ke ul li span {
    font-weight: bold;
}

.loc {
    border: 1px solid #ddd;
    padding: 10px;
}

.loc div {
    display: flex;
    align-items: center;
    justify-content: center;
}

.loc {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.loc div {
    height: 40px;
}

.loc input {
    height: 40px;
}

#seacrch {
    outline: none;
    width: 150%;
    margin-bottom: 5px;

}

.loc button {
    width: 100%;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
}

.bang-thong-ke table {
    width: 100%;
    margin-top: 10px;
}

.bang-thong-ke table th {
    background-color: #007bff;
    color: white;
}
</style>

<body>
    <div class="container">
        <div class="header">
            <div class="img">
                <img src="../src/img/logoadmin.jpg" alt="logo" />
                <span>Admin</span>
            </div>
            <div class="search">
                <input type="text" id="fname" name="fname" />
            </div>
            <div class="icon_header">
                <div>
                    <i class="fa-solid fa-expand"></i>
                </div>
                <div><i class="fa-regular fa-bell"></i></div>

                <div style="
              display: flex;
              justify-content: center;
              align-items: center;
              gap: 10px;
            ">
                    <img src="../src/img/Ellipse 4.png" alt="" /> <span>muoi</span>
                    <div>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                </div>

                <div><i class="fa-solid fa-gear"></i></div>
            </div>
        </div>
        <div class="header_content">
            <div class="content_side">
                <div class="side_item" onclick="handleHome()">
                    <div><i class="fa-solid fa-user"></i></div>
                    <div><span>Trang Chủ</span></div>
                </div>
                <div class="side_item" onclick="handleProduct()">
                    <div>
                        <i class="fa-solid fa-shop"></i>
                    </div>
                    <div><span>Quản Lí Sản Phẩm</span></div>
                </div>
                <div class="side_item" onclick="handleOrder()">
                    <div><i class="fa-solid fa-truck-fast"></i></div>
                    <div><span>Quản Lí Đơn Hàng</span></div>
                </div>
                <div class="side_item" onclick="handleReceipt()">
                    <div><i class="fa-solid fa-pen"></i></div>
                    <div><span>Quản Lí Phiếu Nhập</span></div>
                </div>
                <div class="side_item" onclick="handleclient()">
                    <div><i class="fa-solid fa-user"></i></div>
                    <div><span>Quản lí Khách Hàng</span></div>
                </div>
                <div class="side_item" onclick="Manage_permissions()">
                    <div><i class="fa-solid fa-user-group"></i></i></div>
                    <div>
                        <p>Quản Lí Quyền </p>
                    </div>
                </div>
                <div class="side_item" id="promotion_item" onclick="handlePromotion()">
                    <div><i class="fa-solid fa-money-bill-wave"></i></div>
                    <div>
                        <p>Khuyến Mãi</p>
                    </div>
                </div>
                <div class="side_item" onclick="handleStastical()">
                    <div><i class="fa-solid fa-chart-simple"></i></div>
                    <div>
                        <p>Thống Kê</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="Mange_client">
            <div class="admin_home">
                <h4>Chào Mừng Đến Với Admin</h4>
            </div>
            <div>
                <h1>THỐNG KÊ CỬA HÀNG GIÀY</h1>
            </div>
            <div>
                <div class="thong-ke">

                    <ul>
                        <li style="background-color: #007bff;">
                            <span>Số lượng đơn hàng:</span>
                            <span id="so-luong-don-hang">36</span>
                        </li>
                        <li style="background-color: red;">
                            <span>Số lượng bán ra:</span>
                            <span id="so-luong-ban-ra">15</span>
                        </li>
                        <li style="background-color: #1BCD32">
                            <span>Doanh thu:</span>
                            <span id="doanh-thu">10.850.000 ₫</span>
                        </li>
                    </ul>
                </div>
                <div class="loc">
                    <div>
                        <label for="tu-ngay">Từ ngày : </label>
                        <input type="date" id="tu-ngay" name="tu-ngay">
                    </div>
                    <div><label for="den-ngay">Đến ngày : </label>
                        <input type="date" id="den-ngay" name="den-ngay">
                    </div>
                    <div style="width: 40%;">
                        <input type="text" name="" id="seacrch" placeholder="Tìm kiếm sản phẩm">
                    </div>
                    <div style="width: 10%;"> <button><i class="fa-solid fa-magnifying-glass"></i></button></div>

                </div>
                <div class="bang-thong-ke">

                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ẢNH SẢN PHẨM</th>
                                <th>TÊN SẢN PHẨM</th>
                                <th>SỐ LƯỢNG BÁN RA</th>
                                <th>DOANH THU</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><img src="images/ao-khoac-nam-hoodie-ni-bong.jpg" alt="Áo khoác nam hoodie nỉ bóng">
                                </td>
                                <td>Áo khoác nam hoodie nỉ bóng</td>
                                <td>6</td>
                                <td>2.130.000 ₫</td>
                                <td><a href="#">Xem chi tiết</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../"></script>
    <script src="../../public/js/Client.js"></script>
    <script src="../../public/js/Product.js"></script>
    <script src="../../public/js/Promotion.js"></script>
    <script src="../../public/js/Receipt.js"></script>
    <script src="../../public/js/Entry.js"></script>
    <script src="../../public/js/Manage_permissions.js"></script>
    <script src="../../public/js/handleStastical.js"></script>
</body>

</html>