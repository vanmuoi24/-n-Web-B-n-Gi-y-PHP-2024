function handleOrder() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  const recceip = `

  <div>
  <div class="Mange_item">
      <h3>Quản lý Phiếu Nhập</h3>
   
  </div>
</div>
  <div class="client_status">
          <div class="status_demo">
            <select>
              <option>Trạng Thái</option>
              <option value="1">Khách Hàng Online</option>
              <option value="2">Khách Hàng Ofline</option>
            </select>
          </div>
          <div class="serch_client">
            <input type="text" placeholder="Nhập tên tìm kiếm tại đây " />
          </div>
          <div class="serch_date">
            <div>
              <label for="">Từ:</label>
              <input type="date" />
            </div>
            <div>
              <label for="">Đến:</label>
              <input type="date" />
            </div>
          </div>
          
        </div>
 <div style="overflow-x: auto" class="voucher_table">
 <table>
 </table>
</div>
<div class="Order_Details" style="display: none;">
<div class="oder_title">Chi Tiết Đơn Hàng</div>
<div class="item_order">
    <div class="order_box">
        <div class="box1">
           
        </div>
        <div class="box2">
            <div class="box_item1">
                
            </div>
            <div class="box_item2">
                <div class="box_header">
                    <p>
                        NGƯỜI NHẬN
                    </p>
                </div>
                <div class="box_footer">
                    <p>Vy Văn Mười</p>
                    <span>Địa Chỉ : Cưklong - Krong Năng - Đaklak</span>
                </div>
            </div>

        </div>
        <div class="box3">
            <table> 
            </table>
        </div>
    </div>
    <div class="order_box1">
        <div class="Pay-ment">
            
        </div>

        <div class="pay_tbody">
            <div class="number_pay">
                <p>Tạm Tính</p>
                <span>100000</span>
            </div>
            <div class="number_pay">
                <p>Phí Vận Chuyển</p>
                <span>100000</span>
            </div>
            <div class="number_pay">
                <p>Khuyến Mãi</p>
                <span>100000</span>
            </div>
            <hr>
            <div class="number_pay">
                <p style="color:black; font-weight:700 ; font-size : 1rem" >Cần Thanh Toán</p>
                <span  style="color:red; font-weight:700 ; font-size : 1.2rem">100.000.000</span>
            </div>
        </div>
        <div class="btn-handle">

            <button>Ghi Chú</button>
            <button>Sửa Đơn</button>
            <button>Hủy Đơn</button>

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

function getdatareciep() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../mvc/API/index.php?type=hoadon", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var data = JSON.parse(xhr.responseText);

        let tablevoucher = document.querySelectorAll(".voucher_table table")[0];
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
          <td>${item.MaKH.Ho}</td>
          <td>${item.NgayBan}</td>
          <td>
       ${item.TongTien}
          </td>
          <td>
            <button class="btn-online">Hoat động</button>
          </td>
          <td
            style="
              display: flex;
              gap: 20px;
              align-items: center;
              justify-content: center;
            "
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
      }
    }
  };

  xhr.send();
}

function handleviewcthd(id) {
  console.log(id);
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
        <p>Mã Đơn Hàng : ${dataall.mahd.MaHD}</p>
        <p>Ngày Đặt : ${dataall.mahd.NgayBan}
            |
</p>
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
      Pay_ment.innerHTML = pay_total;
      box1.innerHTML = orderId;

      box_item1.innerHTML = databox;
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
