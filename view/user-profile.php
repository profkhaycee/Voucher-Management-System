<?php

include '../controller/controller.php';

$page_title = "Create Voucher Payment Category";

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
}else{
    $user = $action->fetchUser($_GET['id'])[0];

}

?>



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="p-2">
                <!-- <form action="../model/user.php?action=create" method='post' enctype='multipart/form-data'> -->
                <form id="user-profile-form" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-lg-6 ">
                            <div class="mb-3">
                                <label class="form-label" for="firstname">First Name</label>
                                <input id="firstname" value="<?=$user['first_name']?>" name="first_name" placeholder="Enter First Name" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="mb-3">
                                <label class="form-label" for="lastname">Last Name</label>
                                <input id="lastname" value="<?=$user['last_name']?>"  name="last_name" placeholder="Enter Last Name" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input id="email" value="<?=$user['email']?>" name="email" placeholder="Enter Email" required type="email" class="form-control">
                            </div>
                        </div>
                        <!-- <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="Password">Password </label>
                                <input id="password" name="password" placeholder="" value="12345" type="text" class="form-control bg-light" readonly>
                                <small class="mx-3 text-muted">Default Password id '12345', The user can change this once they login</small>
                            </div>
                        </div> -->
                        
                        
                        <div class="col-lg-6 ">
                            <div class="mb-3">
                                <label class="form-label" for="phone">Phone</label>
                                <input id="phone" name="phone" value="<?=$user['phone']?>" placeholder="Enter Phone Number" required type="tel" class="form-control" minlength='11' maxlength='11'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="signature" class="form-label">Upload / Change Signature </label>
                                <input name="signature" id="img-signature"  class ="form-control" required type="file" accept="image/*">
                                <h6 class="text-danger ">Note: signature image must not be more than 2MB</h6>
                            </div>
                            <div class="mb-3">
                                <p><img id="img-preview" width="200" height="70" src="<?=$user['signature']?>"></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="hstack gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    
                </form>

                
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $("#img-signature").on('change',function(){
        var image = new FileReader();
        image.onload = function(e){
            $("#img-preview").show();
            $("#img-preview").attr('src', e.target.result);
        }
        image.readAsDataURL(this.files[0]);

    });

    $("#user-profile-form").on('submit',function(e){
        e.preventDefault();
        // var datat = new FormData($("#user-form")[0]);
        var datat = new FormData(this);
        
        console.log(datat); 
        
            $.ajax({
                url: "../model/user.php?action=edit",
                dataType: 'json',
                type: 'POST',
                contentType: false,
                processData: false,
                data: datat,
                success: function(response){
                    console.log(response);
                    if(response.status == 1001){
                        Swal.fire({icon:"success", title: "<h3 style='color:green'>Success</h3>", text:response.message});
                        setTimeout(() => {
                            location.replace('../view/user-list.php')
                        }, 3000);
                        
                    }else{
                        Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:response.message});
                    }
                }
                // error: function(xhr, status)

            })
        
    })

</script>


<?php

include 'footer.php';

?>
