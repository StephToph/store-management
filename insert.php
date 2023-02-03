<?php
include "config.php";
extract($_POST);
if (isset($_POST['nameSend'])) {
    $nameSend = $_POST['nameSend'];


    $query = "SELECT * FROM category WHERE name='$nameSend' ";

    $rs = mysqli_query($conn, $query);
    $data = mysqli_num_rows($rs);
    if ($data > 0) {
        $output = 'fail';
    } else {
        $sql = "INSERT INTO category (name) values('$nameSend')";
        $result = mysqli_query($conn, $sql);
        if ($result == true) {
            $output='success';
        } else {
            $output= 'fail';
        }

    }

    echo json_encode($output);

}
?>