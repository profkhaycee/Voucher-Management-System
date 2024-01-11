<?php

include '../controller/controller.php';

if($_GET['action'] == 'create'){
    // echo "create"; exit;
    $payee_name = $action->validateInput($_POST['payee_name']);
    $payee_email = $action->validateInput($_POST['payee_email']);
    $payee_phone = $action->validateInput($_POST['payee_phone']);
    $payee_address = $action->validateInput($_POST['payee_address']);
    $voucher_date = $action->validateInput($_POST['voucher_date']);
    $payment_category = $action->validateInput($_POST['payment_category']);
    $voucher_type = $action->validateInput($_POST['voucher_type']);
    $amount = $action->validateInput($_POST['amount']);
    $vat = $action->validateInput($_POST['vat']);
    $wht = $action->validateInput($_POST['wht']);
    $stamp_duty = $action->validateInput($_POST['stamp_duty']);
    $net_amount = $action->validateInput($_POST['net_amount']);
    // $initiator_comment = empty($action->validateInput($_POST['initiator_comment']) ? NULL : $action->validateInput($_POST['initiator_comment']);
    $initiator_comment = $action->validateInput($_POST['initiator_comment']);


    $response = $action->createVoucher($payee_name, $payee_email, $payee_phone, $payee_address, $voucher_date, $payment_category, $voucher_type, $amount, $vat, $wht, $stamp_duty, $net_amount, $initiator_comment);
    // echo $response; exit;
    if($response === true){
        echo "<script> alert('VOUCHER ADDED SUCCESSFULLY') ; location.replace('../view/voucher-list.php') </script>";
        
    }else{
        echo $action->error;
    }
}elseif($_GET['action'] == 'edit'){
    $voucher_id = $_GET['id'];
    // echo "edit voucher -- $voucher_id"; exit;
    $payee_name = $action->validateInput($_POST['payee_name']);
    $payee_email = $action->validateInput($_POST['payee_email']);
    $payee_phone = $action->validateInput($_POST['payee_phone']);
    $payee_address = $action->validateInput($_POST['payee_address']);
    $voucher_date = $action->validateInput($_POST['voucher_date']);
    $payment_category = $action->validateInput($_POST['payment_category']);
    $voucher_type = $action->validateInput($_POST['voucher_type']);
    $amount = $action->validateInput($_POST['amount']);
    $vat = $action->validateInput($_POST['vat']);
    $wht = $action->validateInput($_POST['wht']);
    $stamp_duty = $action->validateInput($_POST['stamp_duty']);
    $net_amount = $action->validateInput($_POST['net_amount']);
    // $initiator_comment = empty($action->validateInput($_POST['initiator_comment']) ? NULL : $action->validateInput($_POST['initiator_comment']);
    $initiator_comment = $action->validateInput($_POST['initiator_comment']);


    $response = $action->editVoucher($voucher_id,$payee_name, $payee_email, $payee_phone, $payee_address, $voucher_date, $payment_category, $voucher_type, $amount, $vat, $wht, $stamp_duty, $net_amount, $initiator_comment);
    // echo $response; exit;

    if($response === true){
        echo "<script> alert('VOUCHER EDITED SUCCESSFULLY') ; location.replace('../view/voucher-list.php') </script>";
        
    }else{
        echo $action->error;
    }
}


?>