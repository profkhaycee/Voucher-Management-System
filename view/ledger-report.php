
<?php

include '../controller/controller.php';

$page_title = "Journal Report";

include 'header.php';
include '../controller/session.php';

include 'sidenav.php';

$response = $action->fetchVoucher('all');
// echo json_encode($_SESSION) . "<hr>"; echo $_SESSION['last_activity'] - time();
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