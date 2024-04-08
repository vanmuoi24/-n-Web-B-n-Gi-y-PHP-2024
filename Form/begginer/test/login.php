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
    <?php 
        session_start();
        if(!isset($_SESSION['current_user'])) { ?>
        <div>
            <form action="login.php" method="POST" id="loginform">
                <input type="text" name="email" placeholder="Email">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="submit" value="Đăng nhập">
            </form>
        </div>
        <?php } else {
            
            $currentUser = $_SESSION['current_user'];
    ?>
            <p>
                Xin chao <?php echo $currentUser['username'] ?>
            </p>
            <a  href="logout.php">Dang xuat</a>
        <?php } ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $( "#loginform" ).on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'login_action.php',
                data: $(this).serializeArray(),
                success: function(response){
                    response = JSON.parse(response);
                    console.log("response: ",response);
                    if(response.status == 0){
                        alert(response.message);
                    }else{
                        alert(response.message);
                        location.reload();
                    }
                },
            });
        });
    </script>
</body>
</html>