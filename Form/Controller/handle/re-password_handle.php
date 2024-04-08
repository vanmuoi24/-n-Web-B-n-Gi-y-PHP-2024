<?php
    include('../../Modal/connect/connect_db.php');
    if(isset($_POST['phone']) && !empty($_POST['phone'] && $_POST['email']) && !empty($_POST['email'])){
        $sql = "SELECT phone,email FROM client WHERE phone ='".$_POST['phone']."' AND email ='".$_POST['email']."'";
        $result = mysqli_query($mysli,$sql);
        if($result->num_rows == 0){
            echo  json_encode(array(
                'status' => 0,
                'message' => 'Thông tin không đúng',
            ));
            exit;
        } else {
            $sql_update = "UPDATE 'clent' SET 'password' = '".$_POST['newpassword']."' ";
            $mysli_update = mysqli_query($mysli, $sql_update);
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