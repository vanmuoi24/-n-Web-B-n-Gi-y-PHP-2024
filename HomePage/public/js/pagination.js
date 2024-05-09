function loadPaginationByFilter(filter, input, page) {
	//
	let url = '';
	if (filter && input) {
		url = `type=pagination&filter=${filter}&input=${input}&page=${page}`;
	} else {
		url = `type=paginationHome&page=${page}`;
	}
	console.log('url: ', url);
	handlePagination(url, filter, input, page);
}
function handlePagination(url, filter, input, page) {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', `../../mvc/API/index.php?${url}`, true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			let currPage = page;
			let dataTotalPage = JSON.parse(xhr.responseText);
			console.log('dataTotalPage: ', dataTotalPage);
			if (dataTotalPage.totalPage <= 1) {
				document.querySelector('.pmbpagi__list').innerHTML = '';
				return;
			}
			console.log(
				'pagination: ',
				dataTotalPage.totalPage,
				currPage,
				filter,
				input
			);
			renderPagination(dataTotalPage.totalPage, currPage, filter, input);
		}
	};
	xhr.send();
}
function renderPagination(totalPage, currPage = 1, filter, input) {
	const listPagination = document.querySelector('.pmbpagi__list');

	if (totalPage == 1 || totalPage == 0) return;
	//
	let htmls = '';
	let htmlsQuantityPage = '';
	for (let i = 1; i <= totalPage; i++) {
		htmlsQuantityPage += `
		<li class="pmbpagi__item ${i == currPage ? 'active' : ''} ">
			<a  onclick="showProductByPage(${i}, this)" 
				data-page=${currPage}
				data-filter="${filter}"
				data-input="${input}"  
				class="pmbpagi__link"
			>
					${i}
			</a>
		</li>
		`;
	}
	if (currPage != 1)
		htmls += `
		<li class="pmbpagi__item pmbpagi__item--prev">
			<a onclick="showProductPrevPage(this)" 
				data-page=${currPage} 
				data-filter="${filter}"
				data-input="${input}"   
				class="pmbpagi__link"
			>
				<i class="fa-solid fa-angle-left"></i>
			</a>
		</li>
	`;
	htmls += htmlsQuantityPage;
	if (currPage != totalPage)
		htmls += `
		<li class="pmbpagi__item pmbpagi__item--next">
			<a onclick="showProductNextPage(this)" 
				data-total=${totalPage} 
				data-page=${currPage} 
				data-filter="${filter}"
				data-input="${input}"   
				class="pmbpagi__link"
			>
				<i class="fa-solid fa-angle-right"></i>
			</a>
		</li>
	`;
	listPagination.innerHTML = htmls;
}

function showProductByPage(page, ele) {
	let currPage = ele.dataset.page;
	let filter = ele.dataset.filter;
	let input = ele.dataset.input;
	if (page == currPage) return;
	// console.log(page, currPage);
	loadProductByFilter(filter, input, page);
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
function showProductPrevPage(ele) {
	let currPage = ele.dataset.page;
	let filter = ele.dataset.filter;
	let input = ele.dataset.input;
	if (currPage == 1) return;
	loadProductByFilter(filter, input, parseInt(currPage) - 1);
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
function showProductNextPage(ele) {
	let currPage = ele.dataset.page;
	let totalPage = ele.dataset.total;
	let filter = ele.dataset.filter;
	let input = ele.dataset.input;
	if (currPage == totalPage) return;
	loadProductByFilter(filter, input, parseInt(currPage) + 1);
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
//

function loadPaginationFilterSidebar(filter, input, page) {
	//
	let url = '';
	if (filter && input) {
		url = `type=pagination&filter=${filter}&input=${input}&page=${page}`;
	} else {
		url = `type=paginationHome&page=${page}`;
	}
	console.log('url: ', url);
	handlePaginationSidebar(url, filter, input, page);
}

function handlePaginationSidebar(url, filter, input, page) {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', `../../mvc/API/index.php?${url}`, true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			let currPage = page;
			let dataTotalPage = JSON.parse(xhr.responseText);
			console.log('dataTotalPage: ', dataTotalPage);
			if (dataTotalPage.totalPage <= 1) {
				document.querySelector('.pmbpagi__list').innerHTML = '';
				return;
			}
			console.log(
				'pagination: ',
				dataTotalPage.totalPage,
				currPage,
				filter,
				input
			);
			renderPagination(dataTotalPage.totalPage, currPage, filter, input);
		}
	};
	xhr.send();
}
