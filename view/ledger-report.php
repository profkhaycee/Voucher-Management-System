
<?php

include '../controller/controller.php';

$page_title = "Ledger Report";

include 'header.php';
include '../controller/session.php';

include 'sidenav.php';

$from_date = isset($_GET['from_date'])  ? $_GET['from_date'] : '';
$to_date = isset($_GET['to_date'])  ? $_GET['to_date'] : '';
$category = isset($_GET['payment_category'])  ? $_GET['payment_category'] : '';


// $response = $action->fetchVoucher('all');
$response = $action->fetchVoucherReport($from_date, $to_date, $category);
// echo json_encode($_SESSION) . "<hr>"; echo $_SESSION['last_activity'] - time();
// echo json_encode($response);

if(is_array($response)){
    $tbody = " "; $arr_debit = []; $arr_credit = []; $total_debit = 0; $total_credit = 0;
    foreach($response as $data){
        if($data['voucher_type'] == 'Debit'){
            $debit = '₦'. number_format($data['net_amount']);
            $arr_debit[] = floatval($data['net_amount']);
            // $total_debit = $total_debit + floatval($data['net_amount']);
        }else{
            $debit = ' ';
            $total_debit = 0;
        }
        if($data['voucher_type'] == 'Credit'){
            $credit = '₦'. number_format($data['net_amount']);
            $arr_credit[] = floatval($data['net_amount']);
            // $total_credit += floatval($data['net_amount']);
        }else{
            $credit = ' ';
            $total_credit = 0;
        }
        // $debit = ($data['voucher_type'] == 'Debit') ? '₦'. number_format($data['net_amount']) : ' ';
        // $credit = ($data['voucher_type'] == 'Credit') ? '₦'. number_format($data['net_amount']) : ' ';

        $cat = $action->fetchVoucherCategory($data['payment_category']);
        $cat_str = $cat[0]['code']. " - ". $cat[0]['name'];
        
        $tbody .= '<tr>
                        
                        <td>'.$data['voucher_date'].'</td>
                        <td>'.$data['voucher_no'].'</td>
                        <td>'.$cat_str.'</td>
                        <td>'.$data['payee_name'].'</td>

                        <td>'.$debit.'</td>
                        <td>'.$credit.'</td>
                        
                    </tr>';
        
    }

    $total_credit = array_sum($arr_credit);
    $total_debit = array_sum($arr_debit);

}else{
    $tbody = "<tr> NO DATA TO FETCH </tr>";
}


?>


<div class="row">
    <div class="col-xl-12">
        <div class="card mx-5">
            <div class="card-body">
                <form class="filter-report mb-5 mt-2" style="border: 2px solid lightgray" action="ledger-report.php" method="get">
                    <h3 class="text-center my-2 fw-bold">Filter Report</h3>
                    <div class="row mx-1 my-3">
                        <div class="col-lg-4">
                            <div class="mb-2">
                                <label for="date-field">From Date:</label>
                                <input type="date" class="form-control bg-light border-0 flatpickr-input" name="from_date" id="" data-provider="flatpickr" data-time="true" placeholder="Select from Date">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2">
                                <label for="date-field">To Date:</label>
                                <input type="date" class="form-control bg-light border-0 flatpickr-input" name="to_date" id="date-field" data-provider="flatpickr" data-time="true" placeholder="Select To Date">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="payment-category">Payment category</label>
                            <div class="input-light">
                                <select class="form-control bg-light border-0 w-100" data-choices data-choices-search-false id="payment-category" name="payment_category" >
                                    <option value="" selected>Select Payment Category</option>
                                    <?php foreach($action->fetchVoucherCategory('all') as $data){
                                        echo "<option value='".$data['id']."'> ".$data['code']." - ".$data['name']." </option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="hstack gap-2 my-4 justify-content-center">
                        <button type="submit" class="btn btn-primary px-4">FILTER</button>
                    </div>
                </form>
                <div class="table-responsive table-card">
                    <table class="table table-hover table-striped table-bordered table-nowrap align-middle mb-2 p-1">
                        <thead class="table-dark">
                            <tr class="text-muted text-uppercase">
                                <!-- <th style="width: 50px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th> -->
                                <th scope="col">Voucher Date</th>
                                <th scope="col">Voucher No.</th>
                                <th scope="col">Category</th>
                                <th scope="col">Payee</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th> 
                            </tr>
                        </thead>

                        <tbody>
                            <?php echo $tbody ; ?>
                            
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><h4>Total</h4></th>
                            <th><h4>₦<?=number_format($total_debit)?></h4></th>
                            <th><h4>₦<?=number_format($total_credit) ?></h4></th>
                        </tfoot><!-- end tbody -->
                    </table><!-- end table -->
                </div><!-- end table responsive -->
            </div>
        </div>
    </div>
</div>


     

<?php

include 'footer.php';

?>