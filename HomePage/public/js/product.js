function loadProductByFilter(filter = '', input = '', page = 1) {
	loadProductHomeHtml();
	handleProductByFilter(filter, input, page);
	loadPaginationByFilter(filter, input, page);
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
	//
	// saveKeyFilter(filter, input);
}

function handleProductByFilter(filter, input, page) {
	let url = '';
	if (filter && input) {
		url = `type=product&filter=${filter}&input=${input}&page=${page}`;
	} else {
		url = `type=productsHome&page=${page}`;
	}
	let xhr = new XMLHttpRequest();
	xhr.open('GET', `../../mvc/API/index.php?${url}`, true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			const data = JSON.parse(xhr.responseText);
			const dataTemp = data.length >= 0 ? [...data] : [];

			console.log('data: ', data);

			renderProduct(data);

			//filter
			document
				.querySelector('#pm-filter-select')
				.addEventListener('change', () => {
					let selectVal =
						document.getElementById('pm-filter-select').value;

					if (selectVal === 'mac-dinh') {
						renderProduct(data);
						return;
					}
					if (selectVal === 'tang-dan') {
						let dataSort = dataTemp.sort(
							(a, b) => a.priceProduct - b.priceProduct
						);
						console.log(dataSort);
						renderProduct(dataSort);
					}
					if (selectVal === 'giam-dan') {
						let dataSort = dataTemp.sort(
							(a, b) => b.priceProduct - a.priceProduct
						);
						console.log(dataSort);
						renderProduct(dataSort);
					}
					if (selectVal === 'moi-nhat') {
						let dataSort = dataTemp.sort(
							(a, b) => b.idProduct - a.idProduct
						);
						console.log(dataSort);
						renderProduct(dataSort);
					}
				});
		}
	};
	xhr.send();
}

function handleProductByID(id) {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', `../../mvc/API/index.php?type=productbyid&id=${id}`, true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			let data = JSON.parse(xhr.responseText);
			console.log('data detail: ', data);
			renderDetail(data);
		}
	};
	xhr.send();
}

function renderProduct(products) {
	const listProduct = document.querySelector('.pmbp-list');

	listProduct.innerHTML = '';
	if (products.notFound || products.length <= 0) {
		listProduct.innerHTML = `<h1>${products.notFound}</h1>`;
		return;
	}
	//
	let htmls = '';
	products.map((product) => {
		//
		let soldOutTag =
			product.quantityProduct == 0
				? `<div class="pmbp-tag" style="padding: 4px 10px">
			<p>SOLD OUT</p>
		</div>`
				: '';
		let discountTag = product.discountProduct.percentDiscount
			? `<div class="pmbp-tag" style="padding: 4px 10px">
				<p>-${parseInt(product.discountProduct.percentDiscount)}%</p>
			</div>`
			: '';
		//
		//
		htmls += `
			<li class="pmbp-item">
			<a onclick="showDetail(\'${product.idProduct}\')" class="pmbp-link">
					${soldOutTag ? soldOutTag : discountTag}
					<div class="pmbp-img">
						<img src="${product.imgProduct}" alt="${product.nameProduct}" />
					</div>
					<div class="pmbp-info">
						<p class="pmbp-name">
							${product.nameProduct}
						</p>
						<p class="pmbp-category">
							${product.brandProduct.nameBrand}
						</p>
						<p class="pmbp-price ${discountTag ? '--is-not-discount' : ''}">
							${formatCurrency(product.priceProduct)}
						</p>
						${
							discountTag
								? `<p class="pmbp-price ">
										${formatCurrency(
											product.priceProduct -
												product.priceProduct *
													(product.discountProduct
														.percentDiscount /
														100)
										)}
									</p>`
								: ''
						}
					</div>
				</a>
			</li>
		`;
	});
	listProduct.innerHTML = htmls;
}
