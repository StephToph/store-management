<?php
include "config.php";
if (isset($_POST['pname'])) {
    $nameSend = $_POST['pname'];
    $cateSend = $_POST['pcates'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $brand = $_POST['tat'];


    if ($nameSend != '') {
        $sqli = "SELECT * FROM product where id ='$nameSend' ";

        if ($result = mysqli_query($conn, $sqli)) {
            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {

                    $par = $rows['name'];
                }
            }
        }
        $sqls = "SELECT * FROM product where name ='$par' and cat_name='$cateSend' and brand_id ='$brand' ";
        if ($results = mysqli_query($conn, $sqls)) {
            if (mysqli_num_rows($results) > 0) {
                while ($rowed = mysqli_fetch_assoc($results)) {
                    $pars = $rowed['id'];
                }
                $sql = "INSERT INTO variation (product_id,price,quantity) values ('$pars', '$price', '$quantity')";
                $resulted = mysqli_query($conn, $sql, );
                if ($resulted == true) {
                    $output = 'success';
                } else {
                    $output = 'fail';
                }



            }else {
                $output = 'fail';
            }




        }else {
            $output = 'fail';
        }


        echo json_encode($output);
    }
}