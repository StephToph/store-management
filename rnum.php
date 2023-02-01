<?php
include "config.php";

extract($_GET);

$num = $_GET["num"];

$sql = "SELECT * from sales where sale_id='$num'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($rows = mysqli_fetch_assoc($result)) {
        $num = "";      
    }
}
$row['num'] = $num;
echo json_encode($row);
?>