<?php
include "config.php";
if (isset($_POST['pname'])) {
    $id = $_POST['Iid'];
    $nameSend = $_POST['pname'];
    $cateSend = $_POST['pcates'];  
    $brand = $_POST['tat'];
    $bundle = $_POST['bundle'];
    $piece = $_POST['piece'];

    if ($nameSend != '') {
        $sqli = "SELECT * FROM product where id ='$nameSend' ";

        if ($result = mysqli_query($conn, $sqli)) {
            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {

                    $par = $rows['name'];
                }
            }
        }
        $sqls = "SELECT * FROM product where name ='$par' and cat_name='$cateSend' and brand_id ='$brand' ";
        if ($results = mysqli_query($conn, $sqls)) {
            if (mysqli_num_rows($results) > 0) {
                while ($rowed = mysqli_fetch_assoc($results)) {
                    $pars = $rowed['id'];
                }


                $sql = " UPDATE setting set product_id='$pars', bundle ='$bundle', piece='$piece' where id ='$id' ";
                $resulted = mysqli_query($conn, $sql, );
                if ($resulted == true) {
                    $output = 'success';
                } else {
                    $output = 'fail';
                }

            }


        }




    }
    echo json_encode($output);

}