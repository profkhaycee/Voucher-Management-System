
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Voucher Portal - <?php echo $page_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Voucher Management System" name="description" />
    <meta content="Stephen Kelechi Emmanuel" name="author" />
    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->
    <link rel="shortcut icon" href="assets/images/vm-logo.png">

    <!-- plugin css -->
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css" />
    
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!--- sweetalert  --->
    <link rel="stylesheet" href="assets/libs/sweetalert2/sweetalert2.min.css">
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    <script src="assets/libs/jquery/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



</head>

<body>

<?php 
// include '../controller/session.php';
$user = $action->fetchUser($_SESSION['id'])[0]
?>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- @include('layout.header') -->

        <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="index.php" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.png" alt="" height="40" width="50">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-dark.png" alt="" height="40" width="50">
                            </span>
                        </a>

                        <a href="index.php" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.png" alt="" height="40" width="50">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-light.png" alt="" height="40" width="50">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                        <span class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>

                
                </div>

                <div class="d-flex align-items-center">

                    

                    
                        <h5 class="d-inline-blockd mt-2 "><?php if($_SESSION['isAdmin'] == 1){echo "Admin";}else{ echo $action->fetchUserType($_SESSION['user_type'])[0]['name'] ; }?> </h5>
                    
                    

                    <div class="dropdown header-item">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <!-- <img class="rounded-circle header-profile-userx" src="assets/images/users/avatar-4.jpg" alt="Header Avatar"> -->
                                <span class="text-start ms-xl-2">
                                    <span class="d-inline-block fw-medium user-name-text fs-16"><?= $user['first_name'] ?> <i class="las la-angle-down fs-12 ms-1"></i></span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="user-profile.php?id=<?=$_SESSION['id']?>"><i class="bx bx-user fs-15 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                            <a class="dropdown-item" href="change-password.php?id=<?=$_SESSION['id']?>"><i class="bx bx-wallet fs-15 align-middle me-1"></i> <span key="t-my-wallet">Change Password</span></a>
                            <!-- <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench fs-15 align-middle me-1"></i> <span key="t-settings">Settings</span></a> -->
                            <!-- <a class="dropdown-item" href="auth-lockscreen.html"><i class="bx bx-lock-open fs-15 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="logout.php"><i class="bx bx-power-off fs-15 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

        
    
        <!-- {{-- @yield('sidebar') --}} -->
        <!-- @include('layout.sidebar') -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        
                    <!-- end page title -->

                   <!-- @yield('main-content') -->


