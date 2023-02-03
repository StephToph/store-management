<?php

include "config.php";

$query = '';
$output = array();
$query = "SELECT * FROM  variation ";

$result = mysqli_query($conn, $query);
$count_all_rows = mysqli_num_rows($result);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $query .= " WHERE product_id like '%" . $search_value . "%' ";
    $query .= " OR id like '%" . $search_value . "%' ";
    $query .= " OR quantity like '%" . $search_value . "%' ";
    $query .= " OR price like '%" . $search_value . "%' ";  

}
$column_order = array('id',  'product_id','quantity','price');
if (isset($_POST['order'])) {
    $column = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $query .= " ORDER BY " . $column_order[$_POST['order'][0]['column']] . ' ' . $order;
} else {
    $query .= " ORDER BY id desc ";
}
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $query .= " LIMIT " . $start . "," . $length;

}
$data = array();

$run_result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($run_result)) {
    $sub_data = array();

    $sub_data[] = $row['id'];
    
    $cat ='';
 
    if ($row['product_id'] != "") {
        $id = $row['product_id'];
        $query = "SELECT * FROM product WHERE id='$id' ";
        $result = mysqli_query($conn, $query);

        while ($rows = mysqli_fetch_assoc($result)) {
           $cat= $rows['name'];
           $sat= $rows['brand_id'];
        }
    } 
   if($sat != "" ){
    $query = "SELECT * FROM brand WHERE id='$sat' ";
    $result = mysqli_query($conn, $query);
    while ($rows = mysqli_fetch_assoc($result)) {
        $mat= $rows['name'];
        
     }
   }
    $sub_data[] =$cat;
    $sub_data[] = $mat;
    $sub_data[] =$row['quantity'];
    $sub_data[] = $row['price'];
   
    $sub_data[] = '<div style="text-align:right;"><a href="javascript:void()"  id="editbtn"  data-id="' . $row['id'] . '"   class="text-primary"> <i class="anticon anticon-edit "></i>Edit</a></div>';
   
    $data[] = $sub_data;
}

$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $count_all_rows,
    "recordsFiltered" => $count_all_rows,
    "data" => $data

);
echo json_encode($output);

?>