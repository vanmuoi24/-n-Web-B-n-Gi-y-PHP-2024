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
	if (!ele.classList.contains('pss-select')) {
		document.querySelector('.pss-select').value = 'default';
	}
	if (!ele) {
		console.log('loctien');
	} else ele.classList.add('active');
}
function showProductByType(ele) {
	activeFilter(ele);
	loadProductFilterSidebar('type', ele.dataset.id);
}
function showProductByMaterial(ele, id) {
	activeFilter(ele);
	loadProductFilterSidebar('material', id);
}
function showProductByColor(ele) {
	activeFilter(ele);
	loadProductFilterSidebar('color', ele.dataset.id);
}
function showProductBySize(ele) {
	activeFilter(ele);
	if (ele.value == 'default') {
		loadProductFilter();
		return;
	}

	loadProductFilterSidebar('size', ele.value);
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
	activeFilter();
	loadProductFilterSidebar('price', `${from}-${to}`);
}
