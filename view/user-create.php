<?php

include '../controller/controller.php';

$page_title = "Create User";

include 'header.php';
include '../controller/session.php';
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
                        <div class="col-lg-4 ">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input id="email" name="email" placeholder="Enter Email" required type="email" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
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
                        
                        <div class="col-lg-4 ">
                            <div class="mb-3">
                                <label class="form-label" for="phone">Phone</label>
                                <input id="phone" name="phone" placeholder="Enter Phone Number" required type="tel" class="form-control" minlength='11' maxlength='11'>
                            </div>
                        </div>
                    </div>
                  
                    <h6 class="mx-2 mt-3">Note: Default Password is '12345', The user can change this once they login</h6>               
                    <div class="hstack gap-2 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Save</button>
                    </div>
                    
                </form>

                

                </div>
            </div>
        </div>
    </div>
</div>


<script>

$(document).ready(function(){

    $("#user-form").on('submit',function(e){
        e.preventDefault();
        // var datat = new FormData($("#user-form")[0]);
        var datat = new FormData(this);
        
        console.log(datat); 
        
        $.ajax({
            url: "../model/user.php?action=create",
            // dataType: 'json',
            type: 'POST',
            contentType: false,
            processData: false,
            data: datat,
            success: function(response){
                console.log(response);
                if(response.status == 1001){
                    Swal.fire({icon:"success", title: "<h3 style='color:green'>Success</h3>", text:response.message});
                    setTimeout(() => {
                        location.replace('user-list.php')
                    }, 3000);
                    
                }else{
                    Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:response.message});
                }
            },
            error: function(xhr, status, error){
                Swal.fire({icon:"error", title: "<h3 style='color:red'>"+status+"</h3>", text: error+ " -- PLS CONTACT THE ADMINISTRATOR -- " });
            }

        })
        
    })


});


</script> 


<?php

    include 'footer.php';

?>
