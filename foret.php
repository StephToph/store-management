<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>testimony</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">

</head>

<body class="text-capitalize font-weight-semibold">
    <div class="app">
        <div class="container-fluid p-0 h-100">
            <div class="row no-gutters h-100 full-height">
                <div class="col-lg-4 d-none d-lg-flex bg"
                    style="background-image:url('assets/images/others/sign-up-1.jpg')">
                    <div class="d-flex h-100 p-h-40 p-v-15 flex-column justify-content-between">
                        <div>
                            <h1 class="text-white m-b-20 font-weight-normal">Testimony Poly</h1>
                        </div>
                        <div>
                            <h1 class="text-white m-b-20 font-weight-normal">Exploring testimony</h1>
                            <p class="text-white font-size-16 lh-2 w-80 opacity-08">Climb leg rub face on everything
                                give attitude nap all day for under the bed. Chase mice attack feet but rub face on
                                everything hopped up.</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-white">©
                                <?php
                                echo date('Y'); ?>
                            </span>
                            <!-- <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-white text-link" href="">Legal</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-white text-link" href="">Privacy</a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 bg-white">
                    <div class="container h-100">
                        <div class="row no-gutters h-100 align-items-center">
                            <div class="col-md-8 col-lg-7 col-xl-6 mx-auto">
                                <h2>forget password</h2>
                                <p class="m-b-30">please input neccesary details</p>
                                <form enctype="multipart/form-data" id="myform">
                                    <div id="msg1"></div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="userName">Username:</label>
                                        <input type="text" class="form-control" autocomplete="off" name="username"
                                            id="userName" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="email">Email:</label>
                                        <input type="email" name="email" required class="form-control" id="email"
                                            placeholder="Email">
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label class="font-weight-semibold" for="password">Password:</label>
                                        <input type="password" disabled name="password" autocomplete="off"
                                            class="form-control" id="password" placeholder="Password">
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label class="font-weight-semibold" autocomplete="off"
                                            for="confirmPassword">Confirm
                                            Password:</label>
                                        <input type="password" disabled class="form-control" name='PasswordConfirm'
                                            id="confirmPassword" placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between p-t-15">
                                            <div class="checkbox">
                                                <button id="trigger-loading" class="btn btn-primary m-r-5">
                                                    <i class="anticon anticon-loading m-r-5"></i>
                                                    <i class="anticon anticon-poweroff m-r-5"></i>
                                                    <span>check account</span>
                                                </button>
                                            </div>
                                            <button type="submit" style="display: none;" id="ban" class="btn btn-primary">Sign
                                                In</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>
    <script src="assets/vendors/jquery-validation/jquery.validate.min.js"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <script>
        $('#trigger-loading').on('click', function () {

            $(this).addClass("is-loading");

            $('#myform').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'post',
                    url: "see.php",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (data) {
                        if (data == 'pass') {
                            // $("#myform")[0].reset();                            
                            setTimeout(function () { $("#trigger-loading").removeClass("is-loading"); }, 100);

                            $('.form-group').show(); 
                            $('#confirmPassword').attr("disabled",false);
                            $('#password').attr("disabled",false);
                            $('#ban').show();
                            $('#trigger-loading').hide(); 
                        } if (data == 'fails') {
                            $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">email already exist </span><br><br>');
                            setTimeout(function () {
                                $("#msg1").html('');
                            }, 5000);
                        }
                        if (data == 'failed') {
                            $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">passord doesnt match confirm Password </span><br><br>');
                            setTimeout(function () {
                                $("#msg1").html('');
                            }, 5000);
                        }
                        else {

                        }
                    }
                });

            })
        });
        $('#ban').on('click', function () {
            $('#myform').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'post',
                    url: "dad.php",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (data) {
                        if (data == 'success') {
                            // $("#myform")[0].reset();
                            window.location = "\index.php";
                            setTimeout(function () {
                                $("#msg").html('');
                            }, 5000);
                        } if (data == 'fails') {
                            $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">email already exist </span><br><br>');
                            setTimeout(function () {
                                $("#msg1").html('');
                            }, 5000);
                        }
                        if (data == 'failed') {
                            $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">passord doesnt match confirm Password </span><br><br>');
                            setTimeout(function () {
                                $("#msg1").html('');
                            }, 5000);
                        }
                        else {

                        }
                    }
                });

            })
        })
    </script>

</body>

</html>
<!-- Localized -->