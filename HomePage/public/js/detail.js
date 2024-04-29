function showDetail(id) {
	handleProductByID(id);
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
// HANDLE SELECT SIZE
function selectSize() {
	const listSize = document.querySelectorAll('.dpis-num');
	console.log('ahihi: ', listSize);
	listSize.forEach((item) =>
		item.addEventListener('click', function (e) {
			e.target.classList.add('active');
			removeActiveSelectSize(e.target.dataset.size);
		})
	);
}
function removeActiveSelectSize(index) {
	const listSize = document.querySelectorAll('.dpis-num');
	listSize.forEach((item) => {
		if (item.dataset.size != index) item.classList.remove('active');
	});
}

// HANDLE show/hide detail&discription
function showDiscInDetail() {
	document.querySelector('.dpmi-disc__content').classList.toggle('active');
	document.querySelector('.dpmi-detail__content').classList.remove('active');
}
function showDetailInDetail() {
	document.querySelector('.dpmi-disc__content').classList.remove('active');
	document.querySelector('.dpmi-detail__content').classList.toggle('active');
}
function showSizeGuideInDetail() {
	const sizeGuideEleInDetail = document.querySelector('.dpmi-size-guide');

	document.querySelector('.dpmi-disc__content').classList.remove('active');
	document
		.querySelector('.dpmi-size-guide__content')
		.classList.toggle('active');
	document.querySelector('.dpmi-detail__content').classList.remove('active');
}
//
function renderDetail(product) {
	const pageBody = document.querySelector('#page-body');
	let discountPrice = '';
	let discountTag = '';
	if (product.discountProduct.percentDiscount > 0) {
		discountPrice = `
		<p class="dpi-price">
         ${formatCurrency(
				product.priceProduct -
					(product.priceProduct *
						product.discountProduct.percentDiscount) /
						100
			)}
         
      </p>
      `;
		//
		discountTag = `
			<span data-iddiscount=${
				product.discountProduct.idDiscount
			} data-discount=${parseInt(
			product.discountProduct.percentDiscount
		)} class="detail-left__tag">-${parseInt(
			product.discountProduct.percentDiscount
		)}%</span>
		`;
	}
	if (product.quantityProduct <= 0) {
		discountTag = `
			<span class="detail-left__tag">SOLD OUT</span>
		`;
	}
	let imgEle = `
			<div class="detail-img">
            <img src="${product.imgProduct}" alt="${product.nameProduct}">
            ${discountTag}
         </div>
	`;
	let infoEle = `
					<div class="detail-product">
                  <div class="dp-info">
                     <div class="dpi-content">
                        <p class="dpi-name">${product.nameProduct}</p>
                        ${discountPrice}
                        <p class="dpi-price  ${
									discountPrice ? '--is-not-discount' : ''
								}">${formatCurrency(product.priceProduct)}
                        </p>
                        <p class="dpi-discription">
                           Fullbox ${product.nameProduct} / ${
		product.colorProduct.nameColor
	}. 
                           Phù hợp: mọi lứa tuổi, đi học, đi làm, thể thao hoạt động thể thao. Size:
                           36-45. Chất liệu: ${
										product.materialProduct
									}. Giao hàng toàn quốc. 
                           Bảo hành 3 tháng. 
                           Đổi trả dễ dàng. 
                           Streetwear, trẻ trung năng động.
                        </p>
                     </div>
                     ${listSizeHtml(product.sizeProduct)}
                     <div class="dpi-add-cart">
                        <div class="btn btn--primary dpi-add-cart-btn" id="btn-add-cart" onclick="addCart(\'${
									product.idProduct
								}\')">THÊM VÀO GIỎ HÀNG</div>
                     </div>
                  </div>
                  <div class="dp-more-info">
                     ${shipHtml()}
                     ${addressHtml()}
                     ${sizeGuideHtml()}
                     ${discriptionHtml(product)}
                     ${detailHtml(product)}
                  </div>
               </div>
	`;

	let detail = `
   <div class="detail">
      <div class="container-second">
         <div class="detail-content">
            <div class="detail-wrapper">
               <div class="detail-left">
               ${imgEle}
               </div>
               <div class="detail-right">
               ${infoEle}
               </div>
            </div>
         </div>
      </div>
   </div>
   `;
	pageBody.innerHTML = detail;
	document.querySelector('#page-heading').innerHTML =
		'<h1>CHI TIẾT SẢN PHẨM</h1>';
	//
	selectSize();
}
//
///RENDER HTML
function sizeGuideHtml() {
	return `
         <div onclick="showSizeGuideInDetail()" class="dpmi-size-guide">
               <div class="dpmi-size-guide__heading">
                  <span><i class="fa-solid fa-ruler"></i></span>
                  Size guide
               </div>
            <div class="dpmi-
         size-guide__content">
         <h2>Bảng size chính thức tại SGUShoes</h2>
         <table class="size-guide">
            <tr>
               <th>EU</th>
               <th>US MEN</th>
               <th>US WOMEN</th>
               <th>Chiều dài chân</th>
            </tr>
            <tr>
               <td>36</td>
               <td></td>
               <td>6</td>
               <td>~22.5cm</td>
            </tr>
            <tr>
               <td>37</td>
               <td></td>
               <td>6.5</td>
               <td>~23cm</td>
            </tr>
            <tr>
               <td>38</td>
               <td></td>
               <td>7.5</td>
               <td>~23.8</td>
            </tr>
            <tr>
               <td>39</td>
               <td></td>
               <td>8.5</td>
               <td>~24.6cm</td>
            </tr>
            <tr>
               <td> 40</td>
               <td>7</td>
               <td>9.5</td>
               <td>~25cm</td>
            </tr>
            <tr>
               <td>41</td>
               <td>8</td>
               <td>10.5</td>
               <td>~25.5cm</td>
            </tr>
            <tr>
               <td>42</td>
               <td>9</td>
               <td></td>
               <td>~26cm</td>
            </tr>
            <tr>
               <td>43</td>
               <td>10</td>
               <td></td>
               <td>~26.8cm</td>
            </tr>
            <tr>
               <td>44</td>
               <td>11</td>
               <td></td>
               <td>~27.8cm</td>
            </tr>
            <tr>
               <td>45</td>
               <td></td>
               <td>12</td>
               <td>~28.6cm</td>
            </tr>
         </table>
      </div>
                     </div>
                           
   

   `;
}
function shipHtml() {
	return `
      <div class="dpmi-ship">
      
         <div>
            <span><i class="fa-solid fa-fire"></i></span>
            Miễn phí vận chuyển toàn quốc cho đơn hàng trên 1tr.
         </div>
         <div>
            <span><i class="fa-solid fa-bolt"></i></span>Giao nhanh 2h trong nội thành HCM.
         </div>
         <div>
            <span><i class="fa-solid fa-truck"></i></span>Thời gian vận chuyển trung bình 3-4 ngày.
         </div>
         </div>
   `;
}
function addressHtml() {
	return `
   <div class="dpmi-address">
      <p style="	margin-bottom: 18px; ">Visit our store in HCM city</p>
      <p style="	margin-bottom: 8px; font-size: 1.8rem">Phone: 0903 150 443</p>
      <p style="font-size: 1.8rem"> 273 An Dương Vương ,P3, Q5, HCM.</p>
   </div>
   `;
}
function discriptionHtml(product) {
	return `
         <div onclick="showDiscInDetail()" class="dpmi-disc">
            <div class="dpmi-disc__heading">
               <p>Mô tả</p>
               <p><i class="fa-solid fa-angle-down"></i></p>
            </div>
         </div>
         <div class="dpmi-disc__content">
         <h3>${product.nameProduct}</h3>
         <p>Một trong những mẫu được nhiều người yêu giày săn đón trong thời
            gian vừa qua. Đôi giày ${product.nameProduct} sở hữu nhiều ưu điểm nổi bật mà
            không
            phải bất kỳ dòng giày nào cũng có.
         </p>
         <h3>Chất Liệu Cao Cấp Bền Bỉ</h3>
         <p>
            Chất liệu chính là ${product.materialProduct} cực sang. Hơn nữa, phần TPU trên miếng lót gót chân
            tạo nên độ ổn định đáng kinh ngạc. Mẫu giày vô cùng bền bỉ và không có hiện tượng cong
            vênh và hở phần đầu.
         </p>
         <h3>Cảm Giác Thoải Mái</h3>
         <p>
            Kết cấu của mẫu giày bám sát mọi sự chuyển động của người dùng, đem lại sự thoải mái khi
            mang hàng giờ liền. Tính năng hỗ trợ vòm tuyệt hảo phục vụ mục đích đi dạo nhiều giờ liền
            mà không cảm thấy đau chân.
         </p>
         <h3>Khả Năng Phối Ghép</h3>
         <p>
            Kiểu dáng tối giản giúp ${product.nameProduct} có thể phối ghép với nhiều items đến
            từ
            các phong cách thời trang khác nhau. Đồng thời, gam màu trung tính giúp biến đổi
            các outfits trở nên hài hòa và phù hợp với nhiều mục đích sử dụng.
         </p>
      </div>
   `;
}
function detailHtml(product) {
	return `
   
   <div onclick="showDetailInDetail()" class="dpmi-detail">
      <div class="dpmi-detail__heading">
         <div style="display: flex; justify-content: space-between">
            <span >Chi tiết</span>
            <span ><i class="fa-solid fa-angle-down"></i></span>
         </div>
         <div class='dpmi-detail__content'>
            <table class='detail-content'>
               <tr>
                  <th>Size</th>
                  <td>35,36,37,38,39,40,41,42,43,44</td>
               </tr>
               <tr>
                  <th>Loại sản phẩm</th>
                  <td>${product.typeProduct.nameType}</td>
               </tr>
               <tr>
                  <th>Màu sắc</th>
                  <td>${product.colorProduct.nameColor}</td>
               </tr>
               <tr>
                  <th>Thương hiệu</th>
                  <td>${product.brandProduct.nameBrand}</td>
               </tr>
               <tr>
                  <th>Xuất xứ</th>
                  <td>${product.originProduct.nameOrigin}</td>
               </tr>
            </table>
         </div>
      </div>
   </div>
   `;
}
function listSizeHtml(data) {
	console.log(data);
	let htmls = `
      <div class="dpi-size">
         <p>Size: </p>
            <ul class="dpis-list">
   `;

	data.map((item) => {
		htmls += `
         <li class="dpis-item"><span class="dpis-num" data-size=${
				item.idSize
			}>${item.idSize.slice(1)}</span></li>
      `;
	});
	htmls += `
         </ul>
      </div>
   `;
	console.log(htmls);
	return htmls;
}
