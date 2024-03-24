<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css//index.css" />
    <title>Document</title>
</head>

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
                <a href="./Product.php" class="side_item">
                    <div>
                        <i class="fa-solid fa-shop"></i>
                    </div>
                    <div><span>Quản Lí Sản Phẩm</span></div>
                </a>
                <div class="side_item" onclick="handleOrder()">
                    <div><i class="fa-solid fa-truck-fast"></i></div>
                    <div><span>Quản Lí Đơn Hàng</span></div>
                </div>
                <a href="./Entry_Slip.php" class="side_item" onclick="handleReceipt()">
                    <div><i class="fa-solid fa-pen"></i></div>
                    <div><span>Quản Lí Phiếu Nhập</span></div>
                </a>
                <a href="./Client.php" class="side_item" onclick="handleclient()">
                    <div><i class="fa-solid fa-user"></i></div>
                    <div><span>Quản lí Khách Hàng</span></div>
                </a>
                <div class="side_item" onclick="handleStastical()">
                    <div><i class="fa-solid fa-chart-simple"></i></div>
                    <div>
                        <p>Thống Kê</p>
                    </div>
                </div>
                <div class="side_item" onclick="handlePromotion()">
                    <div><i class="fa-solid fa-money-bill-wave"></i></div>
                    <div>
                        <p>Khuyến Mãi</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="Mange_client">
            <div class="admin_home">
                <h4>Chào Mừng Đến Với Admin</h4>
                <!-- <div class="home_img1">
            <img src="../src//img/NIKE.png" alt="" />
          </div>
          <div class="home_img2">
            <img src="../src/img/Shoe 1.png" alt="" />
          </div> -->
            </div>
            <!-- Vocher -->


            <div>
                <div class="table_product">
                    <table id="table_product">
                        <tr>
                            <th>STT</th>
                            <th>Họ và Tên</th>
                            <th>Địa Chỉ</th>
                            <th>Giới Tính</th>
                            <th>email</th>

                            <th>Hành Động</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Văn Mười</td>
                            <td>Dak Lak</td>
                            <td>Nam</td>
                            <td>domuoigghh@gmail.com</td>
                            <td>
                                <i class="fa-solid fa-pen-to-square" style="color: #04b64b"></i>
                                <i class="fa-solid fa-trash-can" style="color: #ff4a4a"></i>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="../js/Home.js"></script>
    <script src="../js/Client.js"></script>
    <script src="../js/Product.js"></script>
    <script src="../js/Promotion.js"></script>
    <script src="../js/Receipt.js"></script>
    <script src="../js/Entry.js"></script>

</body>

</html>