<?php
include "config.php";

extract($_POST);
if (isset($_POST["nameup"])) {
 
$name = $_POST["nameup"];
$id = $_POST["id"];
$sql="UPDATE category set name='$name' WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if($result==true){
   $output = array("result" => 'success');
}
else {
   $output = array("result" => 'fail');
}

echo json_encode($output);
}


?>