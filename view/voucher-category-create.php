<?php

include '../controller/controller.php';

$page_title = "Create Voucher Payment Category";

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
                <div class="col-xl-12">
                    <div class="card mx-5">
                        <div class="card-body">
                            <div class="p-5">
                            <form action="../model/payment_category.php" method="post">
                                
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="category-code">Payment Category Code</label>
                                            <input id="category-code" required name="category_code" placeholder="Enter Category code" type="text" class="form-control" minlength='4' maxlength='4'>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label class="form-label" for="category-name">Payment Category Name</label>
                                            <input id="category-name" required name="category_name" placeholder="Enter Category Name" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                               

                                <div class="hstack gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>

                            

                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php

include 'footer.php';

?>

