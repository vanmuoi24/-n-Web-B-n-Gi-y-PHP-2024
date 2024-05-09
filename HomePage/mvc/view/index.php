<!DOCTYPE html>
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

   <link rel="icon" type="image/png" href="../../public/img/logo.png" />
   <link rel="stylesheet" href="../../public/css/base.css" />
   <link rel="stylesheet" href="../../public/css/reset.css" />
   <link rel="stylesheet" href="../../public/css/index.css" />
   <title>SGU SHOES</title>
</head>

<body>
   <div id="app">
      <header id="header">
         <!--** TOP BAR -->

         <div class="topbar">
            <div class="container">
               <div class="tb-content">
                  <h3 style="text-align: center">
                     Hotline: 0979.345.678 | Free Ship cho đơn hàng trên
                     3tr999 đồng
                  </h3>
               </div>
            </div>
         </div>
         <!--** NAV BAR -->
         <div class="navbar-top">
            <div class="container">
               <div class="nb-content">
                  <div class="nb__left">
                     <div class="nb__left-logo">
                        <a href="index.php"><img src="../../public/img/logo.png" alt="" /></a>
                     </div>
                  </div>
                  <div class="nb__center">
                     <div class="nbc-content">
                        <form class="nb__center-form">
                           <input class="nb__center-inp" type="text" placeholder="Tìm kiếm giày của bạn" />
                           <button class="nb__center-submit" type="submit">
                              <i class="fa-solid fa-magnifying-glass"></i>
                           </button>
                        </form>
                        <div class="nb-center__search">
                           <div class="nbcs-content">
                              <div class="nbcs-result">
                                 <ul class="nbcs-list">
                                 </ul>
                              </div>
                              <div class="nbcs-bottom">
                                 <a class="nbcs-bottom__view">Xem tất cả</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="nb__right">
                     <div class="nbr-content">
                        <div class="nbr__account">
                           <a class="nbr__account-link">
                              <i class="fa-solid fa-user"></i>
                           </a>
                           <ul class="nbra__list">
                              <!-- check auth -->




                           </ul>
                        </div>
                        <span id="usernameLogin" style="color:white ; margin-top:10px ; font-size:1.2rem"></span>

                        <div class="nbr__cart" onclick="showMyCart()">
                           <div class="nbr__cart-link">
                              <i class="fa-solid fa-bag-shopping"></i>
                              <p class="nbr__cart-quantity"></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="navbar-bottom">
            <div class="container">
               <div class="nb-content">
                  <div class="nbb-nav">
                     <ul class="nbb-list">

                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="navbar-sticky">
            <div class="container">
               <div class="nb-content">
                  <div class="nb__left">
                     <div class="nb__left-logo">
                        <a href="index.php"><img src="../../public/img/logo.png" alt="" /></a>
                     </div>
                  </div>
                  <div class="nb__center">
                     <div class="nbc-content">
                        <div class="nbb-nav">
                           <ul class="nbb-list --is-sticky">
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="nb__right">
                     <div class="nbr-content">
                        <div class="nbr__account">
                           <a class="nbr__account-link">
                              <i class="fa-solid fa-user"></i>
                           </a>
                           <ul class="nbra__list">
                              <!-- check auth -->

                           </ul>
                        </div>
                        <div class="nbr__cart" onclick="showMyCart()">
                           <div class="nbr__cart-link">
                              <i class="fa-solid fa-bag-shopping"></i>
                              <p class="nbr__cart-quantity"></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <div id="page-main">
         <div id="page-heading">

         </div>

         <div id="page-body">

         </div>
      </div>
      <footer>
         <div class="container">
            <div class="footer-content">
               <div class="fc__info">
                  <div class="fci__list">
                     <div class="fci__item">
                        <h2 class="--text-spacing-2">
                           SGUSNEAKER - AUTHENTIC
                        </h2>
                        <ul>
                           <li>
                              <p>
                                 Address: 273 Đ.An Dương Vương, P3, Q5,TPHCM
                              </p>
                           </li>
                           <li>
                              <p>Phone: 0903 150 443</p>
                           </li>
                           <li>
                              <p>Open: 10am - 9pm (Tất cả các ngày)</p>
                           </li>
                           <li>
                              <p>Email: cskh@sgusneaker.com</p>
                           </li>
                        </ul>
                     </div>
                     <div class="fci__item">
                        <h2>CHĂM SÓC KHÁCH HÀNG</h2>
                        <ul>
                           <li>
                              <p>Hướng dẫn mua hàng</p>
                           </li>
                           <li>
                              <p>Chính sách bảo mật</p>
                           </li>
                           <li>
                              <p>Bảo hành và đổi trả</p>
                           </li>
                           <li>
                              <p>Vận chuyển và giao nhận</p>
                           </li>
                        </ul>
                     </div>
                     <div class="fci__item">
                        <h2>TÀI KHOẢN VÀ ĐƠN HÀNG</h2>
                        <ul>
                           <li>
                              <p>Thông tin tài khoản</p>
                           </li>
                           <li>
                              <p>Đơn hàng</p>
                           </li>
                        </ul>
                     </div>
                     <div class="fci__item">
                        <h2>CÁC THÔNG TIN KHÁC</h2>
                        <ul>
                           <li>
                              <p>Hình thức thanh toán</p>
                           </li>
                           <li>
                              <p>Điều khoản dịch vụ</p>
                           </li>
                           <li>
                              <p>Đánh giá/ góp ý</p>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="fc__intro">
                  <div class="fc__intro-wrapper">
                     <h2>SGUSneaker Store In Ho Chi Minh City</h2>
                     <p>
                        Tìm kiếm đôi giày sneaker yêu thích của bạn tại
                        SGUSNEAKER, cửa hàng giày sneaker và phụ kiện thời
                        trang đường phố hàng đầu Việt Nam. Tự hào phục vụ hơn
                        5000 khách hàng tại HCM và toàn Việt Nam từ 2024.
                        Chúng tôi có đầy đủ các loại giày sneaker từ các
                        thương hiệu nổi tiếng nhất thế giới từ Nike, Adidas,
                        Converse, Puma…v.v. Đội ngũ nhân viên thân thiện và
                        nhiệt tình sẽ giúp bạn tìm được đôi giày hoàn hảo cho
                        phong cách của mình.
                     </p>

                  </div>
                  <div class="fc__social">
                     <ul>
                        <li>
                           <a href=""><i class="fa-brands fa-facebook"></i></a>
                        </li>
                        <li>
                           <a href=""><i class="fa-brands fa-tiktok"></i></a>
                        </li>
                        <li>
                           <a href=""><i class="fa-brands fa-square-instagram"></i></a>
                        </li>
                        <li>
                           <a href=""><i class="fa-brands fa-square-twitter"></i></a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="fc__certify">
                  <div class="fc__certify-wrapper">
                     <div class="fc__certify-img">
                        <img src="../../public/img/certify1.png" alt="" />
                     </div>
                     <div class="fc__certify-img">
                        <img src="../../public/img/certify2.webp" alt="" />
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="--separate-horizontal"></div>
         <div class="copyright">
            <p>SGUSNEAKER - AUTHENTIC © 2023</p>
         </div>
      </footer>
      <!--  -->
      <!-- BACK TO TOP -->
      <!--  -->
      <div class="back-to-top" onclick="handleBackToTop()">
         <i class="fa fa-angle-up"></i>
      </div>
   </div>
   <div id="modal" class="hide">
   </div>
   <div id="toast"></div>

   <div class="cart">
      <div class="cart-container">
         <div class="cart-top">
            <p class="ct__title">MY CART</p>
            <div class="ct__close" onclick="hideMyCart()">
               <i class="fa-solid fa-xmark"></i>Close
            </div>
         </div>
      </div>
      <div class="cart-body">
         <!-- CART EMPTY -->
         <div class="cb__empty">
            <div class="cbe-wrapper">
               <p class="cbe-icon">
                  <i class="fa-solid fa-cart-shopping"></i>
               </p>
               <p class="cbe-text">Chưa Có Sản Phẩm Trong Giỏ Hàng</p>
            </div>

         </div>
         <!-- CART LIST -->
         <div class="cb__carts">
            <ul class="cbc-list">

            </ul>
         </div>
      </div>
      <div class="cart-bottom">
         <div class="cbottom__pay">
            <div class="cbp__total">
               <p class="cbp__title">Tạm tính:</p>
               <p class="cbp__price"></p>
            </div>
            <div class="cbp__mycart" onclick="loadCartPage()">XEM GIỎ HÀNG</div>

            <div onclick="loadPayPage()" class="btn btn--primary cbp__btn">THANH TOÁN</div>
         </div>
      </div>
   </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
   <script type="text/javascript" src="../../public/js/lib/helper.js"></script>
   <script type="text/javascript" src="../../public/js/lib/toast.js"></script>
   <script type="text/javascript" src="../../public/js/lib/validator.js"></script>

   <script type="text/javascript" src="../../index.js"></script>
   <script type="text/javascript" src="../../public/js/filter.js"></script>
   <script type="text/javascript" src="../../public/js/home.js"></script>
   <script type="text/javascript" src="../../public/js/detail.js"></script>
   <script type="text/javascript" src="../../public/js/brand.js"></script>
   <script type="text/javascript" src="../../public/js/product.js"></script>
   <script type="text/javascript" src="../../public/js/pagination.js"></script>
   <script type="text/javascript" src="../../public/js/sidebar.js"></script>
   <script type="text/javascript" src="../../public/js/search.js"></script>
   <script type="text/javascript" src="../../public/js/detail.js"></script>
   <script type="text/javascript" src="../../public/js/account.js"></script>
   <script type="text/javascript" src="../../public/js/cart.js"></script>
   <script type="text/javascript" src="../../public/js/pay.js"></script>
   <script type="text/javascript" src="../../public/js/ordered.js"></script>
</body>

</html>