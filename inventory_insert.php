<?php
include "config.php";
if (isset($_POST['pname'])) {
    $nameSend = $_POST['pname'];
    $cateSend = $_POST['pcates'];
    $brandSend = $_POST['tat'];
    $date = date('Y-m-d H:i:s');
    $quantity_left = $_POST['quantity_left'];

    $quantity_add = $_POST['quantity_add'];

    $current_quantity = $_POST['total_quantity'];


    $sqls = "SELECT * FROM product where name ='$nameSend' and cat_name='$cateSend' and brand_id ='$brandSend' ";
    if ($results = mysqli_query($conn, $sqls)) {
        if (mysqli_num_rows($results) > 0) {
            while ($rowed = mysqli_fetch_assoc($results)) {
                $pars = $rowed['id'];
                $cateSend = $rowed['cat_name'];
                $brandSend = $rowed['brand_id'];
            }
        }
    }
    $cvat = $current_quantity;
    $vat = $quantity_add;
    $till = "SELECT  * FROM  setting where product_id = '$pars'";
    $still = mysqli_query($conn, $till);
    if (mysqli_num_rows($still) > 0) {
        while ($rowed = mysqli_fetch_assoc($still)) {
            $bun = $rowed['bundle'];

        }
        $cvat = $current_quantity * $bun;
        $vat = $quantity_add * $bun;
    }


    // $will = "SELECT * from  setting where product_id = ";
    $sql = "INSERT INTO inventory (cat_id,product_id,quantity_left,quantity_add,date,brand_id,current_quantity) values ('$cateSend', '$pars', '$quantity_left','$vat', '$date', '$brandSend','$cvat')";
    $result = mysqli_query($conn, $sql);

    if ($result == true) {
        $output = 'success';
    } else {
        $output = 'fail';
    }
    echo json_encode($output);

}
?>