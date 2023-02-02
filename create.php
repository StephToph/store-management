<?php
include "config.php";
extract($_POST);
if (isset($_POST['username'])) {
    $nameSend = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $cpassword = md5($_POST['PasswordConfirm']);

    if ($email != '') {
        $say = "SELECT * from users WHERE email='$email'";
        $result = mysqli_query($conn, $say);
        if (mysqli_num_rows($result) > 0) {
            $output = 'fails';
        } else {
            if ($cpassword == $password) {
                $sql = "INSERT INTO users (firstname,password,email) values('$nameSend','$password','$email')";
                $result = mysqli_query($conn, $sql);
                if ($result == true) {
                    $output = 'success';
                } else {
                    $output = 'fail';
                }
            }else{
                $output = 'failed';
            }
        }
        echo json_encode($output);
    }
}
?>