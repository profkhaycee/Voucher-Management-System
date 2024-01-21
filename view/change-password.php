<?php

include '../controller/controller.php';

$page_title = "Change Password";

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


<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="auth-full-page-content d-flex mindd-vh-100 py-sm-3 py-2">
            <div class="w-100">
                 
                    <div class="card my-md-auto ">
                            <div class="p-4">
                                <!-- <form action="../model/user.php?action=login" class="auth-input" method="POST"> -->
                                <form id="password-form">
                                    <p class="text-danger">Note: Default Password is "12345"</p>
                                    <div class="mb-2">
                                        <label for="userpassword" class="form-label">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" name="password" required placeholder="Enter password" id="password" minlength='5'>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="las la-eye align-middle fs-18"></i></button>
                                        </div>
                                    </div>
            
                                    <div class="mb-3">
                                        <label for="userpassword" class="form-label">Confirm Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input" name="password" required placeholder="Confirm password" id="confirm-password">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="las la-eye align-middle fs-18"></i></button>
                                        </div>
                                        <div class="feedback"></div>
                                    </div>
                                
                                    <div class="mt-2">
                                        <button class="btn btn-primary px-4 submit" type="submit">Submit</button>
                                    </div>

                                </form>
            
                            </div>
                    </div>
                    <!-- end card -->                    
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

<script>

$(document).ready(function(){
    // alert('clicked');
    $('.submit').attr('disabled', true);

    $('#confirm-password').change(function(){
        var password = ('#password').val();
        var confirm_password = ('#confirm-password').val();

        if( password === confrim_password){
            $('.submit').attr('disabled', false);
            $('div.feedback').html("<p class='bg-primary-subtle text-primary'>Password Matched! </p>")
        }else{
            $('.submit').attr('disabled', true);
            $('div.feedback').html("<p class='bg-dange-subtle text-danger'>Password Does Not Match! </p>")
        }
    })

    $("#password-form").on('submit',function(e){
        e.preventDefault();
        // var datat = new FormData($("#login-form")[0]);
        var datat = new FormData(this);
        console.log(datat)
                    
        $.ajax({
            url: "../model/user.php?action=login",
            dataType: 'json',
            type: 'POST',
            contentType: false,
            processData: false,
            data: datat,
            success: function(response){
                console.log(response);
                if(response.status == 1001){
                    location.replace('voucher-list.php')
                    // Swal.fire({icon:"success", title: "<h3 style='color:green'>Success</h3>", text:response.message});
                    // setTimeout(() => {
                    //     location.replace('voucher-list.php')
                    // }, 3000);
                    
                }else{
                    Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:response.message});
                }
            }
        })
    })

});


</script> 

<?php

include 'footer.php';

?>

