<?php

include "config.php";

$query = '';
$output = array();
$query = "SELECT * FROM setting";

$result = mysqli_query($conn, $query);
$count_all_rows = mysqli_num_rows($result);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $query .= " WHERE product_id like '%" . $search_value . "%' ";
    $query .= " OR id like '%" . $search_value . "%' ";
}
$column_order = array('product_id','bundle','piece');
if (isset($_POST['order'])) {
    $column = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $query .= " ORDER BY " . $column_order[$_POST['order'][0]['column']] . ' ' . $order;
} else {
    $query .= " ORDER BY id asc";
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
    $dat = $row['product_id'];
    if ($dat != '') {
        $eat = "SELECT * FROM PRODUCT WHERE id=$dat";
        $rest = mysqli_query($conn, $eat);
        while ($rows= mysqli_fetch_assoc($rest)) {
            $cat = $rows['name'];
        }
    }
    $sub_data[] = $cat;
    $sub_data[] = $row['bundle'];
    $sub_data[] = $row['piece'];
    $sub_data[] = '<div align="right"><a href="javascript:void()"  id="editbtn"  data-id="' . $row['id'] . '"   class="text-primary"> <i class="anticon anticon-edit "></i>Edit</a></div>';

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