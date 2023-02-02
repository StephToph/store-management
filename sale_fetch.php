<?php

include "config.php";

$query = '';
$output = array();
$query = "SELECT * FROM sales";

$result = mysqli_query($conn, $query);
$count_all_rows = mysqli_num_rows($result);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $query .= " WHERE sale_id like '%" . $search_value . "%' ";
    $query .= " OR product_id like '%" . $search_value . "%' ";
    $query .= " OR prices like '%" . $search_value . "%' ";
    $query .= " OR total_price like '%" . $search_value . "%' ";
    $query .= " OR quantity like '%" . $search_value . "%' ";


}
$column_order = array('sale_id', 'product_id', 'total_price', 'prices', 'quantity');
if (isset($_POST['order'])) {
    $column = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $query .= " ORDER BY " . $column_order[$_POST['order'][0]['column']] . ' ' . $order;
} else {
    $query .= " ORDER BY reg_date desc ";
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

    $sub_data[] = '&#35;' . $row['sale_id'];

    $cat = '';
    $brand = '';
    if ($row['product_id'] != "") {
        $id = $row['product_id'];
        $query = "SELECT * FROM product WHERE id='$id' ";
        $result = mysqli_query($conn, $query);

        while ($rows = mysqli_fetch_assoc($result)) {
            $cat = $rows['name'];
        }
    }

    $id = $row['product_id'];
    $sub_data[] = $cat;
    $sub_data[] = '	&#8358;' . number_format($row['prices'], 2);
    $qun = $row['quantity'];
    $sae = $qun;
    $will = "SELECT * FROM setting where product_id ='$id' ";
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
        $sae = $sun;
    }
    $sub_data[] = $sae;   
    $sub_data[] = '	&#8358;' . number_format($row['total_price'], 2);
    $sub_data[] = $row['reg_date'];
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