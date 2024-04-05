function handleStastical() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  let Stastical = `

<div class="wrapper_thongke">
    <div class="Mange_item">
           <h3>Thống kê </h3>

    </div>
    <div class="thong-ke">
        <ul>
           
        </ul>
    </div>
    <div class="loc">
        <div>
            <label for="tu-ngay">Từ ngày : </label>
            <input type="date" id="tu-ngay" name="tu-ngay">
        </div>
        <div><label for="den-ngay">Đến ngày : </label>
            <input type="date" id="den-ngay" name="den-ngay">
        </div>
        <div style="width: 40%;">
            <input type="text" name="" id="seacrch" placeholder="Tìm kiếm sản phẩm">
        </div>
        <div style="width: 10%;"> <button><i class="fa-solid fa-magnifying-glass"></i></button></div>

    </div>
    <div class="bang-thong-ke">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ẢNH SẢN PHẨM</th>
                    <th>TÊN SẢN PHẨM</th>
                    <th>SỐ LƯỢNG BÁN RA</th>
                    <th>DOANH THU</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>

    <div class="cthd_table">
    <div class="item_cthd" style="display:none;">
      <div " class="closs_title">
      <p>CHI TIẾT ĐƠN HÀNG </p>
      <i class="fa-regular fa-circle-xmark" onclick="handlecloss()"></i>
      </div>
      <table>
        

      </table>
    </div>
</div>
</div>                
    
    
    `;
  Mange_client.innerHTML = Stastical;
  listThongKe();
}
function cityop() {
  let poss = document.querySelectorAll(
    ".header ,.header_content,.thong-ke,.loc,.bang-thong-ke,.Mange_item"
  );
  poss.forEach((poss) => {
    poss.style.opacity = "0.1";
    poss.style.pointerEvents = "none";
  });
}
function cityopmove() {
  let poss = document.querySelectorAll(
    ".header ,.header_content,.thong-ke,.loc,.bang-thong-ke,.Mange_item"
  );
  poss.forEach((poss) => {
    poss.style.opacity = "1";
    poss.style.pointerEvents = "auto";
  });
}

function handlecloss() {
  let item_cthd = document.getElementsByClassName("item_cthd")[0];
  item_cthd.style.display = "none";
  cityopmove();
}
function listThongKe() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../mvc/API/index.php?type=dsthongke", true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let thong_ke = document.querySelectorAll(".thong-ke ul")[0];
      let bang_thong_ke = document.querySelectorAll(".bang-thong-ke tbody")[0];
      var response = JSON.parse(xhr.responseText);
      console.log(response);
      let donhang = 0;
      let soluong = 0;
      let doanhthu = 0;
      let item_price;
      let data = response.hoadon;
      data.map((donHang) => {
        donhang++;
        doanhthu += parseFloat(donHang.TongTien);
      });
      response.chitiet.map((chitiet) => {
        soluong += parseFloat(chitiet.SoLuong);
      });

      item_price = `
                <li style="background-color: #007bff;">
                    <span>Số lượng đơn hàng:</span>
                    <span id="so-luong-don-hang">${donhang}</span>
                </li>
                <li style="background-color: red;">
                    <span>Số lượng bán ra:</span>
                    <span id="so-luong-ban-ra">${soluong}</span>
                </li>
                <li style="background-color: #1BCD32">
                    <span>Doanh thu:</span>
                    <span id="doanh-thu">${formatCurrency(doanhthu)} </span>
                </li>
      
      `;
      let tbody = "";
      let dem = 0;
      response.chitiet.map((chitiet) => {
        tbody += `
            <tr>
                <td>${dem++}</td>
                <td>${chitiet.MaGiay}
                </td>
                <td>${chitiet.Tengia}</td>
                <td>${chitiet.SoLuong}</td>
                <td>${formatCurrency(chitiet.SoLuong)}</td>
                <td><button onclick ="handlechitiet('${
                  chitiet.MaGiay
                }')" >Xem chi tiết</button></td>
            </tr>
        `;
      });

      thong_ke.innerHTML = item_price;
      bang_thong_ke.innerHTML = tbody;
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
function handlechitiet(id) {
  let item_cthd = document.getElementsByClassName("item_cthd")[0];
  item_cthd.style.display = "block";
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../mvc/API/index.php?type=dschitietHD&id=" + id, true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);
      console.log(JSON.parse(response));
      let tablect = document.querySelectorAll(".item_cthd table")[0];

      let cttable = `
          <tr>  
                <th>MÃ ĐƠN HÀNG</th>
                <th>NGÀY MUA</th>
          </tr>  
      `;
      JSON.parse(response).hoadon.map((item, index) => {
        cttable += `
                <tr>
                    <td>${item.MaHD}</td>
                    <td>${item.NgayBan}</td>
                </tr>
        `;
        tablect.innerHTML = cttable;
      });
    }
  };
  xhr.send();
  cityop();
}
