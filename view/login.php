<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Voucher Portal - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Voucher Management System" name="description" />
    <meta content="Stephen Kelechi Emmanuel" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/logo-dark.png">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    

     <!--- sweetalert  --->
     <link rel="stylesheet" href="assets/libs/sweetalert2/sweetalert2.min.css">
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>


</head>

    <body class="auth-bg 100-vh">
        <div class="bg-overlay bg-light"></div>
    
        <div class="account-pages">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-2">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100 py-0 py-xl-2">
    
                                    <div class="text-center mb-3">
                                        <a href="#">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo-dark.png" alt="" height="60" width="80">
                                            </span>
                                        </a>
                                        <h2 class="mt-3">NIGERIA ARABIC LANGUAGE VILLAGE, NGALA</h2>
                                        <p>(Inter-University Centre for Arabic Studies)</p>
                                    </div>
                                    

                                    <div class="card my-auto overflow-hidden">
                                        <div class="row g-0">
                                            <div class="p-5">
                                                <div class="text-center">
                                                    <h5 class="mb-0">Welcome Back !</h5>
                                                    <p class="text-muted mt-2">Sign in to Access the Voucher Portal</p>
                                                </div>
                                            
                                                <div class="mt-4">
                                                    <!-- <form action="../model/user.php?action=login" class="auth-input" method="POST"> -->
                                                    <form id="login-form">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" name="email" required  id="email" placeholder="Enter Email address">
                                                        </div>
                                
                                                        <div class="mb-2">
                                                            <label for="userpassword" class="form-label">Password</label>
                                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                                <input type="password" class="form-control pe-5 password-input" name="password" required placeholder="Enter password" id="password" minlength='5'>
                                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="las la-eye align-middle fs-18"></i></button>
                                                            </div>
                                                        </div>
            
                                                        <!-- <div class="form-check form-check-primary fs-16 py-2">
                                                            <input class="form-check-input" type="checkbox" id="remember-check">
                                                            <div class="float-end">
                                                                <a href="#" class="text-muted text-decoration-underline fs-14">Forgot your password?</a>
                                                            </div>
                                                            <label class="form-check-label fs-14" for="remember-check">
                                                                Remember me
                                                            </label>
                                                        </div> -->
            
                                                        <div class="mt-2">
                                                            <button class="btn btn-primary w-100" type="submit">Log In</button>
                                                        </div>
            
                                                       
                                                    </form>
                                                </div>
                            
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card -->
                                    
                                    <div class="mt-5 text-center">
                                        <p class="mb-0 text-muted">©
                                            <?php echo date('Y') ?> © Voucher Management <i class="mdi mdi-heart text-danger"></i> Designed & Developed by App Realms
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>

    <script>
        $(document).ready(function(){
            $("#login-form").on('submit',function(e){
                e.preventDefault();
                var datat = new FormData($("#login-form")[0]);
                // var datat = new FormData(this);
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
        })
    </script>

</body>


</html>