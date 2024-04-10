<?php
    $localhost="localhost";
    $user="root";
    $password= "";
    $database="test";
    $mysqli = mysqli_connect($localhost,$user,$password,$database);
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }else {
        echo "";
    }
?>