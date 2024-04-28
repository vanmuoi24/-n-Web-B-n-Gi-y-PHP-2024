document.getElementById("signup").addEventListener("click", () => {
  // if (!Validate_Register())
  //   return;
  var fullnameValue = document.getElementById("fullname").value;
  var emailValue = document.getElementById("email").value;
  var phoneValue = document.getElementById("phone").value;
  var addressValue = document.getElementById("address").value;
  var usernameValue = document.getElementById("username").value;
  var passwordValue = document.getElementById("password").value;
  var confirmPasswordValue = document.getElementById("confirmpassword").value;

  let data = {
    fullnameValue: fullnameValue,
    emailValue: emailValue,
    phoneValue: phoneValue,
    addressValue: addressValue,
    usernameValue: usernameValue,
    passwordValue: passwordValue,
    confirmPasswordValue: confirmPasswordValue,
  };
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../MVC/API/index.php?type=dangki", true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);
      let res = JSON.parse(JSON.parse(response));
      if (res.EC == "1") {
        alert(res.EM);
        window.location.href = "../../MVC/View/LoginView.php";
      }
    }
  };
  console.log(data);
  xhr.send(JSON.stringify(data));
});
function Validate_Register() {
  // Định nghĩa các biến và mẫu regex
  var pattern_phone = /^0[1-9]{1}\d{8}$/;
  var pattern_username = /^[KH]+\d{5}$/;
  var pattern_password =
    /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_-])[0-9a-zA-Z!@#$%^&*()_-]{8,16}$/;

  // Lấy các phần tử và thông báo lỗi
  var fullname = document.getElementById("fullname").value;
  var phone = document.getElementById("phone").value;
  var address = document.getElementById("address").value;
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var confirmpassword = document.getElementById("confirmpassword").value;

  var fullname_error = document.getElementById("fullname--error");
  var phone_error = document.getElementById("phone--error");
  var address_error = document.getElementById("address--error");
  var username_error = document.getElementById("username--error");
  var password_error = document.getElementById("password--error");
  var confirmpassword_error = document.getElementById("confirmpassword--error");

  // Xóa thông báo lỗi cũ
  fullname_error.textContent = "";
  phone_error.textContent = "";
  address_error.textContent = "";
  username_error.textContent = "";
  password_error.textContent = "";
  confirmpassword_error.textContent = "";

  var isValid = true;

  // Kiểm tra và xử lý lỗi cho từng trường
  if (fullname.trim() === "") {
    fullname_error.textContent = "Vui lòng nhập họ tên";
    isValid = false;
  }
<<<<<<< HEAD

  if (phone.trim() === "") {
=======
  // if(email === "") {
  //     email_error.textContent = "Vui lòng nhập email";
  //     isValid = false;
  // } else if(!email.match(pattern_email)) {
  //     email_error.textContent = "Email không hợp lệ";
  //     isValid = false;
  // }
  if (phone === "") {
>>>>>>> 648b9d0cfd462d477692e7223b5c3870f4263cd3
    phone_error.textContent = "Vui lòng nhập số điện thoại";
    isValid = false;
  } else if (!pattern_phone.test(phone.trim())) {
    phone_error.textContent = "Số điện thoại không hợp lệ";
    isValid = false;
  }

  if (address.trim() === "") {
    address_error.textContent = "Vui lòng nhập địa chỉ";
    isValid = false;
  }

  if (username.trim() === "") {
    username_error.textContent = "Vui lòng nhập tên đăng nhập";
    isValid = false;
  } else if (!pattern_username.test(username.trim())) {
    username_error.textContent = "Định dạng: KH + 5 ký tự số (Vd: KH12345)";
    isValid = false;
  }

  if (password.trim() === "") {
    password_error.textContent = "Vui lòng nhập mật khẩu";
    isValid = false;
  } else if (!pattern_password.test(password.trim())) {
    password_error.textContent = "Mật khẩu không hợp lệ";
    isValid = false;
  }

  if (confirmpassword.trim() === "") {
    confirmpassword_error.textContent = "Vui lòng nhập lại mật khẩu";
    isValid = false;
  } else if (confirmpassword.trim() !== password.trim()) {
    confirmpassword_error.textContent = "Mật khẩu không khớp";
    isValid = false;
  }

  return isValid;
}
