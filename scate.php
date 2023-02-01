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
        
        $query1 = "SELECT * FROM variation where product_id ='$pars' and quantity='$qity' ";
        $rsy = mysqli_query($conn, $query1);
        $roweds = mysqli_fetch_assoc($rsy);
        if ($roweds != '') {
            $par = $roweds['price'];
        }
    }
}}
$row[] = $par;
echo json_encode($row);


?>