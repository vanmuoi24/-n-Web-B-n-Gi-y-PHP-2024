function handleReceipt() {
	const Mange_client = document.getElementsByClassName('Mange_client')[0];
	const entry = `
    <div class="admin_home">
    </div>
    <div>
      <div class="Mange_item">
          <h3>Quản lý Phiếu Nhập</h3>
          <div class="entry_btn">
              <button onclick="hanldeAddEntry()">Thêm Phiếu Nhập <i class="fa-solid fa-plus"></i></button>
          </div>
      </div>
    </div>
    <div style="overflow-x: auto" class="voucher_table">
        <table>
           
        </table>
    </div>
    
    <div style="overflow-x: auto" class="entry_table">
        <div style="border: 1px solid black" class="entry_span">
            <span> Chi Tiết Phiếu Nhập </span>
            <button id="btn3" onclick="handleclose()">Đóng</button>
        </div>
    </div>
    <div class="for_add_item"  style="display: none">
        <div class="item_text">
            <span>Thêm Phiếu Nhập</span>
        </div>
        <div class="content_item_add" >
            <div class="input_add_item" >
                <div class="add_item_content">
                    <label>Mã Giày : </label>
                    <div>
                        <input type="text" name="ma_giay" id="ma_giay" value="" />
                        <span id="ma_giay_error" class="error-message"></span>
                    </div>         
                </div>
                <div class="add_item_content0" id="lablepn" style="display:none;">
                    <label>Mã PN : </label>
                    <div>
                        <input type="text" name="ma_pn" id="ma_pn" />
                        <span id="ma_pn_error" class="error-message"></span>
                    </div>
                </div>
                <div class="add_item_content0" id="lablepn" ">
                <label>Chọn Đối Tượng Sử Dụng : </label>
                <select id="Grender">
                        <option value="">Giới Tính</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>

                    </select>
                <div>
                   
                </div>
            </div>
              <div class="add_item_content">
                  <label>Chọn Sản Phẩm Đã Có</label>
                  <div>                  
                      <i onclick="handlsaveid()" class="fa-solid fa-circle-plus"></i>
                  </div>
              </div>
            </div>
            <div class="input_add_item">
                <div class="add_item_content1">
                    <label>Tên Giày : </label>
                    <div> <input type="text" name="ten_giay" id="ten_giay" placeholder="vd: Giày Af1" />
                        <span id="ten_giay_error" class="error-message"></span>
                    </div>
                </div>
                <div class=" add_item_content2">
                    <label>Chất Liệu : </label>
                    <div>
<input type="text" name="chat_lieu" id="chat_lieu" value="" placeholder="vd: vải"  />
                        <span id="chat_lieu_error" class="error-message"></span>
                    </div>
                </div>
            </div>
            <div class="input_add_item">
                <div class="add_item_content1">
                    <label>Số Lượng : </label>
                    <div>
                    <input type="text" name="so_luong" id="so_luong" value="" placeholder="vd:123" />

                        <span id="so_luong_error" class="error-message"></span>
                    </div>
                </div>
                <div class="add_item_content2">
                    <label>Giá Nhập : </label>
                    <div><input type="text" name="gia_nhap" id="gia_nhap" value="" placeholder="vd:123" />
                        <span id="gia_nhap_error" class="error-message"></span>
                    </div>
                </div>
            </div>
            <div class="input_add_item">
                <div class="add_item_content1">
                    <label>Loại : </label>
                    <select name="loai" id="loai">
                        <option value="">Chọn loại</option>
                    </select>
                    <span id="loai_error" class="error-message"></span>
                </div>
                <div class="add_item_content2">
                    <label>Thương Hiệu : </label>
                    <select name="thuong_hieu" id="thuong_hieu">
                        <option value="">Chọn thương hiệu</option>
                    </select>
                    <span id="thuong_hieu_error" class="error-message"></span>
                </div>
            </div>
            <div class="input_add_item">
                <div class="add_item_content1">
                    <label>Size : </label>
                    <select name="size" id="size">
                        <option value="">Chọn size</option>
                    </select>
                    <span id="size_error" class="error-message"></span>
                </div>
                <div class="add_item_content2">
                    <label>Màu Sắc : </label>
                    <select name="mausac" id="mausac">
                        <option value="">Chọn màu sắc</option>
                    </select>
                    <span id="mausac_error" class="error-message"></span>
                </div>
            </div>
            <div class="input_add_item">
                <div class="add_item_content1"  style="width: 50%; ">
                    <label>Nhà Cung Cấp : </label>
                    <select name="nhacungcap" id="nhacungcap" style="width: 100%; height: 40px;">
                        <option value="">Chọn nhà cung cấp</option>
                    </select>
                    <span id="nhacungcap_error" class="error-message"></span>
                </div>
<div class="add_item_content1" style="width: 50%; ">
                <input type="file" id="chooseFile" accept="image/*" onchange="previewImage(event)" style="width: 100%; height: 40px;" />
                <img id="preview" src="" style="width: 40%;" />
                

                <span id="nhacungcap_error" class="error-message"></span>
            </div>
            </div>
          </div>
            <div class="btn_content_exit">
                <button id="btn1" onclick="handlesavepn()">
                    Lưu <i class="fa-solid fa-floppy-disk"></i>
                </button>
                <button id="btn2" onclick="hanldeexit()">
                    Thoát <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="table_product" style="display: block; position: absolute; width: 80%; max-height: 500px; overflow: auto; margin-top: 30px;">
        <table id="table_product">
        </table>
    </div>
    <div class="table_cthd" style="display: none;">
        <table>
            <thead>
                <tr>
                    <th>Mã Giày</th>
                    <th>Mã Phiếu Nhập</th>
                    <th>Size</th>
                    <th>Số Lượng</th>
                    <th>Giá Nhập</th>
                    <th>
                        <div class="closstable">
                            <i class="fa-regular fa-circle-xmark" onclick="handleclosscthd()"></i>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
  `;

	Mange_client.innerHTML = entry;
	handlegetList();
}
function showimgsave() {
	const fileInput = document.getElementById('fileInput');
	const previewImage = document.getElementById('PreviewImage');

	fileInput.addEventListener('change', function () {
		const previewImage = document.getElementById('PreviewImage');

		const file = fileInput.files[0];
		const reader = new FileReader();

		reader.onloadend = function () {
			previewImage.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);
		} else {
			previewImage.src = '';
		}
	});
}

function previewImage(event) {
	const preview = document.getElementById('preview');
	const file = event.target.files[0];
	const reader = new FileReader();

	reader.onloadend = function () {
		const imageUrl = reader.result;
		console.log('Đường dẫn ảnh:', imageUrl);

		preview.src = imageUrl;
	};

	if (file) {
		reader.readAsDataURL(file);
	} else {
		preview.src = '#';
	}
}

function hanldeAddEntry() {
	localStorage.setItem('MaNV', 'NV001');
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../../mvc/API/index.php?type=ds4table', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var data = JSON.parse(xhr.responseText);
			console.log('check', data);
			let loaiop = document.getElementById('loai');
			let size1 = document.getElementById('size');
			let thuong_hieu = document.getElementById('thuong_hieu');
			let mausac = document.getElementById('mausac');
			let nhacungcap = document.getElementById('nhacungcap');
			let option1 = '';
			let option2 = '';
			let option3 = '';
			let option4 = '';
			let option5 = '';
			data.loai.map((item, index) => {
				option1 += `
        <option value="${item.MaLoai}">${item.TenLoai}</option>
         `;
			});
			data.size.map((item, index) => {
				option2 += `
        <option value="${item.MaSize}">${item.KichThuoc}</option>
         `;
			});
			data.thuonghieu.map((item, index) => {
				option3 += `
        <option value="${item.MaThuongHieu}">${item.TenThuongHieu}</option>
         `;
			});
			data.mausac.map((item, index) => {
				option4 += `
        <option value="${item.MaMau}">${item.TenMau}</option>
         `;
			});
			data.nhacungcap.map((item, index) => {
				option5 += `
        <option value="${item.MaNCC}">${item.TenNCC}</option>
         `;
			});
			loaiop.innerHTML = option1;
			size1.innerHTML = option2;
			nhacungcap.innerHTML = option5;
			thuong_hieu.innerHTML = option3;
			mausac.innerHTML = option4;
		}
	};
	xhr.send();

	const for_add_item = document.getElementsByClassName('for_add_item')[0];
	for_add_item.style.display = 'block';
	let table = document.querySelectorAll('.voucher_table table')[0];
	table.style.opacity = '0.1';
	table.style.pointerEvents = 'none';
	cityop();
}

function hanldeexit() {
	const entry_table = document.getElementsByClassName('for_add_item')[0];
	entry_table.style.display = 'none';
	let table = document.querySelectorAll('.voucher_table table')[0];
	table.style.opacity = '1';
	table.style.pointerEvents = 'auto';
	cityopmove();
}

function cityop() {
	let poss = document.querySelectorAll('.header ,.header_content,.Mange_item');
	poss.forEach((poss) => {
		poss.style.opacity = '0.1';
		poss.style.pointerEvents = 'none';
	});
}

function cityopmove() {
	let poss = document.querySelectorAll('.header ,.header_content,.Mange_item');
	poss.forEach((poss) => {
		poss.style.opacity = '1';
		poss.style.pointerEvents = 'auto';
	});
}

function handlsaveid() {
	let poss = document.querySelectorAll('.header ,.header_content,.Mange_item');
	poss.forEach((poss) => {
		poss.style.opacity = '0.1';
		poss.style.pointerEvents = 'none';
	});
	const entry_table = document.getElementsByClassName('for_add_item')[0];
	entry_table.style.display = 'none';
	const table_product = document.getElementsByClassName('table_product')[0];
	table_product.style.display = 'block';
	tableproduct();
}

function handleshowinput() {
	const table_product = document.getElementsByClassName('table_product')[0];
	table_product.style.display = 'none';
	let table = document.querySelectorAll('.voucher_table table')[0];
	table.style.opacity = '1';
	table.style.pointerEvents = 'auto';
	cityopmove();
}
function handleclosscthd() {
	const table_cthd = document.getElementsByClassName('table_cthd')[0];
	table_cthd.style.display = 'none';
	let table = document.querySelectorAll('.voucher_table table')[0];
	table.style.opacity = '1';
	table.style.pointerEvents = 'auto';
	cityopmove();
}
function handlegetList() {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../../mvc/API/index.php?type=dsphieunhap', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var data = JSON.parse(xhr.responseText);
			console.log(data);
			const voucher_table = document.querySelectorAll(
				'.voucher_table table'
			)[0];
			let table_item = `
        <tr>
            <th>STT</th>
            <th>MaPN</th>
            <th>Ngày Nhập</th>
            <th>Tổng Tiền</th>
            <th>Nhận Viên</th>
            <th>Nhà Cung Cấp</th>
            <th>Tác Vụ</th>
        </tr> 
      `;
			let dem = 0;
			data.map((item, index) => {
				table_item += `
        <tr>
            <td>${dem++}</td>
            <td>${item.MaPN}</td>
            <td>${item.NgayNhap}</td>
            <td>${formatCurrency(item.TongTien)}</td>
            <td>${item.MaNV.Ho}${item.MaNV.Ten}</td>
            <td>${item.MaNCC.TenNCC}</td>
            <td>
            <i class="fa-solid fa-eye" style="color: 0078ff" onclick="handleviewctph('${
					item.MaPN
				}')"></i>
        </tr> 
        
        `;
				voucher_table.innerHTML = table_item;
			});
		}
	};
	xhr.send();
}
function handleviewctph(id) {
	console.log(id);
	const table_cthd = document.getElementsByClassName('table_cthd')[0];
	table_cthd.style.display = 'block';
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../../mvc/API/index.php?type=dschitiethd&id=' + id, true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var data = JSON.parse(xhr.responseText);
			console.log(JSON.parse(data));
			const table_cthd_body = document.querySelector(
				'.table_cthd table tbody'
			);
			let table_ct = '';
			JSON.parse(data).forEach((item) => {
				table_ct += `
          <tr>
            <td>${item.MaGiay}</td>
            <td>${item.MaPN}</td>
            <td>${item.Sizes.KichThuoc}</td>
            <td>${item.SoLuong}</td>
            <td>${formatCurrency(item.GiaNhap)}</td>
          </tr>
        `;
			});
			table_cthd_body.innerHTML = table_ct;
		}
	};
	let table = document.querySelectorAll('.voucher_table table')[0];
	table.style.opacity = '0.1';
	table.style.pointerEvents = 'none';
	xhr.send();
	cityop();
}

function tableproduct() {
	var xhr = new XMLHttpRequest();
	xhr.open('GET', '../../mvc/API/index.php?type=giay', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			if (xhr.readyState == 4 && xhr.status == 200) {
				var data = JSON.parse(xhr.responseText);
				let tablevoucher = document.getElementById('table_product');
				let tableitem = `  
        <tr>
        <th>STT</th>
        <th>Tên Sản Phẩm</th>
        <th>Thương Hiệu</th>
        <th>Số Lượng</th>
        <th>Hình Ảnh</th>
        <th>Giá Tiền</th>
        <th style="display: flex; align-items: center;"> <i class="fas fa-times-circle" onclick="handleshowinput()"></i></th>
    </tr>
 `;

				data.forEach((item, index) => {
					index++;
					tableitem += `
          <tr>
          <td>${index++}</td>
          <td>${item.Tengia}</td>
          <td>${item.ThuongHieu.TenThuongHieu}</td>
         
          <td>
          <img src="${item.HinhAnh}" alt="" style="width: 50px" />
          </td>
          <td>${formatCurrency(item.DonGia)}</td>
          <td>
          <i class="fa-regular fa-hand-pointer" onclick="handleitemproduct('${
					item.MaGiay
				}')"></i>
          </td>
      </tr>
          `;
				});
				tablevoucher.innerHTML = tableitem;
			}
		}
	};

	xhr.send();
}

function handleitemproduct(id) {
	const table_product = document.getElementsByClassName('table_product')[0];
	table_product.style.display = 'none';
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../../mvc/API/index.php?type=dssanpham&id=' + id, true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var response = JSON.parse(xhr.responseText);
			console.log(JSON.parse(response));
			filterdataproduct(JSON.parse(response));
		}
	};
	xhr.send();
}

function filterdataproduct(data) {
	console.log(data, 'check');
	const entry_table = document.getElementsByClassName('for_add_item')[0];
	entry_table.style.display = 'block';
	document.getElementById('ma_giay').value = data.giay.MaGiay;
	document.getElementById('ten_giay').value = data.giay.Tengia;
	document.getElementById('chat_lieu').value = data.giay.ChatLieu;
	document.getElementById('gia_nhap').value = data.giay.DonGia;
	document.getElementById('preview').src = data.giay.HinhAnh;
	var loai = document.getElementById('loai');
	var selectElement = document.getElementById('thuong_hieu');
	var size = document.getElementById('size');
	var mausac = document.getElementById('mausac');
	var nhacungcap = document.getElementById('nhacungcap');
	let size1 = document.getElementById('size');

	for (var i = 0; i < selectElement.options.length; i++) {
		if (
			selectElement.options[i].text === data.giay.ThuongHieu.TenThuongHieu
		) {
			selectElement.options[i].selected = true;
			break;
		}
	}
	for (var i = 0; i < loai.options.length; i++) {
		if (loai.options[i].text === data.giay.Loai.TenLoai) {
			loai.options[i].selected = true;
			break;
		}
	}

	for (var i = 0; i < mausac.options.length; i++) {
		if (mausac.options[i].text === data.giay.MauSac.TenMau) {
			mausac.options[i].selected = true;
			break;
		}
	}
	for (var i = 0; i < nhacungcap.options.length; i++) {
		if (nhacungcap.options[i].text === data.nhacungcap.TenNCC) {
			nhacungcap.options[i].selected = true;
			break;
		}
	}
	let option2 = '';

	data.size.map((item, index) => {
		option2 += `
    <option value="${item.MaSz + ' ' + item.SoLuong}">${item.KichThuoc}</option>
     `;
	});

	size1.innerHTML = option2;
	let value_quality = document.getElementById('so_luong');
	document.getElementById('size').addEventListener('change', () => {
		let selectedValue = size1.value;
		let [value, quantity] = selectedValue.split(' ');
		value_quality.value = quantity;

		console.log('Giá trị đã chọn:', value);
		console.log('Số lượng:', quantity);
	});

	lockInputs();
	let lablepn = document.getElementById('lablepn');

	if (!data.chitiet) {
		let mapn = document.getElementById('ma_pn');

		lablepn.style.display = 'none';
		mapn.value = '';
	} else if (data.chitiet) {
		let mapn = document.getElementById('ma_pn');

		lablepn.style.display = 'block';
		mapn.value = data.chitiet.MaPN;
		mapn.disabled = true;
	}
}

function lockInputs() {
	const inputsAndSelects = document.querySelectorAll(
		'#loai , #thuong_hieu, #mausac,#ma_giay,#chat_lieu,#ten_giay,#nhacungcap ,#preview ,#chooseFile'
	);
	inputsAndSelects.forEach((element) => {
		element.disabled = true;
	});
}

function handlesavepn() {
	if (!validateForm2()) {
		return;
	}

	const inputsAndSelects = document.querySelectorAll(
		'#loai , #thuong_hieu, #mausac, #ma_giay, #chat_lieu, #ten_giay, #ma_pn,#nhacungcap'
	);

	let so_luong = document.getElementById('so_luong');
	let gia_nhap = document.getElementById('gia_nhap');

	let size = document.getElementById('size');
	let Grender = document.getElementById('Grender');
	let selectedValue = size.value;
	let [value, quantity] = selectedValue.split(' ');
	let dataMNV = localStorage.getItem('MaNV');
	const hinh_anh = document.getElementById('preview').src;

	const datainput = {
		Manv: dataMNV,
		so_luong: parseFloat(so_luong.value),
		gia_nhap: parseFloat(gia_nhap.value),
		hinh_anh: hinh_anh,
		value: value,
		Grender: Grender.value,
	};

	inputsAndSelects.forEach((element) => {
		datainput[element.id] = element.value;
	});
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../../mvc/API/index.php?type=themsanphamoi', true);
	xhr.setRequestHeader('Content-type', 'application/json');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var response = JSON.parse(xhr.responseText);
			console.log(JSON.parse(JSON.parse(response)));

			handlegetList();
		}
	};

	xhr.send(JSON.stringify(datainput));
	const entry_table = document.getElementsByClassName('for_add_item')[0];
	entry_table.style.display = 'none';
	let table = document.querySelectorAll('.voucher_table table')[0];
	table.style.opacity = '1';
	table.style.pointerEvents = 'auto';

	cityopmove();
}

function validateForm2() {
	var ma_giay = document.getElementById('ma_giay');
	var ma_giay_value = ma_giay.value.trim();
	var ma_giay_error = document.getElementById('ma_giay_error');
	var ten_giay = document.getElementById('ten_giay');
	var ten_giay_value = ten_giay.value.trim();
	var ten_giay_error = document.getElementById('ten_giay_error');
	var chat_lieu = document.getElementById('chat_lieu');
	var chat_lieu_value = chat_lieu.value.trim();
	var chat_lieu_error = document.getElementById('chat_lieu_error');
	var so_luong = document.getElementById('so_luong');
	var so_luong_value = so_luong.value.trim();
	var so_luong_error = document.getElementById('so_luong_error');
	var gia_nhap = document.getElementById('gia_nhap');
	var gia_nhap_value = gia_nhap.value.trim();
	var gia_nhap_error = document.getElementById('gia_nhap_error');
	var loai = document.getElementById('loai');
	var loai_value = loai.value;
	var loai_error = document.getElementById('loai_error');
	var thuong_hieu = document.getElementById('thuong_hieu');
	var thuong_hieu_value = thuong_hieu.value;
	var thuong_hieu_error = document.getElementById('thuong_hieu_error');
	var size = document.getElementById('size');
	var size_value = size.value;
	var size_error = document.getElementById('size_error');
	var mausac = document.getElementById('mausac');
	var mausac_value = mausac.value;
	var mausac_error = document.getElementById('mausac_error');

	var nhacungcap = document.getElementById('nhacungcap');
	var nhacungcap_value = nhacungcap.value;
	var nhacungcap_error = document.getElementById('nhacungcap_error');
	ma_giay_error.textContent = '';
	ten_giay_error.textContent = '';
	chat_lieu_error.textContent = '';
	so_luong_error.textContent = '';
	gia_nhap_error.textContent = '';
	loai_error.textContent = '';
	thuong_hieu_error.textContent = '';
	size_error.textContent = '';
	mausac_error.textContent = '';
	nhacungcap_error.textContent = '';
	var isValid = true;
	if (ma_giay_value === '') {
		ma_giay_error.textContent = 'Vui lòng nhập mã giày';
		ma_giay.classList.add('error-border');
		isValid = false;
	}
	if (ten_giay_value === '') {
		ten_giay_error.textContent = 'Vui lòng nhập tên giày';
		isValid = false;
	}
	if (chat_lieu_value === '') {
		chat_lieu_error.textContent = 'Vui lòng nhập chất liệu';
		isValid = false;
	}
	// Validate Số Lượng
	if (so_luong_value === '') {
		so_luong_error.textContent = 'Vui lòng nhập số lượng';
		isValid = false;
	} else if (isNaN(so_luong_value)) {
		so_luong_error.textContent = 'Số lượng phải là số ';
		isValid = false;
	}

	// Validate Giá Nhập
	if (gia_nhap_value === '') {
		gia_nhap_error.textContent = 'Vui lòng nhập giá nhập';
		isValid = false;
	} else if (isNaN(gia_nhap_value)) {
		gia_nhap_error.textContent = 'Giá nhập phải là số ';
		isValid = false;
	}

	if (loai_value === '') {
		loai_error.textContent = 'Vui lòng chọn loại';
		isValid = false;
	}
	if (thuong_hieu_value === '') {
		thuong_hieu_error.textContent = 'Vui lòng chọn thương hiệu';
		isValid = false;
	}
	if (size_value === '') {
		size_error.textContent = 'Vui lòng chọn size';
		isValid = false;
	}
	if (mausac_value === '') {
		mausac_error.textContent = 'Vui lòng chọn màu sắc';
		isValid = false;
	}
	if (nhacungcap_value === '') {
		nhacungcap_error.textContent = 'Vui lòng chọn nhà cung cấp';
		isValid = false;
	}

	return isValid;
}
