<?php
    include("../Modal/ConnectModal.php");
    if(isset($_GET['email'])){
        $sql_email = "SELECT email FROM client WHERE email  LIKE '".$_GET['email']."'";
        $result_email = mysqli_query($mysqli,$sql_email);
        if($result_email !== false && $result_email->num_rows > 0) { //Tồn tại email
            echo json_encode(false);
        } else { //Chưa tồn tại email
            echo json_encode(true);
        }
    }
    if(isset($_GET['username'])){
        $sql_username = "SELECT username FROM client WHERE username LIKE '".$_GET['username']."'";
        $result_username = mysqli_query($mysqli,$sql_username);
        if($result_username !== false && $result_username->num_rows > 0) { //Tồn tại username
            echo json_encode(false);
        } else { //Chưa tồn tại username
            echo json_encode(true);
        }
    }
    if(isset($_GET['phone'])){
        $sql_phone = "SELECT phone FROM client WHERE phone  LIKE '".$_GET['phone']."'";
        $result_phone = mysqli_query($mysqli,$sql_phone);
        if($result_phone !== false && $result_phone->num_rows > 0) { //Tồn tại phone
            echo json_encode(false);
        } else { //Chưa tồn tại phone
            echo json_encode(true);
        }
    }

?>