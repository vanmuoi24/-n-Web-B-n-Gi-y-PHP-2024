<?php
    include('ConnectModal.php');
        if(isset($_POST['fullname']) && !empty($_POST['fullname']) 
            && isset($_POST['phone']) && !empty($_POST['phone'])
            && isset($_POST['email']) && !empty($_POST['email'])
            && isset($_POST['address']) && !empty($_POST['address'])
            && isset($_POST['username']) && !empty($_POST['username'])
            && isset($_POST['password']) && !empty($_POST['password'])
            && isset($_POST['confirmpassword']) && !empty($_POST['confirmpassword'])){  
            $fullname = $_POST['fullname'];
            $fullname = explode(" ",$fullname);
            $firstname = $fullname[0];
            $lastname = "";
            for($i = 1; $i < count($fullname); $i++)
                $lastname.= $fullname[$i] . " ";
            $sql = "INSERT INTO taikhoan (TenDN,MatKhau,Ho,Ten,Email,DiaChi,SDT) VALUES 
            ('".$_POST['username']."','".$_POST['password']."','".$firstname."','".$lastname."','".$_POST['email']."','".$_POST['address']."','".$_POST['phone']."')";
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