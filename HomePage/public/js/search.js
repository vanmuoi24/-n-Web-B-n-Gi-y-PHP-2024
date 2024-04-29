function loadSearch() {
	//live search
	$('.nb__center-inp').keyup(function () {
		const limit = 9;
		let keySearch = $(this).val();
		//
		handleSearch(renderLiveResult, keySearch);
	});

	//view all result
	$('.nbcs-bottom__view').click(function (e) {
		e.preventDefault();
		keySearch = $('.nb__center-inp').val();
		loadProductHomeHtml();
		handleSearch(renderProduct, keySearch);
		loadPaginationByFilter('search', keySearch);
	});

	//search
	$('.nb__center-submit').click(function (e) {
		e.preventDefault();
		if (!$('.nb__center-inp').val()) {
			alert('Vui lòng nhập từ khóa để tìm kiếm');
			return;
		}
		keySearch = $('.nb__center-inp').val();
		loadProductHomeHtml();
		handleSearch(renderProduct, keySearch);
		loadPaginationByFilter('search', keySearch, 1);
	});
}
function handleSearch(render, keySearch, page = 1) {
	//
	if (keySearch.trim() == '') {
		$('.nb-center__search').removeClass('active');
		return;
	}
	//
	if (keySearch.trim() != '') {
		let xhr = new XMLHttpRequest();
		xhr.open(
			'GET',
			`../../mvc/API/index.php?type=product&filter=search&input=${keySearch}&page=${page}`,
			true
		);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let data = JSON.parse(xhr.responseText);
				const dataTemp = data.length >= 0 ? [...data] : [];

				render(data);
				document.querySelector(
					'#page-heading'
				).innerHTML = `<h1>KẾT QUẢ TÌM KIẾM: ${keySearch}</h1>`;
				//filter
				document
					.querySelector('#pm-filter-select')
					.addEventListener('change', () => {
						let selectVal =
							document.getElementById('pm-filter-select').value;

						if (selectVal === 'mac-dinh') {
							render(data);
							return;
						}
						if (selectVal === 'tang-dan') {
							let dataSort = dataTemp.sort(
								(a, b) => a.priceProduct - b.priceProduct
							);
							console.log(dataSort);
							render(dataSort);
						}
						if (selectVal === 'giam-dan') {
							let dataSort = dataTemp.sort(
								(a, b) => b.priceProduct - a.priceProduct
							);
							console.log(dataSort);
							render(dataSort);
						}
						if (selectVal === 'moi-nhat') {
							let dataSort = dataTemp.sort(
								(a, b) => b.idProduct - a.idProduct
							);
							console.log(dataSort);
							render(dataSort);
						}
					});
			}
		};
		xhr.send();
		$('.nb-center__search').removeClass('active');
	}
}
function renderLiveResult(result) {
	const listSearch = document.querySelector('.nbcs-list');

	let htmls = '';
	listSearch.innerHTML = htmls;
	//
	if (result.notFound) {
		listSearch.innerHTML = `
						<li class="nbcs-item --not-found">
							<p>${result.notFound}</p>
						</li>`;
		$('.nbcs-bottom').removeClass('active');

		return;
	}
	//

	//
	result.map((product) => {
		htmls += `
							<li class="nbcs-item">
					            <a class="nbcs-link" onclick="showDetail(\'${product.idProduct}\')">
                           	<div class="nbcs-img">
											<img src="${product.imgProduct}" alt="${product.nameProduct}" >
										</div>
                              <div class="nbcs-info">
                                 <p class="nbcs-name">${product.nameProduct}</p>
                                 <p class="nbcs-price --is-not-discount">${formatCurrency(
												product.priceProduct
											)}</p>
											<p class="nbcs-price">${formatCurrency(
												product.priceProduct -
													(product.priceProduct *
														product.discountProduct
															.percentDiscount) /
														100
											)}</p>
                              </div>
                           </a>
                     </li>
						`;
	});
	listSearch.innerHTML = htmls;
	$('.nb-center__search').addClass('active');
	if (result.length < 9) $('.nbcs-bottom').removeClass('active');
	else $('.nbcs-bottom').addClass('active');
}
