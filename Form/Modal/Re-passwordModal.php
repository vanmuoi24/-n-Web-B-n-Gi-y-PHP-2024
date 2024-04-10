<?php
    include('ConnectModal.php');
    if(isset($_POST['phone']) && !empty($_POST['phone']) && 
    isset($_POST['email']) && !empty($_POST['email'])){
        $sql = "SELECT SDT,Email FROM taikhoan WHERE SDT ='".$_POST['phone']."' AND Email ='".$_POST['email']."'";
        $result = mysqli_query($mysqli,$sql);
        if($result->num_rows == 0){
            echo  json_encode(array(
                'status' => 0,
                'message' => 'Thông tin không đúng',
            ));
            exit;
        } else {
            $sql_update = "UPDATE taikhoan SET MatKhau = '".$_POST['re-password']."' WHERE Email = '".$_POST['email']."' ";
            $mysqli_update = mysqli_query($mysqli, $sql_update);
            echo  json_encode(array(
                'status' => 1,
                'message' => 'Đổi mật khẩu thành công',
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