

    </div>
    <!-- container-fluid -->
</div>
    <!-- End Page-content -->

<!-- @include('layout.footer') -->

<footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <?php echo date('Y') ?> © Voucher Management
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Designed & Developed by App Realms
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top"><i class="ri-arrow-up-line"></i></button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
<div id="status">
    <div class="spinner-border text-primary avatar-sm" role="status"><span class="visually-hidden">Loading...</span></div>
</div>
</div>


<!-- <script>Swal.fire("this is a test alert")</script> -->


<!-- JAVASCRIPT -->
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/plugins.js"></script>
 <!-- password-addon init -->
 <script src="assets/js/pages/password-addon.init.js"></script>

 <!-- number to words -->
 <script src="assets/libs/multilingual-number-to-word/jquerySpellingNumber.js"></script>


<!-- apexcharts -->
<!-- <script src="assets/libs/apexcharts/apexcharts.min.js"></script> -->

<!-- Vector map-->
<!-- <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="assets/libs/jsvectormap/maps/world-merc.js"></script> -->

<!-- Dashboard init -->
<!-- <script src="assets/js/pages/dashboard.init.js"></script> -->

   <!-- dropzone js -->
   <!-- <script src="assets/libs/dropzone/dropzone-min.js"></script>

<script src="assets/js/pages/ecommerce-product-create.init.js"></script> -->

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script> -->
<script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

<script>

    // $(".selector").flatpickr(optional_config);
    $(".flatpickr-input").flatpickr();

    $('.table-responsive .table-hover').DataTable({
        fixedHeader: {
            header: true,
            footer: true
    }
    });
</script>


</body>

</html>