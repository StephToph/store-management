<?php
include "config.php";

extract($_GET);
$product = $_GET["val"];
$brand = $_GET["vals"];
$cate = $_GET["sar"];

$par = "<option>Select variation</option>";


if ($product != '') {
    $sqli = "SELECT * FROM product where id ='$product'";


    if ($result = mysqli_query($conn, $sqli)) {
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {

                $pared = $rows['name'];
            }
        }
    }
    if ($cate != '') {
        $query = "SELECT * FROM product where name ='$pared' and  brand_id='$brand' and  cat_name='$cate' ";
        $rs = mysqli_query($conn, $query);
        $rowed = mysqli_fetch_assoc($rs);
        if ($rowed != '') {
            $pars = $rowed['id'];
            $query1 = "SELECT * FROM variation where product_id ='$pars'";
            if ($motion = mysqli_query($conn, $query1)) {
                if (mysqli_num_rows($motion) > 0) {
                    while ($rowed = mysqli_fetch_assoc($motion)) {
                        $sel = '';

                        $par .= "<option  value='" . $rowed['quantity'] . "' " . $sel . ">" . $rowed['quantity'] . "</option>";
                    }

                }
            }
        }

    }
}
$row["select"] = $par;
echo json_encode($row);
?>