
<?php

include '../controller/controller.php';

$page_title = "Vouchers List";

include 'header.php';
include 'sidenav.php';

$response = $action->fetchVoucher('all');

if(is_array($response)){
    $tbody = " ";
    foreach($response as $data){
        $cat = $action->fetchVoucherCategory($data['payment_category']); //echo json_encode($cat); 
        $cat_str = $cat[0]['code']. " - ". $cat[0]['name'];
        if($data['is_paid'] == 1){
            $paid_str = '<span class="badge bg-primary p-2">Paid</span>';

        }else{
            $paid_str = '<span class="badge bg-danger p-2">unpaid</span>';
        }

        $tbody .= '<tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check1" value="option">
                            </div>
                        </td>
                        <td>'.$data['voucher_date'].'</td>
                        <td>'.$data['voucher_no'].'</td>
                        <td>'.$data['payee_name'].'</td>
                        <td>'.$cat_str.'</td>
                        <td>'.$data['voucher_type'].'</td>
                        <td>₦'.number_format($data['amount']).'</td>
                        <td>₦'.number_format($data['net_amount']).'</td>
                        <td><span class="badge bg-secondary"> Initiated </span></td>
                        <td>'.$paid_str.'</td>
                        <td> 
                            <a class="link-info me-2" href="voucher-view.php?id='.$data['id'].'"><i class="las la-eye fs-20 align-middle me-1"></i>View</a>
                            <a class="link-warning" href="voucher-edit.php?id='.$data['id'].'"><i class="las la-pen fs-20 align-middle me-1"></i>Edit</a>
                        </td>
                        
                    </tr>';
    }

}else{
    $tbody = "<tr> NO DATA TO FETCH </tr>";
}


?>


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
                    <table class="table table-hover table-bordered table-nowrap align-middle mb-0">
                        <thead class="table-dark">
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
                                <th scope="col">Voucher <br> Type</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Net Payment</th> 
                                <th scope="col">Voucher <br> phase</th> 
                                <th scope="col" style="width: 16%;">Status</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php echo $tbody ; ?>
                            
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