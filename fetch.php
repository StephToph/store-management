<?php

include "config.php";

$query = '';
$output = array();
$query = "SELECT * FROM category";

$result =mysqli_query($conn,$query);
$count_all_rows = mysqli_num_rows($result);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $query .= " WHERE name like '%".$search_value."%' ";
    $query .= " OR id like '%".$search_value."%' ";
}
$column_order = array('id', 'name');
if (isset($_POST['order'])) {
    $column = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $query .= " ORDER BY ".$column_order[$_POST['order'][0]['column']].' '.$order;
} else {
    $query .= " ORDER BY id asc";
}
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $query .= " LIMIT ".$start.",".$length;
}
$data = array();
$run_result =mysqli_query($conn,$query);

    while ($row = mysqli_fetch_assoc($run_result)) {
        $sub_data = array();
        $sub_data[] = $row['id'];
        $sub_data[] = $row['name'];
        $sub_data[] = '<div align="right"><a href="javascript:void()"  id="editbtn"  data-id="'.$row['id'].'"   class="text-primary"> <i class="anticon anticon-edit "></i>Edit</a>&nbsp;&nbsp;|<a href="javascript:void()" data-id="'.$row['id'].'" class="text-danger btnDelete"> <i class="anticon anticon-delete"></i>Delete</a></div>';

        $data[] = $sub_data;
    }

$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" =>$count_all_rows,
    "recordsFiltered" => $count_all_rows,
    "data" => $data

);
echo json_encode($output);

?>