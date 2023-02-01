<?php
include "config.php";

if (isset($_POST['pname'])) {
    $user_id = $_POST['pid'];

    $sql = "SELECT * FROM product WHERE id=$user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $file = $row['image'];

            $nameSend = $_POST['pname'];
            $cateSend = $_POST['pcate'];
            $descSend = $_POST['desc'];
            $price = $_POST['price'];
            $band = $_POST['yes'];
            // $imageSend = $_FILES['image'];


            // $date = date('Y-m-d H:i:s');


            if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {

                $filename = $_FILES['image']['name'];
                $fileTmpname = $_FILES['image']['tmp_name'];

                $fileExt = explode('.', $filename);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg', 'jpeg', 'png');
                $filenamenew = uniqid('', true) . "." . $fileActualExt;
                $upload_images = 'upload/' . $filenamenew;
                move_uploaded_file($fileTmpname, $upload_images);
                unlink($file);
                $sqls = "UPDATE product set name='$nameSend', cat_name='$cateSend', description='$descSend', image='$upload_images',brand_id='$band',price='$price'   WHERE id=$user_id ";

                $results = mysqli_query($conn, $sqls);
                if ($results == true) {
                    $output = 'success';
                } else {
                    $output = 'fail';
                }

            } else {
                $sqls = "UPDATE product set name='$nameSend', cat_name='$cateSend', description='$descSend', brand_id='$band',price='$price'   WHERE id=$user_id ";
                $results = mysqli_query($conn, $sqls);
                if ($results == true) {
                    $output = 'success';
                } else {
                    $output = 'fail';
                }
            }

        }

    }
    echo json_encode($output);

}

?>