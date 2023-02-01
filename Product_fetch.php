<?php

include "config.php";

$query = '';
$output = array();
$query = "SELECT * FROM product";

$result = mysqli_query($conn, $query);
$count_all_rows = mysqli_num_rows($result);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $query .= " WHERE name like '%" . $search_value . "%' ";
    $query .= " OR id like '%" . $search_value . "%' ";
    $query .= " OR cat_name like '%" . $search_value . "%' ";

}
$column_order = array('id', 'name', 'name', 'id');
if (isset($_POST['order'])) {
    $column = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $query .= " ORDER BY " . $column_order[$_POST['order'][0]['column']] . ' ' . $order;
} else {
    $query .= " ORDER BY id asc ";
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

    if ($row['image'] != "") {
        $image = '<img src="' . $row['image'] . '" class="img-fluid rounded"  style=" width:100%;max-height:13vh;  object-fit:cover;object-position: top;" />';
    } else {
        $image = '';
    }
    $sub_data[] = $image;
    $sub_data[] = $row['name'];
    $sub_data[] = $row['description'];
    $cat ='';
    $brand ='';
    if ($row['cat_name'] != "") {
        $id = $row['cat_name'];
        $query = "SELECT * FROM category WHERE id='$id' ";
        $result = mysqli_query($conn, $query);

        while ($rows = mysqli_fetch_assoc($result)) {
           $cat= $rows['name'];
        }
    } 
    if ($row['brand_id'] != "") {
        $id = $row['brand_id'];
        $querys = "SELECT * FROM brand WHERE id='$id' ";
        $results = mysqli_query($conn, $querys);

        while ($rows = mysqli_fetch_assoc($results)) {
           $brand= $rows['name'];
        }
    } 


    $sub_data[] =$cat;
    $sub_data[] = $brand;
    // $sub_data[] = '	&#8358;'.number_format($row['price'],2);
    $sub_data[] = '<div align="right"><a href="javascript:void()"  id="editbtn"  data-id="' . $row['id'] . '"   class="text-primary"> <i class="anticon anticon-edit "></i>Edit</a>&nbsp;&nbsp;|<a href="javascript:void()" data-id="' . $row['id'] . '" class="text-danger btnDelete"> <i class="anticon anticon-delete"></i>Delete</a></div>';

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