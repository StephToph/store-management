<?php
include "config.php";
session_start();
if (isset($_SESSION['User_id'])) {
    header("location:home.php");
    die();
}

if (isset($_POST['submit'])) {

    $firstname = $_POST['firstname'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users where firstname = '" . $firstname . "' && password = '" . $password . "' ";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['User_id'] = $row['id'];
        $_SESSION['Username'] = $row['firstname'];
        header("Location:home.php");
    } else {
        header("Location:index.php?error=Incorrect details ");

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Testimony Poly </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid p-0 h-100">
            <div class="row no-gutters h-100 full-height">
                <div class="col-lg-4 d-none d-lg-flex bg"
                    style="background-image:url('assets/images/others/login-1.jpg')">
                    <div class="d-flex h-100 p-h-40 p-v-15 flex-column justify-content-between">
                        <div>
                            <h1 style="color: white; font-weight: 900;  font-size: 40px;">Testimony Poly</h1>
                        </div>
                        <div>
                            <h1 class="text-white m-b-20 font-weight-normal">Exploring Testimony Poly</h1>
                            <!-- <p class="text-white font-size-16 lh-2 w-80 opacity-08">Climb leg rub face on everything
                                give attitude nap all day for under the bed. Chase mice attack feet but rub face on
                                everything hopped up.</p> -->
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-white">©<?php
                            echo date('Y');
                            ?> </span>

                        </div>
                    </div>
                </div>

                <div class="col-lg-8 bg-white">
                    <div class="container h-100">
                        <div class="row no-gutters h-100 align-items-center">
                            <div class="col-md-8 col-lg-7 col-xl-6 mx-auto">
                                <h2>Sign In</h2>
                                <p class="m-b-30">Enter your credential to get access</p>
                                <?php if (isset($_GET['error'])) { ?>
                                    <div id="msg1" class="alert alert-warning w-50" role="alert">
                                        <?php echo $_GET['error'] ?>
                                    </div>
                                <?php } ?>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="userName">Username:</label>
                                        <div class="input-affix">
                                            <i class="prefix-icon anticon anticon-user"></i>
                                            <input type="text" class="form-control" name="firstname" id="userName"
                                                placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="password">Password:</label>
                                        <a class="float-right font-size-13 text-muted" href="">Forget Password?</a>
                                        <div class="input-affix m-b-10">
                                            <i class="prefix-icon anticon anticon-lock"></i>
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="font-size-13 text-muted">
                                                Don't have an account?
                                                <a class="small" href=""> Signup</a>
                                            </span>
                                            <button class="btn btn-primary" name="submit">Sign In</button>
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

    <!-- page js -->

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <script>
         $("#msg1").preventDefault();
        setTimeout(function () {
            $("#msg1").html('');
        }, 5000);
    </script>



</body>

</html>
<!-- Localized -->