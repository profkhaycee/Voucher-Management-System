<?php


include '../controller/controller.php';

$page_title = "Voucher Details";

include 'header.php';
include '../controller/session.php';
include 'sidenav.php';

$voucher_id = $_GET['id'];

$response = $action->fetchVoucher($voucher_id);
if(is_array($response)){
    $data = $response[0];
    $category = $action->fetchVoucherCategory($data['payment_category'])[0];
    $voucher_date = date("l M d, Y",strtotime($data['voucher_date']));

    if($data['is_paid'] == 1){
        $paid_str = '<span class="badge bg-primary p-2">Paid</span>';
    }else{
        $paid_str = '<span class="badge bg-danger p-2">unpaid</span>';
    }

    if($data['approval_level'] == 1){
        $level_str = '<span class="badge bg-success p-2"> Initiated </span>';
    }elseif($data['approval_level'] == 2){
        $level_str = '<span class="badge bg-warning p-2"> Reviewed </span>';
    }elseif($data['approval_level'] == 3){
        $level_str = '<span class="badge bg-primary p-2"> Approved </span>';
    }elseif($data['approval_level'] == 4){
        $level_str = '<span class="badge bg-danger p-2"> Rejected </span>';
    }

    $initiator = $action->fetchUser($data['initiator']);
    $initiator_name = $initiator[0]['first_name'] . " ". $initiator[0]['last_name'] ;
    $initiator_signature = $initiator[0]['signature'];

    if(!empty($data['reviewer'])){
        $reviewer = $action->fetchUser($data['reviewer']);
        $reviewer_name = $reviewer[0]['first_name'] . " ". $reviewer[0]['last_name'] ;
        $reviewer_signature = $reviewer[0]['signature'];
    }

    if(!empty($data['approver'])){
        $approver = $action->fetchUser($data['approver']);
        $approver_name = $approver[0]['first_name'] . " ". $approver[0]['last_name'] ;
        $approver_signature = $approver[0]['signature'];
    }

    if(!empty($data['rejected_by'])){
        $user = $action->fetchUser($data['rejected_by']);
        // echo json_encode($user); var_dump($user);
        $rejected_by = $user[0]['first_name'] . " ". $user[0]['last_name'] ;
        // $reject_reason = $user[0]['reject_reason'];
    }

}else{?>
    <script> 
        Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:'Invalid Voucher Selected'}) ; 
        setTimeout(() => {location.replace('voucher-list.php'); }, 3000);
    </script>
 
<?php exit;}

?>

    

<div class="row justify-content-center">
    <div class="col-xxl-9">
        <div class="card" id="demo">
                <div class="card-body">
                    <div class="row border-bottom-2 border-bottom-solid my-3">
                        <div class="col-1">
                            <span class="logo-lg px-3 px">
                                <img src="assets/images/logo-dark.png" alt="" height="50" width="100">
                            </span>
                        </div>
                        <div class="col-11">
                            <h3 class="text-center fw-bold"><span class="ms-3">NIGERIA ARABIC LANGUAGE VILLAGE, NGALA </span> </h3>
                            <p class="text-center">(Inter-University Centre for Arabic Studies)</p>
                        </div>
                        <hr class="border-4">
                    </div>
                    <div class="row p-4">
                        <div class="col-6">
                            <h5 class="fw-bold mb-2">Voucher: <?php echo $data['voucher_no']."/".$category['code']."-". $category['name'] ; ?>  </h5>
                            <h6 class="mb-2">Voucher Date: <?= $voucher_date ?> </h6>
                            <!-- <div class="row g-4"> -->
                                
                                <!--end col-->
                                <!-- <div class="col-lg-6 col-6">
                                    <h6 class="text-muted text-uppercase fw-semibold">Voucher Date</h6>
                                    <p class="text-muted mb-0"><span id="invoice-date"><?//= $voucher_date ?></span> </p>
                                </div> -->
                                <!--end col-->
                                <!-- <div class="col-lg-6 col-6">
                                    <p class="text-muted mb-1 text-uppercase fw-medium fs-14">Payment Status</p>
                                    <?//=$paid_str?></p>
                                </div> -->
                                <!--end col-->
                                <!-- <div class="col-lg-6 col-6">
                                    <p class="text-muted mb-1 text-uppercase fw-medium fs-14">Amount</p>
                                    <h5 class="fs-16 mb-0">$<span id="total-amount"><?//= $data['amount'] ?></span></h5>
                                </div> -->
                                <!--end col-->
                            <!-- </div> -->
                        </div>
                        <div class="col-3">
                            <p class="text-muted mb-1 text-uppercase fw-medium fs-14">Phase</p>
                            <?=$level_str?>
                            
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
                                    <!-- <h6 class="text-muted text-uppercase fw-semibold mb-3"> Voucher Date </h6>
                                    <p class="text-muted mb-3"><span id="invoice-date"><?//= $voucher_date ?></span> </p> -->
                                    <h6 class="text-muted text-uppercase fw-semibold mb-1"> Voucher Reason </h6>
                                    <p class="text-muted mb-2 me-3"><span id="invoice-date"><?= $data['initiator_comment'] ?></span> </p>
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
                            <h3 class="fw-bold mb-4">₦<?php echo number_format($data['net_amount'], 2); ?></h3>
                            <h5 class="fw-bold"><?= $data['voucher_type'] ?></h5>
                        </div>

                    </div>

                    <div class="row border-top border-top-dashed">
                        <div class="col-lg-6 me-5">
                            <div class="initiator border-bottom border-bottom-solid ms-3 mt-2">
                                <h6 class="text-muted d-md-inline text-uppercase fw-semibold mb-3"> Initiated By: </h6>
                                <p class="mx-2 d-md-inline py-1" id="initiator-name"><?= $initiator_name ?> </p>
                                <p class="mx-2 py-1" id="initiator-signature"><img src="<?= $initiator_signature?>" width="100" height="50"> <span class="ms-4"><?= $data['created_at']?></span></p>
                            </div>
                            <?php if(!empty($data['reviewer'])){ ?>
                            <div class="reviewer border-bottom border-bottom-solid ms-3 mt-2">
                                <h6 class="text-muted d-md-inline text-uppercase fw-semibold mb-3"> Reviewed By: </h6>
                                <p class="mx-2 d-md-inline py-1" id="reviewer-name"><?= $reviewer_name ?> </p>
                                <p class="mx-2 py-1" id="reviewer-signature"><img src="<?= $reviewer_signature?>" width="100" height="50"> <span class="ms-4"><?= $data['date_reviewed']?></span></p>
                            </div>
                            <?php } 
                            if(!empty($data['approver'])){
                            ?>
                            <div class="approver border-bottom border-bottom-solid ms-3 mt-2">
                                <h6 class="text-muted d-md-inline text-uppercase fw-semibold mb-3"> Approved By: </h6>
                                <p class="mx-2 d-md-inline py-1" id="approver-name"><?= $approver_name ?> </p>
                                <p class="mx-2 py-1" id="approver-signature"><img src="<?= $approver_signature?>" width="100" height="50"> <span class="ms-4"><?= $data['date_approved']?></span></p>
                            </div>
                            <?php } 
                            if(!empty($data['rejected_by'])){
                            ?>
                            <div class="approver border-bottom border-bottom-solid ms-3 mt-2">
                                <h6 class="text-danger d-md-inline text-uppercase fw-semibold mb-3"> Rejected By: </h6>
                                <p class="mx-2 d-md-inline py-1" id="rejected_by"><?= $rejected_by ?> </p>
                                <p class="mx-3 p-2 mt-3 bg-danger-subtle text-danger" id="reject-reason"><?=$data['reject_reason']?></p>
                                <p class="ms-4"><?= $data['date_rejected']?></p>
                                
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-lg-4 ms-5">
                            <div class="card-body">
                                
                                <div class="">
                                    <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                        <tbody>
                                            <tr>
                                                <td>Amount</td>
                                                <td class="text-end">₦<?php echo number_format($data['amount'], 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td>VAT</td>
                                                <td class="text-end">₦<?php echo number_format($data['vat'], 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td>WHT</td>
                                                <td class="text-end">₦<?php echo number_format($data['wht'], 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td>STAMP DUTY</td>
                                                <td class="text-end">₦<?php echo number_format($data['stamp_duty'], 2); ?></td>
                                            </tr>
                                            <tr class="border-top border-top-dashed fs-15">
                                                <th scope="row">Net Amount</th>
                                                <th class="text-end">₦<?php echo number_format($data['net_amount'], 2); ?></th>
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
                                
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                    </div>
                    <div class="hstack gap-2 justify-content-end d-print-none mt-5 pt-4 border-top border-top-dashed">
                        <a href="javascript:window.print()" class="btn btn-info"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                        <!-- <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download</a> -->
                    </div>
                </div>
        </div>
    </div>
    <!--end col-->
</div>

<?php

include 'footer.php';

?>