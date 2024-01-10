<?php

include '../controller/controller.php';

$page_title = "Dashboard";

include 'header.php';
include 'sidenav.php';

?>


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><?php echo $page_title; ?> </h4>

                        <!-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">@yield('breadcrumb-item')</a></li>
                                <li class="breadcrumb-item active">@yield('breadcrumb-item-active')</li>
                            </ol>
                        </div> -->

                    </div>
                </div>
            </div>

<div class="row">
    <div class="col-xl-6 col-md-6">
        <!-- card -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="fs-22 fw-semibold ff-secondary mb-2">$<span class="counter-value" data-target="559.25">0</span>k</h4>
                        <p class="text-uppercase fw-medium fs-14 text-muted mb-0">Vouchers Sent 
                            <span class="text-success fs-14 mb-0 ms-1">
                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +89.24 %
                            </span>
                        </p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-light rounded-circle fs-3">
                            <i class="las la-file-alt fs-24 text-primary"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <span class="badge bg-primary me-1">2,258</span> <span class="text-muted">Vouchers sent</span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="fs-22 fw-semibold ff-secondary mb-2">$<span class="counter-value" data-target="409.66">0</span>k</h4>
                        <p class="text-uppercase fw-medium fs-14 text-muted mb-0">Paid Vouchers
                            <span class="text-danger fs-14 mb-0 ms-1">
                                <i class="ri-arrow-right-down-line fs-13 align-middle"></i> +8.09 %
                            </span>
                        </p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-light rounded-circle fs-3">
                            <i class="las la-check-square fs-24 text-primary"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <span class="badge bg-danger me-1">1,958</span> <span class="text-muted">Paid by clients</span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-6 col-md-6">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="fs-22 fw-semibold ff-secondary mb-2 text-white">$<span class="counter-value" data-target="136.98">0</span>k</h4>
                        <p class="text-uppercase fw-medium fs-14 text-white-50 mb-0"> Unpaid Vouchers
                            <span class="text-danger fs-14 mb-0 ms-1">
                                <i class="ri-arrow-right-down-line fs-13 align-middle"></i> +9.01 %
                            </span>
                        </p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-light-subtle text-light  rounded-circle fs-3">
                            <i class="las la-clock fs-24 text-white"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <span class="badge bg-danger me-1">338</span> <span class="text-white">Unpaid by clients</span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-6 col-md-6">
        <!-- card -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="fs-22 fw-semibold ff-secondary mb-2">$<span class="counter-value" data-target="84.20">0</span>k</h4>
                        <p class="text-uppercase fw-medium fs-14 text-muted mb-0"> Cancelled Vouchers
                            <span class="text-success fs-14 mb-0 ms-1">
                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +7.55 %
                            </span>
                        </p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-light rounded-circle fs-3">
                            <i class="las la-times-circle fs-24 text-primary"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <span class="badge bg-primary me-1">502</span> <span class="text-muted">Cancelled by clients</span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<?php

include 'footer.php';

?>

