<?php
include "config.php";

$id = $_GET['id'];

$query = "SELECT * FROM variation WHERE id='$id' ";
$sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql);


$sqli2 = "SELECT * FROM product";
$par4 = '<option></option>';
if ($resulted = mysqli_query($conn, $sqli2)) {
    if (mysqli_num_rows($resulted) > 0) {
        while ($rows = mysqli_fetch_assoc($resulted)) {
            $sid = $row["product_id"];
            $chs = '';
            if ($rows["id"] == $row["product_id"]) {
                $chs = "selected";
            }
            $par4 .= "<option id='product' value='" . $rows['id'] . "' " . $chs . ">" . $rows['name'] . "</option>";
            $query1 = "SELECT * FROM product WHERE id='$sid' ";
            $sql1 = mysqli_query($conn, $query1);
            $row1 = mysqli_fetch_assoc($sql1);
            $myword = "SELECT * FROM brand";
            $sar = '<option></option>';
            if ($motion = mysqli_query($conn, $myword)) {
                if (mysqli_num_rows($motion) > 0) {
                    while ($rowed = mysqli_fetch_assoc($motion)) {
                        $sel = '';
                        if ($rowed["id"] == $row1['brand_id']) {
                            $sel = "selected";
                        }
                        $sar .= "<option id='brand' value='" . $rowed['id'] . "'  " . $sel . ">" . $rowed['name'] . "</option>";
                    }

                }
            }
            $sqli = "SELECT * FROM category";
            $par = '<option></option>';
            if ($result = mysqli_query($conn, $sqli)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($ros = mysqli_fetch_assoc($result)) {
                        $ch = '';
                        if ($ros["id"] == $row1["cat_name"]) {
                            $ch = "selected";
                        }
                        $par .= "<option id='cate' value='" . $ros['id'] . "' " . $ch . ">" . $ros['name'] . "</option>";



                    }
                }
            }



        }
    }
}
$row['product'] = $par4;
$row['brand'] = $sar;
$row['select'] = $par;
echo json_encode($row);





?>