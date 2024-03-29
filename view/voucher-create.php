
<?php

include '../controller/controller.php';

$page_title = "Create Voucher";

include 'header.php';

include 'sidenav.php';
include '../controller/session.php';

// if($_SESSION['user_type'] != 0 && $_SESSION['user_type'] != 1){

if(!in_array($_SESSION['user_type'],[0, 1, 5 ])){?>
    <script> 
        Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:'YOU ARE NOT ALLOWED TO ACCESS THIS PAGE'}) ; 
        setTimeout(() => {location.replace('voucher-list.php'); }, 3000);
    </script>
    <!-- echo "<script> alert('YOU ARE NOT ALLOWED TO ACCESS THIS PAGE') ; location.replace('voucher-list.php'); </script>"; -->
<?php 
exit; }

?>
     

            <div class="row justify-content-center">
                <div class="col-xxl-9">
                    <div class="card">
                        <!-- <form class="needs-validation" action="../model/voucher.php?action=create" method="post"  id="invoice_form"> -->
                        <form class="needs-validation"  id="voucher-form" enctype="multipart/form-data">
                            <div class="card-body border-bottom border-bottom-dashed p-4">
                                <div class="containerss">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-2">
                                                <label for="payee-name">Payee Name</label>
                                                <input type="text" class="form-control bg-light border-0" required name="payee_name" id="payee-name" placeholder="Enter Full Name of Payee">
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control bg-light border-0" required name="payee_email" id="payee-email" placeholder="Enter Email Address of payee" />
                                                <div class="invalid-feedback">
                                                    Please enter a valid email, Ex., example@gamil.com
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="phone">Phone Number</label>
                                                <input type="tel" class="form-control bg-light border-0" data-plugin="cleave-phone" required name="payee_phone" id="payee-phone" placeholder="Enter Phone number of Payee" minlength='11' maxlength='11' />
                                                <div class="invalid-feedback">
                                                    Please enter a contact number
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2">
                                                <label for="address"> Address</label>
                                                <input type="text" class="form-control bg-light border-0" required name="payee_address" id="payee-address" placeholder=" Enter Address of payee" />
                                                <div class="invalid-feedback">
                                                    Please enter Address
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-2">
                                                <label for="date-field">Date</label>
                                                <input type="date" class="form-control bg-light border-0 flatpickr-input" required name="voucher_date" id="date-field" data-provider="flatpickr" data-time="true" placeholder="Select Date">
                                                <div class="invalid-feedback">
                                                    pick a valid date
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="payment-category">Payment category</label>
                                            <div class="input-light">
                                                <select class="form-control bg-light border-0 w-100" data-choices data-choices-search-false id="payment-category" required name="payment_category" >
                                                    <option value="" selected>Select Payment Category</option>
                                                    <?php foreach($action->fetchVoucherCategory('all') as $data){
                                                        echo "<option value='".$data['id']."'> ".$data['code']." - ".$data['name']." </option>";
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-checkr mb-2"> 
                                                <label for="">Select voucher Type:</label><br>
                                                <?php if(in_array($_SESSION['user_type'], [0, 1])){ 
                                                    $readonly = $_SESSION['user_type'] == 1 ?  'readonly checked' : '';
                                                    // $checked = $_SESSION['user_type'] == 1 ?  'checked' : '';
                                                ?>
                                                <input class="form-check-input mx-3" required type="radio" name="voucher_type" id="voucher-type" <?= $readonly?> value="Debit" >
                                                <label class="form-check-label" for="voucher-type">   Debit </label> 
                                                <?php }if(in_array($_SESSION['user_type'], [0, 5])){ 
                                                    $readonly = $_SESSION['user_type'] == 5 ?  'readonly checked' : '';
                                                ?>
                                                <input class="form-check-input mx-3" required type="radio" name="voucher_type" id="voucher-type" <?= $readonly?> value="Credit">
                                                <label class="form-check-label" for="voucher-type">   Credit   </label> 
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <!-- Example Textarea -->
                                            <div>
                                                <label for="exampleFormControlTextarea5" class="form-label">Initiator's Comment</label>
                                                <textarea class="form-control" required id="exampleFormControlTextarea5" rows="3" placeholder="Enter Reason why voucher was raised" name="initiator_comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="signature" class="form-label ">Upload Document 1 </label>
                                                <input name="document1" id="doc1" data-feedback='feedback1'  class ="doc-attach form-control" type="file" accept=".doc, .docx, .pdf, .jpg, .jpeg, .png">
                                                <h6 class="text-danger ">Note: Document must not be more than 2MB</h6>
                                                <p class="feedback1"></p>
                                            </div>
                                        
                                            <div class="mb-3">
                                                <label for="signature" class="form-label ">Upload Document 2 </label>
                                                <input name="document2" id="doc2" data-feedback='feedback2' class ="doc-attach form-control" type="file" accept=".doc, .docx, .pdf, .jpg, .jpeg, .png">
                                                <h6 class="text-danger ">Note: Document must not be more than 2MB</h6>
                                                <p class="feedback2"></p>
                                            </div>
                                        
                                            <div class="mb-3">
                                                <label for="signature" class="form-label ">Upload Document 3 </label>
                                                <input name="document3" id="doc3" data-feedback='feedback3' class ="doc-attach form-control" type="file" accept=".doc, .docx, .pdf, .jpg, .jpeg, .png">
                                                <h6 class="text-danger ">Note: Document must not be more than 2MB</h6>
                                                <p class="feedback3"></p>
                                            </div>
                                        
                                            <div class="mb-3">
                                                <label for="signature" class="form-label">Upload Document 4 </label>
                                                <input name="document4" id="doc4" data-feedback='feedback4' class ="doc-attach form-control" type="file" accept=".doc, .docx, .pdf, .jpg, .jpeg, .png">
                                                <h6 class="text-danger ">Note: Document must not be more than 2MB</h6>
                                                <p class="feedback4"></p>
                                            </div>
                                               
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="">Amount</label>
                                                <input type="number" class="form-control bg-light border-0" required name="amount" id="amount" placeholder="Enter Amount" step="0.01">
                                            </div>
                                            <div>
                                                <label for="">VAT</label>
                                                <input type="text" class="form-control bg-light border-0" required name="vat" id="vat" placeholder="7.5%" readonly>
                                            </div>
                                            <div>
                                                <label for="">WHT</label>
                                                <input type="text" class="form-control bg-light border-0" required name="wht" id="wht" placeholder="7.5%" readonly>
                                            </div>
                                            <div>
                                                <label for="">Stamp Duty</label>
                                                <input type="text" class="form-control bg-light border-0" required name="stamp_duty" id="stamp_duty" placeholder="5%" readonly>
                                            </div>
                                            <div>
                                                <label for=""> Net Amount</label>
                                                <input type="text" class="form-control bg-light border-0" required name="net_amount" id="net_amount" placeholder="0.00" readonly>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            
                            </div>
                        
                            <div class="card-body p-4">
                                
                                <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                    <button type="submit" class="btn btn-info btn-submit"><i class="ri-printer-line align-bottom me-1"></i> Create</button>
                                    <!-- <a href="javascript:void(0);" class= "btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download Invoice</a>
                                    <a href="javascript:void(0);" class="btn btn-danger"><i class="ri-send-plane-fill align-bottom me-1"></i> Send Invoice</a>  -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end col-->
            </div>

<script>
    $(document).ready(function(){

        /******** check document size */
        $(".doc-attach").on('change',function(){
            var fb_class = $(this).attr('data-feedback');
            console.log(fb_class)

            var size = ((this.files[0].size)/1000000).toFixed(2)  ;
            console.log(size);
            if(size <= 2){
                var classx = "bg-primary-subtle text-primary";
                // $("#upload-signature").attr('disabled', false);
            }else{
                var classx =  "bg-danger-subtle text-danger" ;
                $(this).val('')
                // $("#upload-signature").attr('disabled', true);
            }
            // $("#feedback").html("<span class='p-2 "+classx+"'>file size : "+ size +" MB </span>");
            // $(this).append("<br><br><span class='p-2 "+classx+"'>file size : "+ size +" MB </span>");
            $("."+fb_class).html("<span class='p-2 "+classx+"'>file size : "+ size +" MB </span>");

        });

        /***** calculate VAT, WHT, STAMP DUTY AND NET AMOUNT */
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

        /**** SUBMIT FORM */
        $("#voucher-form").submit(function(e){
            e.preventDefault();

            var datat = new FormData(this);
            // var datat = new FormData($("#voucher-form")[0]);
            console.log(datat.get('email')); 
            $.ajax({
                url: "../model/voucher.php?action=create",
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



    })
</script>

<?php

include 'footer.php';

?>