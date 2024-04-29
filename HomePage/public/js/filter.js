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
//
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
