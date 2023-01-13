<?php
include "config.php";
$cat_id = $_POST['id'];

$sql = "DELETE FROM category  WHERE id='$cat_id'";
$result = mysqli_query($conn, $sql);


$result = $conn->query($sql);

if ($result == true) {
  $output = array("result" => 'success');
 
} else {
  $output = array("result" => 'fail');
  
}

echo json_encode($output);


?>