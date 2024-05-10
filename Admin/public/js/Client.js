function handleclient() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  const client = `
  <div>
  <div class="table_product">
  <div>
  <h3>Quản lí Khách Hàng</h3>
  <div class="client_status">

  <div class="serch_client">
    <input type="text" placeholder="Nhập tên tìm kiếm tại đây" id="searchnameclient" />
   
  </div>
  

</div>
  </div>
    <table id="table_product" style="margin-top:30px">
      
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
      let searchnameclient = document.getElementById("searchnameclient");
      searchnameclient.addEventListener("input", () => {
        let keyword = searchnameclient.value.trim().toUpperCase(); // Chuyển thành chữ hoa
        const filteredData = response.filter((item, index) => {
          return item.Ten.toUpperCase().includes(keyword);
        });
        handledata(filteredData);
      });
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
        <th>Số Điện Thoai</th>
      </tr>
  `;
  data.forEach((item, index) => {
    data_table += `
      <tr>
        <td>${index + 1}</td>
        <td>${item.Ho} ${item.Ten}</td>
        <td>${item.DiaChi}</td>
 
        <td>${item.Email}</td>
        <td>${item.SDT}</td>
        
      </tr>
    `;
  });
  table_product.innerHTML = data_table;
}
