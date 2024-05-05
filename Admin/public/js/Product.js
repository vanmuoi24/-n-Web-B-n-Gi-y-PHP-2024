let currentPage = 1;
let totalPages = 1;
let sortOrder = "asc";

function handleProduct() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  const ProductOut = `
    <div>
      <div class="Mange_item">
        <h3>Quản lý sản Phẩm</h3>
        <div style="display: flex; justify-content: center; align-items: center">
          <img src="../src/img/Rectangle 3685.png" alt="" />
          <img src="../src/img/Group 629.png" alt="" />
        </div>
      </div>
      <div class="table_product">
        <table id="table_product"></table>
      </div>
      <div class="pagination">
        <a onclick="prevPage()">&laquo;</a>
        <span id="pageNumbers"></span>
        <a onclick="nextPage()">&raquo;</a>
      </div>
    </div>
    <div class="viewctProduct" style="width: 100% ;display:none">
 

    <div class="" style="width: 50% ; margin: auto; border :1px solid;background:white">

        <div style=" margin: auto;" class="viewproduct">
        </div>
    
        <div>
                   <table id="table_product1" style=" margin: auto;">
              
                <tr>
                    
                </tr>
            </table>
        </div>
    </div>
</div>
  `;
  Mange_client.innerHTML = ProductOut;

  phantrang(6, 0, sortOrder);
}

function handledeleteitem(id) {
  if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../mvc/API/index.php?type=xoa&id=" + id, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          alert("Xóa sản phẩm thành công!");
          phantrang(6, (currentPage - 1) * 6, sortOrder);
        } else {
          alert("Lỗi khi xóa: " + response.error);
        }
      }
    };
    xhr.send();
  }
}

function phantrang(limit, offset, sortOrder) {
  // Sửa đổi ở đây
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../mvc/API/index.php?type=dsphantrang", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);
      var data = response.data;

      if (data.length > 0) {
        totalPages = response.totalPages;
        updatePageContent(data);
        updatePageNumbers(currentPage, totalPages);
      } else {
        console.log("Không có dữ liệu để hiển thị.");
      }
    }
  };
  xhr.send("limit=" + limit + "&offset=" + offset + "&sortOrder=" + sortOrder);
}

function updatePageNumbers() {
  let pageNumbers = document.getElementById("pageNumbers");
  pageNumbers.innerHTML = "";

  if (totalPages > 0) {
    for (let i = 1; i <= totalPages; i++) {
      let pageLink = document.createElement("a");
      pageLink.textContent = i;
      pageLink.onclick = function () {
        currentPage = i;
        phantrang(6, (currentPage - 1) * 6, sortOrder);
        updatePageNumbers();
      };

      if (i === currentPage) {
        pageLink.classList.add("active");
      }

      pageNumbers.appendChild(pageLink);
    }
  }
}

function prevPage() {
  if (currentPage > 1) {
    currentPage--;
    phantrang(6, (currentPage - 1) * 6, sortOrder);
  }
}

function nextPage() {
  if (currentPage < totalPages) {
    currentPage++;
    phantrang(6, (currentPage - 1) * 6, sortOrder);
  }
}

function updatePageContent(data) {
  let tablevoucher = document.getElementById("table_product");
  let tableitem = `<tr>
                        <th>Mã Sản Phẩm  </th>
                        <th>Tên Sản Phẩm  <i class="fa-solid fa-arrow-down" onclick="handledowdata()"></i> <i class="fa-solid fa-arrow-up" onclick="handleupdata()"></i></th>
                        <th>Thương Hiệu</th>
                        <th>Hình Ảnh</th>
                        <th>Giá Tiền</th>
                        <th>Hành Động</th>
                    </tr>`;
  let dem = 0;
  data.forEach((item, index) => {
    index++;
    tableitem += `
            <tr>
                <td>${item.MaGiay}</td>
                <td>${item.Tengia}</td>
                <td>${item.ThuongHieu.TenThuongHieu}</td>
           
                <td><img src="${
                  item.HinhAnh
                }" alt="" style="width: 50px" /></td>
                <td>${formatCurrency(item.DonGia)}</td>
                <td>
                    <i class="fa-solid fa-eye" style="color: #04b64b" onclick=handleview('${
                      item.MaGiay
                    }')></i>
                    <i class="fa-solid fa-trash-can" style="color: #ff4a4a" onclick="handledeleteitem('${
                      item.MaGiay
                    }')"></i>
                </td>
            </tr>`;
  });
  tablevoucher.innerHTML = tableitem;
}

function formatCurrency(amount) {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(amount);
}

function handledowdata() {
  sortOrder = "asc";
  phantrang(6, (currentPage - 1) * 6, sortOrder); // Sửa đổi ở đây
}

function handleupdata() {
  sortOrder = "desc";
  phantrang(6, (currentPage - 1) * 6, sortOrder); // Sửa đổi ở đây
}

function handleview(id) {
  let table_product = document.getElementsByClassName("table_product")[0];
  table_product.style.opacity = "0.1";
  let viewctProduct = document.getElementsByClassName("viewctProduct")[0];
  viewctProduct.style = "block";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../mvc/API/index.php?type=viewctProduct&id=" + id, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      let viewproduct = document.querySelector(".viewproduct");
      let table = document.querySelector("#table_product1");
      let item = JSON.parse(data);
      console.log(item);
      let view = `
  <div class="icon_view">    <h3>Thông Tin Chi Tiết Sản Phẩm</h3>
  <i class="fa-regular fa-circle-xmark" onclick="handleclossitem()"></i></div>

          <span> Mã Sản Phẩm : ${id} </span>
          <span> Tên Sản Phẩm : ${item.giay.Tengia}</span>
          <span> Thương Hiệu Sản Phẩm : ${item.giay.TenThuongHieu}</span>
          <span style="padding:20px 0px 20px 0px"> Hình Ảnh : <img src="${
            item.giay.HinhAnh
          }" style="width: 50px ;top:30%" /> </span>
          <span> Giá Tiền : ${formatCurrency(item.giay.DonGia)}</span>
      `;

      let tableview = `
          <thead>
              <th>Size</th>
              <th>Số Lượng</th>
          </thead>
          <tbody>
      `;
      item.giaysize.forEach((item, index) => {
        // Sử dụng forEach thay vì map vì không cần trả về mảng mới
        tableview += `
              <tr>
                  <td>${item.Sizes.KichThuoc}</td>
                  <td>${item.SoLuong}</td>
              </tr>
          `;
      });
      tableview += `</tbody>`;
      table.innerHTML = tableview;
      viewproduct.innerHTML = view;
    }
  };
  xhr.send();
  cityop();
}
function cityop() {
  let poss = document.querySelectorAll(".header ,.table_product");

  console.log(table_product);
  poss.forEach((poss) => {
    poss.style.opacity = "0.1";
    poss.style.pointerEvents = "none";
  });
}

function cityopmove() {
  let poss = document.querySelectorAll(".header,.table_product");
  poss.forEach((poss) => {
    poss.style.opacity = "1";
    poss.style.pointerEvents = "auto";
  });
}
function handleclossitem() {
  let viewctProduct = document.getElementsByClassName("viewctProduct")[0];
  viewctProduct.style.display = "none";

  let table_product = document.getElementsByClassName("table_product")[0];
  table_product.style.opacity = "1";
  cityopmove();
}
