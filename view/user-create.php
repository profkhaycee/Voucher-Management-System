<?php

include '../controller/controller.php';

$page_title = "Create User";

include 'header.php';
include 'sidenav.php';

if($_SESSION['isAdmin'] != 1){?>
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
        <div class="card">
            <div class="card-body">
                <div class="p-2">
                <!-- <form action="../model/user.php?action=create" method='post' enctype='multipart/form-data'> -->
                <form id="user-form" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-lg-6 ">
                            <div class="mb-3">
                                <label class="form-label" for="firstname">First Name</label>
                                <input id="firstname" name="first_name" placeholder="Enter First Name" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="mb-3">
                                <label class="form-label" for="lastname">Last Name</label>
                                <input id="lastname" name="last_name" placeholder="Enter Last Name" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input id="email" name="email" placeholder="Enter Email" required type="email" class="form-control">
                            </div>
                        </div>
                        <!-- <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="Password">Password </label>
                                <input id="password" name="password" placeholder="" value="12345" type="text" class="form-control bg-light" readonly>
                                <small class="mx-3 text-muted">Default Password id '12345', The user can change this once they login</small>
                            </div>
                        </div> -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="user-type" class="form-label">User Type</label>
                                <select class="form-select" data-trigger name="user_type" required id="user-type">
                                    <option value="" selected>Select User Type</option>
                                    <?php foreach($action->fetchUserType('all') as $data){
                                        echo "<option value='".$data['id']."'> ".$data['name']." </option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="signature" class="form-label">Upload Signature </label>
                                <input name="signature" id="img-signature"  class ="form-control" required type="file" accept="image/*">
                                <h6 class="text-danger ">Note: signature image must not be more than 2MB</h6>
                            </div>
                            <div class="mb-3">
                                <p><img id="img-preview" width="200" height="70" ></p>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="mb-3">
                                <label class="form-label" for="phone">Phone</label>
                                <input id="phone" name="phone" placeholder="Enter Phone Number" required type="tel" class="form-control" minlength='11' maxlength='11'>
                            </div>
                        </div>
                    </div>
                    
                    <!--                     
                    <div class="dropzone mb-3">
                        <div class="fallback">
                            <input name="file" type="file" accept="image/*">
                        </div>
                        <div class="dz-message needsclick">
                            <div class="mb-3">
                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                            </div>

                            <h4>Upload Signature here</h4>
                        </div>
                    </div>

                    <ul class="list-unstyled" id="dropzone-preview">
                        <li class="mt-2" id="dropzone-preview-list">
                            <!- This is used as the file preview template ->
                            <div class="border rounded">
                                <div class="d-flex p-2">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm bg-light rounded">
                                            <img data-dz-thumbnail class="img-fluid rounded d-block" src="assets/images/new-document.png" alt="Dropzone-Image" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="pt-1">
                                            <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-3">
                                        <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul> -->
                    <!-- end dropzon-preview -->
                    <h6 class="mx-2 mt-5">Note: Default Password id '12345', The user can change this once they login</h6>               
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

$(document).ready(function(){
    // $('#img-preview').hide();

    // let signature = document.getElementById("img-signature");

    // signature.onchange = function () {
    // let image = new FileReader();
    
    // image.onload = function (e) {
    //     document.getElementById("img-preview").src = e.target.result;
    //     };
    // image.readAsDataURL(this.files[0]);
    // };
 

    $("#img-signature").on('change',function(){
        var image = new FileReader();
        image.onload = function(e){
            $("#img-preview").show();
            $("#img-preview").attr('src', e.target.result);
        }
        image.readAsDataURL(this.files[0]);

    });

    $("#user-form").on('submit',function(e){
        e.preventDefault();
        // var datat = new FormData($("#user-form")[0]);
        var datat = new FormData(this);
        
        console.log(datat); 
        
            $.ajax({
                url: "../model/user.php?action=create",
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


});


</script> 


<?php

    include 'footer.php';

?>
