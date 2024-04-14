// Lấy tất cả các phần tử có class .side_item
const sideItems = document.querySelectorAll(".side_item");

// Lặp qua từng phần tử và thêm sự kiện click
sideItems.forEach((item) => {
  item.addEventListener("click", function () {
    // Loại bỏ lớp active trên tất cả các phần tử
    sideItems.forEach((item) => {
      item.classList.remove("active");
    });

    this.classList.add("active");
  });
});
function handleHome(event) {
  window.location.href = "../../mvc/view/index.php";
}
