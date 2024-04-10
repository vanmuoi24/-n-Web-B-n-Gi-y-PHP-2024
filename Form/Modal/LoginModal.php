<?php
    session_start();
    include('ConnectModal.php');
    if(isset($_POST['username']) && !empty($_POST['username'] && $_POST['password']) && !empty($_POST['password'])){
        $sql = "SELECT TenDN,MatKhau FROM taikhoan WHERE TenDN ='".$_POST['username']."' AND MatKhau ='".$_POST['password']."'";
        $result = mysqli_query($mysqli,$sql);
        if($result->num_rows == 0){
            echo json_encode(array(
                'status'=> 0,
                'message'=> "Thông tin đăng nhập không đúng",
            ));
            exit;
        } else {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['current_user'] = $user;
            echo json_encode(array(
                'status'=> 1,
                'message'=> "Đăng nhập thành công",
            ));
            exit;
        }
    } else {
        echo json_encode(array(
            'status'=> 0,
            'message'=> "Chưa nhập thông tin"
        ));
        exit;
    }
?>