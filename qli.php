<?php
include "config.php";

extract($_GET);
$product = $_GET["val"];
$brand = $_GET["vals"];
$cate = $_GET["sar"];
$par = '0';


if ($product != '') {
    $sqli = "SELECT * FROM product where id ='$product'";


    if ($result = mysqli_query($conn, $sqli)) {
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {

                $par = $rows['name'];
            }
        }
    }
    $sqli = "SELECT * FROM product where name ='$par'";

    if ($result = mysqli_query($conn, $sqli)) {
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {

                $par = $rows['id'];
            }
        }
    }
   

    if ($cate != '') {
        $query = "SELECT * FROM inventory where product_id='$par' and  brand_id='$brand' and  cat_id='$cate' ";
        $rs = mysqli_query($conn, $query);
        $rowed = mysqli_fetch_assoc($rs);
        if ($rowed != '') {
            $par = $rowed['current_quantity'];
        } else {
            $par = '0';
        }
    }
}
$row[] = $par;
echo json_encode($row);


?>