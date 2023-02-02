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
                <button class="btn btn-secondary btn-tone float-right m-t-35" id="add" data-toggle="modal"
                    data-target="#addnew">Add
                    Product</button>

                <div class="m-t-35 table">
                    <table id="dtable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>

                                <th>Name:</th>
                                <th>Description</th>
                                <th>Category Name:</th>
                                <th>brand:</th>

                                <th style="text-align:right;">Option</th>
                            </tr>
                        </thead>

                        <tfoot>

                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
        <!-- add modal start -->
        <div class="modal fade" id="addnew">
            <div class="modal-dialog modal-dialog-scrollable">
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
                                <p style=" font-weight: 500;">Product Name:</p>
                                <input type="text" name="pnames" id="name" placeholder="name" class="form-control"
                                    required>
                            </div>
                            <div class="form-group m-b-15">
                                <p style=" font-weight: 500;">Category Name:</p>
                                <select id="cate" name="pcates" class="form-control select2" onchange="testy();">
                                    <?php
                                    $sql = "SELECT * FROM category";
                                    echo "<option></option>";
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
                                <p style=" font-weight: 500;">Brand:</p>
                                <select name="tat" id="tat" class="form-control">
                                    <?php
                                    $sql = "SELECT * FROM brand";
                                    echo "<option></option>";
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
                                <input type="text" name="descs" id="desc" placeholder="name" class="form-control">
                            </div>
                            <!-- <div class="form-group">
                                <p style=" font-weight: 500;">price</p>
                                <input type="number" name="prices" id="prices" placeholder="name" class="form-control"
                                    required>
                            </div> -->

                            <figure>
                                <img id="myimage"
                                    style="width:auto; display: block;position:relative; max-width: 50%; margin:auto; object-fit:cover;object-position: top;">
                            </figure>
                            <div class="custom-file">
                                <p style=" font-weight: 500;">image:</p>
                                <input type="file" name="images" accept="image/*" class="custom-file-input" required
                                    id="customFile">
                                <label class="custom-file-label" for="customFile">Choose image</label>
                                <!-- 
                                <input type="file" class="btn btn-secondary" name="image" 
                                    required> -->
                            </div>
                           <br>
                           <br>
                            <button type="submit" class="btn btn-primary btn-tone  btn-block">ADD</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-tone  m-r-10"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- add modal stop -->
        <!-- update modal start -->
        <div class="modal fade" id="updatenew">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mods">update Product</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="msg2"></div>
                        <form enctype="multipart/form-data" id="myforms">

                            <div class="form-group">
                                <p style=" font-weight: 500;">Product Name:</p>
                                <input type="text" name="pname" id="name" placeholder="name" class="form-control"
                                    required>
                                <input type="hidden" id="id" name="pid" value="">
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Category Name:</p>
                                <select name="pcate" class="form-control" id="cat">

                                </select>
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Brand:</p>
                                <select name="yes" id="yes" class="form-control">
                                </select>
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Description</p>
                                <input type="text" name="desc" id="desc" class="form-control">
                            </div>
                            <!-- <div class="form-group">
                                <p style=" font-weight: 500;">price</p>
                                <input type="number" name="price" id="price" placeholder="name" class="form-control"
                                    required>
                            </div> -->
                            <figure>
                                <img id="myimages" name="myimages"
                                    style="width:auto; display: block;position:relative; max-width: 50%;margin:auto; object-fit:cover;object-position: top;">
                            </figure>
                            <div class="custom-file">
                                <p style=" font-weight: 500;">image:</p>
                                <input type="file" name="image" accept="image/*" class="custom-file-input im1"
                                    id="customFiles">
                                <label class="custom-file-label" for="customFiles">Choose image</label>
                                <!-- 
                                <input type="file" class="btn btn-secondary" name="image" 
                                    required> -->
                            </div>
                            <br>
                           <br>
                            <button type="submit" class="btn btn-primary btn-tone  btn-block">update</button>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-tone m-r-10"
                            data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- update modal stop -->
        <!-- delete modal start -->
        <div class="modal fade" id="delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure</p>
                        <button type="button" class="btn btn-danger btn-tone Delete " style="float:right;"> <i
                                class="anticon anticon-delete"></i>delete</button>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- delete modal stop -->
        <script src="assets\js\jquery-3.6.3.js"></script>
        <!--  table scripts  and function start -->
        <script src="assets/vendors/select2/select2.min.js"></script>
        <script>

            function testy() {
                var val = document.getElementById("cate").value;
                var vals = document.getElementById("cat").value;
                val
                $.ajax({
                    type: "GET",
                    url: "brandcate.php",
                    data: { val: val },
                    success: function (data) {
                        var json1 = JSON.parse(data);
                        $("#tat").html(json1);
                    }
                })
            }
            let uploadbtn = document.getElementById("customFile");
            let myimage = document.getElementById("myimage");
            uploadbtn.onchange = () => {
                let reader = new FileReader();
                reader.readAsDataURL(uploadbtn.files[0]);
                reader.onload = () => {
                    myimage.setAttribute("src", reader.result);
                }
            }
            let uploadbtn1 = document.getElementById("customFiles");
            let myimages = document.getElementById("myimages");
            uploadbtn1.onchange = () => {
                let reader = new FileReader();
                reader.readAsDataURL(uploadbtn1.files[0]);
                reader.onload = () => {
                    myimages.setAttribute("src", reader.result);
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
                        $(nRow).attr("name", aData[0]);
                    }
                    ,
                    "columnDefs": [{
                        "targets": [0, 2, 5],//not sort
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
                                myimage.clear();

                            }
                            else {
                                $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">Category already exist</span><br><br>');
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
                $.ajax(
                    {
                        url: "get_single_product.php",
                        data: { id: id },
                        type: "GET",
                        success: function (data) {
                            var json = JSON.parse(data);
                            $('#updatenew').modal('show');
                            $("input[name='pid']").val(json.id);
                            $("input[name='pname']").val(json.name);
                            $("input[name='desc']").val(json.description);
                            $("#cat").html(json.select);
                            $("#yes").html(json.brand);
                            $("input[name='price']").val(json.price);
                            myimages.setAttribute("src", json.image);
                        }
                    }
                )
            });
            $(document).ready(function () {
                $('#myforms').on('submit', function (event) {
                    event.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: "product_update.php",
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function (data) {
                            if (data == 'success') {
                                $('.modal').each(function () {
                                    $(this).modal('hide');
                                });
                                $('#dtable').DataTable().ajax.reload();
                                $("#msg").html('<span class="alert alert-success">Category is updated Successfully</span><br><br>');
                                setTimeout(function () {
                                    $("#msg").html('');
                                }, 5000);

                            }
                            else {
                                $("#msg2").html('<span class="alert alert-warning alert-dismissible fade show">Category is already exist</span><br><br>');
                                setTimeout(function () {
                                    $("#msg2").html('');
                                }, 5000);
                            }
                        }
                    });
                })
            });
            $(document).on('click', '.btnDelete', function (event) {
                $('#delete').modal('show');
                var id = $(this).data('id');
                $(document).on('click', '.Delete', function (event) {
                    event.preventDefault();
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
                                    setTimeout(function () {
                                        $("#msg").html('');
                                    }, 5000);
                                }
                                else {
                                    $('#dtable').DataTable().ajax.reload();
                                    $("#msg").html('<span class="alert alert-warnin">product not deleted</span><br><br>');
                                    setTimeout(function () {
                                        $("#msg").html('');
                                    }, 5000);
                                }
                            }
                        }
                    )
                });
            });
        </script>
        <!--table scripts stop  -->
        <?php
        include "footer.php"
            ?>