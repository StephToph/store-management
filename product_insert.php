<?php
include "config.php";
if (isset($_POST['pnames'])) {
    $nameSend = $_POST['pnames'];
    $cateSend = $_POST['pcates'];
    $descSend = $_POST['descs'];
    $imageSend = $_FILES['images'];
    $date = date('Y-m-d H:i:s');
    $brand=$_POST['tat'];
    


    $filename = $_FILES['images']['name'];
    $fileTmpname = $_FILES['images']['tmp_name'];

    $fileExt = explode('.', $filename);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');

    $check = "SELECT * FROM product WHERE name='$nameSend' AND cat_name='$cateSend' AND brand_id='$brand'";
    $rs = mysqli_query($conn, $check);
    $data = mysqli_num_rows($rs);
    if ($data > 0) {
        $output = 'fs';
    } else {
        if (in_array($fileActualExt, $allowed)) {
            $filenamenew = uniqid('', true) . "." . $fileActualExt;
            $upload_images = 'upload/' . $filenamenew;
            move_uploaded_file($fileTmpname, $upload_images);
            $sql = "INSERT INTO product (cat_name,name,description,image,Reg_date,brand_id) values ('$cateSend', '$nameSend', '$descSend', '$upload_images', '$date','$brand')";
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