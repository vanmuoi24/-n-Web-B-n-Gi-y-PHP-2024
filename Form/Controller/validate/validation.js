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
    return this.optional(element) || /^MaKH\d+$/i.test(value);
}, "Định dạng (VD: MaKH1)");

$(document).ready(function(){ValidationRegister();
    ValidationLogin();
    ValidationRe_password()
});
function ValidationRegister(){
    $("#registerform").validate({
        rules:{
            fullname:{
                required: true,
                validateFullname: true,
                minlength: 5,
            },
            phone:{
                required: true,
                validatePhone: true,
                remote: "check_validation.php",
            },
            email:{
                required: true,
                validateEmail: true,
                remote: "check_validation.php",
            },
            address:{
                required: true,
                validateAddress: true,
            },
            username:{
                required: true,
                validateUsername: true,
                remote: "check_validation.php",
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
                minlength: "Họ tên có độ dài từ 2 kí tự",
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
                messages: "Định dạng (VD: MaKH1)",
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
                url: '../handle/register_handle.php',
                data: $(form).serializeArray(),
                success: function(response){
                    response = JSON.parse(response);
                    console.log("response: ",response);
                    if(response.status == 0){
                        alert(response.message);
                    }else{
                        alert(response.message);
                        location.href = "../../View/form/success.php";
                    }
                },
              });
        }
       });
    
}

function ValidationLogin(){
    $( "#loginform" ).submit(function( event ) {
        event.preventDefault();                        
        $.ajax({
            type: "POST",
            url: '../../handle/login_handle.php',
            data: $(this).serializeArray(),
            success: function(response){ 
                response = JSON.parse(response);
                if(response.status == 0){
                    alert(response.message);
                } else{
                    alert(response.message);
                    location.reload();
                }
            },  
        });
    });
}

function ValidationRe_password(){
    $( "#re-passwordform" ).submit(function( event ) {
        event.preventDefault();                        
        $.ajax({
            type: "POST",
            url: '../../handle/re-password_handle.php',
            data: $(this).serializeArray(),
            success: function(response){
                response = JSON.parse(response);
                if(response.status == 0){
                    alert(response.message);
                } else{
                    alert(response.message);
                    location.href = 'login.php';
                }
            },  
        });
    });
}