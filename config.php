<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "store_db";

    $conn = new mysqli($servername , $username ,$password, $dbname);
    if ($conn){
   
    }else {
    die(mysqli_error($conn));
    }

?>


