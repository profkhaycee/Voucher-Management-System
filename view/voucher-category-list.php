
<?php

include '../controller/controller.php';

$page_title = "Voucher Payment Category List";

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




$response = $action->fetchVoucherCategory('all');

if(is_array($response)){
    $tbody = " ";
    foreach($response as $data){
        $tbody .= '<tr>
                        
                        <td>'.$data['code'].'</td>
                        <td>'.$data['name'].'</td>
                        <td>
                            <div class="hstack gap-3 flex-wrap">
                                <a href="javascript:void(0);" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                <a href="javascript:void(0);" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                            </div>
                        </td>
                        
                    </tr>';
    }

}else{
    $tbody = "<tr> NO DATA TO FETCH </tr>";
}

?>



<div class="row pb-4 gy-3">
    <div class="col-sm-4">
        <a href="voucher-category-create.php" class="btn btn-primary addMembers-modal"><i class="las la-plus me-1"></i> Add Voucher Category</a>
    </div>

    <!--  <div class="col-sm-auto ms-auto">
       <div class="d-flex gap-3">
        <div class="search-box">
            <input type="text" class="form-control" placeholder="Search for name or designation...">
            <i class="las la-search search-icon"></i>
        </div>
        <div class="">
            <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-soft-info btn-icon fs-14"><i class="las la-ellipsis-v fs-18"></i></button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                <li><a class="dropdown-item" href="#">Print</a></li>
                <li><a class="dropdown-item" href="#">Export to Excel</a></li>
            </ul>
        </div>
       </div>
    </div>  -->
</div>



<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive table-card px-2">
                    <table class="table table-hover table-striped table-bordered table-nowrap align-middle mb-0">
                        <thead class="table-dark">
                            <tr class="text-muted text-uppercase">
                                
                                <th scope="col">Payment Category Code</th>
                                <th scope="col">Payment Category Name</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                           <?php echo $tbody; ?>
                                
                            </tr>

                            
                        </tbody><!-- end tbody -->
                    </table><!-- end table -->
                </div><!-- end table responsive -->
            </div>
        </div>
    </div>
</div>


<?php

include 'footer.php';

?>