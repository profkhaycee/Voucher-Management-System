
 <!-- ========== App Menu ========== -->
 <div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="50" width="50">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="50" width="50">
            </span>
        </a>

        <!-- Light Logo-->
        <a href="index.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="50" width="50">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="50" width="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <!--  <li class="menu-title"><span data-key="t-menu">Menu</span></li>  -->
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="dashboard.php">
                        <i class="las la-house-damage"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li> -->

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Voucher Management</span></li>
                
                
                <li class="nav-item">
                    <a href="voucher-list.php" class="nav-link" data-key="t-invoice"> View Vouchers </a>
                </li>
                <?php if($_SESSION['isAdmin'] == 1 || $_SESSION['user_type'] == 1){?>
                <li class="nav-item">
                    <a href="voucher-create.php" class="nav-link" data-key="t-add-invoice"> Create Voucher </a>
                </li>
                <li class="nav-item">
                    <a href="voucher-category-create.php" class="nav-link" data-key="t-add-invoice"> Create Voucher Category </a>
                </li>
                <li class="nav-item">
                    <a href="voucher-category-list.php" class="nav-link" data-key="t-add-invoice"> View Voucher Categories </a>
                </li>
                <?php } ?>


                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Reports</span></li>

                <li class="nav-item">
                    <a href="journal-report.php" class="nav-link" data-key="t-payment-summary"> Journal Report</a>
                </li>
                <li class="nav-item">
                    <a href="ledger-report.php" class="nav-link" data-key="t-sale-report"> Ledger Report </a>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link" data-key="t-expenses-report"> Trial Balance </a>
                <!-- <a href="trial-balance.php" class="nav-link" data-key="t-expenses-report"> Trial Balance </a> -->
                </li>
                <?php if($_SESSION['isAdmin'] == 1 ){ ?>
                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Users</span></li>
                <li class="nav-item">
                    <a href="user-create.php" class="nav-link" data-key="t-expenses-report"> Create Users </a>
                </li>
                <li class="nav-item">
                    <a href="user-list.php" class="nav-link" data-key="t-expenses-report"> View Users </a>
                </li>
                <?php } ?>

                        

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><?= $page_title ?></h4>
                    </div>
                </div>
            </div>