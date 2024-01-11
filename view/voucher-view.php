<?php


include '../controller/controller.php';

$page_title = "Voucher Details";

include 'header.php';
include 'sidenav.php';

$voucher_id = $_GET['id'];

$data = $action->fetchVoucher($voucher_id)[0];
$voucher_date = date("l M d, Y",strtotime($data['voucher_date']));

if($data['is_paid'] == 1){
    $paid_str = '<span class="badge bg-primary p-2">Paid</span>';
}else{
    $paid_str = '<span class="badge bg-danger p-2">unpaid</span>';
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

<div class="row justify-content-center">
    <div class="col-xxl-9">
        <div class="card" id="demo">
                <div class="card-body">
                <div class="row p-4">
                    <div class="col-9">
                        <h3 class="fw-bold mb-4">Voucher: <?= $data['voucher_no'] ?> </h3>
                        <!-- <div class="row g-4"> -->
                            
                            <!--end col-->
                            <!-- <div class="col-lg-6 col-6">
                                <h6 class="text-muted text-uppercase fw-semibold">Voucher Date</h6>
                                <p class="text-muted mb-0"><span id="invoice-date"><?= $voucher_date ?></span> </p>
                            </div> -->
                            <!--end col-->
                            <!-- <div class="col-lg-6 col-6">
                                <p class="text-muted mb-1 text-uppercase fw-medium fs-14">Payment Status</p>
                                <?=$paid_str?></p>
                            </div> -->
                            <!--end col-->
                            <!-- <div class="col-lg-6 col-6">
                                <p class="text-muted mb-1 text-uppercase fw-medium fs-14">Amount</p>
                                <h5 class="fs-16 mb-0">$<span id="total-amount"><?= $data['amount'] ?></span></h5>
                            </div> -->
                            <!--end col-->
                        <!-- </div> -->
                    </div>
                    <div class="col-3">
                        <p class="text-muted mb-1 text-uppercase fw-medium fs-14">Payment Status</p>
                        <?=$paid_str?>
                        
                    </div>
                </div><!--end col-->

                <div class="row p-4 border-top border-top-dashed">
                    <div class="col-lg-9">
                        <div class="row g-3">
                            <div class="col-6">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3"> Voucher Date </h6>
                                <p class="text-muted mb-0"><span id="invoice-date"><?= $voucher_date ?></span> </p>
                            </div>
                            <!--end col-->
                            <div class="col-6">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3"> Payee Info </h6>
                                <p class="fw-medium mb-2" id="shipping-name"><?php echo $data['payee_name']; ?></p>
                                <p class="text-muted mb-1" id="shipping-address-line-1"><?php echo $data['payee_address']; ?></p>
                                <p class="text-muted mb-1"><span>Phone: </span><span id="shipping-phone-no"><?php echo $data['payee_phone']; ?></span></p>
                                <p class="text-muted mb-1"><span>Email: </span><span id="shipping-phone-no"><?php echo $data['payee_email']; ?></span></p>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div><!--end col-->

                    <div class="col-lg-3">
                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Net Amount</h6>
                            <h3 class="fw-bold mb-2">₦<?php echo number_format($data['net_amount']); ?></h3>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            
                            <div class="border-top border-top-dashed mt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                    <tbody>
                                        <tr>
                                            <td>Amount</td>
                                            <td class="text-end">₦<?php echo number_format($data['amount']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>VAT</td>
                                            <td class="text-end">₦<?php echo number_format($data['vat']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>WHT</td>
                                            <td class="text-end">₦<?php echo number_format($data['wht']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>STAMP DUTY</td>
                                            <td class="text-end">₦<?php echo number_format($data['stamp_duty']); ?></td>
                                        </tr>
                                        <tr class="border-top border-top-dashed fs-15">
                                            <th scope="row">Net Amount</th>
                                            <th class="text-end">₦<?php echo number_format($data['net_amount']); ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end table-->
                            </div>
                            
                            <!-- <div class="mt-4">
                                <div class="alert alert-info">
                                    <p class="mb-0"><span class="fw-semibold">NOTES:</span>
                                        <span id="note">All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or
                                            credit card or direct payment online. If account is not paid within 7
                                            days the credits details supplied as confirmation of work undertaken
                                            will be charged the agreed quoted fee noted above.
                                        </span>
                                    </p>
                                </div>
                            </div> -->
                            <div class="hstack gap-2 justify-content-end d-print-none mt-5 pt-4 border-top border-top-dashed">
                                <a href="javascript:window.print()" class="btn btn-info"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                                <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download</a>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                </div>
                </div>
        </div>
    </div>
    <!--end col-->
</div>

<?php

include 'footer.php';

?>