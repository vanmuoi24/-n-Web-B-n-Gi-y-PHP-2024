
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
    <link rel="stylesheet" href="../css/styles_form.css">
    <title>Login</title>
</head>
<body>
        <?php
        session_start();
        if(!isset($_SESSION['current_user'])) { ?>
    <div class="main">
        <div class="wrapper">
            <div class="left">
                <div class="logo__header">
                    <img src="../uploads/logo_header.png" alt="Logo header" width="100%">
                </div>
                <div class="logo__footer">
                    <img src="../uploads/logo_footer.png" alt="Logo footer" width="100%">
                </div>
            </div>
            <div class="right">
                <div class="sign-wrapper">
                        <h1 class="sign__heading">Xin chào!</h1>
                    <div class="sign">
                        <div class="sign__form">
                            <form action="login.php" method="POST" autocomplete="off" class="sign__form-content" name="loginform" id="loginform">
                                <input type="text" class="sign-input" name="username" placeholder="Tài khoản (VD: kh">
                                <input type="password" class="sign-input" name="password" placeholder="Mật khẩu">
                                <input type="submit" class="btn btn--primary sign-submit" name="signin" value="Đăng nhập">
                            </form>
                        </div>
                        <div class="sign__bottom">
                            <div class="bottom__content">
                                <a href="re-password.php">Quên mật khẩu?</a>
                                <p>Bạn chưa có tài khoản? <a href="register.php">Đăng kí</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        } else {
    $currentUser = $_SESSION['current_user'];
    ?>
        <p>Xin chao <?php echo $currentUser['username'] ?></p>
        <a href="logout.php">Đăng xuất</a>
    <?php } ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $( "#loginform" ).submit(function( event ) {
            event.preventDefault();                        
            $.ajax({
                type: "POST",
                url: '../../Controller/handle/login_handle.php',
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
    </script>
</body>
</html>
