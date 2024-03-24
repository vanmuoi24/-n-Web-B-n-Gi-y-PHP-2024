function handleclient() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  const client = `
  <div>
  <div class="table_product">
    <table id="table_product">
      <tr>
        <th>STT</th>
        <th>Họ và Tên</th>
        <th>Địa Chỉ</th>
        <th>Giới Tính</th>
        <th>email</th>

        <th>Hành Động</th>
      </tr>
      <tr>
        <td>1</td>
        <td>Văn Mười</td>
        <td>Dak Lak</td>
        <td>Nam</td>
        <td>domuoigghh@gmail.com</td>
        <td>
          <i class="fa-solid fa-pen-to-square" style="color: #04b64b"></i>
          <i class="fa-solid fa-trash-can" style="color: #ff4a4a"></i>
        </td>
      </tr>
    </table>
  </div>
</div>
        `;

  Mange_client.innerHTML = client;
}
