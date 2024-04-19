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
    <div class="client_status">
    <div class="serch_client">
      <input type="text" placeholder="Tìm kiếm tên sản phẩm " id="searchnameStaics" />
      <button onclick="handlesearchname()" id="handlesearchname">Tìm Kiếm <i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div class="serch_date" >
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
      <div style="" onclick="handlesearchStatic()"><button>Tìm Kiếm <i class="fa-solid fa-magnifying-glass"></i></button></div>
    </div>
  </div>
    <div class="table_product">
        <table id="table_product">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ẢNH SẢN PHẨM</th>
                    <th>TÊN SẢN PHẨM</th>
                    <th>SỐ LƯỢNG BÁN RA</th>
                    <th>DOANH THU   <i class="fa-solid fa-arrow-down" onclick="handledowdth()" id="handledowdth"></i> <i class="fa-solid fa-arrow-up" onclick="handleupdth()" id="handleupdth"></i></th>
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
      <i class="fa-regular fa-circle-xmark" onclick="handlecloss1()"></i>
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
    ".header ,.header_content,.thong-ke,.loc,.Mange_item,.client_status"
  );
  poss.forEach((poss) => {
    poss.style.opacity = "0.1";
    poss.style.pointerEvents = "none";
  });
}
function cityopmove() {
  let poss = document.querySelectorAll(
    ".header ,.header_content,.thong-ke,.loc,.Mange_item, .client_status"
  );
  poss.forEach((poss) => {
    poss.style.opacity = "1";
    poss.style.pointerEvents = "auto";
  });
}

function handlecloss1() {
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
      var response = JSON.parse(xhr.responseText);
      let data = {
        hoadon: response.hoadon,
        chitiet: response.chitiet,
      };
      displaylist(data);
      document
        .getElementById("searchnameStaics")
        .addEventListener("click", () => {
          let keyinput = document.getElementById("searchnameStaics").value;
          const filteredData = data.chitiet.filter((item, index) => {
            return item.Tengia.includes(keyinput);
          });
          displaylist({
            hoadon: response.hoadon,
            chitiet: filteredData,
          });
        });

      document.getElementById("handledowdth").addEventListener("click", () => {
        let keyinput = document.getElementById("searchnameStaics").value;
        const filteredData = data.chitiet.filter((item) => {
          return item.Tengia.includes(keyinput);
        });

        filteredData.sort((a, b) => b.GiaBan - a.GiaBan);

        displaylist({
          hoadon: response.hoadon,
          chitiet: filteredData,
        });
      });
      document.getElementById("handleupdth").addEventListener("click", () => {
        let keyinput = document.getElementById("searchnameStaics").value;
        const filteredData = data.chitiet.filter((item) => {
          return item.Tengia.includes(keyinput);
        });

        filteredData.sort((a, b) => a.GiaBan - b.GiaBan);
        displaylist({
          hoadon: response.hoadon,
          chitiet: filteredData,
        });
      });
    }
  };
  xhr.send();
}

function displaylist(data) {
  let donhang = data.hoadon.length;
  let soluong = 0;
  let doanhthu = 0;

  data.chitiet.forEach((chitiet) => {
    soluong += parseFloat(chitiet.SoLuong);
    doanhthu += parseInt(chitiet.SoLuong) * parseInt(chitiet.GiaBan);
  });

  let item_price = `
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
  data.chitiet.forEach((chitiet) => {
    tbody += `
      <tr>
          <td>${dem++}</td>
          <td><img src="${chitiet.HinhAnh}" alt="" style="width: 50px" /></td>
          <td>${chitiet.Tengia}</td>
          <td>${chitiet.SoLuong}</td>
          <td>${formatCurrency(chitiet.SoLuong * chitiet.GiaBan)}</td>
          <td><button onclick="handlechitiet('${
            chitiet.MaGiay
          }')">Xem chi tiết</button></td>
      </tr>
    `;
  });

  let thong_ke = document.querySelectorAll(".thong-ke ul")[0];
  let bang_thong_ke = document.querySelectorAll(".table_product tbody")[0];

  thong_ke.innerHTML = item_price;
  bang_thong_ke.innerHTML = tbody;
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

function handlesearchStatic() {
  let daylast = document.getElementById("daylast");
  let dayfrist = document.getElementById("dayfrist");
  let data = {
    dayfrist: dayfrist.value,
    daylast: daylast.value,
  };
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../mvc/API/index.php?type=searchdayTke", true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);

      console.log();
      displaylist({
        hoadon: JSON.parse(response).hoadon,
        chitiet: JSON.parse(response).chitiet,
      });
    }
  };
  xhr.send(JSON.stringify(data));
}
