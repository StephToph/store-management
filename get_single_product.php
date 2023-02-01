<?php
include "config.php";

$id = $_GET['id'];

$query="SELECT * FROM product WHERE id='$id' " ;
$sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql);    

$sqli = "SELECT * FROM category";
$par = '<option></option>';
if ($result = mysqli_query($conn, $sqli)) {
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $ch = '';
            if ($rows["id"]==$row["cat_name"]) {
                $ch = "selected"; 
            }
            $par .= "<option id='cate' value='" . $rows['id'] . "' ".$ch.">" . $rows['name'] . "</option>";
        }
    }
}
$myword = "SELECT * FROM brand";
$sar = '<option></option>';
if($motion= mysqli_query($conn,$myword)){
    if(mysqli_num_rows($motion)>0){
        while ($rowed = mysqli_fetch_assoc($motion)) {
            $sel = '';
            if ($rowed["id"]==$row["brand_id"]) {
                $sel = "selected"; 
            }
            $sar .= "<option id='cate' value='" . $rowed['id'] . "' ".$sel.">" . $rowed['name'] . "</option>";
        }

    }
}
$row['brand'] = $sar;
$row['select'] = $par;
echo json_encode($row);


       


?>