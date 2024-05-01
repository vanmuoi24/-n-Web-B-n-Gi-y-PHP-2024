function loadProductInPay() {
  const dataCart = localStorage.getItem("carts")
    ? JSON.parse(localStorage.getItem("carts"))
    : [];
  //
  renderProductInPay(dataCart);
}

function renderProductInPay(data) {
  if (data.length === 0) {
    return;
  }
  let htmls = "";
  let totalPrice = 0;
  data.map((item, index) => {
    let price = (
      item.priceDiscountProduct ? item.priceDiscountProduct : item.priceProduct
    ).replace(/[^0-9]/g, "");
    price *= parseInt(item.quantity);
    totalPrice += parseInt(price);
    //
    htmls += `
      <tr>
      <td>
         <div class="pr-product">
            <div class="pr-img">
               <img
                  src="${item.imgProduct}"
                  alt="${item.nameProduct}">
            </div>
            <span class="pr-name">
					${item.nameProduct} 
				</span>
            <span data-size=${item.idSize}  class="pr-size">
				- ${item.sizeProduct} 
				</span>
            <span class="pr-quantity"> - x${item.quantity}</span>
            <span class="pr-percent" ${
              item.idDiscount ? `data-iddiscount="${item.idDiscount}"` : ""
            }>${
      item.percentDiscount ? ` - Giảm ${item.percentDiscount}%` : ""
    }</span>
         </div>
      </td>
      <td>
         <p class="pr-price"> ${formatCurrency(price)}</p>
      </td>
   </tr>               		

      `;
  });

  if (totalPrice >= 3999000) {
    document.querySelectorAll(".pr-ship-value")[1].classList.add("unactive");
    document.querySelectorAll(".pr-ship-value")[0].classList.remove("unactive");
    document.querySelector(".mcr-total-value").innerText =
      formatCurrency(totalPrice);
  } else
    document.querySelector(".mcr-total-value").innerText = formatCurrency(
      totalPrice + 35000
    );
  document.querySelector(".mcr-prev-total-value").innerText =
    formatCurrency(totalPrice);

  document.querySelector(".pr-detail").innerHTML = htmls;
  valid(document.getElementById("pay-info-form"), confirmPay);
}

function confirmPay() {
  const condition = 3999000;
  if (confirm("Bạn đã cung cấp thông tin chính xác")) {
    const id = JSON.parse(localStorage.getItem("accountID"));
    const firstname = document.getElementById("firstname").value;
    const lastname = document.getElementById("lastname").value;
    const phone = document.getElementById("phone").value;
    const email = document.getElementById("email").value;
    const address = document.getElementById("address").value;
    const note = document.getElementById("note").value;
    const carts = JSON.parse(localStorage.getItem("carts"));
    const datePay = formatDate(new Date());
    const freeship =
      document
        .querySelector(".mcr-prev-total-value")
        .innerText.replace(/[^0-9]/g, "") >= condition
        ? "KM002"
        : "";
    const total = document
      .querySelector(".mcr-total-value")
      .innerText.replace(/[^0-9]/g, "");

    //
    // replace(/[^0-9]/g, '')
    const dataInfo = {
      id,
      firstname,
      lastname,
      phone,
      email,
      address,
      note,
      carts,
      datePay,
      freeship,
      total,
    };
    console.log("data pay: ", dataInfo);
    // handle ajax
    var xhr = new XMLHttpRequest();
    xhr.open("POST", `../../mvc/API/index.php?type=confirmPay`, true);
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = JSON.parse(xhr.responseText);
        console.log("confirm pay: ", response);
        if (response.status) {
          loadCompleteOrder();
          loadCartMini();
          toast({
            title: response.title,
            message: response.msg,
            type: "success",
            duration: 3000,
          });
        }
      }
    };
    xhr.send(JSON.stringify(dataInfo));

    localStorage.removeItem("carts");
  }
}

function loadInfoInPay() {
  const id = JSON.parse(sessionStorage.getItem("username"));

  handleInfo(id.tendn, renderInfoInPay);
}
function renderInfoInPay(data) {
  let htmls = `
		<div class="pif-group-wrapper">
				<div class="pif-group">
					<label for="firstname" class="pif-label">Họ <span style="color: red">*</span></label>
					<input value=${data.fullname.slice(
            0,
            data.fullname.indexOf(" ")
          )} type="text" name="firstname" id="firstname" class="pif-inp">
				</div>
				<div class="pif-group">
					<label for="lastname" class="pif-label">Tên<span style="color: red">*</span></label>
					<input value="${data.fullname.slice(data.fullname.indexOf(" ") + 1)}"
						type="text" name="lastname" id="lastname" class="pif-inp">
				</div>
			</div>
			<div class="pif-group">
				<label for="phone" class="pif-label">Số điện thoại<span style="color: red">*</span></label>
				<input value=${data.phone} type="text" name="phone" id="phone" class="pif-inp">
			</div>
			<div class="pif-group">
				<label for="email" class="pif-label">Email<span style="color: red">*</span></label>
				<input value=${data.mail} type="text" name="email" id="email" class="pif-inp">
			</div>
			<div class="pif-group">
				<label for="address" class="pif-label">Địa chỉ<span style="color: red">*</span></label>
				<input value=${
          data.address
        } type="text" name="address" id="address" class="pif-inp">
			</div>
			<div class="pif-group">
				<label for="note" class="pif-label">Ghi chú</label>
				<textarea style="padding: 12px 6px; font-size: 1.6rem" name="note" id="note" cols="3"
					rows="1"
					placeholder=" Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."></textarea>
			</div>
		<button type="submit" class="btn btn--primary mcr-btn">XÁC NHẬN ĐẶT HÀNG</button>
	`;
  document.getElementById("pay-info-form").innerHTML = htmls;
}
function loadPayPage() {
  let check = sessionStorage.getItem("username");
  if (check) {
    let htmls = `
		<div class="mycart">
			<div class="container-second">
				<div class="mc-content">
					<div class="mc-wrapper">
						<div class="mc-top">
							<div class="mc-step">
								<ul class="mcs-list">
									<li class="mcs-item">
										<a onclick="loadCartPage()">GIỎ HÀNG</a>
										<span><i class="fa-solid fa-arrow-right"></i></span>
									</li>
									<li  class="mcs-item active">
										<a onclick="loadPayPage()">THANH TOÁN</a>
										<span><i class="fa-solid fa-arrow-right"></i></span>
									</li>
									<li class="mcs-item disable">
										<a>HOÀN THÀNH ĐƠN HÀNG</a>

									</li>
								</ul>
							</div>
						</div>
						<div class="mc-body">
						
							<div class="pay-wrapper">
								<div class="pay-left">
									<h2 class="pay-heading">THÔNG TIN KHÁCH HÀNG</h2>
									<form id="pay-info-form">

									</form>
								</div>
								<div class="pay-right">
									<div class="pr-order">
										<div class="pr-wrapper">
											<h2 style="text-align:center;font-size: 2rem; margin-bottom: 32px;">ĐƠN HÀNG CỦA BẠN</h2>
											<div class="pr-top">
												<p style="text-align: left;">SẢN PHẨM</p>
												<p style="padding-right: 24px">TẠM TÍNH</p>
											</div>
											<div class="pr-content">
												<table class="pr-detail">

												</table>
											</div>
											<div class="pr-total-wrapper">
												<p class="mcr-prev-total">Tạm tính</p>
												<p class="mcr-prev-total-value"></p>
											</div>
											<div class="pr-ship-wrapper">
												<p class="pr-ship">Giao hàng</p>
												<p class="pr-ship-value unactive">Freeship (3-4 ngày)<br>0đ</p>
												<p class="pr-ship-value">Tiêu chuẩn (3-4 ngày) <br> 35.000đ</p>
											</div>
											<div class="pr-total-wrapper">
												<p class="mcr-total">Tổng tiền</p>
												<p class="mcr-total-value"></p>
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
	`;
    document.getElementById("page-body").innerHTML = htmls;
    document.getElementById("page-heading").innerHTML = "<h1>THANH TOÁN</h1>";
    loadInfoInPay();
    loadProductInPay();
    hideMyCart();
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0;
  } else {
    alert("Vui lòng đăng nhập tài khoản để mua hàng");
    return;
  }
  // For Chrome, Firefox, IE and Opera
}
function loadCompleteOrder() {
  let htmls = `
		<div class="mycart">
			<div class="container-second">
				<div class="mc-content">
					<div class="mc-wrapper">
						<div class="mc-top">
							<div class="mc-step">
								<ul class="mcs-list">
									<li class="mcs-item disable">
										<a>GIỎ HÀNG</a>
										<span><i class="fa-solid fa-arrow-right"></i></span>
									</li>
									<li  class="mcs-item disable">
										<a>THANH TOÁN</a>
										<span><i class="fa-solid fa-arrow-right"></i></span>
									</li>
									<li class="mcs-item active">
										<a>HOÀN THÀNH ĐƠN HÀNG</a>

									</li>
								</ul>
							</div>
						</div>
						<div class="mc-body">
							<div class="complete-order">
								<a class="btn btn--primary" href="index.php" >TIẾP TỤC MUA HÀNG</a>
								<button class="btn btn--primary" onclick="
								loadOrderedPage()
								">ĐƠN HÀNG CỦA BẠN</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	`;
  document.getElementById("page-body").innerHTML = htmls;
  document.getElementById("page-heading").innerHTML =
    "<h1>HOÀN THÀNH ĐƠN HÀNG</h1>";
}
//
//<div class="complete-order">
//<button class="btn btn--primary" onclick="" >TIẾP TỤC MUA HÀNG</button>
//<button class="btn btn--primary" onclick="">ĐƠN HÀNG CỦA BẠN</button>
//</div>
