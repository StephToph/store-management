<?php
include "config.php";
include "header.php";
?>

<!-- Page Container START -->
<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Setting</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="home.php" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                    <span class="breadcrumb-item active"><i class="anticon anticon-audit m-r-5"></i>Setting</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="msg">
                </div>
                <button class="btn btn-secondary btn-tone float-right m-t-35" id="add" data-toggle="modal"
                    data-target="#addnew">Add Setting</button>

                <div class="m-t-35 table">
                    <table id="dtable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product Name:</th>
                                <th>bundle:</th>
                                <th>piece:</th>
                                <th style="text-align:right;">Option:</th>
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
                        <h5 class="modal-title" style="font-size: 25px;font-weight:500;">Add Setting</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="msg1"></div>
                        <form enctype="multipart/form-data" id="myform">

                            <div class="form-group">
                                <p style=" font-weight: 500;">Product_Name:</p>
                                <select id="pname" name="pname" onchange="tesy();" class="select2" required>
                                    <?php
                                    $sql = "SELECT * FROM product";
                                    echo "<option>select product</option>";
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
                            <div class=" form-group m-b-15">
                                <p style=" font-weight: 500;">Category Name:</p>
                                <select id="cate" name="pcates" onchange="tesy();" class="select2">
                                    <?php
                                    $sql = "SELECT * FROM category";
                                    echo "<option>select_category</option>";
                                    if ($result = mysqli_query($conn, $sql)) {
                                        if (mysqli_num_rows($result) > 0) {
                                            //print_r($result);
                                            echo "<option>none</option>";
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
                                <select name="tat" id="tat" class="select2" onchange="tesy();">
                                    <?php
                                    $sql = "SELECT * FROM brand";
                                    echo "<option>Select brand</option>";
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
                            <div class="form-group m-b-15">
                                <p style=" font-weight: 500;">bundle:</p>
                                <input type="number" name="bundle"  class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">piece:</p>
                                <input type="number" name="piece" class="form-control" name="piece">
                            </div>

                            <button type="submit" class="btn btn-primary btn-tone  btn-block">ADD</button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-tone m-r-10" data-dismiss="modal">Close</button>
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
                        <h5 class="modal-title" id="mods">update setting</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="fade hide" id="msg2"></div>
                        <form enctype="multipart/form-data" id="myforms">
                            <input type="text" hidden name="Iid" id="Iid">
                            <div class="form-group">
                                <p style=" font-weight: 500;">Product_Name:</p>
                                <select id="pats" name="pname" class="form-control" required>
                                </select>
                            </div>
                            <div class=" form-group m-b-15">
                                <p style=" font-weight: 500;">Category Name:</p>
                                <select id="cates" name="pcates" onchange="tesy();" class="form-control  ">
                                </select>
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Brand:</p>
                                <select name="tat" id="tats" class="form-control" onchange="tesy();">
                                </select>
                            </div>
                            <div class="form-group m-b-15">
                                <p style=" font-weight: 500;">bundle:</p>
                                <input type="number" name="bundle" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">piece:</p>
                                <input type="number" name="piece" class="form-control" name="piece">
                            </div>
                            <button type="submit" class="btn btn-primary btn-tone  btn-block">update</button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-tone m-r-10" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- update modal stop -->
        <script src="assets\js\jquery-3.6.3.js"></script>
        <!--  table scripts  and function start -->
        <script src="assets/vendors/select2/select2.min.js"></script>
        <Script>
            $('.select2').select2();
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
                        url: "setting_fetch.php",
                        method: "POST"
                    },
                    "fnCreate": function (nRow, aData, iDataIndex) {
                        $(nRow).attr("sale_id", aData[0]);
                    },
                    "columnDefs": [{
                        "targets": [3], //not sort
                        "orderable": false,
                    }]
                })
            }


            $(document).ready(function () {
                $('#myform').on('submit', function (event) {
                    event.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: "setting_insert.php",
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
                                $("#msg").html('<span class="alert alert-success">Inventory is Added Successfully</span><br><br>');
                                setTimeout(function () {
                                    $("#msg").html('');
                                }, 5000);
                            } else {
                                $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">Inventory Already exist</span><br><br>');
                                setTimeout(function () {
                                    $("#msg1").html('');
                                }, 5000);
                            }
                        }
                    });

                })
            })
            $(document).on('click', '#editbtn', function (event) {
                var id = $(this).data('id');
                $.ajax({
                    url: "get_single_setting.php",
                    data: { id: id },
                    type: "GET",
                    success: function (data) {
                        var json = JSON.parse(data);
                        $('#updatenew').modal('show');
                        $("input[name='Iid']").val(json.id);
                        $("#pats").html(json.product);
                        $("#cates").html(json.select);
                        $("#tats").html(json.brand);
                        $("input[name='bundle']").val(json.bundle);
                        $("input[name='piece']").val(json.piece);
                    }
                })
            });
            $(document).ready(function () {
                $('#myforms').on('submit', function (event) {
                    event.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: "setting_update.php",
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
                                $("#msg").html('<span class="alert alert-success">inventory  updated Successfully</span><br><br>');
                                setTimeout(function () {
                                    $("#msg").html('');
                                }, 5000);


                            } else {
                                $("#myform")[0].reset();
                                $("#msg2").html('<span class="alert alert-warning ">error occured</span><br><br>');
                                setTimeout(function () {
                                    $("#msg2").html('');
                                }, 5000);
                            }
                        }
                    });
                })
            });
        </Script>
        <?php
        include "footer.php"
            ?>