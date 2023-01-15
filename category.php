<?php
include "config.php";
include "header.php";
?>
<!-- Page Container START -->
<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Category</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="home.php" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                    <span class="breadcrumb-item active"><i class="anticon anticon-audit m-r-5"></i>Category</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="msg">
                </div>
                <button class="btn btn-secondary float-right m-t-35" data-toggle="modal" data-target="#addnew"
                    onclick="adduser()">Add Category</button>

                <div class="m-t-35">
                    <table id="dtable" class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
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
        <!-- add modal start -->
        <div class="modal fade " id="addnew">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Category</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="msg1"></div>

                        <div class="form-group">
                            <p style=" font-weight: 500;">Name:</p>
                            <input type="text" id="name" placeholder="name" class="form-control" required>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default m-r-10" data-dismiss="modal">Close</button>
                        <button type="button" onclick="adduser()" class="btn btn-success">ADD</button>
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
                        <h5 class="modal-title" id="mods">update New Category</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="fade hide" id="msg2"></div>

                        <div class="form-group">
                            <input type="hidden" id="id" name="id" value="">
                            <input type="hidden" id="trid" name="id" value="">
                            <p style=" font-weight: 500;">Name:</p>
                            <input type="text" id="uname" placeholder="name" class="form-control" required>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default m-r-10" data-dismiss="modal">Close</button>
                        <button type="button" onclick="updatecat()" class="btn btn-primary">Update</button>
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
                        <button type="button" class="btn btn-danger Delete " style="float:right;"> <i
                                    class="anticon anticon-delete"></i>delete</button>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- delete modal stop -->
        <script src="https://code.jquery.com/jquery-3.6.3.js"
            integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
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
                        url: "fetch.php",
                        method: "POST"
                    },
                    "fnCreate": function (nRow, aData, iDataIndex) {
                        $(nRow).attr("id", aData[0]);
                    }
                    ,
                    "columnDefs": [{
                        "targets": [2],//not sort
                        "orderable": false
                    }]
                })
            }
            function adduser() {
                var nameAdd = $('#name').val();
                if (nameAdd != '') {
                    $.ajax({
                        url: "insert.php",
                        type: 'post',
                        data: { nameSend: nameAdd },
                        dataType: "json",                       
                        success:function(data) {
                            if (data == 'success') {
                                $("#name").val('');
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
                                $('#dtable').DataTable().ajax.reload();
                                $('#msg1').toast('show');
                                $("#msg1").html('<span class="alert alert-warning ">Category already exist</span><br><br>');
                                setTimeout(function () {
                                    $("#msg1").html('');
                                }, 5000);



                            }
                        }
                    });
                }

            }
            $(document).on('click', '#editbtn', function (event) {
                var id = $(this).data('id');
                var trid = $(this).closest('tr').attr('id');
                $.ajax(
                    {
                        url: "get_single_user.php",
                        data: { id: id },
                        type: "post",
                        success: function (data) {
                            var json = JSON.parse(data);
                            $('#id').val(json.id);                         
                            $('#pname').val(json.name);
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
                    url: "update.php",
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
                            setTimeout(function () {
                                $("#msg").html('');
                            }, 5000);

                        }
                        else {
                            $("#name").val('');
                            $('#dtable').DataTable().ajax.reload();
                            $("#msg2").html('<span class="alert alert-warning ">error</span><br><br>');
                            setTimeout(function () {
                                $("#msg2").html('');
                            }, 5000);
                        }
                    }
                }
                );
            };
            $(document).on('click', '.btnDelete', function (event) {
                $('#delete').modal('show');
                var id = $(this).data('id');
                $(document).on('click', '.Delete', function (event) {
                    event.preventDefault();
                    $.ajax(
                        {
                            url: "delete.php",
                            data: { id: id },
                            type: "post",
                            success: function (data) {
                                var d = JSON.parse(data);
                                if (d.result == 'success') {
                                    $('#dtable').DataTable().ajax.reload();
                                    $('.modal').each(function () {
                                        $(this).modal('hide');
                                        $("#msg").html('<span class="alert alert-warning">Category is deleted Successfully</span><br><br>');
                                        $('#msg').toast('show');
                                        // setTimeout(function () {
                                        //     $('#msg').remove();
                                        // }, 3000);
                                    });
                                }
                                else {
                                    $('#dtable').DataTable().ajax.reload();
                                    $("#msg").html('<span class="alert alert-success">Category as not been deleted </span><br><br>');
                                    setTimeout(function () {
                                        $("#msg1").html('');
                                    }, 5000);

                                }
                            }
                        }
                    )
                }
                );
            });
        </script>
        <!--table scripts stop  -->
        <?php
        include "footer.php"
            ?>