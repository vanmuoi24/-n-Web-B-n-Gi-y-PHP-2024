function loadOrderedPage(id = 0) {
	let htmls = `
      <div class="order">
         <div class="container-second">
            <div class="order-wrapper">
               <div class="order-top">
                  <div class="order-status">
                     <ul class="os-list">
							
                     </ul>
                  </div>
                  <div class="order-search">
                     <form id="order-search-form">
                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input placeholder="Tìm kiếm theo mã hóa đơn" class="order-search-inp" type="text">
                     </form>
                     <form id="order-date-form">
                        <input class="order-date-inp order-from-inp" name="date-from" type="date">
                        <input class="order-date-inp order-to-inp" name="date-to" type="date">
                        <button class="btn btn--primary order-date-btn">Lọc</button>
                     </form>
                     
                  </div>
               </div>
               <div class="order-body">
                  <div class="order-content">
                     <div class="oc-list">
                        <table class="oc-table">
                        
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   `;
	document.getElementById('page-body').innerHTML = htmls;
	document.getElementById(
		'page-heading'
	).innerHTML = `<h1>ĐƠN HÀNG CỦA BẠN</h1>`;
	renderStatusBar(id);
	handleOrder(id);
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
function renderOrderByStatus(data) {
	let htmls = `<tr>
   <th>Mã đơn hàng</th>
   <th>Ngày mua</th>
   <th>Thành tiền</th>
   <th>Trạng thái</th>
   <th>Chi tiết</th>
</tr>`;
	if (data.length <= 0) {
		htmls += `
      <tr>
         <td colspan=5 style="padding-top: 100px"><h1>Bạn chưa có đơn hàng nào</h1></td>
      </tr>
   `;
	} else
		data.map((item) => {
			htmls += `
      <tr>
         <td>
            <p class="oc-item-address">
                ${item.idOrder}  
            </p>
         </td>
         <td>
            <p class="oc-item-address">
               ${convertDate(item.dateOrder)}
            </p>
         </td>
         <td>
            <p class="oc-item-price">${formatCurrency(item.priceOrder)}</p>
         </td>
         <td>
            <p class="oc-item-status">${item.statusOrder}</p>
         </td>
         <td>
            <div onclick="loadOrderDetailPage(${
					item.idOrder
				})" class="oc-item-detail"><i class="fa-solid fa-eye"></i></div>
         </td>
      </tr>
   `;
		});
	document.querySelector('.oc-table').innerHTML = htmls;
}
function handleOrder(id) {
	const accountID = JSON.parse(sessionStorage.getItem('username')).tendn;
	let xhr = new XMLHttpRequest();
	xhr.open(
		'GET',
		`../../mvc/API/index.php?type=orderByStatus&idaccount=${accountID}&idstatus=${id}`,
		true
	);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			let data = JSON.parse(xhr.responseText);
			console.log('data ordered list: ', data);
			renderOrderByStatus(data);
			//
			// search
			document
				.querySelector('.order-search-inp')
				.addEventListener('keydown', (e) => {
					if (e.keyCode == 13) {
						e.preventDefault();
						if (!e.target.value) {
							renderOrderByStatus(data);
						} else {
							let dataFilter = data.filter(
								(item) => item.idOrder == e.target.value
							);
							console.log(dataFilter);
							renderOrderByStatus(dataFilter);
						}
					}
				});
			//
			// search
			document
				.querySelector('.order-date-btn')
				.addEventListener('click', (e) => {
					e.preventDefault();
					let from = document.querySelector('.order-from-inp').value;
					let to = document.querySelector('.order-to-inp').value;
					handleFilterByDate(from, to, data);
				});
		}
	};
	xhr.send();
}
function handleFilterByDate(from, to, orders) {
	if (from > to && to !== '' && from !== '') {
		alert('Khoảng thời gian không hợp lệ !');
		return;
	}
	if (from !== '' && to === '') {
		orders = orders.filter((item) => {
			return new Date(item.dateOrder) >= new Date(from).setHours(0, 0, 0);
		});
	} else if (from === '' && to !== '') {
		orders = orders.filter((item) => {
			return new Date(item.dateOrder) <= new Date(to).setHours(23, 59, 59);
		});
	} else if (from != '' && to != '') {
		orders = orders.filter((item) => {
			return (
				new Date(item.dateOrder) >= new Date(from).setHours(0, 0, 0) &&
				new Date(item.dateOrder) <= new Date(to).setHours(23, 59, 59)
			);
		});
	}
	renderOrderByStatus(orders);
}
function renderStatusBar(id) {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', `../../mvc/API/index.php?type=statusAll`, true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			let data = JSON.parse(xhr.responseText);
			console.log('data status list: ', data);
			let htmls = `
						<li class="os-item">
                     <a 
								onclick="loadOrderByStatus(0)"
								class="os-link"
							>
                        Tất cả
                     </a>
                  </li>
			`;
			data.map((item) => {
				//
				htmls += `
                  <li class="os-item">
                     <a onclick="loadOrderByStatus(${item.idStatus})" 
                        class="os-link ${id == item.idStatus ? 'active' : ''}"
                     >
                        ${item.nameStatus}
                     </a>
                  </li>
            `;
			});
			document.querySelector('.os-list').innerHTML += htmls;
			// handle active
			const statusBars = document.querySelectorAll('.os-link');
			statusBars.forEach((item) => item.classList.remove('active'));
			statusBars[id].classList.add('active');
		}
	};
	xhr.send();
}
function loadOrderByStatus(idStatus) {
	loadOrderedPage(idStatus);
}

function loadOrderDetailPage(idOrder) {
	loadOrderDetail();
	const accountID = JSON.parse(sessionStorage.getItem('username')).tendn;

	handleOrderDetail(accountID, idOrder);
}
function handleOrderDetail(accountID, idOrder) {
	let xhr = new XMLHttpRequest();
	xhr.open(
		'GET',
		`../../mvc/API/index.php?type=orderDetailByID&idaccount=${accountID}&idorder=${idOrder}`,
		true
	);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			let data = JSON.parse(xhr.responseText);
			console.log('data ordered detail: ', data);
			renderOrderDetail(data);
		}
	};
	xhr.send();
}
function renderOrderDetail(data) {
	let infoHtmls = `
	<p>Khách hàng: <span>${data.info.fullname}</span></p>
	<p>SĐT: <span>${data.info.phone}</span></p>
	<p>Địa chỉ: <span>${data.info.address}</span></p>
	<p>Lưu ý: <span>${data.info.note ? data.info.note : ''}</span></p>
	`;
	let detailHtmls = `
	<p>Đặt ngày: <span>${convertDate(data.info.dateOrder)}</span></p>
	<p>Phí vận chuyển: <span>${
		parseInt(data.info.total) >= 3999000
			? formatCurrency('0')
			: formatCurrency('35000')
	}</span></p>			
	<p>Tổng tiền: <span>${formatCurrency(data.info.total)}</span></p>
	`;
	let btnCancelHtmls = `
		<button onclick="cancelOrder(${data.info.id})" 
			class="btn btn--primary odr-btn-cancel"
		>
			HỦY ĐƠN HÀNG
		</button>
	`;
	let btnReOrderHtmls = `
		<button onclick="reOrder(${data.info.id})" 
			class="btn btn--primary odr-btn-cancel"
		>
			MUA LẠI
		</button>
	`;
	let productHtmls = `
		<tr>
			<th colspan="2">Sản phẩm</th>
			<th>Số lượng</th>
			<th>Giá</th>
			<th>Giảm</th>
			<th>Sau giảm</th>
		</tr>
	`;
	data.carts.map((item) => {
		productHtmls += `
			<tr>
				<td>
					<div class="odl-img">
						<img
							src="${item.img}"
							alt="${item.name}">
					</div>
				</td>
				<td>
					<p class="odl-name">${item.name} - ${item.size.slice(1)}</p>
				</td>
				<td>
					<p class="odl-name">${item.quantity}</p>
				</td>
				<td>
					<p class="odl-price">${formatCurrency(item.price)}</p>
				</td>
				<td>
					<p class="odl-percent">${item.percentDiscount ? item.percentDiscount : 0}%</p>
				</td>
				<td>
					<p class="odl-total">${formatCurrency(
						parseFloat(
							parseFloat(item.price) -
								parseFloat(item.price) *
									(parseFloat(
										item.percentDiscount ? item.percentDiscount : 0
									) /
										100)
						) * parseFloat(item.quantity)
					)}</p>
				</td>
			</tr>
		`;
	});
	document.querySelector('.odr-info').innerHTML = infoHtmls;
	document.querySelector('.odr-detail').innerHTML = detailHtmls;
	document.querySelector('table.odl-list').innerHTML = productHtmls;
	// check cancel
	if (data.info.status == 1) {
		document.querySelector('.odr-btn').innerHTML = btnCancelHtmls;
	}
	if (data.info.status == 4) {
		document.querySelector('.odr-btn').innerHTML = btnReOrderHtmls;
	}
	// active status
	document
		.querySelectorAll('.ods-item')
		.forEach((item) => item.classList.remove('ative'));
	document
		.querySelectorAll('.ods-item')
		[parseInt(data.info.status) - 1].classList.add('active');
}
function loadOrderDetail() {
	let htmls = `
		<div class="order-detail">
			<div class="container-second">
				<div class="od-content">
					<div class="od-wrapper">
						<div class="od-top">
							<div class="od-status">
								<ul class="ods-list">
									<li class="ods-item">
										<i class=" fa-solid fa-hourglass-start ods-icon--waiting"></i> Đang chờ
									</li>
									<span class="ods-line"></span>
									<li class="ods-item">
										<i class=" fa-solid fa-money-check ods-icon--contacted"></i> Đã liên lạc
									</li>
									<span class="ods-line"></span>
									<li class="ods-item">
										<i class="fa-solid fa-circle-check ods-icon--success"></i> Đã giao
									</li>
									<span class="ods-line"></span>
									<li class="ods-item">
										<i class="fa-solid fa-circle-xmark ods-icon--canceled"></i> Đã hủy
									</li>
								</ul>
							</div>
						</div>
						<div class="od-body">
							<div class="odb-wrapper">
								<div class="od-left">
									<table class="odl-list" style=" border-collapse: collapse;width: 100%; text-align:center">
										
									
									</table>
								</div>
								<div class="od-right">
									<div class="odr-total">
										<div class="odr-wrapprer">
											<h2>THÔNG TIN ĐƠN HÀNG</h2>
											<div class="odr-info">
												
											</div>
											<div class="odr-line"></div>
											<div class="odr-detail">
												
											</div>
											<div class="odr-btn"></div>
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
}

function cancelOrder(id) {
	if (confirm('Bạn có chắc chắn hủy đơn hàng')) {
		let xhr = new XMLHttpRequest();
		xhr.open(
			'GET',
			`../../mvc/API/index.php?type=cancelOrder&id=${id}`,
			true
		);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let response = JSON.parse(xhr.responseText);
				console.log('data response cancel: ', response);
				if (response.status) {
					toast({
						title: response.title,
						message: response.msg,
						type: 'success',
						duration: 3000,
					});
					loadOrderedPage();
				} else {
					toast({
						title: response.title,
						message: response.msg,
						type: 'error',
						duration: 3000,
					});
				}
			}
		};
		xhr.send();
	}
}

function reOrder(id) {
	if (confirm('Bạn có chắc chắn hủy đơn hàng')) {
		let xhr = new XMLHttpRequest();
		xhr.open('GET', `../../mvc/API/index.php?type=reOrder&id=${id}`, true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let response = JSON.parse(xhr.responseText);
				console.log('response cancel: ', response);
				if (response.status) {
					toast({
						title: response.title,
						message: response.msg,
						type: 'success',
						duration: 3000,
					});
					loadOrderDetailPage(id);
				} else {
					toast({
						title: response.title,
						message: response.msg,
						type: 'error',
						duration: 3000,
					});
				}
			}
		};
		xhr.send();
	}
}
