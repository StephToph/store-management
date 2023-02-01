<?php
include "config.php";
if (isset($_POST['pnames'])) {
    $id = $_POST['Iid'];
    $nameSend = $_POST['pnames'];
    $cateSend = $_POST['pcates'];  
    $brand = $_POST['tat'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

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


                $sql = " UPDATE variation set product_id='$pars', quantity ='$quantity', price='$price' where id ='$id' ";
                $resulted = mysqli_query($conn, $sql, );
                if ($resulted == true) {
                    $output = 'success';
                } else {
                    $output = 'fail';
                }

            }


        }
    }
    echo json_encode($output);

}