
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            text-align: center;
        }
        input{
            margin: 24px;
        }
    </style>
</head>
<body>
        <div class="wrapper">
            <div class="right">
                <div class="sign-wrapper">
                        <h1 class="sign__heading">Xin chào!</h1>
                    <div class="sign">
                        <div class="sign__form">
                            <form action=""  method="POST"  class="sign__form-content" name="formValidation" id="registerform">
                                <input type="email" class="sign-input" name="email" placeholder="Email">
                                <input type="text" class="sign-input" name="username" placeholder="Tên đăng nhập">
                                <input id="password" type="password" class="sign-input" name="password" placeholder="Mật khẩu">
                                <input type="password" class="sign-input" name="confirmpassword" placeholder="Xác nhận mật khẩu">
                                <button id="btn-submit" type="submit" class="btn btn--primary sign-submit" name="signup">Đăng kí</button>
                            </form>
                        </div>
                        <div class="sign__bottom">
                            <div class="bottom__content">
                                <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script >
            $("#registerform").validate({
    rules:{
        email:{
            required: true,
            email: true,
            remote: "check-email.php",
        },
        username:{
            required: true,
            remote: "check-email.php"
        },
        password:{
            required: true,
        },
        confirmpassword:{
            required: true,
            equalTo: "#password",
        }
    },
    messages:{
        email:{
            required: "Nhập email",
            email: "Email không hợp lệ",
            remote: "Email đã tồn tại",
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
                url: 'register_action.php',
                data: $(form).serializeArray(),
                success: function(response){
                    console.log(response);
                    response = JSON.parse(response);
                    console.log("response: ",response);
                    if(response.status == 0){
                        alert(response.message);
                    }else{
                        alert(response.message);
                        location.href = "login.php";
                    }
                },
            });
    }
   });
    </script>
    
</body>
</html>