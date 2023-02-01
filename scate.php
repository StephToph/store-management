<?php
include "config.php";

extract($_GET);
$product = $_GET["val"];
$brand = $_GET["vals"];
$cate = $_GET["sar"];
$qity = $_GET["dat"];
$par = '0';


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


        }
        $query1 = "SELECT * FROM variation where product_id ='$pars' and quantity='$qity' ";
        $rsy = mysqli_query($conn, $query1);
        $roweds = mysqli_fetch_assoc($rsy);
        if ($roweds != '') {
            $par = $roweds['price'];
        }

    }
}
$query1 = "SELECT current_quantity FROM inventory where product_id ='$pars' order by date DESC LIMIT 1 ";
$rsy = mysqli_query($conn, $query1);
$roweds = mysqli_fetch_assoc($rsy);
$pared = $roweds['current_quantity'];
$sad = $pared;
$will = "SELECT * FROM setting where product_id ='$pars' ";
$sql1 = mysqli_query($conn, $will);
if (mysqli_num_rows($sql1) != 0) {
    while ($row2 = mysqli_fetch_assoc($sql1)) {
        $dis = $row2["bundle"];
        if ($pared >= 10) {
            $bill = $pared / $dis;
            $sa = (int) $bill;
            $esd = $bill - $sa;
            $end = $esd * 10;
            $sun = $sa . ' bag';
            if ($end > 0) {
                $sun = $sa . ' bag  ' . $end . ' bundle';
            }
        }
        if ($pared < 10) {
            $actq = $pared * 1;
            $sun = $actq . 'bundle';
        }
    }
    $sad = $sun;
}
$row['sam'] = $par;
$row['wat'] = $sad;
echo json_encode($row);


?>