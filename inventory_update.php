<?php
include "config.php";

if (isset($_POST['Iid'])) {
    $user_id = $_POST['Iid'];
    $product = $_POST['pname'];
    $cateSend = $_POST['pcates'];
    $brandSend = $_POST['tat'];
    $quantity_left = $_POST['rquantity_left'];
    $quantity_add = $_POST['quantity_add'];
    $total_quantity = $_POST['total_quantity'];

    $sqls = "SELECT * FROM product where name ='$product' and cat_name='$cateSend' and brand_id ='$brandSend' ";
    if ($results = mysqli_query($conn, $sqls)) {
        if (mysqli_num_rows($results) > 0) {
            while ($rowed = mysqli_fetch_assoc($results)) {
                $pars = $rowed['id'];
                $cateSend = $rowed['cat_name'];
                $brandSend = $rowed['brand_id'];
            }

          
            $vat = $quantity_add;
            $till = "SELECT  * FROM  setting where product_id='$pars'";
            $still = mysqli_query($conn, $till);
            if (mysqli_num_rows($still) > 0) {
                while ($roweds = mysqli_fetch_assoc($still)) {
                    $bun = $roweds['bundle'];

                }
                $till = $total_quantity * $bun;
                $vat = $quantity_add * $bun;
                $cvat = $till + $vat;
            }

        }


    }
    $sqls = "UPDATE  inventory set  product_id='$pars',brand_id='$brandSend',cat_id='$cateSend',quantity_left='$quantity_left',quantity_add='$vat',current_quantity='$cvat'  WHERE id=$user_id ";
    $results = mysqli_query($conn, $sqls);
    if ($results == true) {
        $output = 'success';
    } else {
        $output = 'fail';
    }
    echo json_encode($output);
}

?>