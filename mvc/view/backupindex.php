<?php
session_start();

$_SESSION['account'] = 'KH01';
?>
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
                     Hotline: 0903.150.443 | Free Ship cho đơn hàng trên
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
                        <div class="nbr__account"
                           <?php echo isset($_SESSION['account']) ? 'onclick="loadInfo(' . "'" . $_SESSION["account"] . "'" . ')"' : ''  ?>>
                           <a class="nbr__account-link">
                              <i class="fa-solid fa-user"></i>
                           </a>
                           <ul class="nbra__list">
                              <!-- check auth -->
                              <?php if (isset($_SESSION['account']))
                                 echo
                                 '

                                    <li class="nbra__item" onclick="loadInfo(' . "'" . $_SESSION["account"] . "'" . ')">
                                       Thông tin
                                    </li>
                                    <li class="nbra__item">
                                       Đơn hàng
                                    </li>
                                    <li class="nbra__item">
                                       Đăng xuất
                                    </li>                                 
                                 ';
                              else echo
                              '
                                    <li class="nbra__item">
                                       Đăng nhập
                                    </li>
                                    <li class="nbra__item">
                                       Đăng kí
                                    </li> 
                                 '
                              ?>
                           </ul>
                        </div>


                        <div class="nbr__cart" onclick="showMyCart()">
                           <div class="nbr__cart-link">
                              <i class="fa-solid fa-bag-shopping"></i>
                              <p class="nbr__cart-quantity">10</p>
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
                        <!-- <li class="nbb-item">
                           <a href="" class="nbb-link">NIKE</a>
                        </li>
                        <li class="nbb-item">
                           <a href="" class="nbb-link">ADIDAS</a>
                        </li>
                        <li class="nbb-item">
                           <a href="" class="nbb-link">PUMA</a>
                        </li>
                        <li class="nbb-item">
                           <a href="" class="nbb-link">CONVERSE</a>
                        </li> -->
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
                              <li class="nbb-item --is-sticky">
                                 <a href="" class="nbb-link">NIKE</a>
                              </li>
                              <li class="nbb-item --is-sticky">
                                 <a href="" class="nbb-link">ADIDAS</a>
                              </li>
                              <li class="nbb-item --is-sticky">
                                 <a href="" class="nbb-link">PUMA</a>
                              </li>
                              <li class="nbb-item --is-sticky">
                                 <a href="" class="nbb-link">CONVERSE</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="nb__right">
                     <div class="nbr-content">
                        <div class="nbr__account">
                           <a href="" class="nbr__account-link">
                              <i class="fa-solid fa-user"></i>
                           </a>
                           <ul class="nbra__list">
                              <!-- check auth -->
                              <?php if (isset($_SESSION['user']))
                                 echo
                                 '
                                    <li class="nbra__item">
                                       Thông tin
                                    </li>
                                    <li class="nbra__item">
                                       Đơn hàng
                                    </li>
                                    <li class="nbra__item">
                                       Đăng xuất
                                    </li>                                 
                                 ';
                              else echo
                              '
                                    <li class="nbra__item">
                                       Đăng nhập
                                    </li>
                                    <li class="nbra__item">
                                       Đăng kí
                                    </li> 
                                 '
                              ?>
                           </ul>
                        </div>


                        <div class="nbr__cart" onclick="showMyCart()">
                           <div class="nbr__cart-link">
                              <i class="fa-solid fa-bag-shopping"></i>
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
            <div class="container">
               <h1>
                  GIÀY SNEAKER AUTHENTIC
               </h1>
            </div>
         </div>
         <div id="page-body">
            <div class="container">
               <div class="product">
                  <!-- <div class="product-sidebar">
                     <div class="ps-collection">
                        <h2>COLLECTION</h2>
                        <div class="pst-content">
                           <ul class="pst-list">
                           </ul>
                        </div>
                     </div>
                     <div class="--separate-line"></div>
                     <div class="ps-material">
                        <h2>CHẤT LIỆU</h2>
                        <div class="psm-content">
                           <ul class="psm-list">
                           </ul>
                        </div>
                     </div>
                     <div class="--separate-line"></div>
                     <div class="ps-color">
                        <h2>MÀU SẮC</h2>
                        <div class="psc-content">
                           <ul class="psc-list">
                           </ul>
                        </div>
                     </div>
                     <div class="--separate-line"></div>
                     <div class="ps-size">
                        <h2>SIZE</h2>
                        <div class="pss-content">
                           <select class="pss-select" onchange="showProductBySize(this)">
                              <option class="pss-opt" value="default">--</option>
                           </select>
                        </div>
                     </div>
                     <div class="--separate-line"></div>

                     <div class="ps-price">
                        <h2>KHOẢNG GIÁ</h2>
                        <div class="psp-content">
                           <div id="form-filter-price" class="psp-form">
                              <div class="psp-form-group">
                                 <span>Từ</span>
                                 <input type="number" name="from-price" id="from-price" class="psp-from-price">
                                 <span>-</span>
                                 <input type="number" name="to-price" id="to-price" class="psp-to-price">
                              </div>
                              <p class="ps-price-error"></p>
                              <button id="submit-price" onclick="showProductByPrice()" class="psp-submit-price">
                                 Lọc giá
                              </button>
                           </div>
                        </div>
                     </div>
                  </div> -->
                  <div class="product-main">
                     <div class="pm-wrapper">
                        <div class="pm-top">
                           <div class="pm-filter">
                              <select name="" id="">
                                 <option value="mac-dinh" selected>Mặc định</option>
                                 <option value="moi-nhat">Mới nhất</option>
                                 <option value="tang-dan">Tăng dần</option>
                                 <option value="giam-dan">Giảm dần</option>
                              </select>
                           </div>
                        </div>
                        <div class="pm-body">
                           <div class="pmb-wrapper">
                              <div class="pmb-content">
                                 <div class="pmb-products">
                                    <ul class="pmbp-list">

                                    </ul>
                                 </div>
                                 <div class="pmb-pagination">
                                    <div class="pmbpagi__body">
                                       <ul class="pmbpagi__list">

                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              <div class="pmb-news">
                                 <h2>
                                    Giày Sneaker Nam Cho Bạn Tại SGUSneaker
                                 </h2>
                                 <div>
                                    <p>
                                       Mọi chàng trai đều cần một đôi Sneaker để
                                       trở nên tuyệt vời - và may mắn cho bạn,
                                       lựa chọn giày Sneaker tại SGUSneaker còn
                                       tuyệt vời hơn nữa. Được thành lập và phát
                                       triển từ 2024 - SGUSneaker tin rằng những
                                       sản phẩm chất lượng của chúng tôi sẽ đi
                                       cùng bạn đến cũ mòn. Chúng tôi đã phát
                                       triển thành một thương hiệu uy tín, đẩy
                                       mạnh văn hóa Sneaker, Streetwear và giúp
                                       những chàng trai như bạn nổi bật. Bạn
                                       đang tìm kiếm một đôi giày Sneaker Nam
                                       hoàn hảo?
                                    </p>
                                    <p class="pmb-news__continue">
                                       Giầy thể thao nam Nike và giày
                                       thể thao Adidas nam, giày New Balance nam
                                       là một trong những thương hiệu tốt cho
                                       bạn. Bạn có thể kéo xuống dưới và tìm
                                       kiếm một đôi giầy Sneaker phù hợp với
                                       mình.<br />
                                       Bạn có thể ấn xem tiếp và tham khảo
                                       một số đôi giầy Sneaker phù hợp với mình.
                                    </p>
                                 </div>
                                 <div class="pbm-news__btn-continue">Xem tiếp...</div>
                                 <div class="pmb-news__hidden">
                                    <div class="pmb-news__item">
                                       <img src="../../public/img/new1.jpg" alt="">
                                       <p>EQT Support ADV White tại SGUSneaker</p>
                                    </div>
                                    <h2>“Nhập Môn” Chọn Giày Sneaker Nam</h2>
                                    <p>
                                       Nếu bạn lần đầu đến với Sneaker thì những item càng đơn giản càng phù hợp với
                                       bạn.
                                       Bạn có thể tìm kiếm bên dưới những đôi Converse với các colorways
                                       (phối màu) trắng đen hoặc vàng.
                                       Chắc chắn bạn cũng cần một số đôi giày Sneaker có nhiều công nghệ để hỗ trợ. Vậy
                                       thì
                                       Adidas Prophere hoặc Nike Air Max 90 là những mẫu giày vừa khỏe khoắn vừa phù
                                       hợp.
                                       Sẽ thế nào nếu bắt đầu với một đôi “All in one”, đây cũng là sự lựa chọn của rất
                                       nhiều Khách hàng khi đến với SaigonSneaker.com. Chắc chắn Nike Air Force hoặc
                                       Adidas
                                       Stan Smith sẽ là những cái tên xuất hiện trong đầu của chúng tôi khi gợi ý cho
                                       bạn.
                                    </p>
                                    <div class="pmb-news__item">
                                       <img src="../../public/img/new5.jpg" alt="">
                                       <p>Converse Chuck 70 Low Top Black (1970s)</p>
                                    </div>
                                    <h2>Giày Nam Sneaker Cho Các Tín Đồ Thời Trang</h2>
                                    <p>
                                       Nếu như bạn là một người yêu thích thời trang, muốn mix & match những phụ kiện
                                       đẹp
                                       nhất và thời trang nhất lên người. Hãy tìm Balenciaga Triple S hoặc Adidas Yeezy
                                       vì
                                       chúng là những mẫu sneaker cho nam tuyệt vời.
                                       Tại SaigonSneaker.com luôn có những mẫu giày đẹp nhất và luôn là những đôi
                                       sneaker
                                       trending với Nike Air Force x G-DRAGON hay đôi Converse CDG tuyệt đẹp của
                                       Converse
                                       collab cùng CDG.</p>
                                    <div class="pmb-news__item">
                                       <img src="../../public/img/new3.webp" alt="">
                                       <p>Đôi giày mới nhất Nike Air Force I x G Dragon</p>
                                    </div>
                                    <h2>Sneaker Dành Cho Những Chàng Trai Thích Thể Thao</h2>
                                    <p>
                                       Nếu như bạn muốn một đôi giày nào đó dành cho các hoạt động thể chất như chạy bộ,
                                       cầu lông hay Gym thì các bạn có thể tìm kiếm Adidas AlphaBounce hoặc Nike Air Max
                                       97
                                       tại SaigonSneaker.com.
                                       Những đôi Sneaker hỗ trợ những công nghệ tuyệt vời để bạn có thể thoải mái trên
                                       từng
                                       bước di chuyển. Đế Bounce cực êm ái của AlphaBounce, PrimeKnit giúp ôm trọn thân
                                       giày của Nike Air Max 270,..tất cả đều có tại cửa hàng của chúng tôi.
                                       Nếu như bạn đang có những nhu cầu khác, đừng ngần ngại hãy inbox vào Fanpage của
                                       chúng tôi để nhận được tư vấn. Hoặc bạn có thể chọn bất cứ mẫu giày Sneaker Nam
                                       nào
                                       phù hợp với mình ngay website của SaigonSneaker.com</p>
                                    <div class="pmb-news__item">
                                       <img src="../../public/img/new2.webp" alt="">
                                       <p>Adidas AlphaBounce – Đôi giày vừa thời trang vừa Sporty</p>
                                    </div>
                                    <p>
                                       Nếu là bạn, bạn sẽ chọn đôi giày nào cho mình? Đơn giản chỉ là kéo xuống và tìm
                                       kiếm
                                       một đôi giày thích hợp thôi phải không nào.
                                       Bạn có thể mua trực tiếp trên website của SaigonSneaker.com hoăc đến ngay
                                       Showroom
                                       của chúng tôi để onfeet và lựa chọn những đôi giày Sneaker nam phù hợp nhất.
                                       Nếu bạn lo ngại rằng những đôi giày sneaker nam chính hãng sẽ có giá quá cao so
                                       với
                                       “túi tiền” của bạn thì đến với SaigonSneaker.com, bạn sẽ xóa bỏ được nỗi lo lắng
                                       này.
                                       Vì chúng tôi luôn có những đợt khuyến mãi lớn lên tới 50%, giúp quý khách hàng sở
                                       hữu được những đôi giày chất lượng với giá phải chăng.
                                       Hy vọng rằng SaigonSneaker.com sẽ được cùng bạn đồng hành trên những bước chân
                                       tiếp
                                       theo.
                                       Nếu bạn đang muốn tìm một đôi giày sneaker nữ đẹp và chất lượng thì có thể tham
                                       khảo
                                       tại https://saigonsneaker.com/collections/giay-sneaker-nu/
                                    </p>
                                    <div class="pmb-news__btn-hidden">Ẩn chi tiết</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
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
         <!-- <div class="cb__empty">
               <div class="cbe-wrapper">
                  <p class="cbe-icon">
                     <i class="fa-solid fa-cart-shopping"></i>
                  </p>
                  <p class="cbe-text">Chưa Có Sản Phẩm Trong Giỏ Hàng</p>
               </div>
               <div class="cbe-return">
                  <a href="">RETURN TO SHOP</a>
               </div>
            </div> -->
         <!-- CART LIST -->
         <div class="cb__carts">
            <ul class="cbc-list">
               <li class="cbc-item">
                  <div class="cbc-img">
                     <img src="../../public/img/giay.jpg" alt="" />
                  </div>
                  <div class="cbc-info">
                     <p class="cbc-info__name">Giày nike air force 1</p>
                     <p class="cbc-info__size">Size <span> 43</span></p>
                     <p class="cbc-info__quantity" style="display: inline-block">
                        1
                     </p>
                     <i class="fa-solid fa-xmark"></i>
                     <p class="cbc-info__price" style="display: inline-block">
                        1.990.000 VNĐ
                     </p>
                  </div>
                  <div class="cbc-remove">
                     <i class="fa-solid fa-xmark"></i>
                  </div>
               </li>
               <li class="cbc-item">
                  <div class="cbc-img">
                     <img src="../../public/img/giay.jpg" alt="" />
                  </div>
                  <div class="cbc-info">
                     <p class="cbc-info__name">Giày nike air force 1</p>
                     <p class="cbc-info__size">Size <span> 43</span></p>
                     <p class="cbc-info__quantity" style="display: inline-block">
                        1
                     </p>
                     <i class="fa-solid fa-xmark"></i>
                     <p class="cbc-info__price" style="display: inline-block">
                        1.990.000 VNĐ
                     </p>
                  </div>
                  <div class="cbc-remove">
                     <i class="fa-solid fa-xmark"></i>
                  </div>
               </li>
               <li class="cbc-item">
                  <div class="cbc-img">
                     <img src="../../public/img/giay.jpg" alt="" />
                  </div>
                  <div class="cbc-info">
                     <p class="cbc-info__name">Giày nike air force 1</p>
                     <p class="cbc-info__size">Size <span> 43</span></p>
                     <p class="cbc-info__quantity" style="display: inline-block">
                        1
                     </p>
                     <i class="fa-solid fa-xmark"></i>
                     <p class="cbc-info__price" style="display: inline-block">
                        1.990.000 VNĐ
                     </p>
                  </div>
                  <div class="cbc-remove">
                     <i class="fa-solid fa-xmark"></i>
                  </div>
               </li>
               <li class="cbc-item">
                  <div class="cbc-img">
                     <img src="../../public/img/giay.jpg" alt="" />
                  </div>
                  <div class="cbc-info">
                     <p class="cbc-info__name">Giày nike air force 1</p>
                     <p class="cbc-info__size">Size <span> 43</span></p>
                     <p class="cbc-info__quantity" style="display: inline-block">
                        1
                     </p>
                     <i class="fa-solid fa-xmark"></i>
                     <p class="cbc-info__price" style="display: inline-block">
                        1.990.000 VNĐ
                     </p>
                  </div>
                  <div class="cbc-remove">
                     <i class="fa-solid fa-xmark"></i>
                  </div>
               </li>
               <li class="cbc-item">
                  <div class="cbc-img">
                     <img src="../../public/img/giay.jpg" alt="" />
                  </div>
                  <div class="cbc-info">
                     <p class="cbc-info__name">Giày nike air force 1</p>
                     <p class="cbc-info__size">Size <span> 43</span></p>
                     <p class="cbc-info__quantity" style="display: inline-block">
                        1
                     </p>
                     <i class="fa-solid fa-xmark"></i>
                     <p class="cbc-info__price" style="display: inline-block">
                        1.990.000 VNĐ
                     </p>
                  </div>
                  <div class="cbc-remove">
                     <i class="fa-solid fa-xmark"></i>
                  </div>
               </li>
               <li class="cbc-item">
                  <div class="cbc-img">
                     <img src="../../public/img/giay.jpg" alt="" />
                  </div>
                  <div class="cbc-info">
                     <p class="cbc-info__name">Giày nike air force 1</p>
                     <p class="cbc-info__size">Size <span> 43</span></p>
                     <p class="cbc-info__quantity" style="display: inline-block">
                        1
                     </p>
                     <i class="fa-solid fa-xmark"></i>
                     <p class="cbc-info__price" style="display: inline-block">
                        1.990.000 VNĐ
                     </p>
                  </div>
                  <div class="cbc-remove">
                     <i class="fa-solid fa-xmark"></i>
                  </div>
               </li>
               <li class="cbc-item">
                  <div class="cbc-img">
                     <img src="../../public/img/giay.jpg" alt="" />
                  </div>
                  <div class="cbc-info">
                     <p class="cbc-info__name">Giày nike air force 1</p>
                     <p class="cbc-info__size">Size <span> 43</span></p>
                     <p class="cbc-info__quantity" style="display: inline-block">
                        1
                     </p>
                     <i class="fa-solid fa-xmark"></i>
                     <p class="cbc-info__price" style="display: inline-block">
                        1.990.000 VNĐ
                     </p>
                  </div>
                  <div class="cbc-remove">
                     <i class="fa-solid fa-xmark"></i>
                  </div>
               </li>
            </ul>
         </div>
      </div>
      <div class="cart-bottom">
         <div class="cbottom__pay">
            <div class="cbp__total">
               <p class="cbp__title">Tổng tiền:</p>
               <p class="cbp__price">1.990.000 VNĐ</p>
            </div>
            <div class="cbp__mycart">XEM GIỎ HÀNG</div>

            <div class="cbp__btn">THANH TOÁN</div>
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
</body>

</html>