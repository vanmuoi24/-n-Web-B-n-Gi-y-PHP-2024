<?php
    header("location: login.php");
    if(isset($_POST['loginform'])){
        include'login.php';
    } else if(isset($_POST['registerform'])){
        include'register.php';
    } else if(isset($_POST['re-passwordform'])){
        include're-password.php';
    } else if(isset($_POST['re-passwordform'])){
        include're-password.php';
    }
?>
