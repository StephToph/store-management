<?php
include "config.php";

$id = $_GET['id'];

$query = "SELECT * FROM inventory WHERE id='$id' ";
$sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql);

$sqli = "SELECT * FROM category";
$par = '<option></option>';
if ($result = mysqli_query($conn, $sqli)) {
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $ch = '';
            if ($rows["id"] == $row["cat_id"]) {
                $ch = "selected";
            }
            $par .= "<option id='cate' value='" . $rows['id'] . "' " . $ch . ">" . $rows['name'] . "</option>";
        }
    }
}
$myword = "SELECT * FROM brand";
$sar = '<option></option>';
if ($motion = mysqli_query($conn, $myword)) {
    if (mysqli_num_rows($motion) > 0) {
        while ($rowed = mysqli_fetch_assoc($motion)) {
            $sel = '';
            if ($rowed["id"] == $row["brand_id"]) {
                $sel = "selected";
            }
            $sar .= "<option id='cate' value='" . $rowed['id'] . "' " . $sel . ">" . $rowed['name'] . "</option>";
        }

    }
}
$mywords = "SELECT * FROM product";
$sars = '<option></option>';
if ($motions = mysqli_query($conn, $mywords)) {
    if (mysqli_num_rows($motions) > 0) {
        while ($roweds = mysqli_fetch_assoc($motions)) {

            $sels = '';
            if ($roweds["id"] == $row["product_id"]) {
                $sels = "selected";
            }
            $sars .= "<option id='cate' value='" . $roweds['name'] . "' " . $sels . ">" . $roweds['name'] . "</option>";
        }

    }
}
$qun = $row['current_quantity'];
$ids = $row['product_id'];

$sad = $qun;
$bin = $qun;
$will = "SELECT * FROM setting where product_id ='$ids' ";
$sql1 = mysqli_query($conn, $will);
if (mysqli_num_rows($sql1) > 0) {
    while ($row2 = mysqli_fetch_assoc($sql1)) {
        $dis = $row2["bundle"];
        $bin = $qun / $dis;

        if ($qun >= 10) {
            $bill = $qun / $dis;
            $sa = (int) $bill;
            $esd = $bill - $sa;
            $end = $esd * 10;
            $sun = $sa . ' bag';
            if ($end > 0) {
                $sun = $sa .('bag').$end.(' bundle');
            }

        }
        if ($qun < 10) {
            $actq = $qun * 1;
            $sun = $actq.'bundle';
        }

    }
    $sad = $sun;
}

$row['real'] = $bin;
$row['quantity'] = $sad;
$row['wast'] = $sars;
$row['brand'] = $sar;
$row['cates'] = $par;
echo json_encode($row);


?>