<?php
include "config.php";

$id = $_GET['id'];

$query="SELECT * FROM brand WHERE id='$id' " ;
$sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql);    

// $row['select'] = $par;
echo json_encode($row);


       


?>