//fix
function activeFilter(ele = false) {
	document
		.querySelectorAll('.pst-link')
		.forEach((item) => item.classList.remove('active'));
	document
		.querySelectorAll('.psm-link')
		.forEach((item) => item.classList.remove('active'));
	document
		.querySelectorAll('.psc-link')
		.forEach((item) => item.classList.remove('active'));
	document.querySelector('.pss-select').value = 'default';
	document.querySelector('.pst-list').value = 'default';
	ele.classList.add('active');
}
function showProductByType(ele) {
	if (ele.value == 'default') {
		loadProductByFilter();
		return;
	}
	console.log('type', ele.value);

	loadProductFilterSidebar('type', ele.value);
	activeFilter(ele);
}
// function showProductByType(ele) {
// 	activeFilter(ele);
// 	loadProductFilterSidebar('type', ele.dataset.id);
// }
function showProductByMaterial(ele, id) {
	loadProductFilterSidebar('material', id);
	hideFilter();
	activeFilter(ele);
}
function showProductByColor(ele) {
	loadProductFilterSidebar('color', ele.dataset.id);
	hideFilter();
	activeFilter(ele);
}
function showProductBySize(ele) {
	if (ele.value == 'default') {
		loadProductByFilter();
		return;
	}

	loadProductFilterSidebar('size', ele.value);
	hideFilter();
	activeFilter(ele);
}

function showProductByPrice() {
	let from = parseInt($('#from-price').val());
	let to = parseInt($('#to-price').val());
	// console.log('from - to: ', from, to);
	if (!from && !to) {
		document.querySelector('.ps-price-error').innerText =
			'Vui lòng không bỏ trống!!!';
		return;
	}
	if (from > to) {
		document.querySelector('.ps-price-error').innerText =
			'Vui lòng kiểm tra lại giá trị nhập!!!';
		return;
	}
	loadProductFilterSidebar('price', `${from}-${to}`);
	hideFilter();
	activeFilter();
}
