<?php
    $username = "root";
    $password = "";
    $hostname = "localhost";
    $database = "test";
    $mysqli = mysqli_connect($hostname,$username,$password,$database);
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }else {
        echo "";
    }
?>