<?php
include "config.php";
if (isset($_POST['pname'])) {
    $nameSend = $_POST['pname'];
    $cateSend = $_POST['pcate'];
    $descSend = $_POST['desc'];
    $imageSend = $_FILES['image'];
    $date = date('Y-m-d H:i:s');


    $filename = $_FILES['image']['name'];
    $fileTmpname = $_FILES['image']['tmp_name'];

    $fileExt = explode('.', $filename);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');

    $check = "SELECT * FROM product WHERE name = '$_POST[pname]'";
    $rs = mysqli_query($conn, $check);
    $data = mysqli_num_rows($rs);
    if ($data > 0) {
        $output = 'fail';
    } else {
        if (in_array($fileActualExt, $allowed)) {
            $filenamenew = uniqid('', true) . "." . $fileActualExt;
            $upload_images = 'upload/' . $filenamenew;
            move_uploaded_file($fileTmpname, $upload_images);
            $sql = "INSERT INTO product (cat_name,name,description,image,Reg_date) values ('$cateSend', '$nameSend', '$descSend', '$upload_images', '$date')";
            $result = mysqli_query($conn, $sql);

            if ($result == true) {
                $output = 'success';
            } else {
                $output = 'fail';
            }

        } else {
            $output = 'fail';
        }
    }

    echo json_encode($output);

}
?>