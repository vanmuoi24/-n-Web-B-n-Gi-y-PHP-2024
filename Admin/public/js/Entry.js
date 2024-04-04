function handleReceipt() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  const entry = `

  <div class="admin_home">
 
</div>
<div>
  <div class="Mange_item">
      <h3>Quản lý Phiếu Nhập</h3>
      <div class="entry_btn">
          <button onclick="hanldeAddEntry()">Thêm Phiếu Nhập <i class="fa-solid fa-plus"></i></button>
      </div>
  </div>
</div>
<div style="overflow-x: auto" class="voucher_table">
  <table>
     
  </table>
</div>

<div style="overflow-x: auto" class="entry_table">
  <div style="border: 1px solid black" class="entry_span">
      <span> Chi Tiết Phiếu Nhập </span>
      <button id="btn3" onclick="handleclose()">Đóng</button>
  </div>
</div>
  <div class="for_add_item"  style="display: none">
      <div class="item_text">
          <span>Thêm Phiếu Nhập</span>
      </div>
      <div class="content_item_add" >
          <div class="input_add_item" >
              <div class="add_item_content">
                  <label>Mã Giày : </label>
                  <div>
                      <input type="text" name="ma_giay" id="ma_giay" value="" />

                  </div>         
              </div>
              <div class="add_item_content0">
                  <label>Mã PN : </label>
                  <div>
                      <input type="text" name="ma_pn" id="ma_pn" />
                  </div>
              </div>

            <div class="add_item_content">
                <label>Chọn Sản Phẩm Đã Có</label>
                <div>                  
                    <i onclick="handlsaveid()" class="fa-solid fa-circle-plus"></i>
                </div>
            </div>
          </div>
          <div class="input_add_item">
              <div class="add_item_content1">
                  <label>Tên Giày : </label>
                  <div> <input type="text" name="ten_giay" id="ten_giay" /></div>
              </div>
              <div class=" add_item_content2">
                  <label>Chất Liệu : </label>
                  <div>
                      <input type="text" name="chat_lieu" id="chat_lieu" value="" />
                  </div>
              </div>
          </div>
          <div class="input_add_item">
              <div class="add_item_content1">
                  <label>Số Lượng : </label>
                  <div> <input type="text" name="so_luong" id="so_luong" value=" " /></div>
              </div>
              <div class="add_item_content2">
                  <label>Giá Nhập : </label>
                  <div><input type="text" name="gia_nhap" id="gia_nhap" value="" /></div>
              </div>
          </div>
          <div class="input_add_item">
              <div class="add_item_content1">
                  <label>Loại : </label>
                  <select name="loai" id="loai">
                   
                  </select>
              </div>
              <div class="add_item_content2">
                  <label>Thương Hiệu : </label>
                  <select name="thuong_hieu" id="thuong_hieu">
                  </select>
              </div>
          </div>
          <div class="input_add_item">
              <div class="add_item_content1">
                  <label>Size : </label>
                  <select name="size" id="size">
                    
                  </select>
              </div>
              <div class="add_item_content2">
                  <label>Màu Sắc : </label>
                  <select name="mausac" id="mausac">
                  </select>
              </div>
          </div>
          <div class="input_add_item">
            <div class="add_item_content1">
                <label>Nhà Cung Cấp : </label>
                <select name="loai" id="loai">
                </select>
            </div>
          <div></div>
         
      </div>
          <div class="btn_content_exit">
              <button  id="btn1" onclick ="handlesavepn()" >
                  Lưu <i class="fa-solid fa-floppy-disk"></i>
              </button>
              <button id="btn2" onclick="hanldeexit()" >
              Thoát <i class="fa-solid fa-right-from-bracket"></i>
          </button>
          </div>
      </div>
      
  </div>
    <div class="table_product">
    <table id="table_product">
    </table>
</div>
<div class="table_cthd" style="display: none" >
    <table>
    <thead>
    <tr>
        <th>Mã Giày</th>
        <th>Mã Phiếu Nhập</th>
        <th>Số Lượng</th>
        <th>Giá Nhập  <div class="closstable"><i class="fa-regular fa-circle-xmark" onclick="handleclosscthd()"></i></div></th>
    </tr>
  </thead>
        <tbody>
            
        </tbody>
    </table>
  </div>
  `;

  Mange_client.innerHTML = entry;
  handlegetList();
}
function hanldeAddEntry() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../mvc/API/index.php?type=ds4table", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      console.log("check", data);
      let loaiop = document.getElementById("loai");
      let size = document.getElementById("size");
      let thuong_hieu = document.getElementById("thuong_hieu");
      let mausac = document.getElementById("mausac");
      let xuatxu = document.getElementById("xuatxu");
      let option1 = "";
      let option2 = "";
      let option3 = "";
      let option4 = "";
      let option5 = "";
      data.loai.map((item, index) => {
        option1 += `
        <option value="${item.MaLoai}">${item.TenLoai}</option>
         `;
      });
      data.size.map((item, index) => {
        option2 += `
        <option value="${item.MaSize}">${item.KichThuoc}</option>
         `;
      });
      data.thuonghieu.map((item, index) => {
        option3 += `
        <option value="${item.MaThuongHieu}">${item.TenThuongHieu}</option>
         `;
      });
      data.mausac.map((item, index) => {
        option4 += `
        <option value="${item.MaMau}">${item.TenMau}</option>
         `;
      });
      // data.xuatxu.map((item, index) => {
      //   option5 += `
      //   <option value="${item.MaXX}">${item.TenNuoc}</option>
      //    `;
      // });
      loaiop.innerHTML = option1;
      size.innerHTML = option2;
      // xuatxu.innerHTML = option5;
      thuong_hieu.innerHTML = option3;
      mausac.innerHTML = option4;
    }
  };
  xhr.send();
  const for_add_item = document.getElementsByClassName("for_add_item")[0];
  for_add_item.style.display = "block";
  cityop();
}

function hanldeexit() {
  const entry_table = document.getElementsByClassName("for_add_item")[0];
  entry_table.style.display = "none";
  cityopmove();
}

function cityop() {
  let poss = document.querySelectorAll(
    ".header ,.header_content,.voucher_table,.Mange_item"
  );
  poss.forEach((poss) => {
    poss.style.opacity = "0.2";
    poss.style.pointerEvents = "none";
  });
}
function cityopmove() {
  let poss = document.querySelectorAll(
    ".header ,.header_content,.voucher_table,.Mange_item"
  );
  poss.forEach((poss) => {
    poss.style.opacity = "1";
    poss.style.pointerEvents = "auto";
  });
}

function handlsaveid() {
  let poss = document.querySelectorAll(
    ".header ,.header_content,.voucher_table,.Mange_item"
  );
  poss.forEach((poss) => {
    poss.style.opacity = "0.5";
    poss.style.pointerEvents = "none";
  });
  const entry_table = document.getElementsByClassName("for_add_item")[0];
  entry_table.style.display = "none";
  const table_product = document.getElementsByClassName("table_product")[0];
  table_product.style.display = "block";
  tableproduct();
}

function handleshowinput() {
  const table_product = document.getElementsByClassName("table_product")[0];
  table_product.style.display = "none";
  cityopmove();
}
function handleclosscthd() {
  const table_cthd = document.getElementsByClassName("table_cthd")[0];
  table_cthd.style.display = "none";
  cityopmove();
}
function handlegetList() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../mvc/API/index.php?type=dsphieunhap", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      console.log(data);
      const voucher_table = document.querySelectorAll(
        ".voucher_table table"
      )[0];
      let table_item = `
        <tr>
            <th>STT</th>
            <th>MaPN</th>
            <th>Ngày Nhập</th>
            <th>Tổng Tiền</th>
            <th>Nhận Viên</th>
            <th>Nhà Cung Cấp</th>
            <th>Tác Vụ</th>
        </tr> 
      `;
      let dem = 0;
      data.map((item, index) => {
        table_item += `
        <tr>
            <td>${dem++}</td>
            <td>${item.MaPN}</td>
            <td>${item.NgayNhap}</td>
            <td>${item.TongTien}</td>
            <td>${item.MaNV.Ho}${item.MaNV.Ten}</td>
            <td>${item.MaNCC.TenNCC}</td>
            <td>
            <i class="fa-solid fa-eye" style="color: 0078ff" onclick="handleviewctph('${
              item.MaPN
            }')"></i>
        </tr> 
        
        `;
        voucher_table.innerHTML = table_item;
      });
    }
  };
  xhr.send();
}
function handleviewctph(id) {
  console.log(id);
  const table_cthd = document.getElementsByClassName("table_cthd")[0];
  table_cthd.style.display = "block";

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../mvc/API/index.php?type=dschitiethd&id=" + id, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      const table_cthd_body = document.querySelector(".table_cthd table tbody");
      let table_ct = "";
      JSON.parse(data).forEach((item) => {
        table_ct += `
          <tr>
            <td>${item.MaGiay}</td>
            <td>${item.MaPN}</td>
            <td>${item.SoLuong}</td>
            <td>${formatCurrency(item.GiaNhap)}</td>
          </tr>
        `;
      });
      table_cthd_body.innerHTML = table_ct;
    }
  };
  xhr.send();
  cityop();
}

function tableproduct() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../mvc/API/index.php?type=giay", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var data = JSON.parse(xhr.responseText);
        let tablevoucher = document.getElementById("table_product");
        let tableitem = `  
        <tr>
        <th>STT</th>
        <th>Tên Sản Phẩm</th>
        <th>Thương Hiệu</th>
        <th>Số Lượng</th>
        <th>Hình Ảnh</th>
        <th>Giá Tiền</th>
        <th style="display: flex; align-items: center;">Hành Động <i class="fas fa-times-circle" onclick="handleshowinput()"></i></th>
    </tr>
 `;
        let dem = 0;
        data.forEach((item, index) => {
          index++;
          let idindex = index;
          tableitem += `
          <tr>
          <td>${dem}</td>
          <td>${item.Tengia}</td>
          <td></td>
          <td>${item.SoLuong}</td>
          <td>
          <img src="../src/img/giay.jpg" alt="" style="width: 50px" />
          </td>
          <td>${formatCurrency(item.DonGia)}</td>
          <td>
          <i class="fa-regular fa-hand-pointer" onclick="handleitemproduct('${
            item.MaGiay
          }')"></i>
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

function handleitemproduct(id) {
  const table_product = document.getElementsByClassName("table_product")[0];
  table_product.style.display = "none";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../mvc/API/index.php?type=dssanpham&id=" + id, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);
      console.log(JSON.parse(response));
      filterdataproduct(JSON.parse(response));
    }
  };
  xhr.send();
}

function filterdataproduct(data) {
  const entry_table = document.getElementsByClassName("for_add_item")[0];
  entry_table.style.display = "block";
  document.getElementById("ma_giay").value = data.giay.MaGiay;
  document.getElementById("ten_giay").value = data.giay.Tengia;
  document.getElementById("chat_lieu").value = data.giay.ChatLieu;
  document.getElementById("so_luong").value = data.giay.SoLuong;
  document.getElementById("gia_nhap").value = data.giay.DonGia;

  var loai = document.getElementById("loai");
  var selectElement = document.getElementById("thuong_hieu");
  var size = document.getElementById("size");
  var mausac = document.getElementById("mausac");
  for (var i = 0; i < selectElement.options.length; i++) {
    if (selectElement.options[i].text === data.giay.ThuongHieu.TenThuongHieu) {
      selectElement.options[i].selected = true;
      break;
    }
  }
  for (var i = 0; i < loai.options.length; i++) {
    if (loai.options[i].text === data.giay.Loai.TenLoai) {
      loai.options[i].selected = true;
      break;
    }
  }
  for (var i = 0; i < size.options.length; i++) {
    if (size.options[i].text === data.giay.Size.KichThuoc) {
      size.options[i].selected = true;
      break;
    }
  }
  for (var i = 0; i < mausac.options.length; i++) {
    if (mausac.options[i].text === data.giay.MauSac.TenMau) {
      mausac.options[i].selected = true;
      break;
    }
  }
  let mapn = document.getElementById("ma_pn");

  if (mapn.value === "") {
    mapn.disabled = true;
  } else {
    mapn.value = data.chitiet.MaPN;
  }

  lockInputs();
}

function lockInputs() {
  const inputsAndSelects = document.querySelectorAll(
    "#loai , #thuong_hieu, #mausac,#ma_giay,#size,#chat_lieu,#ten_giay,#ma_pn"
  );
  inputsAndSelects.forEach((element) => {
    element.disabled = true;
  });
}

function handlesavepn() {
  const inputsAndSelects = document.querySelectorAll(
    "#loai , #thuong_hieu, #mausac, #ma_giay, #size, #chat_lieu, #ten_giay, #so_luong, #gia_nhap, #ma_pn"
  );
  const datainput = {};
  inputsAndSelects.forEach((element) => {
    datainput[element.id] = element.value;
  });
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../mvc/API/index.php?type=themsanphamoi", true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);
      console.log(JSON.parse(JSON.parse(response)));
    }
  };
  xhr.send(JSON.stringify(datainput));
}
