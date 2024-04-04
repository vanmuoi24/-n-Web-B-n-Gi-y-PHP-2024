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
          <button class="btn-voucher">Voucher</button>
          <button class="btn-new" onclick='handleaddvoucher()'>
              Thêm Mới Voucher <i class="fa-solid fa-plus"></i>
          </button>
      </div>
      <div class="voucher">
          <div style="width: 20%">
              <select>
                  <option value="">Điều Kiện Lọc</option>
                  <option value=""></option>
                  <option value=""></option>
              </select>
          </div>
          <div style="width: 60%">
              <input type="text" style="width: 100%" />
          </div>
        <button>Tìm Kiếm</button>
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
                  <button style="background-color: #0078ff; color: white">
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
                      <label for="">Tạo Mã : </label>
                      <input type="text" />
                  </div>
                  <div class="input_add_one">
                      <label for="">Giá Trị Giảm Giá : </label>
                      <input type="text" />
                  </div>
                  <div class="input_add_one">
                      <label for="">Trạng Thái : </label>
                      <select name="" id="">
                          <option value="">Hoat Dong</option>
                      </select>
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
                      <input type="checkbox" /> Áp dụng với chương trình khuyến mãi
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
                      <input type="date" />
                  </div>
                  <div class="input_add_one">
                      <label for="">Ngày Kết Thúc : </label>
                      <input type="date" />
                  </div>
              </div>
          </div>
      </div>
      <hr />
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
}
function getlistvocher() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../mvc/API/index.php?type=danhsachKM", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var data = JSON.parse(xhr.responseText);
        console.log(data);
        let tablevoucher = document.querySelectorAll(".voucher_table table")[0];
        let tableitem = `  <tr>
        <th>MãKM</th>
        <th>Ngày Bắt Đầu</th>
        <th>Ngày Kết Thúc</th>
        <th>Tên Chương Trình</th>
        <th>Loại Chương Trình</th>
        <th>Điều Kiện</th>
        <th>Tac Vu</th>
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
                   
                    <td style="
                    display: flex;
                    gap: 20px;
                    align-items: center;
                    justify-content: center;
                    ">
                        <i class="fa-solid fa-eye" style="color: 0078ff"></i>
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
