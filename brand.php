<?php
include "config.php";
include "header.php";
?>
<!-- Page Container START -->
<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Brand</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="home.php" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                    <span class="breadcrumb-item active"><i class="anticon anticon-audit m-r-5"></i>Brand</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="msg">
                </div>
                <button class="btn btn-secondary btn-tone float-right m-t-35" data-toggle="modal"
                    data-target="#addnew">Add
                    Brand</button>

                <div class="m-t-35">
                    <table id="dtable" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th style="text-align:right;">Option</th>
                            </tr>
                        </thead>
                        <tbody id="datatable"></tbody>
                        <tfoot>

                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- add modal start -->
    <div class="modal fade " id="addnew">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Brand</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="msg1"></div>
                    <form id="myform">
                        <div class="form-group">
                            <p style=" font-weight: 500;">Name:</p>
                            <input type="text" name="bnames" placeholder="name" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-tone  btn-block">ADD</button>
                    </form>
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
                    <h5 class="modal-title" id="mods">update Brand</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="fade hide" id="msg2"></div>
                    <form enctype="multipart/form-data" id="myforms">
                        <div class="form-group">
                            <p style=" font-weight: 500;">Product_Name:</p>
                            <input type="text" name="bname" id="name" placeholder="name" class="form-control" required>
                            <input type="hidden" id="id" name="bid" value="">
                        </div>
                        <!-- <div class="form-group">
                            <p style=" font-weight: 500;">Category Name:</p>
                            <select name="bcate" class="form-control" id="cat">
                            </select>
                        </div> -->
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
    <!-- delete modal start -->
    <div class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure</p>
                    <button type="button" class="btn btn-danger Delete btn-tone " style="float:right;"> <i
                            class="anticon anticon-delete"></i>delete</button>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- delete modal stop -->
    <script src="assets\js\jquery-3.6.3.js"></script>
    <!--  table scripts  start -->
    <script>
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
                    url: "brand_fetch.php",
                    method: "POST"
                },
                "fnCreate": function (nRow, aData, iDataIndex) {
                    $(nRow).attr("id", aData[0]);
                },
                "columnDefs": [{
                    "targets": [1], //not sort
                    "orderable": false,
                }]
            })
        }

        $(document).ready(function () {
            $('#myform').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'post',
                    url: "brand_insert.php",
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
                            $("#msg").html('<span class="alert alert-success">Brand is Added Successfully</span><br><br>');
                            setTimeout(function () {
                                $("#msg").html('');
                            }, 5000);
                            myimage.clear();

                        }
                        else {

                            $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">brand already exist</span><br><br>');
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
                    url: "get_single_brand.php",
                    data: { id: id },
                    type: "GET",
                    success: function (data) {
                        var json = JSON.parse(data);
                        $('#updatenew').modal('show');
                        $("input[name='bid']").val(json.id);
                        $("input[name='bname']").val(json.name);
                        // $("#cat").html(json.select);
                    }
                }
            )
        });

        $(document).ready(function () {
            $('#myforms').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'post',
                    url: "brand_update.php",
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
                            $("#msg").html('<span class="alert alert-success">brand is updated Successfully</span><br><br>');
                            setTimeout(function () {
                                $("#msg").html('');
                            }, 5000);

                        } else {
                            $("#msg2").html('<span class="alert alert-warning ">error</span><br><br>');
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
                $.ajax({
                    url: "brand_delete.php",
                    data: {
                        id: id
                    },
                    type: "post",
                    success: function (data) {
                        var d = JSON.parse(data);
                        if (d.result == 'success') {
                            $('#dtable').DataTable().ajax.reload();
                            $('.modal').each(function () {
                                $(this).modal('hide');
                                $("#msg").html('<span class="alert alert-warning">Brand is deleted Successfully</span><br><br>');
                                $('#msg').toast('show');
                                // setTimeout(function () {
                                //     $('#msg').remove();
                                // }, 3000);
                            });
                        } else {
                            $('#dtable').DataTable().ajax.reload();
                            $("#msg").html('<span class="alert alert-success">Brand as not been deleted </span><br><br>');
                            setTimeout(function () {
                                $("#msg1").html('');
                            }, 5000);

                        }
                    }
                })
            });
        });
    </script>
    <!--table scripts stop  -->
    <?php
    include "footer.php"
        ?>