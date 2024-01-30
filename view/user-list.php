<?php

include '../controller/controller.php';

$page_title = "View User";

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

$response = $action->fetchUser('all');

if(is_array($response)){
    $tbody = " ";
    foreach($response as $data){
        if($data['isAdmin'] == 1){
            $user_type = "Admin";
        }else{
            $user_type = $action->fetchUserType($data['user_type'])[0]['name'];
        }
        if($data['isActive'] == 1){
            // $isActive =  "<span class='badge bg-primary p-2'>Active</span>" ;
            $isActive =  "<span class='text-primary fw-bold me-3'>Active</span>" ;
            $enable = "<button type='button' class='ms-4 text-right btn btn-sm btn-danger btn-action' data-firstname='".$data['first_name']."' data-action = 'Disable' data-id='".$data['id']."'> disable user </button>";
            
        }else{
            // $isActive =  "<span class='badge bg-danger p-2'>InActive</span>" ;
            $isActive =  "<span class='text-danger fw-bold me-3'>InActive</span>" ;
            $enable = "<button type='button' class='ms-4 btn btn-sm btn-primary btn-action' data-firstname='".$data['first_name']."' data-action='Enable' data-id='".$data['id']."'> Enable user </button>";

        }
        // $isActive = $data['isActive'] == 1 ? "<span class='badge bg-primary p-2'>Active</span>" : "<span class='badge bg-danger p-2'>InActive</span>" ;

        $tbody .="<tr>
                    <td>".$data['first_name']." ".$data['last_name']."</td>
                    <td>".$data['email']."</td>
                    <td>".$data['phone']."</td>
                    <td>".$user_type."</td>
                    <td>$isActive $enable</td>
                    <td><p><button type='button' class='mx-2 btn btn-secondary reset fs-12' data-firstname='".$data['first_name']."' data-id='".$data['id']."'> Reset Password </button></p></td>
                </tr>";
    }
}


?>

<script>

    function activateUser(action, user_id){
       
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
    }


    $(document).ready(function(){
        $(".btn-action").click(function(){
            var action = $(this).attr('data-action');
            var user_id = $(this).attr('data-id');
            var firstname = $(this).attr('data-firstname');

            // console.log(action, user_id, firstname);
            Swal.fire({
            title: "<h2>Warning</h2>",
            // text: "Are You Sure You Want to "+action+" "+firstname+ " Profile",
            html: "Are You Sure You Want to <b>"+action+" <i>"+firstname+ "</i></b> Profile",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        url: "../model/user.php?action=activate",
                        type: 'POST',
                        data: {action_type: action, id: user_id},
                        success: function(resp){
                            console.log(response);
                            var response = JSON.parse(resp);
                            if(response.status == 1001){
                                Swal.fire({icon:"success", title: "<h3 style='color:green'>Success</h3>", text:response.message});
                                setTimeout(() => {
                                    location.replace('user-list.php')
                                }, 2000);
                                
                            }else{
                                Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:response.message});
                            }
                        },
                        error: function(xhr, status, error){
                            Swal.fire({icon:"error", title: "<h3 style='color:red'>"+status+"</h3>", text: error+ " -- PLS CONTACT THE ADMINISTRATOR -- " });
                        }

                    })
                    
                }
            });
        })

        $(".reset").click(function(){
            var user_id = $(this).attr('data-id');
            var firstname = $(this).attr('data-firstname');

            // console.log(user_id); //return false;
            Swal.fire({
            title: "<h2>Warning</h2>",
            // text: "Are You Sure You Want to "+action+" "+firstname+ " Profile",
            html: "Are You Sure You Want to <b>Reset <i>"+firstname+ "</i></b> Password",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        url: "../model/user.php?action=reset-password",
                        type: 'POST',
                        data: {id: user_id},
                        success: function(resp){
                            console.log(response);
                            var response = JSON.parse(resp);
                            if(response.status == 1001){
                                Swal.fire({icon:"success", title: "<h3 style='color:green'>Success</h3>", text:response.message});
                                setTimeout(() => {
                                    location.replace('user-list.php')
                                }, 2000);
                            }else{
                                Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:response.message});
                            }
                        },
                        error: function(xhr, status, error){
                            Swal.fire({icon:"error", title: "<h3 style='color:red'>"+status+"</h3>", text: error+ " -- PLS CONTACT THE ADMINISTRATOR -- " });
                        }

                    })
                    
                }
            });

        })
    })
</script>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive table-card px-2">
                    <table class="table table-hover table-striped table-bordered table-nowrap align-middle mb-0">
                        <thead class="table-dark">
                            <tr class="text-muted text-uppercase">
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">User Type</th>
                                <th scope="col" style="width: 16%;">Status</th>
                                
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $tbody ; ?>
                        </tbody>
                    </table><!-- end table -->
                </div><!-- end table responsive -->
            </div>
        </div>
    </div>
</div>



<?php

include 'footer.php';

?>
