<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "store_db";

    $conn = new mysqli($servername , $username ,$password, $dbname);
    if ($conn->connect_error){
        die("CONNECTION FAILED".$conn->connect_error );
    }

?>


