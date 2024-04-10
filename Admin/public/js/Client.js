function handleclient() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  const client = `
  <div>
  <div class="table_product">
  <div>
  <h3>Quản lí Khách Hàng</h3>
  </div>
    <table id="table_product">
      
      
    </table>
  </div>
</div>
        `;

  Mange_client.innerHTML = client;
  getlistClient();
}

function getlistClient() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../mvc/API/index.php?type=dsKhachHang", true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);
      handledata(response);
    }
  };
  xhr.send();
}
function handledata(data) {
  console.log(data);
  const table_product = document.getElementById("table_product");
  let data_table = `
      <tr>
        <th>STT</th>
        <th>Họ và Tên</th>
        <th>Địa Chỉ</th>
        <th>Giới Tính</th>
        <th>Email</th>
        <th>Hành Động</th>
      </tr>
  `;
  data.forEach((item, index) => {
    data_table += `
      <tr>
        <td>${index + 1}</td>
        <td>${item.Ho} ${item.Ten}</td>
        <td>${item.DiaChi}</td>
        <td>${item.GioiTinh}</td>
        <td>${item.Email}</td>
        <td>
          <i class="fa-solid fa-pen-to-square" style="color: #04b64b"></i>
          <i class="fa-solid fa-trash-can" style="color: #ff4a4a"></i>
        </td>
      </tr>
    `;
  });
  table_product.innerHTML = data_table;
}
