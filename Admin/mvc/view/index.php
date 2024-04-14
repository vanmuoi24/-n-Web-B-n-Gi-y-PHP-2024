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
                <div class="side_item" onclick="handleHome(this)">
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
                <div class="side_item" onclick=" handleStastical()">
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
            <div style="width: 100%">
                <img src="../../src/img/Cover.png" alt="" style="width: 100%">
            </div>

        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../"></script>

    <script src="../../public/js/Product.js"></script>
    <script src="../../public/js/Promotion.js"></script>
    <script src="../../public/js/Receipt.js"></script>
    <script src="../../public/js/Entry.js"></script>
    <script src="../../public/js/Manage_permissions.js"></script>
    <script src="../../public/js/Statistical.js"></script>
    <script src="../../public/js/Home.js"></script>
    <script src="../../public/js/Client.js"></script>


</body>

</html>