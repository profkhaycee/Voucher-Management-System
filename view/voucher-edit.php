<?php

include '../controller/controller.php';

$page_title = "Edit Voucher";

include 'header.php';
include '../controller/session.php';
include 'sidenav.php';


$voucher_id = $_GET['id'];

$data = $action->fetchVoucher($voucher_id)[0];
if(is_array($data)){

    if(($data['approval_level'] != 1 && !in_array($_SESSION['user_type'], [1, 0]) ) || !in_array($_SESSION['user_type'], [1, 0])){
        $readonly = "readonly";
    }else{
        $readonly = "";
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

}else{?>
    <script> 
        Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:'Invalid Voucher Selected'}) ; 
        setTimeout(() => {location.replace('voucher-list.php'); }, 3000);
    </script>
 
<?php exit;}

?>


    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card">
                <!-- <form class="needs-validation" action="../model/voucher.php?action=edit&id=<?//= $voucher_id ?>" method="post"  id="invoice_form"> -->
                <form class="needs-validation" id="voucher-edit-form">
                    <div class="card-body border-bottom border-bottom-dashed p-4">
                        <div class="containerss">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <label for="payee-name">Payee Name </label>
                                        <input type="text" class="form-control bg-light border-0" required <?php echo $readonly; ?> name="payee_name" value="<?= $data['payee_name'] ?>" id="payee-name" placeholder="Enter Full Name of Payee">
                                    </div>
                                    
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control bg-light border-0" required <?php echo $readonly; ?> name="payee_email" value="<?= $data['payee_email'] ?>" id="payee-email" placeholder="Enter Email Address of payee" />
                                        <div class="invalid-feedback">
                                            Please enter a valid email, Ex., example@gamil.com
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" class="form-control bg-light border-0" data-plugin="cleave-phone" required <?php echo $readonly; ?> name="payee_phone" value="<?= $data['payee_phone'] ?>" id="payee-phone" placeholder="Enter Phone number of Payee" minlength='11' maxlength='11' />
                                        <div class="invalid-feedback">
                                            Please enter a contact number
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-2">
                                        <label for="address"> Address</label>
                                        <input type="text" class="form-control bg-light border-0" required <?php echo $readonly; ?> name="payee_address" id="payee-address" value="<?= $data['payee_address'] ?>" placeholder=" Enter Address of payee" />
                                        <div class="invalid-feedback">
                                            Please enter Address
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-2">
                                        <label for="date-field">Date</label>
                                            <input type="date" class="form-control bg-light border-0 flatpickr-input" required <?php echo $readonly; ?> name="voucher_date" value="<?= $data['voucher_date'] ?>" id="date-field" data-provider="flatpickr" data-time="true" placeholder="Select Date">
                                            <div class="invalid-feedback">
                                                pick a valid date
                                            </div>
                                         
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="payment-category">Payment category</label>
                                    <div class="input-light">
                                        <select class="form-control bg-light border-0 w-100" data-choices data-choices-search-false id="payment-category" required <?php echo $readonly; ?> name="payment_category" >
                                            <option value="">Select Payment Category</option>
                                            <?php foreach($action->fetchVoucherCategory('all') as $pay_cat){
                                                $selected = ($pay_cat['id'] == $data['payment_category']) ? "selected" : '' ;
                                                echo "<option value='".$pay_cat['id']."' $selected> ".$pay_cat['code']." - ".$pay_cat['name']." </option>";
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-checkr mb-2"> 
                                        <label for="">Select voucher Type:</label><br>
                                        <input class="form-check-input mx-3" required <?php echo $readonly; ?> type="radio" name="voucher_type" id="voucher-type" value="Debit" <?php if($data['voucher_type'] == "Debit") echo  "checked" ?>>
                                        <label class="form-check-label" for="voucher-type">   Debit </label>
                                        <input class="form-check-input mx-3" required <?php echo $readonly; ?> type="radio" name="voucher_type" id="voucher-type" value="Credit" <?php if($data['voucher_type'] == "Credit") echo  "checked" ?>>
                                        <label class="form-check-label" for="voucher-type">   Credit   </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Example Textarea -->
                                    <div>
                                        <label for="exampleFormControlTextarea5" class="form-label">Initiator's Comment</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea5" <?php echo $readonly; ?> rows="3" placeholder="Do you want to make any Comment?" name="initiator_comment"><?php echo $data['initiator_comment']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-8 ">
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
                                        <h6 class="text-muted d-md-inline text-uppercase fw-semibold mb-3"> Approver's By: </h6>
                                        <p class="mx-2 d-md-inline py-1" id="approver-name"><?= $approver_name ?> </p>
                                        <p class="mx-2 py-1" id="approver-signature"><img src="<?= $approver_signature?>" width="100" height="50"> <span class="ms-4"><?= $data['date_approved']?></span></p>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="">Amount</label>
                                        <input type="number" class="form-control bg-light border-0" required <?php echo $readonly; ?> name="amount" id="amount" value="<?= $data['amount'] ?>" placeholder="Enter Amount">
                                    </div>
                                    <div>
                                        <label for="">VAT</label>
                                        <input type="text" class="form-control bg-light border-0" required name="vat" id="vat" value="<?= $data['vat'] ?>" placeholder="7.5%" readonly>
                                    </div>
                                    <div>
                                        <label for="">WHT</label>
                                        <input type="text" class="form-control bg-light border-0" required name="wht" id="wht" value="<?= $data['wht'] ?>" placeholder="7.5%" readonly>
                                    </div>
                                    <div>
                                        <label for="">Stamp Duty</label>
                                        <input type="text" class="form-control bg-light border-0" required name="stamp_duty" id="stamp_duty" value="<?= $data['stamp_duty'] ?>" placeholder="5%" readonly>
                                    </div>
                                    <div>
                                        <label for=""> Net Amount</label>
                                        <input type="text" class="form-control bg-light border-0" required name="net_amount" id="net_amount" value="<?= $data['net_amount'] ?>" placeholder="0.00" readonly>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                      
                    </div>
                   
                    <div class="card-body p-4">
                        
                        <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                            <?php if($data['approval_level'] == 1 && ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 0)){?>
                            <button type="submit" class="btn btn-info btn-submit"><i class="ri-printer-line align-bottom me-1"></i> Save</button>
                            <?php } if($data['approval_level'] == 1 && ($_SESSION['user_type'] == 2  || $_SESSION['user_type'] == 0)){?>
                                <button type="button" class="btn btn-primary level-btn" id="btn-reviewed" data-action='reviewed'> <i class="ri-check-fill align-bottom me-1 fw-bold"> </i>Reviewed</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reject-modal" data-action='rejected'> <i class="ri-close-line me-1 fw-bold"></i> Reject </button>
                            <?php } if($data['approval_level'] == 2 && ($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 0)){ ?>
                                <button type="button" class="btn btn-primary level-btn btn-approved" data-action='approved'> <i class="ri-check-line align-bottom me-1 fw-bold"></i> Approved</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reject-modal" data-action='rejected'> <i class="ri-close-line me-1 fw-bold"></i> Reject </button>
                            <?php } ?>

                            <!-- <a href="javascript:void(0);" class= "btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download Invoice</a>
                            <a href="javascript:void(0);" class="btn btn-danger"><i class="ri-send-plane-fill align-bottom me-1"></i> Send Invoice</a>  -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end col-->

       
    <div>

    <div id="reject-modal" class="modal flip">
        <div class="modal-dialog py-3">
            <div class="modal-content">
                <div class="modal-header border-bottom border-bottom-solid ms-3 mt-2" >
                    <h5 class="modal-title mx-5" id="exampleModalgridLabel">REJECT REASON</h5>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="my-3">
                        <textarea id="reject-reason"  placeholder="Enter a Reason why this Voucher is being Rejected" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="my-2">
                        <button type="button" id="reject-btn" class="mx-4 btn btn-secondary level-btn" data-action="rejected"> Submit</button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger"> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
$(document).ready(function(){

    $("#amount").change(function(){
        var amount = $("#amount").val();
        // Swal.fire("amount changed to "+amount);
        var vat = ((7.5/100) * amount).toFixed(2); 
        var wht = ((7.5/100) * amount).toFixed(2); 
        var stamp_duty = ((5/100) * amount).toFixed(2); 
        var net_amount = (amount - (Number(vat) + Number(wht) + Number(stamp_duty))).toFixed(2);

        $("#vat").val(vat);
        $("#wht").val(wht);
        $("#stamp_duty").val(stamp_duty);
        $("#net_amount").val(net_amount);

    });

    $(".level-btn").on('click', function(){
        var action = $(this).attr('data-action');
        console.log(action);

        if(action == 'rejected'){
            var reason = $.trim($("#reject-reason").val());
            if(reason == ''){
                Swal.fire({icon:"warning", title:"<h2 style='color:red'>warning</h2>", text:"Reject Reason is Empty"});
                return false;
            }else{
                var data = {voucher_no: "<?=$data['voucher_no']?>", reject_reason:reason};
            }
        }else{
            var data = {voucher_no: "<?=$data['voucher_no']?>"} 
        }
        console.log(data); //return false;
        $.ajax({
            url: "../model/voucher.php?action="+action+"&id=<?=$voucher_id?>",
            type: 'POST',
            dataType: 'json',
            // data: {voucher_no: "<?//=$data['voucher_no']?>"},
            data: data,
            success: function(response){
                console.log(response, response.status);
                if(response.status == 1001){
                    Swal.fire({icon:"success", title: "<h3 style='color:green'>Success</h3>", text:response.message});
                    setTimeout(() => {location.replace("../view/voucher-view.php?id=<?= $voucher_id ?>");}, 3000);
                    
                }else{
                    // alert("failed");
                    Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:response.message});
                }
            }
            

        })
    })


     /**** SUBMIT FORM */
    $("#voucher-edit-form").submit(function(e){
            e.preventDefault();

            var datat = new FormData(this);
            // var datat = new FormData($("#voucher-form")[0]);
            console.log(datat.get('email')); 
            $.ajax({
                url: "../model/voucher.php?action=edit&id=<?= $voucher_id ?>",
                // dataType: 'json',
                method: 'post',
                processData: false,
                contentType: false,
                data: datat,    
                success: function(res){
                        var response = JSON.parse(res)
                        console.log(res, response);
                        if(response.status == 1001){
                            Swal.fire({icon:"success", title: "<h3 style='color:green'>Success</h3>", text:response.message});
                            setTimeout(() => {location.replace("voucher-list.php");}, 3000);
                            
                        }else{
                            // alert("failed");
                            Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:response.message});
                        }

                },
                error: function(jqXHR, status, error){
                    console.log(status, error);
                    Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:error});

                }
            })
            
    })

    /*
    $("#btn-reviewed").click(function(){
    // $("#btn-reviewed").on('clcik', function(){
        
        $.ajax({
            url: "../model/voucher.php?action=reviewed&id=<?//=$voucher_id?>",
            type: 'POST',
            dataType: 'json',
            data: {voucher_no: "<?//=$data['voucher_no']?>"},
            success: function(response){
                console.log(response, response.status);
                
                if(response.status == 1001){
                    Swal.fire({icon:"success", title: "<h3 style='color:green'>Success</h3>", text:response.message});
                    setTimeout(() => {
                        location.replace("../view/voucher-view.php?id=<?//= $voucher_id ?>");
                    }, 3000);
                    
                }else{
                    // alert("failed");
                    Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:response.message});
                }
            }
            

        })
        
    })
    */
})

</script>
    

<?php

include 'footer.php';

?>