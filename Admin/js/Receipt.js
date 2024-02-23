function handleOrder() {
  const Mange_client = document.getElementsByClassName("Mange_client")[0];
  const recceip = `
 <div style="overflow-x: auto" class="voucher_table">
 <table>
   <tr>
     <th>STT</th>
     <th>Khách Hàng</th>
     <th>Liên Hệ</th>
     <th>Ngày Đăng Kí</th>
     <th>Trang Thái</th>
     <th>Tác Vụ</th>
   </tr>
   <tr>
     <td>Jill</td>
     <td>web_shop</td>
     <td>500.000vnd</td>
     <td>
       <button class="btn-using">Chưa sử dụng</button>
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
       <i class="fa-solid fa-eye" style="color: 0078ff"></i>
       <i class="fa-solid fa-pen" style="color: rgb(37, 186, 216)"></i>
       <i class="fa-solid fa-trash-can" style="color: red"></i>
     </td>
   </tr>
 </table>
</div>
 
 `;
  Mange_client.innerHTML = recceip;
}
