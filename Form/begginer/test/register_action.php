<?php
    include("connect.php");
    if(isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['username']) && !empty($_POST['username'])
&& isset($_POST['password']) && !empty($_POST['password'])
&& isset($_POST['confirmpassword']) && !empty($_POST['confirmpassword'])){
    $sql = "INSERT INTO client (email,username,password) VALUES ('".$_POST['email']."','".$_POST['username']."','".$_POST['password']."')";
            $result = mysqli_query($mysqli, $sql);
            if(!$result){
                if(strpos(mysqli_error($mysqli), "Duplicate entry") !== FALSE){
                    echo  json_encode(array(
                        'status' => 0,
                        'message' => 'Tên đăng nhập đã tồn tại',
                    ));
                    exit;
                }
            }else {
                echo  json_encode(array(
                    'status' => 1,
                    'message' => 'Đăng kí thành công',
                ));
                exit;
            }
    }else{
            echo  json_encode(array(
                'status' => 0,
                'message' => 'Bạn chưa nhập thông tin',
        ));
        exit;
    }
?>