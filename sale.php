<?php
include "config.php";
include "header.php";
?>
<!-- Page Container START -->
<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Sale</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="home.php" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                    <span class="breadcrumb-item active"><i class="anticon anticon-audit m-r-5"></i>sale</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="msg">
                </div>
                <button class="btn btn-secondary btn-tone float-right m-t-35" id="add" data-toggle="modal"
                    data-target="#addnew" onclick="nums();">Add sale</button>

                <div class="m-t-35 table">
                    <table id="dtable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>sales id</th>
                                <th>product name:</th>
                                <th>price</th>
                                <th>Quantity Sold</th>
                                <th>total price:</th>
                                <th>date sold:</th>
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
                        <h5 class="modal-title">Add Sales</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="msg1"></div>
                        <form enctype="multipart/form-data" id="myform">
                            <div class="form-group">
                                <p style=" font-weight: 500;">Sales_id</p>
                                <input type="number" name="sale" readonly
                                    style="text-align:center;font-weight:700;font-size:25px;color:blue;" id="sale"
                                    placeholder="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <p style=" font-weight: 500;">Product Name:</p>
                                <select id="pname" name="pname"  onclick="bate()" class=" select2"
                                    required>
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
                            <div class="  m-b-15">
                                <p style=" font-weight: 500;">Category Name:</p>
                                <select class="select2" id="cate" name="pcates" onclick="bate()" >
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
                                <select name="tat" id="tat" class=" select2" onclick="bate()" onchange="tesy();">
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
                            <div class="form-group">
                                <p style=" font-weight: 500;">Variation:</p>
                                <select name="dat" id="mar" class=" select2" onchange="tesy();">
                                    <?php
                                    // $sql = "SELECT * FROM variation";
                                    // echo "<option>Select variation</option>";
                                    // if ($result = mysqli_query($conn, $sql)) {
                                    //     if (mysqli_num_rows($result) > 0) {
                                    //         //print_r($result);
                                    //         while ($row = mysqli_fetch_assoc($result)) {
                                    //             echo "<option value='" . $row['quantity'] . "'>" . $row['quantity'] . "</option>";
                                    //         }
                                    //     }
                                    // }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Price</p>
                                <input type="number" name="prices" oninput="add_number();" id="say" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Quantity left:</p>
                                <input type="text" id="wat" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Quantity sold</p>
                                <input type="tel" name="quantity" oninput="add_number();" id="quantity"
                                    placeholder="Quantity_sold" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <p style=" font-weight: 500;">Total price</p>
                                <input type="number" name="tprice" id="tprice" placeholder="total_price"
                                    class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-tone btn-block">ADD</button>
                        </form>
                        <!-- <script>$('.select2').select2();</script> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-tone m-r-10"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- add modal stop -->
        <script src="assets\js\jquery-3.6.3.js"></script>
        <!--  table scripts  and function start -->
        <script src="assets/vendors/select2/select2.min.js"></script>
        <script>
            $('.select2').select2();
            function add_number() {
                document.getElementById("tprice").value = "0";
                var first_number = parseFloat(document.getElementById("quantity").value);
                var second_number = parseFloat(document.getElementById("say").value);
                var result = first_number * second_number;

                document.getElementById("tprice").value = result;

            }
            function bate() {
                var sar = document.getElementById("cate").value;
                var val = document.getElementById("pname").value;
                var vals = document.getElementById("tat").value;
                $.ajax({
                    type: "GET",
                    url: "vary.php",
                    data: { val: val, sar: sar, vals: vals, },
                    success: function (data) {
                        var json1 = JSON.parse(data);
                        $("#mar").html(json1.select);
                    }
                })
            }
            function nums() {
                var num = Math.floor(Math.random() * 1000000);
                $.ajax({
                    type: "GET",
                    url: "rnum.php",
                    data: { num: num },
                    success: function (data) {
                        var json = JSON.parse(data);
                        if (json != '') {
                            $("#myform")[0].reset();
                            $("input[name='sale']").val(json.num);
                        } else {
                            nums();
                        }
                    }
                })

            };
            function tesy() {
                var sar = document.getElementById("cate").value;
                var val = document.getElementById("pname").value;
                var vals = document.getElementById("tat").value;
                var dat = document.getElementById("mar").value;
                $.ajax({
                    type: "GET",
                    url: "scate.php",
                    data: { val: val, sar: sar, vals: vals, dat: dat },
                    success: function (data) {
                        var json1 = JSON.parse(data);
                        $("#say").val(json1.sam);
                        $("#wat").val(json1.wat)
                        // add_number();
                    }
                })
            }
            $(document).ready(function sam() {
                sam().preventDefault();
                var val = document.getElementById("pname").value;
                $.ajax({
                    type: "GET",
                    url: "pcate.php",
                    data: { val: val },
                    success: function (data) {
                        var json1 = JSON.parse(data);
                        $("#say").val(json1)
                    }
                })
            });
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
                        url: "sale_fetch.php",
                        method: "POST"
                    },
                    "fnCreate": function (nRow, aData, iDataIndex) {
                        $(nRow).attr("reg_date", aData[0]);
                    }
                    ,
                    "columnDefs": [{
                        "targets": [],//not sort
                        "orderable": false,
                    }]
                })
            }
            $(document).ready(function () {
                $('#myform').on('submit', function (event) {
                    event.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: "sale_insert.php",
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
                                $("#msg").html('<span class="alert alert-success">   <i class="anticon anticon-info-circle"></i>sales is Added Successfully</span><br><br>');
                                setTimeout(function () {
                                    $("#msg").html('');
                                }, 5000);
                                myimage.clear();

                            } if (data == 'fails') {
                                $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">  <i class="anticon anticon-close-circle"></i>quantity added is more than quantity in store </span><br><br>');
                                // $('#wat').css("background-color","red","color","white");
                                $('#wat').removeClass().addClass("alert alert-warning ");
                                setTimeout(function () {
                                    $("#msg1").html('');
                                    $('#wat').removeClass().addClass("form-control")
                                }, 5000);
                            }
                            if (data == 'dams') {
                                $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show"> <i class="anticon anticon-close-circle"></i>product is not in inventory </span><br><br>');
                                setTimeout(function () {
                                    $("#msg1").html('');
                                }, 5000);
                            }
                            // else {
                            //     $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">please insert values fields </span><br><br>');
                            //     setTimeout(function () {
                            //         $("#msg1").html('');
                            //     }, 5000);

                            // }
                        }
                    });

                })
            })     
        </script>
        <!--table scripts stop  -->
        <?php
        include "footer.php"
            ?>