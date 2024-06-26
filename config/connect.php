<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbName = "th-league";

    $conn = mysqli_connect($host,$user,$password,$dbName);
    if(!$conn){
        echo "Error While Connecting to Database";
    }
?>

