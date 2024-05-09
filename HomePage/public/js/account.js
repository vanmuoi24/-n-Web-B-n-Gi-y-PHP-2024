function loadInfo(id) {
	handleInfo(id, renderAccount);
}

///
///
////
function handleInfo(id, render) {
	let xhr = new XMLHttpRequest();
	xhr.open(
		'GET',
		// `../../mvc/API/index.php?type=account&filter=${filter}&input=${input}`,
		`../../mvc/API/index.php?type=getAccount&id=${id}`,
		true
	);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			let data = JSON.parse(xhr.responseText);
			console.log('Account: ', data);
			render(data);
		}
	};
	xhr.send();
}

function renderAccount(account) {
	let htmls = `
      <div class="account">
         <div class="container-second">
            <div class="account-content">
               <div class="account-info">
                  <form id="account-info__form" autocomplete="off">
                     <div class="aif-group">
                        <label for="code" class="aif-label">Mã khách hàng</label>
                        <input readonly type="text" disabled class="aif-inp" name="code" id="code" value="${account.id}">

                     </div>
                     <div class="aif-group">
                        <label for="fullname" class="aif-label">Họ tên</label>
                        <input type="text" disabled class="aif-inp --is-edit" name="fullname" id="fullname" value="${account.fullname}">
                     </div>
                     <div class="aif-group">
                        <label for="phone" class="aif-label">Điện thoại</label>
                        <input type="text" disabled class="aif-inp --is-edit" name="phone" id="phone" value="${account.phone}">
                     </div>
                     <div class="aif-group">
                        <label for="email" class="aif-label">Email</label>
                        <input type="text" disabled class="aif-inp --is-edit" name="email" id="email" value="${account.mail}">
                     </div>
                     <div class="aif-group">
                        <label for="address" class="aif-label">Địa chỉ</label>
                        <input type="text" disabled class="aif-inp --is-edit" name="address" id="address" value="${account.address}">
                     </div>
                     <div class="btn btn--primary aif-btn-edit" onclick="editInfo()"  id="edit-info">
                        Sửa thông tin
                     </div>
                     <button class="btn btn--primary aif-btn-confirm" type="submit"  id="confirm-edit">
                        Xác nhận
                     </button>
                     <div class="btn btn--primary aif-btn-cancel" onclick="cancelEdit()"  id="cancel-edit">
                        Hủy bỏ
                     </div>
                     <div class="btn btn--primary aif-btn-change" onclick="changePassword()" id="change-password">
                        Đổi mật khẩu
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   `;
	document.querySelector('#page-body').innerHTML = htmls;
	document.querySelector(
		'#page-heading'
	).innerHTML = `<h1>THÔNG TIN TÀI KHOẢN</h1>`;
}
function formInfoHtml(info) {
	return `
		<form id="account-info__form" autocomplete="off">
			<div class="aif-group">
				<label for="code" class="aif-label">Mã khách hàng</label>
				<input readonly type="text" disabled class="aif-inp" name="code" id="code" value="${info.id}">

			</div>
			<div class="aif-group">
				<label for="fullname" class="aif-label">Họ tên</label>
				<input type="text" disabled class="aif-inp --is-edit" name="fullname" id="fullname" value="${info.fullname}">
			</div>
			<div class="aif-group">
				<label for="phone" class="aif-label">Điện thoại</label>
				<input type="text" disabled class="aif-inp --is-edit" name="phone" id="phone" value="${info.phone}">
			</div>
			<div class="aif-group">
				<label for="mail" class="aif-label">Email</label>
				<input type="text" disabled class="aif-inp --is-edit" name="mail" id="mail" value="${info.mail}">
			</div>
			<div class="aif-group">
				<label for="address" class="aif-label">Địa chỉ</label>
				<input type="text" disabled class="aif-inp --is-edit" name="address" id="address" value="${info.address}">
			</div>
			<div class="btn btn--primary aif-btn-edit" onclick="editInfo()"  id="edit-info">
				Sửa thông tin
			</div>
			<button class="btn btn--primary aif-btn-confirm" type="submit"  id="confirm-edit">
				Xác nhận
			</button>
			<div class="btn btn--primary aif-btn-cancel" onclick="cancelEdit()"  id="cancel-edit">
				Hủy bỏ
			</div>
			<div class="btn btn--primary aif-btn-change" onclick="changePassword()" id="change-password">
				Đổi mật khẩu
			</div>
		</form>
   `;
}
//
function editInfo() {
	const inpEles = document.querySelectorAll('.aif-inp.--is-edit');
	inpEles.forEach((item) => {
		item.removeAttribute('disabled');
	});
	//check form
	valid(document.getElementById('account-info__form'), confirmEdit);
	//
	const id = document.querySelector('#code').value;
	const fullname = document.querySelector('#fullname').value;
	const phone = document.querySelector('#phone').value;
	const address = document.querySelector('#address').value;
	const mail = document.querySelector('#email').value;
	const dataAccount = {
		id,
		fullname,
		phone,
		address,
		mail,
	};
	// mượn localstorage để lưu tạm thông tin
	localStorage.setItem('infoAccountTemp', JSON.stringify(dataAccount));
	//
	document.querySelector('#confirm-edit').classList.add('active');
	document.querySelector('#cancel-edit').classList.add('active');
	document.querySelector('#change-password').classList.add('unactive');
	document.querySelector('#edit-info').classList.add('unactive');
	document.querySelector(
		'#page-heading'
	).innerHTML = `<h1>CHỈNH SỬA THÔNG TIN</h1>`;
}
function confirmEdit() {
	//get data
	const id = document.querySelector('#code').value;
	const fullname = document.querySelector('#fullname').value;
	const phone = document.querySelector('#phone').value;
	const address = document.querySelector('#address').value;
	const mail = document.querySelector('#email').value;

	const dataInfo = {
		id,
		firstname: fullname.slice(0, fullname.indexOf(' ')),
		lastname: fullname.slice(fullname.indexOf(' ') + 1),
		phone,
		address,
		mail,
	};
	//
	//handle ajax
	var xhr = new XMLHttpRequest();
	xhr.open('POST', `../../mvc/API/index.php?type=updateAccount`, true);
	xhr.setRequestHeader('Content-type', 'application/json');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var response = JSON.parse(xhr.responseText);
			//cap nhat thanh cong
			if (response.status == 1) {
				let inpEles = document.querySelectorAll('.aif-inp');
				inpEles.forEach((item) => {
					item.setAttribute('disabled', true);
				});
				toast({
					title: response.title,
					message: response.msg,
					type: 'success',
					duration: 3000,
				});
				localStorage.removeItem('infoAccountTemp');
				document.querySelector('#confirm-edit').classList.remove('active');
				document
					.querySelector('#change-password')
					.classList.remove('unactive');
				document.querySelector('#edit-info').classList.remove('unactive');
				document.querySelector('#cancel-edit').classList.remove('active');
				document.querySelector(
					'#page-heading'
				).innerHTML = `<h1>THÔNG TIN TÀI KHOẢN</h1>`;
			}
			//cap nhat that bai
			else if (!response.status) {
				toast({
					title: response.title,
					message: response.msg,
					type: 'warning',
					duration: 3000,
				});
			}
			//trung thong tin ve mail or sdt
			else {
				toast({
					title: response.title,
					message: response.msg,
					type: 'error',
					duration: 3000,
				});
			}
		}
	};
	xhr.send(JSON.stringify(dataInfo));
}
function cancelEdit() {
	if (confirm('Bạn có chắc hủy bỏ thao tác')) {
		const infoAccount = JSON.parse(localStorage.getItem('infoAccountTemp'));
		document.querySelector('.account-info').innerHTML =
			formInfoHtml(infoAccount);
		document.querySelector('#confirm-edit').classList.remove('active');
		document.querySelector('#change-password').classList.remove('unactive');
		document.querySelector('#edit-info').classList.remove('unactive');
		document.querySelector('#cancel-edit').classList.remove('active');
		localStorage.removeItem('infoAccountTemp');
		document.querySelector(
			'#page-heading'
		).innerHTML = `<h1>THÔNG TIN TÀI KHOẢN</h1>`;
	}
}

function changePassword() {
	//
	const id = document.querySelector('#code').value;
	const fullname = document.querySelector('#fullname').value;
	const phone = document.querySelector('#phone').value;
	const address = document.querySelector('#address').value;
	const mail = document.querySelector('#email').value;
	const dataAccount = {
		id,
		fullname,
		phone,
		address,
		mail,
	};
	// mượn localstorage để lưu tạm thông tin
	localStorage.setItem('infoAccountTemp', JSON.stringify(dataAccount));
	//

	//
	const accountInfo = document.querySelector('.account-info');
	const formChangePassword = `
      <form id="account-info__form" autocomplete="off">
			<div class="aif-group">
				<label for="code" class="aif-label">Mã khách hàng</label>
				<input type="text" class="aif-inp" name="code" id="code" >
				<label class="error" id="aif-label-code"></label>
			</div>
         <div class="aif-group">
            <label for="passwordOld" class="aif-label">Mật khẩu cũ</label>
				<div  class="--is-relative">
					<input type="password" class="aif-inp" name="passwordOld" id="passwordOld" >
					<span class="aif-icon" onclick="showPass(this)"><i class="fa-regular fa-eye"></i></span>
					<span class="aif-icon unactive" onclick="hidePass(this)"><i class="fa-regular fa-eye-slash"></i></span>
				</div>
         </div>
         <div class="aif-group">
            <label for="passwordNew" class="aif-label">Mật khẩu mới</label>
				<div class="--is-relative">
					<input type="password" class="aif-inp" name="passwordNew" id="passwordNew" >
					<span class="aif-icon" onclick="showPass(this)"><i class="fa-regular fa-eye"></i></span>
					<span class="aif-icon unactive" onclick="hidePass(this)"><i class="fa-regular fa-eye-slash"></i></span>
				</div>
         </div>
         <div class="aif-group">
            <label for="passwordConfirm" class="aif-label">Xác nhận mật khẩu mới</label>
				<div  class="--is-relative">
					<input type="password" class="aif-inp" name="passwordConfirm" id="passwordConfirm" >
					<span class="aif-icon" onclick="showPass(this)"><i class="fa-regular fa-eye"></i></span>
					<span class="aif-icon unactive" onclick="hidePass(this)"><i class="fa-regular fa-eye-slash"></i></span>
				</div>
         </div>
			<button class="btn btn--primary aif-btn-confirm active" type="submit" id="confirm-change-password">
				Xác nhận
			</button>
         <div class="btn btn--primary aif-btn-cancel active" onclick="cancelEdit()" id="cancel-change-password">
            Hủy bỏ
         </div>
      </form>
   `;
	accountInfo.innerHTML = formChangePassword;
	document.querySelector('#page-heading').innerHTML = `<h1>ĐỔI MẬT KHẨU</h1>`;
	valid(document.getElementById('account-info__form'), confirmChangePassword);
	//
}
function confirmChangePassword() {
	//get data
	const id = document.querySelector('#code').value;
	const passwordOld = document.querySelector('#passwordOld').value;
	const passwordNew = document.querySelector('#passwordNew').value;

	const dataInfo = {
		id,
		passwordNew,
		passwordOld,
	};
	//
	//handle ajax
	var xhr = new XMLHttpRequest();
	xhr.open('POST', `../../mvc/API/index.php?type=changePassword`, true);
	xhr.setRequestHeader('Content-type', 'application/json');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var response = JSON.parse(xhr.responseText);
			if (response.status === 1) {
				const infoAccount = JSON.parse(
					localStorage.getItem('infoAccountTemp')
				);
				document.querySelector('.account-info').innerHTML =
					formInfoHtml(infoAccount);
				document.querySelector('#confirm-edit').classList.remove('active');
				document
					.querySelector('#change-password')
					.classList.remove('unactive');
				document.querySelector('#edit-info').classList.remove('unactive');
				document.querySelector('#cancel-edit').classList.remove('active');
				localStorage.removeItem('infoAccountTemp');
				document.querySelector(
					'#page-heading'
				).innerHTML = `<h1>THÔNG TIN TÀI KHOẢN</h1>`;
				toast({
					title: response.title,
					message: response.msg,
					type: 'success',
					duration: 3000,
				});
			}
			//cap nhat that bai
			else if (!response.status) {
				toast({
					title: response.title,
					message: response.msg,
					type: 'warning',
					duration: 3000,
				});
			}
			//trung thong tin ve mail or sdt
			else {
				toast({
					title: response.title,
					message: response.msg,
					type: 'error',
					duration: 3000,
				});
			}
		}
	};
	xhr.send(JSON.stringify(dataInfo));
}
function showPass(ele) {
	ele.offsetParent.querySelector('.aif-inp').setAttribute('type', 'text');
	ele.offsetParent
		.querySelector('.aif-icon.unactive')
		.classList.remove('unactive');
	ele.classList.add('unactive');
}
function hidePass(ele) {
	ele.offsetParent.querySelector('.aif-inp').setAttribute('type', 'password');
	ele.offsetParent
		.querySelector('.aif-icon.unactive')
		.classList.remove('unactive');
	ele.classList.add('unactive');
}

function checkAuthor() {
	let list = document.getElementsByClassName('nbra__list')[0];
	let list_sticky = document.getElementsByClassName('nbra__list')[1];
	let check = sessionStorage.getItem('username');
	if (check) {
		let user = JSON.parse(check); // Parse once to avoid multiple parsing
		let list_li = `
		<li class="nbra__item" onclick="loadInfo('${user.tendn}')">
		  Thông tin
		</li>
		<li onclick="loadOrderedPage()" class="nbra__item">
		  Đơn hàng
		</li>
		<li class="nbra__item" onclick="logout()">
		  Đăng xuất
		</li>
	  `;
		document.getElementById('usernameLogin').innerHTML =
			user.hokh + ' ' + user.tenkh;
		list.innerHTML = list_li;
		list_sticky.innerHTML = list_li;
	} else {
		let out_li = `
		<li class="nbra__item" onclick="login()">
		  Đăng nhập
		</li>
		<li class="nbra__item" onclick="register()">
		  Đăng kí
		</li>
	  `;
		list.innerHTML = out_li;
		list_sticky.innerHTML = out_li;
		document.getElementById('usernameLogin').innerHTML = '';
	}
}

function login() {
	location.href = '../../../Form/MVC/View/LoginView.php';
}

function register() {
	location.href = '../../../Form/MVC/View/RegisterView.php';
}

function logout() {
	sessionStorage.removeItem('username');
	checkAuthor();
	location.href = '../../mvc/view/index.php';
}
