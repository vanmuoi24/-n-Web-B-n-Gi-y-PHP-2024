function handleHome(event) {
  window.location.href = "../../mvc/view/index.php";

  const sideItems = document.querySelectorAll(".side_item");

  sideItems.forEach((item) => {
    item.classList.remove("active");
  });

  event.currentTarget.classList.add("active");
}
