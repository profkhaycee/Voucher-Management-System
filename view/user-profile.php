<?php

include '../controller/controller.php';

$page_title = "Create Voucher Payment Category";

include 'header.php';
// include '../controller/session.php';

include 'sidenav.php';

// var_dump($_SESSION);
// var_dump($_SESSION['last_activity']);
// var_dump(time());
// var_dump(time() - $_SESSION['last_activity']);
if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    //  echo "<script> alert('--- YOU HAVE BEEN LOGGED OUT DUE TO INACTIVITY  ---- ') ; location.replace('logout.php'); </script>";  ?>
    <script> 
         Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:'YOU HAVE BEEN LOGGED OUT DUE TO INACTIVITY'}) ; 
         setTimeout(() => {location.replace('logout.php'); }, 3000);
     </script>
                  
     <?php 
     exit; 
  }
  $_SESSION['last_activity'] = time(); 

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
                <div class="my-3 px-3 pb-5" style="border-bottom: 3px solid lightgray">
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
                            
                            <div class="col-lg-6 ">
                                <div class="mb-3">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input id="phone" name="phone" value="<?=$user['phone']?>" placeholder="Enter Phone Number" required type="tel" class="form-control" minlength='11' maxlength='11'>
                                </div>
                            </div>

                            
                        </div>
                        
                        <div class="hstack gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">UPDATE PROFILE</button>
                        </div>
                        
                    </form>

                
                </div>
                <div class="row my-5 px-2">
                    <div class="col-lg-6">
                        <form id="signature-form" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="signature" class="form-label fs-24">Upload / Change Signature </label>
                                <input name="signature" id="img-signature"  class ="form-control" required type="file" accept="image/*">
                                <h6 class="text-danger ">Note: signature image must not be more than 2MB</h6>
                            </div>
                            <div class="mb-3">
                                <?php if(trim($user['signature']) == ''){
                                    echo '<p style="height: 50px; width: 200px; border: 1px dashed darkgray; " class="text-center pt-2 no-sign">  no signature </p>';
                                    echo '<p id="img-wrapper"><img id="img-preview" width="200" height="70" ></p>';
                                }else{
                                    echo "showv image";
                                    echo '<p><img id="img-preview" width="200" height="70" src="'.$user['signature'].'"></p>';
                                } 
                                ?>
                                <p id="feedback"></p>
                                
                            </div>
                            <div class="hstack gap-2 mt-3">
                                <button type="submit" class="btn btn-primary" id="upload-signature">UPLOAD</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){

        $("#img-wrapper #img-preview").hide();

        $("#img-signature").on('change',function(){
            $(".no-sign").hide();

            var image = new FileReader();
            image.onload = function(e){
                $("#img-preview").show();
                $("#img-preview").attr('src', e.target.result);
            }
            image.readAsDataURL(this.files[0]);

            var size = ((this.files[0].size)/1000000).toFixed(2)  ;
            if(size <= 2){
                var classx = "bg-primary-subtle text-primary";
                $("#upload-signature").attr('disabled', false);
            }else{
                var classx =  "bg-danger-subtle text-danger" ;
                $("#upload-signature").attr('disabled', true);
                $(this).val('');
            }
            $("#feedback").html("<span class='p-2 "+classx+"'>file size : "+ size +" MB </span>");

        });

        // $("#upload-signature").click(function(){
        $("#signature-form").on('submit',function(e){
            e.preventDefault();

            // var firstname = '<?//=$user['first_name']?>';
            // var id = <?//=$user['id']?>;

            var datat = new FormData($("#signature-form")[0]);

            $.ajax({
                url:"../model/user.php?action=upload_signature",
                // dataType: 'json',
                type: 'POST',
                contentType: false,
                processData: false,
                // data: {first_name: firstname, id:id},    
                data: datat,
                success: function(res){
                    console.log(res);
                    var response = JSON.parse(res);
                    if(response.status == 1001){
                        Swal.fire({icon:"success", title: "<h3 style='color:green'>Success</h3>", text:response.message});
                        setTimeout(() => {
                            location.replace('../view/user-profile.php?id='+id)
                        }, 3000);
                        
                    }else{
                        Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:response.message});
                    }
                },
                error: function(xhr, status, error){
                    Swal.fire({icon:"error", title: "<h3 style='color:red'>"+status+"</h3>", text:error});
                }

            })
        })



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
                                location.replace('../view/user-profile.php?id=<?=$user['id']?>')
                            }, 3000);
                            
                        }else{
                            Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:response.message});
                        }
                    },
                    error: function(xhr, status, error){
                        Swal.fire({icon:"error", title: "<h3 style='color:red'>"+status+"</h3>", text:error});
                    }

                })
            
        })
    })


</script>


<?php

include 'footer.php';

?>
