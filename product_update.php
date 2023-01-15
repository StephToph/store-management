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
            $imageSend = $_FILES['images'];


            // $date = date('Y-m-d H:i:s');


            if (($_FILES['images']['name']) && ($_FILES['images']['name'] != "")) {

                $filename = $_FILES['images']['name'];
                $fileTmpname = $_FILES['images']['tmp_name'];


            } else {
                $filename = $file;

            }
            $fileExt = explode('.', $filename);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png');
            $filenamenew = uniqid('', true) . "." . $fileActualExt;
            unlink($file);
            $upload_images = 'upload/' . $filenamenew;
            move_uploaded_file($fileTmpname, $upload_images);
            $sqls = "UPDATE product set name='$nameSend', cat_name='$cateSend', description='$descSend', image='$upload_images'   WHERE id=$user_id ";

            $results = mysqli_query($conn, $sqls);
            if ($results == true) {
                $output = 'success';
            } else {
                $output = 'fail';
            }




        }

    }
    echo json_encode($output);

}

?>