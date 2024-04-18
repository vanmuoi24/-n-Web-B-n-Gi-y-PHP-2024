function showProductByType(id) {
	loadProductByFilter('type', id);
}
function showProductByMaterial(id) {
	loadProductByFilter('material', id);
}
function showProductByColor(id) {
	loadProductByFilter('color', id);
}
function showProductBySize(ele) {
	if (ele.value == 'default') {
		loadProductByFilter();
		return;
	}
	loadProductByFilter('size', ele.value);
}
function showProductByOrder(ele) {
	if (ele.value == 'mac-dinh') {
		loadProductByFilter();
		return;
	}
	const keyFilter = JSON.parse(localStorage.getItem('keyFilter'));
	const input = `${ele.value},${keyFilter.filter},${keyFilter.input}`;
	// console.log(input);
	loadProductByFilter('orderby', input);
	document.querySelectorAll('#pm-filter-select option').forEach((item) => {
		item.setAttribute('selected', false);
	});
	document
		.querySelector(`#pm-filter-select option[value=${ele.value}]`)
		.setAttribute('selected', true);
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
	loadProductByFilter('price', `${from}-${to}`);
}
function saveKeyFilter(filter = '', input = '') {
	// localStorage.removeItem('keyFilter');
	const dataFilter = {
		filter,
		input,
	};
	localStorage.setItem('keyFilter', JSON.stringify(dataFilter));
}
