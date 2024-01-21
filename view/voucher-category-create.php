<?php

include '../controller/controller.php';

$page_title = "Create Voucher Payment Category";

include 'header.php';
include 'sidenav.php';

if($_SESSION['user_type'] != 0 && $_SESSION['user_type'] != 1){?>
    <script> 
        Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:'YOU ARE NOT ALLOWED TO ACCESS THIS PAGE'}) ; 
        setTimeout(() => {location.replace('voucher-list.php'); }, 3000);
    </script>
    <!-- echo "<script> alert('YOU ARE NOT ALLOWED TO ACCESS THIS PAGE') ; location.replace('voucher-list.php'); </script>"; -->
<?php 
exit; }

?>


<div class="row">
    <div class="col-xl-12">
        <div class="card mx-5">
            <div class="card-body">
                <div class="p-5">
                <!-- <form action="../model/payment_category.php" method="post"> -->
                <form id="category-form" onsubmitvv="return false;">   
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
                        <button id='btn-submit' type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

                

                </div>
            </div>
        </div>
    </div>
</div>


<script>

$(document).ready(function(){
    // alert('clicked');

    $("#category-form").submit(function(e){
    // $("#btn-submit").click(function(){
        e.preventDefault();
        var categoryCode = $.trim($("#category-code").val());
        var categoryName = $.trim($("#category-name").val());
        // alert('clicked')
        if(categoryCode.length != '' && categoryName != ''){
            $.ajax({
                url: "../model/payment_category.php",
                dataType: 'json',
                type: 'POST',
                data: {category_code:categoryCode, category_name : categoryName, action:'create'},
                success: function(response){
                    if(response.status == 1001){
                        Swal.fire({icon:"success", title: "Success", text:"CATEGORY ADDED SUCCESSFULLY"});
                        // setTimeout(() => {
                        //     location.replace('../view/voucher-category-list.php')
                        // }, 3000);
                        
                    }
                }
                // error: function(xhr, status)

            })
        }else{
            Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3> ", text:"please ensure your inputs are valid"});
        }
    })


});


</script> 

<?php

include 'footer.php';

?>

