function loadCartMini() {
	const dataCart = localStorage.getItem('carts')
		? JSON.parse(localStorage.getItem('carts'))
		: [];
	//

	document.querySelector('.cb__empty').classList.remove('active');
	document.querySelector('.cart-bottom').classList.remove('unactive');
	document.querySelectorAll('.nbr__cart-quantity')[0].innerText =
		dataCart.length;
	document.querySelectorAll('.nbr__cart-quantity')[1].innerText =
		dataCart.length;
	//

	renderCartMini(dataCart);
}

function renderCartMini(data) {
	if (data.length == 0) {
		document.querySelector('.cb__empty').classList.add('active');
		document.querySelector('.cart-bottom').classList.add('unactive');
		document.querySelector('.cbc-list').innerHTML = '';
		console.log('rong~');
		return;
	}
	let htmls = '';
	let totalPrice = 0;
	data.map((item, index) => {
		let price = (
			item.priceDiscountProduct
				? item.priceDiscountProduct
				: item.priceProduct
		).replace(/[^0-9]/g, '');

		price *= parseInt(item.quantity);
		totalPrice += parseInt(price);
		let percent = item.percentDiscount
			? `<br>Giảm <span>-${item.percentDiscount}%</span>`
			: '';
		//
		htmls += `
               <li class="cbc-item">
                  <div class="cbc-img">
                     <img src="${item.imgProduct}" alt="${item.nameProduct}" />
                  </div>
                  <div class="cbc-info">
                     <p class="cbc-info__name">${item.nameProduct}</p>
                     <p class="cbc-info__size">
								Size <span> ${item.sizeProduct}
								</span>
								${percent}
							</p>

                     <i class="fa-solid fa-minus cbc-info__decrease" onclick="decreaseQuantity(\'${
								item.idProduct
							}\',\'${item.idSize}\')"></i>
                     <p class="cbc-info__quantity" style="display: inline-block">
                        ${item.quantity}
                     </p>
                     <i class="fa-solid fa-plus cbc-info__increase" onclick="increaseQuantity(\'${
								item.idProduct
							}\',\'${item.idSize}\')"></i>

                     <i class="fa-solid fa-xmark  cbc-info__multi"></i>
                     <p class="cbc-info__price" style="display: inline-block">
                        ${
									item.priceDiscountProduct
										? item.priceDiscountProduct
										: item.priceProduct
								}
                     </p>
                  </div>
                  <div class="cbc-remove" onclick="removeProductCartMini(${index})">
                     <i class="fa-solid fa-xmark"></i>
                  </div>
               </li>
      `;
	});
	document.querySelector('.cbc-list').innerHTML = htmls;
	document.querySelector('.cbp__price').innerText = formatCurrency(totalPrice);
}

function checkQuantity(id, size, quantity, cbFnc) {
	let xhr = new XMLHttpRequest();
	xhr.open(
		'GET',
		`../../mvc/API/index.php?type=checkQuantity&id=${id}&size=${size}&quantity=${quantity}`,
		true
	);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			let response = JSON.parse(xhr.responseText);
			console.log('data response cancel: ', response);

			if (response.status) {
				cbFnc(id, size, quantity);
				alert('Thêm thành công');
				// loadCartMini();
				// showMyCart();
			} else {
				alert('Số lượng trong kho không đủ');
			}
		}
	};
	xhr.send();
}
function dataAddCart(id, size, quantity) {
	const sizeSelected = document.querySelector('.dpis-num.active');
	const carts = JSON.parse(localStorage.getItem('carts'))
		? JSON.parse(localStorage.getItem('carts'))
		: [];

	let nameProduct = document.getElementsByClassName('dpi-name')[0].textContent;
	//
	let priceDiscountProduct = document.getElementsByClassName(
		'dpi-price --is-not-discount'
	)[0]
		? document.getElementsByClassName('dpi-price')[0].textContent
		: '';
	//
	let priceProduct = document.getElementsByClassName(
		'dpi-price --is-not-discount'
	)[0]
		? document.getElementsByClassName('dpi-price --is-not-discount')[0]
				.textContent
		: document.getElementsByClassName('dpi-price')[0].textContent;
	//
	let percentDiscount =
		document.getElementsByClassName('detail-left__tag')[0]?.dataset?.discount;
	let imgProduct = document.querySelector('.detail-img img').src;
	let sizeProduct = sizeSelected.textContent;

	const data = {
		idProduct: id,
		idSize: size,
		idDiscount:
			document.getElementsByClassName('detail-left__tag')[0]?.dataset
				?.iddiscount,
		quantity: quantity,
		nameProduct,
		priceProduct,
		imgProduct,
		priceDiscountProduct,
		sizeProduct,
		percentDiscount,
	};

	const indexExist = carts.findIndex(
		(item) => item.idProduct === data.idProduct && item.idSize === data.idSize
	);
	if (indexExist !== -1) carts[indexExist].quantity++;
	else carts.push(data);
	//
	localStorage.setItem('carts', JSON.stringify(carts));
	loadCartMini();
	showMyCart();
}
function addCart(id, size, quantity = 1) {
	const sizeSelected = document.querySelector('.dpis-num.active');
	if (!sizeSelected) {
		alert('Trường size là không được bỏ trống, xin vui lòng chọn size');
		return;
	}
	checkQuantity(id, sizeSelected.dataset.size, quantity, dataAddCart);
	//
}
function decreaseQuantity(idProduct, idSize) {
	// console.log(idProduct, idSize);
	const carts = JSON.parse(localStorage.getItem('carts'))
		? JSON.parse(localStorage.getItem('carts'))
		: [];

	const index = carts.findIndex(
		(item) => item.idProduct === idProduct && item.idSize === idSize
	);
	if (carts[index].quantity == 1) {
		return;
	}
	carts[index].quantity--;
	localStorage.setItem('carts', JSON.stringify(carts));
	loadCartMini();
}
function increaseQuantity(idProduct, idSize) {
	const carts = JSON.parse(localStorage.getItem('carts'))
		? JSON.parse(localStorage.getItem('carts'))
		: [];

	const index = carts.findIndex(
		(item) => item.idProduct === idProduct && item.idSize === idSize
	);
	checkQuantity(
		idProduct,
		idSize,
		carts[index].quantity + 1,
		handleIncreaseQuantity
	);
}
function handleIncreaseQuantity(idProduct, idSize, quantity) {
	const carts = JSON.parse(localStorage.getItem('carts'))
		? JSON.parse(localStorage.getItem('carts'))
		: [];

	const index = carts.findIndex(
		(item) => item.idProduct === idProduct && item.idSize === idSize
	);
	carts[index].quantity = quantity;
	localStorage.setItem('carts', JSON.stringify(carts));
	loadCartMini();
}

function removeProductCartMini(index) {
	const carts = JSON.parse(localStorage.getItem('carts'))
		? JSON.parse(localStorage.getItem('carts'))
		: [];
	if (confirm('Bạn có muốn xóa?')) {
		carts.splice(index, 1);
		localStorage.setItem('carts', JSON.stringify(carts));
		toast({
			title: 'Xóa thành công',
			message: 'Xóa sản phẩm thành công',
			type: 'success',
			duration: 3000,
		});
		loadCartMini();
	}
}
function loadCart() {
	const dataCart = localStorage.getItem('carts')
		? JSON.parse(localStorage.getItem('carts'))
		: [];
	//
	let emptyCart = `
			<h1 style="text-align:center; font-size:2.4rem">CHƯA CÓ SẢN PHẨM TRONG GIỎ HÀNG</h1>
	`;
	if (dataCart.length <= 0) {
		document.querySelector('.mc-wrapper').innerHTML = emptyCart;
		return;
	}
	console.log('local: ', dataCart);
	renderCart(dataCart);
}
function renderCart(data) {
	if (data.length === 0) return;
	//
	//
	let htmls = '';
	let totalPrice = 0;

	data.map((item, index) => {
		let price = (
			item.priceDiscountProduct
				? item.priceDiscountProduct
				: item.priceProduct
		).replace(/[^0-9]/g, '');
		price *= parseInt(item.quantity);
		totalPrice += parseInt(price);
		//
		htmls += `
         <tr>
            <td>
               <div class="mcl-img">
                  <img
                     src="${item.imgProduct}"
                     alt="${item.nameProduct}">
               </div>
            </td>
            <td>
               <p class="mcl-name">${item.nameProduct} - ${item.sizeProduct} 
            </td>
            <td>
               <p class="mcl-price">${item.priceProduct}</p>
            </td>
				<td>
               <p class="mcl-price">${
						item.percentDiscount ? item.percentDiscount : 0
					}%</p>
            </td>
            <td>
               <div class="mcl-quantity-wrapper">
                  <span 
                     class="mcl-decrese"
                     onclick="decreaseQuantityCart(\'${item.idProduct}\',\'${
			item.idSize
		}\')"
                  ><i class="fa-solid fa-minus"></i></span>
                  <span class="mcl-quantity">${item.quantity}</span>
                  <span 
                     class="mcl-increse"
                     onclick="increaseQuantityCart(\'${item.idProduct}\',\'${
			item.idSize
		}\')"
                  ><i class="fa-solid fa-plus"></i></span>
               </div>
            </td>
            <td>
               <p class="mcl-total">${formatCurrency(price)}</p>
            </td>
            <td>
               <span class="mcl-remove" onclick="removeProductCart(${index})"><i class="fa-regular fa-circle-xmark"></i></span>
            </td>
         </tr>
      `;
	});
	let tableHtml = `
   <tr>
      <th colspan="2">Sản phẩm</th>
      <th>Giá</th>
      <th>Giảm</th>
      <th>Số lượng</th>
      <th>Tạm tính</th>
      <th></th>
   </tr>`;
	tableHtml += htmls;
	document.querySelector('.mcl-list').innerHTML = tableHtml;
	document.querySelector('.mcr-prev-total-value').innerText =
		formatCurrency(totalPrice);

	//
	if (totalPrice < 3990000) {
		document
			.getElementsByClassName('mcr-ship-value')[0]
			.classList.add('unactive');
		document
			.getElementsByClassName('mcr-ship-price')[0]
			.classList.add('unactive');
		document
			.getElementsByClassName('mcr-ship-value')[1]
			.classList.remove('unactive');
		document
			.getElementsByClassName('mcr-ship-price')[1]
			.classList.remove('unactive');
		document.querySelector('.mcr-total-value').innerText = `${formatCurrency(
			totalPrice + 35000
		)}`;
	} else {
		document
			.getElementsByClassName('mcr-ship-value')[1]
			.classList.add('unactive');
		document
			.getElementsByClassName('mcr-ship-price')[1]
			.classList.add('unactive');
		document
			.getElementsByClassName('mcr-ship-value')[0]
			.classList.remove('unactive');
		document
			.getElementsByClassName('mcr-ship-price')[0]
			.classList.remove('unactive');
		document.querySelector('.mcr-total-value').innerText = `${formatCurrency(
			totalPrice
		)}`;
	}
}
function decreaseQuantityCart(idProduct, idSize) {
	// console.log(idProduct, idSize);
	const carts = JSON.parse(localStorage.getItem('carts'))
		? JSON.parse(localStorage.getItem('carts'))
		: [];

	const index = carts.findIndex(
		(item) => item.idProduct === idProduct && item.idSize === idSize
	);
	if (carts[index].quantity == 1) {
		return;
	}
	carts[index].quantity--;
	localStorage.setItem('carts', JSON.stringify(carts));
	loadCart();
}
function increaseQuantityCart(idProduct, idSize) {
	const carts = JSON.parse(localStorage.getItem('carts'))
		? JSON.parse(localStorage.getItem('carts'))
		: [];

	const index = carts.findIndex(
		(item) => item.idProduct === idProduct && item.idSize === idSize
	);
	checkQuantity(
		idProduct,
		idSize,
		carts[index].quantity + 1,
		handleIncreaseQuantityCart
	);
}
function handleIncreaseQuantityCart(idProduct, idSize, quantity) {
	const carts = JSON.parse(localStorage.getItem('carts'))
		? JSON.parse(localStorage.getItem('carts'))
		: [];

	const index = carts.findIndex(
		(item) => item.idProduct === idProduct && item.idSize === idSize
	);
	carts[index].quantity = quantity;
	localStorage.setItem('carts', JSON.stringify(carts));
	loadCart();
}

function removeProductCart(index) {
	const carts = JSON.parse(localStorage.getItem('carts'))
		? JSON.parse(localStorage.getItem('carts'))
		: [];
	if (confirm('Bạn có muốn xóa?')) {
		carts.splice(index, 1);
		localStorage.setItem('carts', JSON.stringify(carts));
		toast({
			title: 'Xóa thành công',
			message: 'Xóa sản phẩm thành công',
			type: 'success',
			duration: 3000,
		});
		loadCart();
		loadCartMini();
	}
}

function loadCartPage() {
	let htmls = `
		<div class="mycart">
			<div class="container-second">
				<div class="mc-content">
					<div class="mc-wrapper">
						<div class="mc-top">
							<div class="mc-step">
								<ul class="mcs-list">
									<li class="mcs-item active">
										<a onclick="loadCartPage()">GIỎ HÀNG</a>
										<span><i class="fa-solid fa-arrow-right"></i></span>
									</li>
									<li class="mcs-item">
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
							<div class="mcb-wrapper">
								<div class="mc-left">
									<table class="mcl-list" style=" border-collapse: collapse;width: 100%; text-align:center">
										
									</table>
								</div>
								<div class="mc-right">
									<div class="mcr-total">
										<div class="mcr-wrapprer">
											<table class="mcr-detail" style=" border-collapse: collapse;width: 100%; text-align:center">
												<tr>
													<th colspan="2">TỔNG CỘNG GIỎ HÀNG</th>
												</tr>
												<tr>
													<td>
														<p class="mcr-prev-total">Tạm tính</p>
													</td>
													<td>
														<p class="mcr-prev-total-value"></p>
													</td>
												</tr>
												<tr>
													<td>
														<p class="mcr-ship">Giao hàng</p>
													</td>
													<td>
														<p class="mcr-ship-value">Freeship (3-4 ngày)</p>
														<p class="mcr-ship-price" style="text-align:right; margin-top:4px">0 đ</p>
														<p class="mcr-ship-value">Tiêu chuẩn (3-4 ngày)</p>
														<p class="mcr-ship-price" style="text-align:right; margin-top:4px">35.000 đ</p>
													</td>
												</tr>
												<tr>
													<td>
														<p class="mcr-total">Tổng</p>
													</td>
													<td>
														<p class="mcr-total-value"></p>
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<div onclick="loadPayPage()" class="btn btn--primary mcr-btn">TIẾN HÀNH THANH TOÁN</div>
													</td>
												</tr>
											</table>
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
	document.getElementById('page-body').innerHTML = htmls;
	document.getElementById('page-heading').innerHTML = '<h1>GIỎ HÀNG</h1>';
	loadCart();
	hideMyCart();
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
