<?php
include "config.php";
if (isset($_POST['bnames'])) {
    $nameSend = $_POST['bnames'];
   


    $query = "SELECT * FROM brand WHERE name='$nameSend' ";
    $rs = mysqli_query($conn, $query);
    $data = mysqli_num_rows($rs);
    if ($data > 0) {
        $output = 'fail';
    } else {
        $sql = "INSERT INTO brand (name) values ( '$nameSend' )";
        $result = mysqli_query($conn, $sql);
        if ($result == true) {
            $output = 'success';
        } else {
            $output = 'fail';
        }
    }
    echo json_encode($output);

} else {
    $output = 'fail';

    echo json_encode($output);
}
?>