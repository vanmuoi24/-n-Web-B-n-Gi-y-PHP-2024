function handleHome(event) {
  // Chuyển hướng trang
  window.location.href = "../../mvc/view/index.php";

  const sideItems = document.querySelectorAll(".side_item");

  // Xóa class 'active' khỏi tất cả các side items
  sideItems.forEach((item) => {
    item.classList.remove("active");
  });

  // Thêm class 'active' cho div được chọn
  event.currentTarget.classList.add("active");
}
