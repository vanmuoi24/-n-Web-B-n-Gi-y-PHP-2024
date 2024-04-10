
$(document).ready(function(){
    Validate_Register();
    Validate_Login();
    Validate_Repassword();
});

function Validate_Register(){
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
                remote: "../CheckValidationController.php",
            },
            email:{
                required: true,
                validateEmail: true,
                remote: "../CheckValidationController.php",
            },
            address:{
                required: true,
                // validateAddress: true,
            },
            username:{
                required: true,
                validateUsername: true,
                remote: "../CheckValidationController.php",
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
}

function Validate_Login(){
    $( "#loginform" ).submit(function( event ) {
        event.preventDefault();                        
        $.ajax({
            type: "POST",
            url: '../../Modal/LoginModal.php',
            data: $(this).serializeArray(),
            success: function(response){
                response = JSON.parse(response);
                if(response.status == 0){ // Có lỗi khi đăng nhập
                    alert(response.message);
                } else{ // Đăng nhập thành công
                    alert(response.message);
                    location.reload();
                }
            },  
        });
    });
}

function Validate_Repassword(){
    $( "#re-passwordform" ).on( "submit", function( event ) {
        event.preventDefault();                        
        $.ajax({
            type: "POST",
            url: '../../Modal/Re-passwordModal.php',
            data: $(this).serializeArray(),
            success: function(response){
                response = JSON.parse(response);
                if(response.status == 0){ // Có lỗi khi đổi mật khẩu
                    alert(response.message);
                } else{ // Đổi mật khẩu thành công
                    alert(response.message);
                    location.href = "../../View/LoginView.php";
                }
            },  
        });
    });
}