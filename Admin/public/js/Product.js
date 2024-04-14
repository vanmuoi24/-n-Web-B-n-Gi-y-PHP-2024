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
  `;
  Mange_client.innerHTML = ProductOut;

  phantrang(6, 0, sortOrder);
}

function handledeleteitem(itemId) {
  // Hiển thị thông báo xác nhận trước khi xóa
  if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../mvc/API/index.php?type=xoa", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          // Thông báo xóa thành công và cập nhật lại danh sách sản phẩm
          alert("Xóa sản phẩm thành công!");
          phantrang(6, (currentPage - 1) * 6, sortOrder);
        } else {
          // Thông báo lỗi khi xóa
          alert("Lỗi khi xóa: " + response.error);
        }
      }
    };
    xhr.send("item_id=" + itemId);
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
                        <th>Số Lượng</th>
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
                <td>${item.SoLuong}</td>
                <td><img src="${
                  item.HinhAnh
                }" alt="" style="width: 50px" /></td>
                <td>${formatCurrency(item.DonGia)}</td>
                <td>
                    <i class="fa-solid fa-pen-to-square" style="color: #04b64b"></i>
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
