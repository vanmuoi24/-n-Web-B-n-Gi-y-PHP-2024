function handlePromotion() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];

  const Pomotion = `
  <div>
  <div class="Mange_item">
      <h3>Quản lý Khuyến Mãi</h3>
      <div style="display: flex; justify-content: center; align-items: center">
          <img src="../src/img/Rectangle 3785.png" alt="" />
          <img src="../src/img/Group 729.png" alt="" />
      </div>
  </div>
  <div class="admin_voucher">
      <div>
          <button class="CTKHM">Chương Trình Khuyến Mãi</button>
          <button class="btn-new" onclick='handleaddvoucher()'>
              Thêm Mới  <i class="fa-solid fa-plus"></i>
          </button>
      </div>
      <div class="voucher">
          <div style="width: 20%">
              <select id="selectPosi">
                  <option value="1">Tất chương trình</option>
                  <option value="Giảm giá">Giảm giá</option>
                  <option value="Quà Tặng">Quà tặng</option>
              </select>
          </div>
          <div style="width: 60%">
              <input type="text" style="width: 100%" id="searchnamePosi"  />
          </div>
          <div style="width: 20%" id="searchnamePosi1"><button>Tìm Kiếm</button></div>
      </div>
      <hr style="margin-top: 20px" />
      <div style="overflow-x: auto" class="voucher_table">
          <table>
           
          </table>
      </div>

      <div class=" add_new_voucher">
          <div class="btn-addnew">
              <span>Quản lý Voucher : Thêm Mới</span>
              <div class="btn-out-save">
                  <button style="background-color: #0078ff; color: white" onclick ="saveallPosi()">
                      <i class="fa-solid fa-floppy-disk"></i> Lưu Dữ Liệu
                  </button>
                  <button id='btn-out'>
                      <i class="fa-solid fa-right-from-bracket"></i> Thoát
                  </button>
              </div>
          </div>
          <hr />


          <div class="add_new_item">
              <div class="add_text">
                  <h5>Thông tin cơ bản</h5>
                  <p>Thông tin cơ bản của voucher</p>
              </div>
              <div class="add_new_input">
                  <div class="input_add_one">
                      <label for=""> Mã Sản Phẩm Giảm Giá :  <i  class="fa-solid fa-circle-plus" onclick="handleBoxPosi()"></i> </label>
                      <select id='allProduct'>
                     
                      
                  </select>
                     
                  </div>
                  <div class="input_add_one">
                      <label for="">Giá Trị Giảm Giá : </label>
                      <input type="number" id="sortPrice" />
                  </div>
                  <div class="input_add_one">
                      <label for="">Điều Kiện Giảm Giá : </label>
                      <textarea id="statusSort"></textarea>
                     
                  </div>
              </div>
          </div>
          <hr />
          <div class="add_new_item">
              <div class="add_text">
                  <h5>Chương Trình Khuyến Mãi</h5>
              </div>
              <div class="add_new_input">
                  <div class="add_check">
                  <label>Loai Chương Trình : </label>
                  <select id="selectPosiall">
                  <option value="Giảm giá">Giảm giá</option>
                  <option value="Quà tặng">Quà tặng</option>
              </select>
              <input type="text" placeholder="Tên Chương Trình"  id="nameevent" />
                  </div>
              </div>
          </div>
          <hr />
          <div class="add_new_item">
              <div class="add_text">
                  <h5>Thời Gian Sử Dung</h5>
              </div>
              <div class="add_new_input">
                  <div class="input_add_one">
                      <label for="">Ngày Bắt Đầu: </label>
                      <input type="date" id="firtday" />
                  </div>
                  <div class="input_add_one">
                      <label for="">Ngày Kết Thúc : </label>
                      <input type="date" id="lastday" />
                  </div>
              </div>
          </div>
      </div>
      <hr />
  </div>
</div>
<div class="table-container">
<div class="btn-out-save">
<button style="background-color: #0078ff; color: white" onclick = "handlesavePosiProduct()">
    <i class="fa-solid fa-floppy-disk"></i> Lưu Dữ Liệu
</button>
<button id='btn-out'>
    <i class="fa-solid fa-right-from-bracket"></i> Thoát
</button>
</div>
            <div class="table-wrapper">

                <table id="myTable">
                    <thead>
                        <tr>
                            <th>Mã Sản Phẩm</th>
                            <th>Giá Bán</th>
                            <th>Chọn</th>
                        </tr>
                    </thead>
                   <tbody></tbody>
                </table>
            </div>
        </div>

    `;

  Mange_client.innerHTML = Pomotion;
  getlistvocher();
}
function handleaddvoucher() {
  let add_new_voucher = document.getElementsByClassName("add_new_voucher")[0];
  add_new_voucher.classList.add("add_cover");
  let posi = document.querySelectorAll(
    ".header, .header_content ,.Mange_item "
  );
  posi.forEach((posion) => {
    posion.style.opacity = "0.5";
    posion.style.pointerEvents = "none";
  });
  document.querySelectorAll("#btn-out").forEach((btn) => {
    btn.addEventListener("click", () => {
      add_new_voucher.classList.remove("add_cover");
      posi.forEach((posion) => {
        posion.style.opacity = "1";
        posion.style.pointerEvents = "auto";
      });
    });
  });

  let selectPosi = document.getElementById("selectPosiall");
  let inputAll = document.querySelector("#allProduct");
  let nameevent = document.getElementById("nameevent");
  nameevent.value = "Áp dụng cho từng sản phẩm";
  selectPosi.addEventListener("change", () => {
    if (selectPosi.value == "Giảm giá") {
      inputAll.disabled = false;
      nameevent.value = "Áp dụng cho từng sản phẩm";
      nameevent.disabled = true;
    }
    if (selectPosi.value == "Quà tặng") {
      inputAll.disabled = true;
      nameevent.value = "Áp dụng cho hóa đơn";
      nameevent.disabled = true;
    }
  });
}
function getlistvocher() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../mvc/API/index.php?type=danhsachKM", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var data = JSON.parse(xhr.responseText);
        getlisttablevoucher(data);
        console.log(data);
        let posi = document.getElementById("selectPosi");
        document.getElementById("selectPosi").addEventListener("change", () => {
          if (posi.value == "1") {
            getlisttablevoucher(data);
          } else {
            let mapData = [];
            data.map((item) => {
              if (posi.value == item.LoaiChuongTrinh) {
                mapData.push(item);
              }
            });
            getlisttablevoucher(mapData);
          }
        });
        document
          .getElementById("searchnamePosi")
          .addEventListener("input", () => {
            let searchnamePosi =
              document.getElementById("searchnamePosi").value;
            const filteredData = data.filter((item, index) => {
              return item.TenChuongTrinh.includes(searchnamePosi);
            });
            getlisttablevoucher(filteredData);
          });
      }
    }
  };

  xhr.send();
}

function getlisttablevoucher(data) {
  let tablevoucher = document.querySelectorAll(".voucher_table table")[0];
  let tableitem = `  <tr>
  <th>MãKM</th>
  <th>Ngày Bắt Đầu</th>
  <th>Ngày Kết Thúc</th>
  <th>Tên Chương Trình</th>
  <th>Loại Chương Trình</th>
  <th>Điều Kiện</th>

</tr>
`;
  data.forEach((item, index) => {
    tableitem += `
    <tr>
              <td>${item.MaKM}</td>
              <td>${item.NgayBatDau}</td>
              <td>${item.NgayKetThuc}</td>
              <td>${item.TenChuongTrinh}</td>
              <td>${item.LoaiChuongTrinh}</td>
              <td>${item.DieuKien}</td>
             
            
          </tr>   
    `;
  });
  tablevoucher.innerHTML = tableitem;
}

function list_posiBoxProduct(data) {
  let mttable = document.querySelectorAll(".table-wrapper tbody")[0];
  let table = "";
  console.log(mttable);
  data.map((item, index) => {
    table += ` 
    <tr>
        <td>${item.MaGiay}</td>
        <td>${formatCurrency(item.DonGia)}</td>
        <td><input type="checkbox" data-magiay="${item.MaGiay}"></td>
    </tr>
`;
  });
  mttable.innerHTML = table;
}
function handleBoxPosi() {
  let selectPosi = document.getElementById("selectPosiall");
  if (selectPosi.value == "Quà tặng") {
    return;
  }
  let table_container = document.getElementsByClassName("table-container")[0];
  table_container.style.display = "block";
  let add_new_voucher = document.getElementsByClassName("add_new_voucher")[0];
  add_new_voucher.classList.remove("add_cover");
  let posi = document.querySelectorAll(
    ".header, .header_content ,.Mange_item,.voucher_table "
  );
  posi.forEach((posion) => {
    posion.style.opacity = "0.5";
    posion.style.pointerEvents = "none";
  });

  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../mvc/API/index.php?type=giay", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var data = JSON.parse(xhr.responseText);
        console.log(data);
        list_posiBoxProduct(data);
      }
    }
  };
  xhr.send();
}
function handlesavePosiProduct() {
  let tableContainer = document.querySelector(".table-container");
  tableContainer.style.display = "none";

  let addNewVoucher = document.querySelector(".add_new_voucher");
  addNewVoucher.classList.add("add_cover");

  let inputAll = document.querySelector("#allProduct");
  let magiayDaChon = [];
  const checkboxes = document.querySelectorAll(
    '.table-wrapper input[type="checkbox"]:checked'
  );

  checkboxes.forEach((checkbox) => {
    const magiay = checkbox.getAttribute("data-magiay");
    magiayDaChon.push(magiay);
  });

  // Xây dựng chuỗi HTML của các option
  let optionAll = "";
  magiayDaChon.forEach((item, index) => {
    optionAll += `<option value="${item}">${item}</option>`;
  });

  // Thay đổi nội dung của dropdown inputAll
  inputAll.innerHTML = optionAll;
}

function saveallPosi() {
  if (!validateFormPosi()) {
    return;
  }
  let inputAll = document.querySelector("#allProduct");
  let sortPrice = document.getElementById("sortPrice").value;
  let statusSort = document.getElementById("statusSort").value;
  let firtday = document.getElementById("firtday").value;
  let lastday = document.getElementById("lastday").value;
  let allOptions = inputAll.options;
  let selectPosi = document.getElementById("selectPosiall");
  let nameevent = document.getElementById("nameevent").value;
  let add_new_voucher = document.getElementsByClassName("add_new_voucher")[0];
  let posi = document.querySelectorAll(
    ".header, .header_content ,.Mange_item,.voucher_table "
  );
  add_new_voucher.classList.remove("add_cover");
  posi.forEach((posion) => {
    posion.style.opacity = "1";
    posion.style.pointerEvents = "auto";
  });
  let allValues = [];
  for (let i = 0; i < allOptions.length; i++) {
    allValues.push(allOptions[i].value);
  }

  let data = {
    TiLeKM: parseFloat(sortPrice),
    DieuKien: statusSort,
    NgayBatDau: firtday,
    NgayKetThuc: lastday,
    MaGiay: allValues,
    Loai: selectPosi.value,
    TenChuongTrinh: nameevent,
  };

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../mvc/API/index.php?type=themKhuyenMai", true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);
      console.log(JSON.parse(JSON.parse(response)));
    }
  };
  getlistvocher();
  xhr.send(JSON.stringify(data));
}
function validateFormPosi() {
  let nameevent = document.getElementById("nameevent").value;
  let firtday = document.getElementById("firtday").value;
  let lastday = document.getElementById("lastday").value;
  let sortPrice = document.getElementById("sortPrice").value;

  if (sortPrice === "") {
    alert("Vui Lòng Nhập Số Giá Trị Giảm Giá");
    return false;
  }
  if (nameevent.trim() === "") {
    alert("Vui lòng nhập Tên Chương Trình.");
    return false;
  }

  if (firtday === "") {
    alert("Vui lòng chọn Ngày Bắt Đầu.");
    return false;
  }

  if (lastday === "") {
    alert("Vui lòng chọn Ngày Kết Thúc.");
    return false;
  }

  if (new Date(firtday) > new Date(lastday)) {
    alert("Ngày Kết Thúc phải sau hoặc bằng Ngày Bắt Đầu.");
    return false;
  }

  return true;
}
