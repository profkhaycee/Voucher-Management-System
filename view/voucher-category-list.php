
<?php

include '../controller/controller.php';

$page_title = "Voucher Payment Category List";

include 'header.php';
include '../controller/session.php';
include 'sidenav.php';

if(!in_array($_SESSION['user_type'],[0, 1, 5 ])){?>
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
                            <button class="btn btn-info fs-15 mx-3 edit-cat" data-code="'.$data['code'].'" data-name="'.$data['name'].'" data-id="'.$data['id'].'"><i class="ri-edit-2-line"></i> Edit </button>
                            <button class="btn btn-danger fs-15 mx-3 delete-cat" data-code="'.$data['code'].'" data-name="'.$data['name'].'" data-id="'.$data['id'].'"><i class="ri-delete-bin-line"></i> Delete </button>
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
                                
                        </tbody><!-- end tbody -->
                    </table><!-- end table -->
                </div><!-- end table responsive -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit-cat-modal" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Grid Modals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-cat-form">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="category-code">Payment Category Code</label>
                                <input id="category-code" required name="category_code" placeholder="Enter Category code" type="text" class="form-control" minlength='4' maxlength='4'>
                            </div>
                        </div><!--end col-->
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="category-name">Payment Category Name</label>
                                <input id="category-name" required name="category_name" placeholder="Enter Category Name" type="text" class="form-control">
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-12">
                            <div class="hstack gap-4 justify-content-end">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function(){
        var id = 0; var code = ''; var name = '';
        $(".edit-cat").click(function(){
            code = $(this).attr('data-code');
            name = $(this).attr('data-name');
            id = $(this).attr('data-id');

            $("#edit-cat-modal").modal('show');
            $("#category-code").val(code)
            $("#category-name").val(name)
        })

        $("#edit-cat-form").submit(function(e){
            e.preventDefault();
            var categoryCode = $.trim($("#category-code").val());
            var categoryName = $.trim($("#category-name").val());
            // console.log(categoryCode, id, categoryName); return false;
            if(categoryCode.length != '' && categoryName != ''){
                $.ajax({
                    url: "../model/payment_category.php?action=edit",
                    // dataType: 'json',
                    type: 'POST',
                    data: {category_code:categoryCode, category_name : categoryName, id:id},
                    success: function(resp){
                        var response = JSON.parse(resp);
                        if(response.status == 1001){
                            Swal.fire({icon:"success", title: "Success", text:"CATEGORY EDITED SUCCESSFULLY"});
                            setTimeout(() => {location.replace('voucher-category-list.php')}, 3000);
                            
                        }
                    },
                    error: function(xhr, status, error){
                        Swal.fire({icon:"error", title: "<h3 style='color:red'>"+status+"</h3>", text: error+ " -- PLS CONTACT THE ADMINISTRATOR -- " });
                    }

                })
            }else{
                Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3> ", text:"please ensure your inputs are valid"});
            }
        })

        $(".delete-cat").click(function(){
            code = $(this).attr('data-code');
            name = $(this).attr('data-name');
            id = $(this).attr('data-id');

            // console.log(code, id, name); return false;
            Swal.fire({
            title: "<h2>Warning</h2>",
            // text: "Are You Sure You Want to "+action+" "+firstname+ " Profile",
            html: "Are You Sure You Want to <b>Delete <i>'"+code+" - "+name+ "'</i></b> ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        url: "../model/payment_category.php?action=delete",
                        type: 'POST',
                        data: {id: id},
                        success: function(resp){
                            console.log(response);
                            var response = JSON.parse(resp);
                            if(response.status == 1001){
                                Swal.fire({icon:"success", title: "<h3 style='color:green'>Success</h3>", text:"DELETED"});
                                setTimeout(() => {
                                    location.replace('voucher-category-list.php')
                                }, 2000);
                                
                            }else{
                                Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:"COULD NOT BE DELETED... PLEASE TRY AGAIN"});
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


<?php

include 'footer.php';

?>