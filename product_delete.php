<?php
include "config.php";
$id = $_POST['id'];

$sql = "SELECT * FROM product WHERE id=$id";

  $result = $conn->query($sql);


if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $files = $row['image'];
    unlink($files);


  }
}
    $sql = "DELETE FROM product   WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    $result = $conn->query($sql);

    if ($result == true) {
      $output = array("result" => 'success');

    } else {
      $output = array("result" => 'fail');

    }

 
  
  echo json_encode($output);



?>