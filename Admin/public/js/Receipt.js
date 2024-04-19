function handleOrder() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  const recceip = `
    <div>
      <div class="Mange_item">
        <h3>Quản lý Đơn Hàng</h3>
      </div>
    </div>
    <div class="client_status">
      <div class="status_demo">
        <select id="selectHandle">
          <option value="1">Trạng Thái Ban Đầu</option>
          <option value="Chưa Xử Lí">Chưa Xử Lí</option>
          <option value="Đã Xử Lí">Đã Xử Lí</option>
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
    <div style="overflow-x: auto" class="voucher_table">
      <table id="table_product"></table>
    </div>
    <div class="Order_Details" style="display: none;">
      <div class="oder_title">Chi Tiết Đơn Hàng</div>
      <div class="item_order">
        <div class="order_box">
          <div class="box1">
          </div>
          <div class="box2">
            <div class="box_item1"></div>
            <div class="box_item2">
              <div class="box_header">
                <p>NGƯỜI NHẬN</p>
              </div>
              <div class="box_footer">
                <p>Vy Văn Mười</p>
                <span>Địa Chỉ : Cưklong - Krong Năng - Đaklak</span>
              </div>
            </div>
          </div>
          <div class="box3">
            <table></table>
          </div>
        </div>
        <div class="order_box1">
          <div class="Pay-ment"></div>
          <div class="pay_tbody">

          </div>
          <div class="btn-handle">
         
            
          </div>
          <div class="btn_out">
            <button onclick="handleout()">Đóng</button>
          </div>
        </div>
      </div>
    </div>
  `;
  Mange_client.innerHTML = recceip;
  getdatareciep();
}

function dispaylist(data) {
  let tablevoucher = document.getElementById("table_product");
  let tableitem = `  
      <tr>
    <th>STT</th>
    <th>Khách Hàng</th>
    <th>Ngày Đặt</th>
    <th>Tổng Tiền</th>
    <th>Trạng Thái</th>
    <th>Tác Vụ</th>
    </tr>
    `;

  let dem = 0;
  data.forEach((item, index) => {
    index++;
    let idindex = index;
    console.log(item.MaHD);
    tableitem += `
      <tr>
      <td>${dem++}</td>
      <td>${item.MaKH.Ho}  ${item.MaKH.Ten}</td>
      <td>${item.NgayBan}</td>
      <td>
   ${item.TongTien}
      </td>
      <td>
        <button class="btn-online">${item.trangthai}</button>
      </td>
      <td
      >
      <i class="fa-solid fa-eye" style="color: 0078ff" onclick="handleviewcthd('${
        item.MaHD
      }')"></i>
        <i class="fa-solid fa-pen" style="color: rgb(37, 186, 216)"></i>
        <i class="fa-solid fa-trash-can" style="color: red"></i>
      </td>
    </tr>
      `;
  });
  tablevoucher.innerHTML = tableitem;
  handlebtnxuli();
}

function getdatareciep() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../mvc/API/index.php?type=hoadon", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var data = JSON.parse(xhr.responseText);
        dispaylist(data);
        console.log(data);
        document
          .getElementById("handlesearchname")
          .addEventListener("click", () => {
            let keyinput = document.getElementById("searchname").value;
            const filteredData = data.filter((item, index) => {
              return item.MaKH.Ten.includes(keyinput);
            });
            dispaylist(filteredData);
          });

        document
          .getElementById("selectHandle")
          .addEventListener("change", () => {
            let valueselect = document.getElementById("selectHandle").value;
            if (valueselect === "1") {
              dispaylist(data);
            } else {
              let mapData = [];
              data.forEach((item) => {
                if (valueselect === item.trangthai) {
                  mapData.push(item);
                }
              });

              dispaylist(mapData);
            }
          });
      }
    }
  };

  xhr.send();
}

function handleviewcthd(id) {
  const Order_Details = document.getElementsByClassName("Order_Details")[0];
  const voucher_table = document.getElementsByClassName("voucher_table")[0];
  voucher_table.style.display = "none";
  Order_Details.style.display = "block";
  let a = document.getElementsByClassName("client_status")[0];
  a.style.opacity = "0.1";
  a.style.pointerEvents = "none";
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../mvc/API/index.php?type=cthoadon&id=" + id, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      const box3 = document.querySelectorAll(".box3 table")[0];
      const box_item1 = document.getElementsByClassName("box_item1")[0];
      const box1 = document.getElementsByClassName("box1")[0];
      const Pay_ment = document.getElementsByClassName("Pay-ment")[0];
      var data = JSON.parse(xhr.responseText);
      let dataall = JSON.parse(data);
      console.log(dataall);
      if (Object.keys(dataall).length === 0) {
        box_item1.innerHTML = "<p>Không có đơn hàng.</p>";
        return;
      }
      let tablebox = `
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Đơn Giá</th>
                <th>Tổng Tiền</th>
            </tr>`;
      let tongtien = 0;
      dataall.chitiethoadon.map((item, index) => {
        tongtien += item.so_soluong * item.gia_ban;
        tablebox += `
                <tr>
                    <td>${item.TenGiay}</td>
                    <td>${item.so_soluong}</td>
                    <td>${formatCurrency(item.gia_ban)}</td>
                    <td>${formatCurrency(item.so_soluong * item.gia_ban)}</td>
                </tr>
            `;
      });
      console.log(tongtien);
      box3.innerHTML = tablebox;

      let databox = `
            <div class="box_header"> 
                <p>Khách Hàng</p>
            </div>
            <div class="box_footer">
                <p>${dataall.mahd.MaKH.Ho} ${dataall.mahd.MaKH.Ten}</p>
                <span>sdt: ${dataall.mahd.MaKH.Email}</span>
            </div>
        `;

      let orderId = `
       <div  style="width:50%"> <p>Mã Đơn Hàng : ${dataall.mahd.MaHD}</p>
       <p>Ngày Đặt : ${dataall.mahd.NgayBan}
           |
       </p></div>
       <div style="width:50%"><span>Trạng Thái : </span>
       <select>
       <option>Đã Liên Lạc</option>
       <option>Đã Giao</option>

       </select></div>
        `;

      let pay_total = `
        <div class="pay_item">
                <p>Phương Thức Thanh Toán</p>
            </div>
            <hr>
            <div class="number_pay">
                <p>Tiền Mặt</p>
                <span>${formatCurrency(tongtien)}</span>
            </div>
            <div class="number_pay">
                <p>Chuyển Khoản</p>
                <span>0</span>
            </div>
        
        `;

      let total = `
        <div class="number_pay">
        <p>Tạm Tính</p>
        <span>${formatCurrency(tongtien)}</span>
      </div>
      <div class="number_pay">
        <p>Khuyến Mãi</p>
        <span>100000</span>
      </div>
      <hr>
      <div class="number_pay">
        <p style="color: black; font-weight: 700; font-size: 1rem">Cần Thanh Toán</p>
        <span style="color: red; font-weight: 700; font-size: 1.2rem">${formatCurrency(
          tongtien
        )}</span>
      </div>
      
        `;

      document.getElementsByClassName("pay_tbody")[0].innerHTML = total;
      Pay_ment.innerHTML = pay_total;
      box1.innerHTML = orderId;

      box_item1.innerHTML = databox;
      let btn_online = document.getElementsByClassName("btn-online");
      for (let i = 0; i < btn_online.length; i++) {
        let btn_text = btn_online[i].textContent.trim();

        if (btn_text === "Chưa Xử Lí") {
          btn_online[i].style.backgroundColor = "red";
          btn_online[i].style.color = "white";
        }
        if (btn_text === "Đã Xử Lí") {
          btn_online[i].style.backgroundColor = "green";
          btn_online[i].style.color = "white";
        }

        console.log(btn_text);
      }
    }
  };

  xhr.send();
  cityop();
}

function handleout() {
  const Order_Details = document.getElementsByClassName("Order_Details")[0];
  const voucher_table = document.getElementsByClassName("voucher_table")[0];
  console.log(Order_Details);
  voucher_table.style.display = "block";
  Order_Details.style.display = "none";
  let a = document.getElementsByClassName("client_status")[0];
  a.style.opacity = "1";
  a.style.pointerEvents = "auto";
  cityopmove();
}

function cityop() {
  let poss = document.querySelectorAll(
    ".header ,.Mange_client,.header_content"
  );

  poss.forEach((poss) => {
    poss.style.opacity = "0.1";
    poss.style.pointerEvents = "none";
  });
}
function cityopmove() {
  let poss = document.querySelectorAll(
    ".header ,.header_content,.client_status"
  );
  poss.forEach((poss) => {
    poss.style.opacity = "1";
    poss.style.pointerEvents = "auto";
  });
}
function formatCurrency(amount) {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(amount);
}
function handlesearch() {
  let daylast = document.getElementById("daylast");
  let dayfrist = document.getElementById("dayfrist");
  let data = {
    dayfrist: dayfrist.value,
    daylast: daylast.value,
  };
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../mvc/API/index.php?type=searchday", true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);
      console.log(JSON.parse(response));
      dispaylist(JSON.parse(response));
    }
  };
  xhr.send(JSON.stringify(data));
}
function handlebtnxuli() {
  let btn_online = document.getElementsByClassName("btn-online");
  for (let i = 0; i < btn_online.length; i++) {
    let btn_text = btn_online[i].textContent.trim();

    if (btn_text === "Chưa Xử Lí") {
      btn_online[i].style.backgroundColor = "red";
      btn_online[i].style.color = "white";
    }
    if (btn_text === "Đã Xử Lí") {
      btn_online[i].style.backgroundColor = "green";
      btn_online[i].style.color = "white";
    }

    console.log(btn_text);
  }
}
