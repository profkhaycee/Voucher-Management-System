<?php

include '../controller/controller.php';

$page_title = "Create User";

include 'header.php';
include 'sidenav.php';

?>


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0"><?= $page_title ?></h4>
        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="p-2">
                <form>
                    <div class="mb-3">
                        <label class="form-label" for="productname">Product Name</label>
                        <input id="productname" name="productname" placeholder="Enter Product Name" type="text" class="form-control">
                    </div>
                    
                    <div class="dropzone mb-3">
                        <div class="fallback">
                            <input name="file" type="file" multiple="multiple">
                        </div>
                        <div class="dz-message needsclick">
                            <div class="mb-3">
                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                            </div>

                            <h4>Drop files here or click to upload.</h4>
                        </div>
                    </div>

                    <ul class="list-unstyled" id="dropzone-preview">
                        <li class="mt-2" id="dropzone-preview-list">
                            <!-- This is used as the file preview template -->
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
                    </ul>
                    <!-- end dropzon-preview -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="brand">Product Brand</label>
                                <input id="brand" name="brand" placeholder="Enter Product Brand" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="price">Product Price</label>
                                <input id="price" name="price" placeholder="Enter Price" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="choices-single-default" class="form-label">Category</label>
                                <select class="form-select" data-trigger name="choices-single-category"
                                    id="choices-single-category">
                                    <option value="SL">Select</option>
                                    <option value="EL">Electronic</option>
                                    <option value="FA">Fashion</option>
                                    <option value="FI">Fitness</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="choices-single-specifications" class="form-label">Specifications</label>
                                <select class="form-select" data-trigger name="choices-single-category"
                                    id="choices-single-specifications">
                                    <option value="HI" selected>High Quality</option>
                                    <option value="LE" selected>Leather</option>
                                    <option value="NO">Notifications</option>
                                    <option value="SI">Sizes</option>
                                    <option value="DI">Different Color</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="productdesc">Product Description</label>
                        <textarea class="form-control" id="productdesc" placeholder="Enter Description" rows="4"></textarea>
                    </div>
                </form>

                <div class="hstack gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-light">Discard</button>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php

include 'footer.php';

?>
