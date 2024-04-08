<?php
    include('../../Modal/connect/connect_db.php');
        if(isset($_POST['fullname']) && !empty($_POST['fullname']) 
                && $_POST['phone'] && !empty($_POST['phone'])
                && $_POST['email'] && !empty($_POST['email'])
                && $_POST['address'] && !empty($_POST['address'])
               // && $_POST['username'] && !empty($_POST['username'])
                && $_POST['password'] && !empty($_POST['password'])){
            $sql = "INSERT INTO client (fullname,phone,email,address,username,password) VALUES ('".$_POST['fullname']."','".$_POST['phone']."','".$_POST['email']."','".$_POST['address']."','kh.".$_POST['phone']."','".$_POST['password']."')";
            $result = mysqli_query($mysqli,$sql);
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
        } else{
        echo  json_encode(array(
            'status' => 0,
            'message' => 'Bạn chưa nhập thông tin',
        ));
        exit;
    }
?>