<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT -->
    <link rel="stylesheet" href="../../public/fontawesome-6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/styles_form.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- <script type="text/javascript" src="../Controller/js/jquery.validate.min.js"></script> -->
    <!-- <script type="text/javascript" src="../Controller/Validation/Validation.js"></script> -->
    <title>Login</title>
</head>

<body>

    <div class="main">
        <div class="wrapper">
            <div class="left">
                <div class="logo__header">
                    <img src="../../public/uploads/logo_header.png" alt="Logo header" width="100%">
                </div>
                <div class="logo__footer">
                    <img src="../../public/uploads/logo_footer.png" alt="Logo footer" width="100%">
                </div>
            </div>
            <div class="right">
                <div class="sign-wrapper">
                    <h1 class="sign__heading">Xin chào!</h1>
                    <div class="sign">
                        <div class="sign__form">
                            <input type="text" class="sign-input" name="username" placeholder="Tên đăng nhập" id="username">
                            <span id="username--error" class="username--error error--message"></span>
                            <input type="password" class="sign-input" name="password" placeholder="Mật khẩu" id="password">
                            <span id="password--error" class="password--error error--message"></span>
                            <input type="submit" class="btn btn--primary sign-submit" name="signin" value="Đăng nhập" id="login">
                        </div>
                        <div class="sign__bottom">
                            <div class="bottom__content">
                                <a href="Re-passwordView.php">Quên mật khẩu?</a>
                                <p>Bạn chưa có tài khoản? <a href="RegisterView.php">Đăng kí</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../public/js/Login.js"></script>
</body>

</html>