<?php

include '../controller/controller.php';

$page_title = "Edit Voucher";

include 'header.php';
include 'sidenav.php';

$voucher_id = $_GET['id'];

$data = $action->fetchVoucher($voucher_id)[0];

// if($data['voucher_type'] == "Debit"){
//     $checked = 
// }

// echo "<script>alert('$rrr')<script>";

?>



            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><?php echo $page_title .' - '. $data['voucher_no'] ; ?> </h4>

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
            <div class="card">
                <form class="needs-validation" action="../model/voucher.php?action=edit&id=<?= $voucher_id ?>" method="post"  id="invoice_form">
                    <div class="card-body border-bottom border-bottom-dashed p-4">
                        <div class="containerss">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <label for="payee-name">Payee Name</label>
                                        <input type="text" class="form-control bg-light border-0" required name="payee_name" value="<?= $data['payee_name'] ?>" id="payee-name" placeholder="Enter Full Name of Payee">
                                    </div>
                                    
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control bg-light border-0" required name="payee_email" value="<?= $data['payee_email'] ?>" id="payee-email" placeholder="Enter Email Address of payee" />
                                        <div class="invalid-feedback">
                                            Please enter a valid email, Ex., example@gamil.com
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" class="form-control bg-light border-0" data-plugin="cleave-phone" required name="payee_phone" value="<?= $data['payee_phone'] ?>" id="payee-phone" placeholder="Enter Phone number of Payee" minlength='11' maxlength='11' />
                                        <div class="invalid-feedback">
                                            Please enter a contact number
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-2">
                                        <label for="address"> Address</label>
                                        <input type="text" class="form-control bg-light border-0" required name="payee_address" id="payee-address" value="<?= $data['payee_address'] ?>" placeholder=" Enter Address of payee" />
                                        <div class="invalid-feedback">
                                            Please enter Address
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-2">
                                        <label for="date-field">Date</label>
                                            <input type="date" class="form-control bg-light border-0 flatpickr-input" required name="voucher_date" value="<?= $data['voucher_date'] ?>" id="date-field" data-provider="flatpickr" data-time="true" placeholder="Select Date">
                                            <div class="invalid-feedback">
                                                pick a valid date
                                            </div>
                                         
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="payment-category">Payment category</label>
                                    <div class="input-light">
                                        <select class="form-control bg-light border-0 w-100" data-choices data-choices-search-false id="payment-category" required name="payment_category" >
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
                                        <input class="form-check-input mx-3" required type="radio" name="voucher_type" id="voucher-type" value="Debit" <?php if($data['voucher_type'] == "Debit") echo  "checked" ?>>
                                        <label class="form-check-label" for="voucher-type">   Debit </label>
                                        <input class="form-check-input mx-3" required type="radio" name="voucher_type" id="voucher-type" value="Credit" <?php if($data['voucher_type'] == "Credit") echo  "checked" ?>>
                                        <label class="form-check-label" for="voucher-type">   Credit   </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Example Textarea -->
                                    <div>
                                        <label for="exampleFormControlTextarea5" class="form-label">Initiator's Comment</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" placeholder="Do you want to make any Comment?" name="initiator_comment"><?php echo $data['initiator_comment']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end my-3">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="">Amount</label>
                                        <input type="number" class="form-control bg-light border-0" required name="amount" id="amount" value="<?= $data['amount'] ?>" placeholder="Enter Amount">
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
                            <button type="submit" class="btn btn-info btn-submit"><i class="ri-printer-line align-bottom me-1"></i> Save</button>
                            <!-- <a href="javascript:void(0);" class= "btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download Invoice</a>
                            <a href="javascript:void(0);" class="btn btn-danger"><i class="ri-send-plane-fill align-bottom me-1"></i> Send Invoice</a>  -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end col-->
    </div>


<?php

include 'footer.php';

?>