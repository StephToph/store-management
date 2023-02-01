<?php
include "config.php";
if (isset($_POST['pname'])) {
    $nameSend = $_POST['pname'];
    $cateSend = $_POST['pcates'];
    $vary = $_POST["dat"];
    $quantity = $_POST['quantity'];
    $tprice = $_POST['tprice'];
    $date = date('Y-m-d H:i:s');
    $brand = $_POST['tat'];
    $price = $_POST['prices'];
    $sale = $_POST['sale'];


    if ($vary == 'bag') {

        $actq = $quantity * 10;
    }
    if ($vary == "bundle") {
        $actq = $quantity * 1;

    }
    if ($vary == "piece") {
        $actq = $quantity / 10;

    }
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
                $will = "SELECT * FROM setting where product_id ='$pars' ";
                $sql = mysqli_query($conn, $will);
                $row = mysqli_fetch_assoc($sql);
                if ($vary == 'bag') {
                    $actq = $quantity * $row['bundle'];
                }
                if ($vary == "bundle") {
                    $actq = $quantity * 1;

                }
                if ($vary == "piece") {
                    $actq = $quantity / $row['piece'];

                }

                $sql2 = "SELECT current_quantity FROM inventory where product_id ='$pars' order by id DESC LIMIT 1 ";
                if ($reserve = mysqli_query($conn, $sql2)) {
                    while ($roweds = mysqli_fetch_assoc($reserve)) {
                        $pared = $roweds['current_quantity'];
                        
                    }
                    if ($actq > $pared) {
                        $output = 'fail';
                    } else {
                        $qunl = $pared - $actq;
                        $add = "0";
                        $sql2 = "UPDATE  inventory set quantity_left ='$qunl', quantity_add ='$add', current_quantity='$qunl' WHERE current_quantity='$pared'";
                        $run = mysqli_query($conn, $sql2);
                        if ($run == true) {
                            $sql = " INSERT INTO sales (sale_id,product_id,prices,quantity,total_price,reg_date) values ('$sale','$pars', '$price', '$actq', '$tprice','$date')";
                            $resulted = mysqli_query($conn, $sql, );
                            if ($resulted == true) {
                                $output = 'success';
                            } else {
                                $output = 'fail';
                            }
                        } else {
                            $output = 'fail';
                        }
                    }


                }



            }
        }
    }
    echo json_encode($output);

}