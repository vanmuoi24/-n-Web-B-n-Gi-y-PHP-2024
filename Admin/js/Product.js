function handleProduct() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  const ProductOut = `
        <div>
            <div class="Mange_item">
                <h3>Quản lý sản Phẩm</h3>
            <div
                style="display: flex; justify-content: center; align-items: center"
                >
                <img src="../src/img/Rectangle 3785.png" alt="" />
                <img src="../src/img/Group 729.png" alt="" />
            </div>
        </div>
        <div class="table_product">
            <table id="table_product">
            <tr>
                <th>STT</th>
                <th>Tên Sản Phẩm</th>
                <th>Thương Hiệu</th>
                <th>Số Lượng</th>
                <th>Hình Ảnh</th>
                <th>Giá Tiền</th>
                <th>Hành Động</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Giày AIR FORCE 1</td>
                <td>NiKe</td>
                <td>10</td>
                <td>
                <img src="../src/img/giay.jpg" alt="" style="width: 50px" />
                </td>
                <td>1.000.000 vnd</td>
                <td>
                <i class="fa-solid fa-pen-to-square" style="color: #04b64b"></i>
                <i class="fa-solid fa-trash-can" style="color: #ff4a4a"></i>
                </td>
            </tr>
            </table>
        </div>
            
    `;
  Mange_client.innerHTML = ProductOut;
}
