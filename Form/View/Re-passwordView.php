<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT -->
    <link rel="stylesheet" href="fontawesome-6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                        <h1 class="sign__heading">Mật khẩu!</h1>
                    <div class="sign">
                        <div class="sign__form">
                            <form action="Re-passwordView.php" method="POST" autocomplete="off" class="sign__form-content" name="re-passwordform" id="re-passwordform">
                                <input type="text" class="sign-input" name="phone" placeholder="Số điện thoại">
                                <input type="text" class="sign-input" name="email" placeholder="Email">
                                <input type="password" class="sign-input" name="re-password" placeholder="Mật khẩu mới">
                                <input type="password" class="sign-input" name="confirmpassword" placeholder="Xác nhận mật khẩu">
                                <input type="submit" class="btn btn--primary sign-submit" name="signin" value="Đổi mật khẩu">
                            </form>
                        </div>
                        <div class="sign__bottom">
                            <div class="btn-re bottom__content">
                                <a href="LoginView.php">Đăng nhập</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="../Controller/Validation/Validation.js"></script>

    <!-- <script>
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
        }); -->
</script>
</body>
</html>
