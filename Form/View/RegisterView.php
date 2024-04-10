
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT -->
    <!-- <link rel="stylesheet" href="fontawesome-6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/styles_form.css">
    <title>Login</title>
</head>
<body>
<div class="main">
        <div class="wrapper">
            <div class="left">
                <div class="logo__header">
                    <img src="uploads/logo_header.png" alt="Logo header" width="100%">
                </div>
                <div class="logo__footer">
                    <img src="uploads/logo_footer.png" alt="Logo footer" width="100%">
                </div>
            </div>
            <div class="right">
                <div class="sign-wrapper">
                        <h1 class="sign__heading">Xin chào!</h1>
                    <div class="sign">
                        <div class="sign__form">
                            <form action="RegisterView.php"  method="POST"  class="sign__form-content" name="registerform" id="registerform">
                                <input type="text" class="sign-input" name="fullname" placeholder="Họ tên">
                                <input type="text" class="sign-input" name="email" placeholder="Email">
                                <input type="text" class="sign-input" name="phone" placeholder="Số điện thoại">
                                <input type="text" class="sign-input" name="address" placeholder="Địa chỉ">
                                <input type="text" class="sign-input" name="username" placeholder="Tên đăng nhập">
                                <input type="password" class="sign-input" name="password" placeholder="Mật khẩu" id="password">
                                <input type="password" class="sign-input" name="confirmpassword" placeholder="Xác nhận mật khẩu">
                                <button type="submit" class="btn btn--primary sign-submit" name="signup">Đăng kí</button>
                            </form>
                        </div>
                        <div class="sign__bottom">
                            <div class="bottom__content">
                                <p>Bạn đã có tài khoản? <a href="LoginView.php">Đăng nhập</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="../../Controller/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../Controller/Validation/Validation.js"></script>

    <!-- <script>
        $("#registerform").validate({
        rules:{
            fullname:{
                required: true,
                // validateFullname: true,
                minlength: 6,
            },
            phone:{
                required: true,
                validatePhone: true,
                remote: "../../Controller/validate/check_validation.php",
            },
            email:{
                required: true,
                validateEmail: true,
                remote: "../../Controller/validate/check_validation.php",
            },
            address:{
                required: true,
                // validateAddress: true,
            },
            username:{
                required: true,
                validateUsername: true,
                remote: "../../Controller/validate/check_validation.php",
            },
            password:{
                required: true,
                validatePassword: true,
            },
            confirmpassword:{
                required: true,
                equalTo: "#password",
            }
        },
        messages:{
            fullname:{
                required: "Nhập họ tên",
                minlength: "Họ tên có độ dài từ 6 kí tự",
            },
            phone:{
                required: "Nhập số điện thoại",
                remote: "Số điện thoại đã tồn tại",
            },
            email:{
                required: "Nhập email",
                remote: "Email đã tồn tại",
            },
            address:{
                required: "Nhập địa chỉ",
            },
            username:{
                required: "Nhập tên đăng nhập",
                remote: "Tên đăng nhập đã tồn tại",
            },
            password:{  
                required: "Nhập mật khẩu",
            },
            confirmpassword:{
                required: "Xác nhận mật khẩu",
                equalTo: "Mật khẩu không chính xác",
            },
          },

          submitHandler: function(form) {
        console.log($(form).serializeArray());
        $.ajax({
                type: "POST",
                url: '../../Modal/RegisterModal.php',
                data: $(form).serializeArray(),
                success: function(response){
                    console.log(response);
                    response = JSON.parse(response);
                    console.log("response: ",response);
                    if(response.status == 0){ // Có lỗi khi đăng kí
                        alert(response.message);
                    }else{ // Đăng kí thành công
                        location.href = "../../View/SuccessView.php";
                    }
                },
            });
    }
        });
// FULLNAME
 $.validator.addMethod("validateFullnane",function(value, element) {
    return this.optional(element)  || /^[^\s][^0-9-_!@#$%^&*\(\)][^\s]$/i.test(value);
}, "Họ và tên không hợp lệ");
// EMAIL
$.validator.addMethod("validateEmail",function(value, element) {
    return this.optional(element) || /^[a-z]+[a-z-_\.0-9]{2,}@[a-z]+[a-z-_\.0-9]{2,}\.[a-z]{2,}$/i.test(value);
}, "Email không hợp lệ");
// ADDRESS
$.validator.addMethod("validateAddress",function(value, element) {
    return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])+$/i.test(value);
}, "Địa chỉ không hợp lệ");
// PHONE
$.validator.addMethod("validatePhone",function(value, element) {
    return this.optional(element) || /^0[1-9]{1}\d{8}$/i.test(value);
}, "Số điện thoại không hợp lệ");
// PASSWORD
$.validator.addMethod("validatePassword", function (value, element) {
    return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_-])[0-9a-zA-Z!@#$%^&*()_-].{8,16}$/i.test(value);
}, "Từ 8 ký tự gồm chữ hoa, chữ thường, chữ số, ký tự đặc biệt");
// USERNAME
$.validator.addMethod("validateUsername",function(value, element) {
    return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/i.test(value);
}, "Từ 6 ký tự gồm chữ hoa, chữ thường, chữ số");
    </script> -->
</body>
</html>