
<?php

include '../controller/controller.php';

$page_title = "Voucher Payment Category List";

include 'header.php';
include 'sidenav.php';

$response = $action->fetchVoucherCategory('all');

if(is_array($response)){
    $tbody = " ";
    foreach($response as $data){
        $tbody .= '<tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check1" value="option">
                            </div>
                        </td>
                        <td>'.$data['code'].'</td>
                        <td>'.$data['name'].'</td>
                        <td>
                            <div class="hstack gap-3 flex-wrap">
                                <a href="javascript:void(0);" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                <a href="javascript:void(0);" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                            </div>
                        </td>
                        
                    </tr>';
    }

}else{
    $tbody = "<tr> NO DATA TO FETCH </tr>";
}

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
        <a href="voucher-category-create.php" class="btn btn-primary addMembers-modal"><i class="las la-plus me-1"></i> Add Voucher Category</a>
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



<div class="row justify-content-center">
    <div class="col-xl-10">
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
                                
                                <th scope="col">Payment Category Code</th>
                                <th scope="col">Payment Category Name</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                           <?php echo $tbody; ?>
                                
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