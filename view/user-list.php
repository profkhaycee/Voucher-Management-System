<?php

include '../controller/controller.php';

$page_title = "View User";

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

$response = $action->fetchUser('all');

if(is_array($response)){
    $tbody = " ";
    foreach($response as $data){
        if($data['isAdmin'] == 1){
            $user_type = "Admin";
        }else{
            $user_type = $action->fetchUserType($data['user_type'])[0]['name'];

        }

        $tbody .="<tr>
                    <td>".$data['first_name']." ".$data['last_name']."</td>
                    <td>".$data['email']."</td>
                    <td>".$data['phone']."</td>
                    <td>".$user_type."</td>
                    <td><span class='badge bg-primary p-2'>Active</span> </td>
        
                </tr>";
    }
}


?>


<!-- <div class="row pb-4 gy-3">
    <div class="col-sm-4">
        <button class="btn btn-primary addPayment-modal" data-bs-toggle="modal" data-bs-target="#addpaymentModal"><i class="las la-plus me-1"></i> Add New</button>
    </div>

</div> -->

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
                                <!-- <th scope="col" style="width: 12%;">Action</th> -->
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
