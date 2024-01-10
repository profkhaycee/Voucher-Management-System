
<?php

include '../controller/controller.php';

$page_title = "Vouchers List";

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
            <div class="row pb-4 gy-3">
    <div class="col-sm-4">
        <a href="voucher-create.php" class="btn btn-primary addMembers-modal"><i class="las la-plus me-1"></i> Add Invoices</a>
    </div>

    <!--  <div class="col-sm-auto ms-auto">
       <div class="d-flex gap-3">
        <div class="search-box">
            <input type="text" class="form-control" placeholder="Search for name or designation...">
            <i class="las la-search search-icon"></i>
        </div>
        <div class="">
            <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-soft-info btn-icon fs-14"><i class="las la-ellipsis-v fs-18"></i></button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                <li><a class="dropdown-item" href="#">Print</a></li>
                <li><a class="dropdown-item" href="#">Export to Excel</a></li>
            </ul>
        </div>
       </div>
    </div>  -->
</div>



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-hover table-nowrap align-middle mb-0">
                        <thead>
                            <tr class="text-muted text-uppercase">
                                <th style="width: 50px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th scope="col">Voucher Date</th>
                                <th scope="col">Voucher No</th>
                                <th scope="col">Payee Name</th>
                                <th scope="col" style="width: 20%;">Payment Category</th>
                                <th scope="col">Voucher Type</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Net Payment</th>
                                <th scope="col" style="width: 16%;">Status</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check1" value="option">
                                    </div>
                                </td>
                                <td>01-01-2023</td>
                                <td><p class="fw-medium mb-0">VOU2150</p></td>
                                <td>
                                    <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Mustapha Ibrahim</a>
                                </td>
                                <td>0001 - Electricity</td>
                                <td>Debit</td>
                                <td>N10000.00</td>
                                <td>N86450.00</td>
                                <td><span class="badge bg-success-subtle text-success p-2">Paid</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="las la-ellipsis-h align-middle fs-18"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                    View</button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                    Edit</button>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                    Download</a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item remove-item-btn" href="#">
                                                    <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check1" value="option">
                                    </div>
                                </td>
                                <td>02-01-2023</td>
                                <td><p class="fw-medium mb-0">VOU2157</p></td>
                                <td>
                                    <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Stephen Kelechi</a>
                                </td>
                                <td>0002 - Water Bill</td>
                                <td>Credit</td>
                                <td>N12500.00</td>
                                <td>N9600.00</td>
                                <td><span class="badge bg-warning-subtle text-warning p-2">Unpaid</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="las la-ellipsis-h align-middle fs-18"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                    View</button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                    Edit</button>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                    Download</a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item remove-item-btn" href="#">
                                                    <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check1" value="option">
                                    </div>
                                </td>
                                <td>03-01-2023</td>
                                <td><p class="fw-medium mb-0">VOU2160</p></td>
                                <td>
                                    <a href="#javascript: void(0);" class="text-body align-middle fw-medium">opeyemi Dauda</a>
                                </td>
                                <td>0004 - Refreshment</td>
                                <td>Credit</td>
                                <td>N120500.00</td>
                                <td>N103050.00</td>
                                <td><span class="badge bg-success-subtle text-success p-2">paid</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="las la-ellipsis-h align-middle fs-18"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                    View</button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                    Edit</button>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                    Download</a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item remove-item-btn" href="#">
                                                    <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                           

                            
                        </tbody><!-- end tbody -->
                    </table><!-- end table -->
                </div><!-- end table responsive -->
            </div>
        </div>
    </div>
</div>

     

<?php

include 'footer.php';

?>