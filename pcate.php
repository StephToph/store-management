<?php
include "config.php";

extract($_GET);
$product = $_GET["val"];
$pars = '<option>null</option>';

if ($product != '') {
    $sqli = "SELECT * FROM product where id ='$product'";


    if ($result = mysqli_query($conn, $sqli)) {
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {

                $par = $rows['name'];
            }
        }
    }
    $sqlis = "SELECT * FROM product where name ='$par'";

    if ($results = mysqli_query($conn, $sqlis)) {
        if (mysqli_num_rows($results) > 0) {
            while ($rows = mysqli_fetch_assoc($results)) {
                $pars=  "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
        }
    }
}
?>