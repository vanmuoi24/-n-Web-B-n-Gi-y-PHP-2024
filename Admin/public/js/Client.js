function handleclient() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  const client = `
  <div>
  <div class="table_product">
  <div>
  <h3>Quản lí Khách Hàng</h3>
  <div class="client_status">
  <div class="status_demo">
    <select id="selectHandle">
      <option value="1">Trạng Thái Ban Đầu</option>
      <option value="Chưa Xử Lí">Đang Chờ</option>
      <option value="Đã Liên Lạc">Đã Liên Lạc</option>
      <option value="Đã Giao">Đã Giao</option>
      <option value="Hủy">Hủy</option>

    </select>
  </div>
  <div class="serch_client">
    <input type="text" placeholder="Nhập tên tìm kiếm tại đây" id="searchname" />
    <button onclick="handlesearchname()" id="handlesearchname">Tìm Kiếm <i class="fa-solid fa-magnifying-glass"></i></button>
  </div>
  <div class="serch_date">
    <div>
      <label for="dayfrist">Từ:</label>
      <input type="date" id="dayfrist" />
    </div>
    <div>
      <label for="daylast">Đến:</label>
      <input type="date" id="daylast" />
    </div>
  </div>
  <div class="searchinput">
    <div style="width: 100%" onclick="handlesearch()"><button>Tìm Kiếm <i class="fa-solid fa-magnifying-glass"></i></button></div>
  </div>
</div>
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

        <th>Email</th>
      </tr>
  `;
  data.forEach((item, index) => {
    data_table += `
      <tr>
        <td>${index + 1}</td>
        <td>${item.Ho} ${item.Ten}</td>
        <td>${item.DiaChi}</td>
 
        <td>${item.Email}</td>
        
      </tr>
    `;
  });
  table_product.innerHTML = data_table;
}
