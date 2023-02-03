<?php
include "config.php";
extract($_POST);

if (isset($_POST['username'])  && isset($_POST['email']) ) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $sqli = "SELECT * FROM users where firstname ='$username' AND email ='$email'";
    $result = mysqli_query($conn, $sqli);
    $sat = mysqli_num_rows($result);
    if ($sat > 0) {
        $output = "pass";
    } else {
        $output = "fail";
    }

    echo json_encode($output);
}


?>