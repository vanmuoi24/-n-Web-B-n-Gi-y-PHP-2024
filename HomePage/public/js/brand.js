//
function loadBrand() {
	//HandleBrand
	let xhr = new XMLHttpRequest();
	xhr.open('GET', '../../mvc/API/index.php?type=brandsHome', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			let dataBrands = JSON.parse(xhr.responseText);
			console.log('dataBrands: ', dataBrands);
			renderBrand(dataBrands);
		}
	};
	xhr.send();
}
function renderBrand(dataBrands) {
	const listBrand = document.querySelector('.nbb-list');
	const listBrandSticky = document.querySelector('.nbb-list.--is-sticky');

	let htmls = `
				<li class="nbb-item">
					<a href="index.php" class="nbb-link">TRANG CHỦ</a>
				</li>
	`;
	let htmlsSticky = `
				<li class="nbb-item --is-sticky">
					<a href="index.php" class="nbb-link">TRANG CHỦ</a>
				</li>
	`;
	dataBrands.map((brand) => {
		htmls += `
				<li class="nbb-item">
					<a onclick="loadProductByFilter('brand','${brand.id}')" class="nbb-link">${brand.name}</a>
				</li>
			`;
		htmlsSticky += `
				<li class="nbb-item --is-sticky">
					<a onclick="loadProductByFilter('brand','${brand.id}')" class="nbb-link">${brand.name}</a>
				</li>
			`;
	});
	listBrand.innerHTML = htmls;
	listBrandSticky.innerHTML = htmlsSticky;
}
