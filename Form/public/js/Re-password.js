document.getElementById("confirm").addEventListener("click", () => {
    if(!Validate_Repassword())
        return;
    var emailValue = document.getElementById('email').value;
    var phoneValue = document.getElementById('phone').value;
    var repasswordValue = document.getElementById('repassword').value;
    var reconfirmPasswordValue = document.getElementById('reconfirmpassword').value;
    var otpValue = document.getElementById('otp').value;

    let data={
        emailValue: emailValue,
        phoneValue: phoneValue,
        repasswordValue: repasswordValue,
        reconfirmPasswordValue: reconfirmPasswordValue,
        otpValue: otpValue,
    }
    var xhr = new XMLHttpRequest();
    xhr.open(
        "POST",
        "../../MVC/API/index.php?type=quenmatkhau",
        true
    );
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
        }
    }
    console.log(data);
    xhr.send(JSON.stringify(data));
})
    
    function Validate_Repassword(){
        pattern_phone = /^0[1-9]{1}\d{8}$/i;
        pattern_email = /^[a-z]+[a-z-_\.0-9]{2,}@[a-z]+[a-z-_\.0-9]{2,}\.[a-z]{2,}$/i;
        pattern_password = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_-])[0-9a-zA-Z!@#$%^&*()_-].{8,16}$/i;
        pattern_otp = /^\d{6}$/i;

        var phone = document.querySelector("#phone").value.trim();
        var email = document.querySelector("#email").value.trim();
        var repassword = document.querySelector("#repassword").value.trim();
        var reconfirmpassword = document.querySelector("#reconfirmpassword").value.trim();
        var otp = document.querySelector("#otp").value.trim();
            

        var phone_error = document.querySelector(".phone--error");
        var email_error = document.querySelector(".email--error");
        var repassword_error = document.querySelector(".repassword--error");
        var reconfirmpassword_error = document.querySelector(".reconfirmpassword--error");
        var otp_error = document.querySelector(".otp--error");
        
        phone_error.textContent="";
        email_error.textContent="";
        repassword_error.textContent="";
        reconfirmpassword_error.textContent="";
        otp_error.textContent="";

        let isValid = true;

        if(phone === "") {
            phone_error.textContent = "Vui lòng nhập số điện thoại";
            isValid = false;
        } else if(!(phone.match(pattern_phone))) {
            phone_error.textContent = " Số điện thoại không hợp lệ";
            isValid = false;
        }
        if(email === "") {
            email_error.textContent = "Vui lòng nhập Email";
            isValid = false;
        } else if(!(email.match(pattern_email))) {
            email_error.textContent = "Email không hợp lệ";
            isValid = false;
        }
        if(repassword === "") {
            repassword_error.textContent = "Vui lòng nhập mật khẩu";
            isValid = false;
        } else if(!(repassword.match(pattern_password))) {
            repassword_error.textContent = "Từ 8 ký tự gồm chữ hoa, chữ thường, chữ số, ký tự đặc biệt";
            isValid = false;
        }
        if(reconfirmpassword === "") {
            reconfirmpassword_error.textContent = "Vui lòng nhập lại mật khẩu";
            isValid = false;
        } else if(reconfirmpassword !== repassword){
            reconfirmpassword_error.textContent = "Sai mật khẩu";
            isValid = false;
        }
        if(otp ===""){
            otp_error.textContent = "Vui lòng nhập mã OTP";
            isValid = false;
        } else if(!(otp.match(pattern_otp))){
            otp_error.textContent = "Mã OTP gồm 6 số";
            isValid = false;
        }
        return isValid;
    }

document.getElementById("otpconfirm").addEventListener("click", () =>{
    if(!Validate_OTP())
        return;

    var phoneTo = document.getElementById('phone').value;
    var repasswordTo = document.getElementById('repassword').value;
    var reconfirmPasswordTo = document.getElementById('reconfirmpassword').value;
    var emailTo = document.getElementById('email').value;

    let data = {
        otpTo: Math.floor(Math.random() * (999999 - 100000 + 1) + 100000),
        emailTo: emailTo,
    };
    var xhr = new XMLHttpRequest();
    xhr.open(
        "POST",
        "../../MVC/API/index.php?type=guiotp",
        true
    );
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);
            if(response.status  == 1)
                alert("Đã gửi OTP");
            else
                alert("Gửi thất bại");
        }
    }
    xhr.send(JSON.stringify(data));
})
function Validate_OTP(){
    pattern_phone = /^0[1-9]{1}\d{8}$/i;
    pattern_email = /^[a-z]+[a-z-_\.0-9]{2,}@[a-z]+[a-z-_\.0-9]{2,}\.[a-z]{2,}$/i;

    var phoneTo = document.querySelector("#phone").value.trim();
    var emailTo = document.querySelector("#email").value.trim();
    var repasswordTo = document.querySelector("#repassword").value.trim();
    var reconfirmpasswordTo = document.querySelector("#reconfirmpassword").value.trim();
    var otpTo = document.querySelector("#otp").value.trim();
        
    var phoneTo_error = document.querySelector(".phone--error");
    var emailTo_error = document.querySelector(".email--error");
    var repasswordTo_error = document.querySelector(".repassword--error");
    var reconfirmpasswordTo_error = document.querySelector(".reconfirmpassword--error");
    var otpTo_error = document.querySelector(".otp--error");
        
    
    phoneTo_error.textContent="";
    emailTo_error.textContent="";
    repasswordTo_error.textContent="";
    reconfirmpasswordTo_error.textContent="";
    otpTo_error.textContent="";

    let isValid = true;

    if(phoneTo === "") {
        phoneTo_error.textContent = "Vui lòng nhập số điện thoại";
        isValid = false;
    } else if(!(phoneTo.match(pattern_phone))) {
        phoneTo_error.textContent = " Số điện thoại không hợp lệ";
        isValid = false;
    }
    if(emailTo === "") {
        emailTo_error.textContent = "Vui lòng nhập Email";
        isValid = false;
    } else if(!(emailTo.match(pattern_email))) {
        emailTo_error.textContent = "Email không hợp lệ";
        isValid = false;
    }
    if(repasswordTo !== "") {
        repasswordTo_error.textContent = "";
        isValid = true;
    }
    if(reconfirmpasswordTo !== "") {
        reconfirmpasswordTo_error.textContent = "";
        isValid = true;
    }
    if(otpTo !== "") {
        otpTo_error.textContent = "";
        isValid = true;
    }
    return isValid;
}