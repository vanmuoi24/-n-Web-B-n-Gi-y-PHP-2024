function handlePromotion() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];

  const Pomotion = `
    <div>
        <div class="Mange_item">
            <h3>Quản lý Khuyến Mãi</h3>
        <div
        style="display: flex; justify-content: center; align-items: center"
        >
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
      <div style="width: 20%"><button>Tìm Kiếm</button></div>
    </div>
    <hr style="margin-top: 20px" />
    <div style="overflow-x: auto" class="voucher_table">
      <table>
        <tr>
          <th>Mã</th>
          <th>Người Tạo</th>
          <th>Giá Trị Giảm Giá</th>
          <th>Thời Gian</th>
          <th>Sử Dụng</th>
          <th>Trạng Thái</th>
          <th>Tác Vụ</th>
        </tr>
        <tr>
          <td>Jill</td>
          <td>web_shop</td>
          <td>500.000vnd</td>
          <td>29-1-2023</td>
          <td><button class="btn-using">Chưa sử dụng</button></td>
          <td><button class="btn-online">Hoat động</button></td>
          <td
            style="
              display: flex;
              gap: 20px;
              align-items: center;
              justify-content: center;
            "
          >
            <i class="fa-solid fa-eye" style="color: 0078ff"></i>
            <i
              class="fa-solid fa-pen"
              style="color: rgb(37, 186, 216)"
            ></i>
            <i class="fa-solid fa-trash-can" style="color: red"></i>
          </td>
        </tr>
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
    `;
  Mange_client.innerHTML = Pomotion;
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
