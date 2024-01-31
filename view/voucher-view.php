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
    $f_year = date('Y', strtotime($data['voucher_date']));

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
    <div class="col-xl-9">
        <div class="card" id="demo">
                <div class="card-body">
                    <div class="row border-bottom-2 border-bottom-solid my-1">
                        <div class="col-lg-1 text-center">
                            <span class="logo-lg px-3">
                                <img src="assets/images/logo-dark.png" alt="" height="50" width="100">
                            </span>
                        </div>
                        <div class="col-lg-11">
                            <h3 class="text-center fw-bold"><span class="ms-3">NIGERIA ARABIC LANGUAGE VILLAGE, NGALA </span> </h3>
                            <p class="text-center">(Inter-University Centre for Arabic Studies)</p>
                        </div>
                        <hr class="border-4">
                    </div>
                    <div class="row px-4 py-1">
                        <div class="col-md-6">
                            <h6 class="fw-semibold mb-2">Voucher No: <?php echo $data['voucher_no'] ; ?>  </h6>
                            <h6 class="fw-semibold mb-2">Category: <?php echo $category['code']."-". $category['name'] ; ?></h6>
                            <h6 class="mb-2 fw-medium">Voucher Date: <?= $voucher_date ?> </h6>
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
                        <div class="col-md-3">
                            <p class="text-muted mb-1 text-uppercase fw-semibold fs-14">Phase</p>
                            <?=$level_str?>
                            
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted mb-1 text-uppercase fw-semibold fs-14">Payment Status</p>
                            <?=$paid_str?>
                            <p class="fw-bolder pt-1 text-primary">Financial Year: <?=$f_year?> </p>
                            
                        </div>
                    </div><!--end col-->

                    <div class="row p-4 border-top border-top-dashed">
                        <div class="col-md-12">
                            <div class="row">
                                <!-- <div class="col-6"> -->
                                    <!-- <h6 class="text-muted text-uppercase fw-semibold mb-3"> Voucher Date </h6>
                                    <p class="text-muted mb-3"><span id="invoice-date"><?//= $voucher_date ?></span> </p> -->
                                    <!-- <h6 class="text-muted text-uppercase fw-semibold mb-1"> Voucher Reason </h6> -->
                                    <!-- <p class="text-muted mb-2 me-3"><span id="invoice-date"><?//= $data['initiator_comment'] ?></span> </p> -->
                                <!-- </div> -->
                                <!--end col-->
                                <div class="col-md-5">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3"> Payee Info </h6>
                                    <!-- <p class="fw-medium mb-2" id="shipping -name">Name: <?php //echo $data['payee_name']; ?></p> -->
                                    <p class="text-muted mb-1" id="shipping-address-line-1">Address: <?php echo $data['payee_address']; ?></p>
                                    <p class="text-muted mb-1"><span>Phone: </span><span id="shipping-phone-no"><?php echo $data['payee_phone']; ?></span></p>
                                    <p class="text-muted mb-1"><span>Email: </span><span id="shipping-phone-no"><?php echo $data['payee_email']; ?></span></p>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Net Amount</h6>
                                    <h3 class="fw-bold mb-4">₦<?php echo number_format($data['net_amount'], 2); ?></h3>
                                    <h4 class="fw-bolder text-primary"><?= $data['voucher_type'] ?></h4>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div><!--end col-->

                        

                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <h4 class="mx-lg-2 fw-bolder">PAYEE: <?php echo $data['payee_name']; ?> </h4>
                                    <table class="table table-bordered text-center align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col">Particulars</th>
                                                <th></th>
                                                <th scope="col">Value</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list">
                                            <tr class="">
                                                <td class="text-start pt-3 pb-5">
                                                    <?= $data['initiator_comment'] ?>
                                                </td>
                                                <td>Amount</td>
                                                <td>₦<?php echo number_format($data['amount'], 2); ?></td>
                                                
                                            </tr>
                                            <tr>
                                               <td></td>
                                               <td>VAT</td>
                                               <td>₦<?php echo number_format($data['vat'], 2); ?></td> 
                                            </tr>
                                            <tr>
                                               <td></td>
                                               <td>WHT</td>
                                               <td>₦<?php echo number_format($data['wht'], 2); ?></td> 
                                            </tr>
                                            <tr>
                                               <td></td>
                                               <td>Stamp Duty</td>
                                               <td>₦<?php echo number_format($data['stamp_duty'], 2); ?></td> 
                                            </tr>
                                            <tr>
                                               <td></td>
                                               <td><h4 class="fw-bold">Total</h4></td>
                                               <td><h4 class="fw-bold">₦<?php echo number_format($data['net_amount'], 2); ?></h4></td> 
                                            </tr>

                                           
                                        </tbody>
                                    </table><!--end table-->
                                </div>

                                <div class="words mx-3 mt-4">
                                    <h5> Total Amount in Words: <span class="amount_words fw-bold"></span> </h5>
                                </div>
                                
                                
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                    </div>
                    
                
                    <div class="row  mt-2 border-top border-top-dashed">
                        <!-- <div class="col-lg-5">
                            <div class="px-3">
                                <h4 class="fw-bold my-3"> Attached Documents</h4>
                                <?php //if(empty($data['document1']) && empty($data['document2']) && empty($data['document3']) && empty($data['document4']) ){
                                        // echo "<h5 class='text-center'>NO ATTACHED DOCUMENT</h5>";
                                    //}else{?>
                                        <div class="m-3 hstack gap-3 flex-wrap">
                                            <?php //if(!empty($data['document1'])){?>
                                            <div>
                                                <span class="d-block ms-3" style="margin-bottom:-25px !important">Document 1</span>
                                                <i class="ri-file-text-line" style="color: gray;font-size:100px"></i>
                                                <a href="<?//=$data['document1']?>" target="_blank" class="text-info d-block ms-3 fs-20" style="margin-top:-25px !important"><u>View</u> </a>
                                            </div>
                                            <?php// }
                                            //if(!empty($data['document2'])){?>
                                            <div>
                                                <span class="d-block ms-3" style="margin-bottom:-25px !important">Document 2</span>
                                                <i class="ri-file-text-line" style="color: gray;font-size:100px"></i>
                                                <a href="<?//=$data['document2']?>" target="_blank" class="text-info d-block ms-3 fs-20" style="margin-top:-25px !important"><u>View</u> </a>
                                            </div>
                                            <?php //}
                                             //if(!empty($data['document3'])){?>
                                            <div>
                                                <span class="d-block ms-3" style="margin-bottom:-25px !important">Document 3</span>
                                                <i class="ri-file-text-line" style="color: gray;font-size:100px"></i>
                                                <a href="<?//=$data['document3']?>" target="_blank" class="text-info d-block ms-3 fs-20" style="margin-top:-25px !important"><u>View</u> </a>
                                            </div>
                                            <?php //}
                                            //if(!empty($data['document4'])){?>
                                            <div>
                                                <span class="d-block ms-3" style="margin-bottom:-25px !important">Document 4</span>
                                                <i class="ri-file-text-line" style="color: gray;font-size:100px"></i>
                                                <a href="<?//=$data['document4']?>" target="_blank" class="text-info d-block ms-3 fs-20" style="margin-top:-25px !important"><u>View</u> </a>
                                            </div>
                                            <?php //} ?>
                                        
                                        </div>
                                    <?php //}
                                ?>
                            </div>
                        </div> -->
                        <div class="hstack gap-3 justify-content-center flex-wrap ">
                            <div class="initiator border-bottom border-bottom-solid  mt-2">
                                <h6 class="text-muted d-md-inliner text-uppercase fw-semibold mb-3"> Initiated By: </h6>
                                <p class="mx-2 d-md-inliner py-1" id="initiator-name"><?= $initiator_name ?> </p>
                                <p class="mx-2 py-1" id="initiator-signature"><img src="<?= $initiator_signature?>" width="100" height="50"> <br><span class="ms-4"><?= $data['created_at']?></span></p>
                            </div>
                            <?php if(!empty($data['reviewer'])){ ?>
                            <div class="reviewer border-bottom border-bottom-solid mt-2">
                                <h6 class="text-muted d-md-inlinet text-uppercase fw-semibold mb-3"> Reviewed By: </h6>
                                <p class="mx-2 d-md-inlinet py-1" id="reviewer-name"><?= $reviewer_name ?> </p>
                                <p class="mx-2 py-1" id="reviewer-signature"><img src="<?= $reviewer_signature?>" width="100" height="50"> <br> <span class="ms-4"><?= $data['date_reviewed']?></span></p>
                            </div>
                            <?php } 
                            if(!empty($data['approver'])){
                            ?>
                            <div class="approver border-bottom border-bottom-solid mt-2">
                                <h6 class="text-muted d-md-inlinet text-uppercase fw-semibold mb-3"> Approved By: </h6>
                                <p class="mx-2 d-md-inlinet py-1" id="approver-name"><?= $approver_name ?> </p>
                                <p class="mx-2 py-1" id="approver-signature"><img src="<?= $approver_signature?>" width="100" height="50"> <br> <span class="ms-4"><?= $data['date_approved']?></span></p>
                            </div>
                            <?php } 
                            if(!empty($data['rejected_by'])){
                            ?>
                            <div class="approver border-bottom border-bottom-solid  mt-2">
                                <h6 class="text-danger d-md-inlinet text-uppercase fw-semibold mb-3"> Rejected By: </h6>
                                <p class="mx-2 d-md-inlinet py-1" id="rejected_by"><?= $rejected_by ?> </p>
                                <p class="mx-3 p-2 mt-3 bg-danger-subtle text-danger" id="reject-reason"><?=$data['reject_reason']?></p>
                                <p class="ms-4"><?= $data['date_rejected']?></p>
                                
                            </div>
                            <?php } ?>
                        </div>
                        
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

<script>
    $(document).ready(function(){
        var total_amount = <?=$data['net_amount']?>;
        var options_sn = {
            noAnd: true,
            lang: "en",
            wholesUnit: "Naira",
            fractionUnit: "Kobo",
            digitsLengthW2F: 2,
            decimalSeperator: ""
        };

        var words = $.spellingNumber(total_amount, options_sn);
        var amount_words = words.replaceAll('hundred', 'hundred and');
        $('.amount_words').html(amount_words);

        // var words = $.spellingNumber(1234567890.87, options_sn);
        // console.log(amount_words);
        // console.log(amount_words.replaceAll('hundred', 'hundred and'));
    })
</script>

<?php

include 'footer.php';

?>