<?php
include "config.php";
include "header.php";
?>
<!-- Page Container START -->
<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Product</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="home.php" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                    <span class="breadcrumb-item active"><i class="anticon anticon-audit m-r-5"></i>Product</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="msg">
                </div>
                <button class="btn btn-secondary float-right m-t-35" data-toggle="modal" data-target="#addnew">Add
                    Product</button>

                <div class="m-t-35">
                    <table id="dtable" class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Name:</th>
                                <th>Name:</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Reg_date</th>
                                <th style="text-align:right;">Option</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Category Name:</th>
                                <th>Name:</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Reg_date</th>
                                <th style="text-align:right;">Option</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
        <!-- add modal start -->
        <div class="modal fade" id="addnew">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="msg1"></div>
                        <form enctype="multipart/form-data" id="myform">

                            <div class="form-group">
                                <p style=" font-weight: 500;">Product_Name:</p>
                                <input type="text" name="pname" id="name" placeholder="name" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Category Name:</p>
                                <select id='cate' name="pcate" class="form-control">
                                    <?php
                                    $sql = "SELECT * FROM category";
                                    if ($result = mysqli_query($conn, $sql)) {
                                        if (mysqli_num_rows($result) > 0) {
                                            //print_r($result);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Description</p>
                                <input type="text" name="desc" id="desc" placeholder="name" class="form-control"
                                    required>
                            </div>
                            <figure>
                                <img id="myimage"
                                    style="width:auto; display: block;position:relative; max-width: 50%;margin:auto; object-fit:cover;object-position: top;">
                            </figure>
                            <div class="custom-file">
                                <p style=" font-weight: 500;">image:</p>
                                <input type="file" name="image" class="custom-file-input" id="customFile"
                                    id="customFile">
                                <label class="custom-file-label" for="customFile">Choose image</label>
                                <!-- 
                                <input type="file" class="btn btn-secondary" name="image" 
                                    required> -->
                            </div>
                            <button type="submit" class="btn btn-primary  btn-block">ADD</button>

                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default m-r-10" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- add modal stop -->
        <!-- update modal start -->
        <div class="modal fade" id="updatenew" tabindex="-1" aria-labelledby="mods" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mods">update Product</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="msg1"></div>
                        <form enctype="multipart/form-data" id="myform">

                            <div class="form-group">
                                <p style=" font-weight: 500;">Product_Name:</p>
                                <input type="text" name="pname" id="name" placeholder="name" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Category Name:</p>
                                <select id='cate' name="pcate" class="form-control">
                                    <?php
                                    $sql = "SELECT * FROM category";
                                    if ($result = mysqli_query($conn, $sql)) {
                                        if (mysqli_num_rows($result) > 0) {
                                            //print_r($result);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Description</p>
                                <input type="text" name="desc" id="desc" placeholder="name" class="form-control"
                                    required>
                            </div>
                            <figure>
                                <img id="myimage"
                                    style="width:auto; display: block;position:relative; max-width: 50%;margin:auto; object-fit:cover;object-position: top;">
                            </figure>
                            <div class="custom-file">
                                <p style=" font-weight: 500;">image:</p>
                                <input type="file" name="image" class="custom-file-input" id="customFile"
                                    id="customFile">
                                <label class="custom-file-label" for="customFile">Choose image</label>
                                <!-- 
                                <input type="file" class="btn btn-secondary" name="image" 
                                    required> -->
                            </div>
                            <button type="submit" class="btn btn-primary  btn-block">ADD</button>

                        </form>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-default m-r-10" data-dismiss="modal">Close</button>
                        <button type="button" onclick="updatecat()" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- update modal stop -->
        <script src="https://code.jquery.com/jquery-3.6.3.js"
            integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
        <!--  table scripts  start -->
        <script>
            let uploadbtn = document.getElementById("customFile");
            let myimage = document.getElementById("myimage");
            uploadbtn.onchange = () => {
                let reader = new FileReader();
                reader.readAsDataURL(uploadbtn.files[0]);

                reader.onload = () => {
                    myimage.setAttribute("src", reader.result);
                }
            }


            $(document).ready(function () {
                get_data();
            });
            function get_data() {
                var dataTable = $('#dtable').dataTable({
                    "processing": true,
                    "serverSide": true,
                    "paging": true,
                    "order": [],
                    "ajax": {
                        url: "Product_fetch.php",
                        method: "POST"
                    },
                    "fnCreate": function (nRow, aData, iDataIndex) {
                        $(nRow).attr("id", aData[0]);
                    }
                    ,
                    "columnDefs": [{
                        "targets": [3, 4, 6],//not sort
                        "orderable": false
                    }]
                })
            }
            $(document).ready(function () {
                $('#myform').on('submit', function (event) {
                    event.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: "product_insert.php",
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function (data) {
                            if (data == 'success') {
                                $("#myform")[0].reset();
                                $('#dtable').DataTable().ajax.reload();
                                $('.modal').each(function () {
                                    $(this).modal('hide');
                                });
                                $("#msg").html('<span class="alert alert-success">Category is Added Successfully</span><br><br>');
                                setTimeout(function () {
                                    $("#msg").html('');
                                }, 5000);

                            }
                            else {
                                var toastHTML = '<span class="alert alert-warning alert-dismissible fade show">Category already exist</span><br><br>';
                                $("#msg1").html(toastHTML);
                                setTimeout(function () {
                                    $("#msg1").html('');
                                }, 5000);

                                // $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">Category already exist</span><br><br>');
                                // $('#msg1').toast('show');

                                //     function display() {$("#msg1").html('');                               
                                //    }                                                                
                                //     setTimeout( display(),10000);
                                // $('#msg1').toast('show');
                            }
                        }
                    });

                })
            })





            $(document).on('click', '#editbtn', function (event) {
                var id = $(this).data('id');
                var trid = $(this).closest('tr').attr('id');
                $.ajax(
                    {
                        url: "get_single_product.php",
                        data: { id: id },
                        type: "post",
                        success: function (data) {
                            var json = JSON.parse(data);
                            $('#id').val(json.id);
                            $('#trid').val(trid);
                            $('#name').val(json.name);
                            $('#pcate').val(json.cat_name);
                            $('#desc').val(json.description);
                            $('#myimage').attr("src", json.image);
                            $('#Date').attr("value", json.date);
                            // $('#Date').val(json.date); 
                            $('#updatenew').modal('show');
                        }
                    }
                )
            });
            function updatecat() {
                var id = $('#id').val();
                var trid = $('#trid');
                var name = $('#uname').val();

                $.ajax({
                    url: "product_update.php",
                    data: { id: id, nameup: name },
                    type: "post",
                    success: function (data) {
                        var d = JSON.parse(data);
                        if (d.result == 'success') {
                            $('#dtable').DataTable().ajax.reload();
                            $("#uname").val('');
                            $('.modal').each(function () {
                                $(this).modal('hide');
                            });
                            $("#msg").html('<span class="alert alert-success">Category is updated Successfully</span><br><br>');
                            $('#msg').toast('show');
                        }
                        else {
                            $("#name").val('');
                            $('#dtable').DataTable().ajax.reload();
                            $("#msg2").html('<span class="alert alert-warning alert-dismissible fade show">Category is already exist</span><br><br>');
                            $('#msg2').toast('show');
                        }
                    }
                }
                );
            };
            $(document).on('click', '.btnDelete', function (event) {
                var id = $(this).data('id');
                if (confirm("Are you sure you want to delete this  Category ")) {
                    $.ajax(
                        {
                            url: "product_delete.php",
                            data: { id: id },
                            type: "post",
                            success: function (data) {
                                var d = JSON.parse(data);
                                if (d.result == 'success') {
                                    $('#dtable').DataTable().ajax.reload();
                                    $('.modal').each(function () {
                                        $(this).modal('hide');
                                    });
                                    $("#msg").html('<span class="alert alert-success">Product deleted Successfully</span><br><br>');
                                    $('#msg').toast('show');
                                }
                                else {
                                    $('#dtable').DataTable().ajax.reload();
                                    $("#msg").html('<span class="alert alert-warnin">product not deleted</span><br><br>');
                                    $('#msg').toast('show');
                                }
                            }
                        }
                    )
                }
            });
        </script>
        <!--table scripts stop  -->
        <?php
        include "footer.php"
            ?>