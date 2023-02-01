<?php
include "config.php";

if (isset($_POST['bname'])) {
    $user_id = $_POST['bid'];

    $nameSend = $_POST['bname'];
   

    $sqls = "UPDATE brand set name='$nameSend'  WHERE id=$user_id ";

    $results = mysqli_query($conn, $sqls);
    if ($results == true) {
        $output = 'success';
    } else {
        $output = 'fail';
    }
    echo json_encode($output);
}

?>