<?php

include "config.php";

$query = '';
$output = array();
$query = "SELECT * FROM  inventory ";

$result = mysqli_query($conn, $query);
$count_all_rows = mysqli_num_rows($result);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $query .= " WHERE product_id like '%" . $search_value . "%' ";
    $query .= " OR id like '%" . $search_value . "%' ";
    $query .= " OR current_quantity like '%" . $search_value . "%' ";
    $query .= " OR brand_id like '%" . $search_value . "%' ";

}
$column_order = array('id', 'product_id', 'current_quantity', 'brand_id', 'cat_id');
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

    $cat = '';
    $brand = '';
    if ($row['product_id'] != "") {
        $ids = $row['product_id'];
        $query = "SELECT * FROM product WHERE id='$ids' ";
        $result = mysqli_query($conn, $query);

        while ($rows = mysqli_fetch_assoc($result)) {
            $cat = $rows['name'];
        }
    }


    $sub_data[] = $cat;
    if ($row['brand_id'] != "") {
        $id = $row['brand_id'];
        $queryd = "SELECT * FROM brand WHERE id='$id' ";
        $resulted = mysqli_query($conn, $queryd);

        while ($rows = mysqli_fetch_assoc($resulted)) {
            $bat = $rows['name'];
        }
    }
    $sub_data[] = $bat;
    $sat = '';
    if ($row['cat_id'] != "") {
        $id = $row['cat_id'];
        $queryds = "SELECT * FROM category WHERE id='$id' ";
        $resulteds = mysqli_query($conn, $queryds);
        while ($rowss = mysqli_fetch_assoc($resulteds)) {
            $sat = $rowss['name'];
        }
    }
    $sub_data[] = $sat;
    $qun = $row['current_quantity'];
    $sad = $qun;
    $will = "SELECT * FROM setting where product_id ='$ids' ";
    $sql1 = mysqli_query($conn, $will);
    if (mysqli_num_rows($sql1) > 0) {
        while ($row2 = mysqli_fetch_assoc($sql1)) {
            $dis = $row2["bundle"];

            if ($qun >= 10) {
                $bill = $qun / $dis;
                $sa = (int) $bill;
                $esd = $bill - $sa;
                $end = $esd * 10;
                $sun = $sa . ' bag';
                if ($end > 0) {
                    $sun = $sa . ' bag  ' . $end . ' bundle';
                }
              
            }
            if ($qun < 10) {
                $actq = $qun * 1;
                $sun = $actq . 'bundle';
            }

        }
        $sad = $sun;
    }
    
    $sub_data[] = $sad;
    $sub_data[] = $row['date'];
    $sub_data[] = '<div><a href="javascript:void()"  id="editbtn"  data-id="' . $row['id'] . '"   class="text-primary"> <i class="anticon anticon-edit "></i>Edit</a></div>';

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