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
    }
  };
  console.log(data);
  xhr.send(JSON.stringify(data));
});

function Validate_Register(){
    pattern_email = /^[a-z]+[a-z-_\.0-9]{2,}@[a-z]+[a-z-_\.0-9]{2,}\.[a-z]{2,}$/i;
    pattern_password = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_-])[0-9a-zA-Z!@#$%^&*()_-].{8,16}$/i;
    pattern_phone = /^0[1-9]{1}\d{8}$/i;
    pattern_username = /^[KH]+\d{5}$/i;

  var fullname_error = document.querySelector(".fullname--error");
  var email_error = document.querySelector(".email--error");
  var phone_error = document.querySelector(".phone--error");
  var address_error = document.querySelector(".address--error");
  var username_error = document.querySelector(".username--error");
  var password_error = document.querySelector(".password--error");
  var confirmpassword_error = document.querySelector(".confirmpassword--error");

  fullname_error.textContent = "";
  email_error.textContent = "";
  phone_error.textContent = "";
  address_error.textContent = "";
  username_error.textContent = "";
  password_error.textContent = "";
  confirmpassword_error.textContent = "";
  var isValid = true;
  if (fullname === "") {
    fullname_error.textContent = "Vui lòng nhập họ tên";
    isValid = false;
  }
  // if(email === "") {
  //     email_error.textContent = "Vui lòng nhập email";
  //     isValid = false;
  // } else if(!email.match(pattern_email)) {
  //     email_error.textContent = "Email không hợp lệ";
  //     isValid = false;
  // }
  if (phone === "") {
    phone_error.textContent = "Vui lòng nhập số điện thoại";
    isValid = false;
  } else if (!phone.match(pattern_phone)) {
    phone_error.textContent = " Số điện thoại không hợp lệ";
    isValid = false;
  }
  if (address === "") {
    address_error.textContent = "Vui lòng nhập địa chỉ";
    isValid = false;
  }
  if (username === "") {
    username_error.textContent = "Vui lòng nhập tên dăng nhập";
    isValid = false;
  } else if (!username.match(pattern_username)) {
    username_error.textContent = "Định dạng: KH + 5 ký tự số (Vd: KH12345)";
    isValid = false;
  }
    if (password === "") {
      password_error.textContent = "Vui lòng nhập mật khẩu";
      isValid = false;
    } else if (!password.match(pattern_password)) {
      password_error.textContent =
        "Từ 8 ký tự gồm chữ hoa, chữ thường, chữ số, ký tự đặc biệt";
      isValid = false;
    }
    if (confirmpassword === "") {
      confirmpassword_error.textContent = "Vui lòng nhập lại mật khẩu";
      isValid = false;
    } else if (confirmpassword !== password) {
      confirmpassword_error.textContent = "Sai mật khẩu";
      isValid = false;
    }
  return isValid;
}

