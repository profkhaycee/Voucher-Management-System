
<?php

include '../controller/controller.php';

$page_title = "Journal Report";

include 'header.php';
include '../controller/session.php';

include 'sidenav.php';

$response = $action->fetchJournalReport();
// echo json_encode($_SESSION) . "<hr>"; echo $_SESSION['last_activity'] - time();
if(is_array($response)){
    $tbody = " ";
    foreach($response as $data){
        if($data['voucher_type'] == 'Debit'){
            $paid = '<b>Paid To : '.$data['payee_name'] .'</b>'; 
            $debit = '₦'. number_format($data['net_amount']);
        }else{
            $debit = ' ';
        }
        if($data['voucher_type'] == 'Credit'){
            $paid = '<b>Received From : '.$data['payee_name'].'</b>';
            $credit = '₦'. number_format($data['net_amount']);
        }else{
            $credit = ' ';
        }
        // $debit = ($data['voucher_type'] == 'Debit') ? $to = 'Paid To: '; '₦'. number_format($data['net_amount']) : ' ';
        // $credit = ($data['voucher_type'] == 'Credit') ? '₦'. number_format($data['net_amount']) : ' ';
        
        $tbody .= '<tr>
                        
                        <td>'.$data['voucher_date'].'</td>
                        <td><p>'.$paid.'</p><p>'.$data['initiator_comment'].'</p></td>
                        <td>'.$debit.'</td>
                        <td>'.$credit.'</td>
                        
                    </tr>';
    }

}else{
    $tbody = "<tr> NO DATA TO FETCH </tr>";
}


?>


<div class="row">
    <div class="col-xl-12">
        <div class="card mx-5">
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-hover table-striped table-bordered table-nowrap align-middle mb-0 p-1">
                        <thead class="table-dark">
                            <tr class="text-muted text-uppercase">
                                <!-- <th style="width: 50px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th> -->
                                <th scope="col">Voucher Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th> 
                            </tr>
                        </thead>

                        <tbody>
                            <?php echo $tbody ; ?>
                            
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