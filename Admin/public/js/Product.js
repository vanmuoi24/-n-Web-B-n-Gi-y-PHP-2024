// function handleDeleteItem(itemId) {
//   console.log(itemId);
//   let confrim = confirm("Bạn có chắc chắn muốn xóa sản phẩm không?");
//   if (confrim) {
//     var xhr = new XMLHttpRequest();
//     xhr.open("POST", "../php/deleteitem.php", true);
//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhr.onreadystatechange = function () {
//       if (xhr.readyState == 4 && xhr.status == 200) {
//         var response = JSON.parse(xhr.responseText);
//         if (response.success) {
//           // Xóa thành công, cập nhật lại danh sách
//           updateItemList();
//         } else {
//           alert("Lỗi khi xóa: " + response.error);
//         }
//       }
//     };

//     xhr.send("item_id=" + itemId);
//   } else {
//     return;
//   }
// }

// function updateItemList() {
//   // Gửi yêu cầu cập nhật danh sách thông qua AJAX
//   var xhr = new XMLHttpRequest();
//   xhr.open("GET", "../php/getotemist.php", true);
//   xhr.onreadystatechange = function () {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       // Cập nhật lại danh sách trên trang web với dữ liệu mới
//       document.getElementById("table_product").innerHTML = xhr.responseText;
//     }
//   };
//   xhr.send();
// }

function handleProduct() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  const ProductOut = `
        <div>
            <div class="Mange_item">
                <h3>Quản lý sản Phẩm</h3>
            <div
                style="display: flex; justify-content: center; align-items: center"
                >
                <img src="../src/img/Rectangle 3785.png" alt="" />
                <img src="../src/img/Group 729.png" alt="" />
            </div>
        </div>
        <div class="table_product">
            <table id="table_product">
            
            
            </table>
        </div>
            
    `;
  Mange_client.innerHTML = ProductOut;
  getlistproduct();
}
function getlistproduct() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../mvc/API/index.php?type=giay", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var data = JSON.parse(xhr.responseText);
        console.log(data);
        let tablevoucher = document.getElementById("table_product");
        console.log(tablevoucher);
        let tableitem = `  
        <tr>
        <th>STT</th>
        <th>Tên Sản Phẩm</th>
        <th>Thương Hiệu</th>
        <th>Số Lượng</th>
        <th>Hình Ảnh</th>
        <th>Giá Tiền</th>
        <th>Hành Động</th>
    </tr>
 `;
        let dem = 0;
        data.forEach((item, index) => {
          index++;
          let idindex = index;
          tableitem += `
          <tr>
          <td>${dem++}</td>
          <td>${item.Tengia}</td>
          <td></td>
          <td>${item.SoLuong}</td>
          <td>
          <img src="../src/img/giay.jpg" alt="" style="width: 50px" />
          </td>
          <td>${formatCurrency(item.DonGia)}</td>
          <td>
          <i class="fa-solid fa-pen-to-square" style="color: #04b64b"></i>
          <i class="fa-solid fa-trash-can" style="color: #ff4a4a" onclick="handledeleteitem(${
            item.MaGiay
          })"></i>
          </td>
      </tr>
          `;
        });
        tablevoucher.innerHTML = tableitem;
      }
    }
  };

  xhr.send();
}
function formatCurrency(amount) {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(amount);
}
function handledeleteitem(itemId) {
  console.log(itemId);
  let confirmed = confirm("Bạn có chắc chắn muốn xóa sản phẩm không?");
  if (confirmed) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../mvc/API/index.php?type=xoa", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          getlistproduct();
        } else {
          alert("Lỗi khi xóa: " + response.error);
        }
      }
    };
    xhr.send("item_id=" + itemId);
  } else {
    return;
  }
}
