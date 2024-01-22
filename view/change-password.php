<?php

include '../controller/controller.php';

$page_title = "Change Password";

include 'header.php';
include 'sidenav.php';


if($_SESSION['id'] != $_GET['id']){?>
    <script> 
        Swal.fire({icon:"error", title: "<h3 style='color:red'>Error!! Wrong Profile selected</h3>", text:'YOU ARE NOT ALLOWED TO ACCESS THIS PAGE.'}) ; 
        setTimeout(() => {location.replace('voucher-list.php'); }, 3000);
    </script>
    <!-- echo "<script> alert('YOU ARE NOT ALLOWED TO ACCESS THIS PAGE') ; location.replace('voucher-list.php'); </script>"; -->
<?php 
exit; 
}

?>


<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="auth-full-page-content d-flex mindd-vh-100 py-sm-3 py-2">
            <div class="w-100">
                 
                    <div class="card my-md-auto ">
                            <div class="p-4">
                                <!-- <form action="../model/user.php?action=login" class="auth-input" method="POST"> -->
                                <form id="password-form">
                                    <p class="text-danger">Note: You Cannot Use Default Password is "12345"</p>
                                    <div class="mb-2">
                                        <label for="userpassword" class="form-label">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" name="password" required placeholder="Enter password" id="password" minlength='5'>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="las la-eye align-middle fs-18"></i></button>
                                            <div class='def'></div>
                                        </div>
                                    </div>
            
                                    <div class="mb-3">
                                        <label for="userpassword" class="form-label">Confirm Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input" name="confirm_password" required placeholder="Confirm password" id="confirm-password">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="las la-eye align-middle fs-18"></i></button>
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
        var password = $('#password').val();
        var confirm_password = $('#confirm-password').val();

        if( password == confirm_password){
            // alert('matched');
            $('.submit').attr('disabled', false);
            $('div.feedback').html("<p class='bg-primary-subtle text-primary'>Password Matched! </p>")
        }else{
            // alert('do not match');
            $('.submit').attr('disabled', true);
            $('div.feedback').html("<p class='bg-danger-subtle text-danger'>Password Does Not Match! </p>")
        }
    })

    $('#password').change(function(){
        if($(this).val() == '12345'){
            $('.submit').attr('disabled', true);
            $('div.def').html("<p class='bg-danger-subtle text-danger'>you cannot use the default password as your password! </p>")
        }else{
            // $('.submit').attr('disabled', false);
            $('div.def').html("")
        }
    })

    $("#password-form").on('submit',function(e){
        e.preventDefault();
        var password = $('#password').val() ;
        var user_id = <?= $_SESSION['id']?>;
        if( password == '12345'){
            Swal.fire({icon:"warning", title: "<h3 style='color:red'>Warning</h3>", text:"you cannot use the default password as your password!"});
            return false;
        }else{
            // var datat = new FormData($("#login-form")[0]);
            var datat = {password: password, id: user_id}
            console.log(datat);

            $.ajax({
                url: "../model/user.php?action=change_password",
                // dataType: 'json',
                type: 'POST',
                data: datat,
                success: function(res){
                    console.log(res);
                    var response = JSON.parse(res);

                    if(response.status == 1001){
                        Swal.fire({icon:"success", title: "<h3 style='color:green'>Success</h3>", text:response.message});
                        setTimeout(() => {
                            location.replace('logout.php')
                        }, 3000);
                        
                    }else{
                        Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:response.message});
                    }
                },
                error: function(jqXHR, status, errorThrown){
                    console.log(jqXHR);
                    console.log(status);
                    console.log(errorThrown);
                }
            })
        }
    })

});


</script> 

<?php

include 'footer.php';

?>

