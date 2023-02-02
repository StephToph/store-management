<?php
include "config.php";
session_start();
if (!isset($_SESSION['User_id'])) {
    header("location:index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Testimony Poly</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">

    <!-- page css -->
    <link href="assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">

    <link href="assets/vendors/select2/select2.css" rel="stylesheet">
    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">



</head>

<body class="text-capitalize font-weight-semibold">
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="index.php">
                        <div class="text-center">
                            <h1 style="color: blue; font-weight: 900;  font-size: 110%;width:inherit;padding-top:10%;">
                                Testimony Poly</h1>
                        </div>
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="index.php">
                        <img src="assets/images/logo/logo-white.png" alt="Logo">
                        <img class="logo-fold" src="assets/images/logo/logo-fold-white.png" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#search-drawer">
                                <i class="anticon anticon-search"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="dropdown dropdown-animated scale-left">
                            <!-- <a href="javascript:void(0);" data-toggle="dropdown">
                                <i class="anticon anticon-bell notification-badge"></i>
                            </a> -->
                            <!-- <div class="dropdown-menu pop-notification">
                                <div
                                    class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                                    <p class="text-dark font-weight-semibold m-b-0">
                                        <i class="anticon anticon-bell"></i>
                                        <span class="m-l-10">Notification</span>
                                    </p>
                                    <a class="btn-sm btn-default btn" href="javascript:void(0);">
                                        <small>View All</small>
                                    </a>
                                </div>
                                <div class="relative">
                                    <div class="overflow-y-auto relative scrollable" style="max-height: 300px">
                                        <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-blue avatar-icon">
                                                    <i class="anticon anticon-mail"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">You received a new message</p>
                                                    <p class="m-b-0"><small>8 min ago</small></p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-cyan avatar-icon">
                                                    <i class="anticon anticon-user-add"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">New user registered</p>
                                                    <p class="m-b-0"><small>7 hours ago</small></p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-red avatar-icon">
                                                    <i class="anticon anticon-user-add"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">System Alert</p>
                                                    <p class="m-b-0"><small>8 hours ago</small></p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item d-block p-15 ">
                                            <div class="d-flex">
                                                <div class="avatar avatar-gold avatar-icon">
                                                    <i class="anticon anticon-user-add"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">You have a new update</p>
                                                    <p class="m-b-0"><small>2 days ago</small></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                        </li>
                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image  m-h-10 m-r-15">
                                    <img src="assets/images/avatars/thumb-3.jpg" alt="">
                                </div>
                            </div>
                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex m-r-50">
                                        <div class="avatar avatar-lg avatar-image">
                                            <img src="assets/images/avatars/thumb-3.jpg" alt="">
                                        </div>
                                        <div class="m-l-10">                                          
                                        <p class="m-b-0 text-dark font-weight-semibold"><?php echo $_SESSION['Username']?></p>                                            
                                                                                         
                                        </div>
                                    </div>
                                </div>
                                <a href="logout.php" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">Logout</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#quick-view">
                                <i class="anticon anticon-appstore"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Header END -->
            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <li class="nav-item ">
                            <a class="dropdown-toggle" href="index.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title" href="">Dashboard</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="dropdown-toggle" href="category.php">
                                <span class="icon-holder">
                                    <i class="fas fa-th-large" style="font-weight: 900;"></i>
                                </span>
                                <span class="title">Category</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="dropdown-toggle" href="brand.php">
                                <span class="icon-holder">
                                    <i class="fas fa-tags"></i>
                                </span>
                                <span class="title">brand</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle">
                                <span class="icon-holder">
                                    <i class=" fas fa-box"></i>
                                </span>
                                <span class="title">Product</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="product.php">
                                        <span class="icon-holder">
                                            <i class=" fas fa-store"></i>
                                        </span>
                                        <span class="title">all Product</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="variation.php"><span class="icon-holder">
                                            <i class="fas fa-clipboard-list"></i>
                                        </span>
                                        <span class="title">variation</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="Setting.php"> <span class="icon-holder">
                                            <i class="anticon anticon-tool"></i>
                                        </span>
                                        <span class="title">Setting</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a class="dropdown-toggle" href="sale.php">
                                <span class="icon-holder">
                                    <i class="fas fa-store-alt"></i>
                                </span>
                                <span class="title">Sales</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="dropdown-toggle" href="inventory.php">
                                <span class="icon-holder">
                                    <i class="fas fa-clipboard-list"></i>
                                </span>
                                <span class="title">Inventory</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>

                        </li>
                        <!-- <li class="nav-item ">
                            <a class="dropdown-toggle" href="variation.php">
                                <span class="icon-holder">
                                    <i class="fas fa-clipboard-list"></i>
                                </span>
                                <span class="title">variation</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a class="dropdown-toggle " href="Setting.php">
                                <span class="icon-holder">
                                <i class="anticon anticon-tool"></i>                                    
                                </span>
                                <span class="title">Setting</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>

                        </li> -->

                        <li class="nav-item ">
                            <a class="dropdown-toggle" href="">
                                <span class="icon-holder">
                                    <i class="anticon anticon-ordered-list"></i>
                                </span>
                                <span class="title">Report</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a class="dropdown-toggle" href="">
                                <span class="icon-holder">
                                    <i class="anticon anticon-user"></i>
                                </span>
                                <span class="title">user</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a class="dropdown-toggle" href="profile.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-profile"></i>
                                </span>
                                <span class="title">Profile</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a class="dropdown-toggle" href="logout.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-logout"></i>
                                </span>
                                <span class="title">Logout</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>

                        </li>

                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->
        </div>