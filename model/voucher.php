<?php

include '../controller/controller.php';

$resp = [];
if($_GET['action'] == 'create'){
    // echo 
    // print_r($_POST); 
    // print_r($_FILES); //exit;
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
    $initiator = $_SESSION['id'];
    $initiator_comment = $action->validateInput($_POST['initiator_comment']);
    $voucher_no = $action->generateVoucherNo();
    $doc1 = ''; $doc2 = ''; $doc3 = ''; $doc4 = ''; 
    $num = 0; $upload_error = false; $upload_arr = [];

    foreach($_FILES as $name=>$value){
        if($value['error'] == 4){continue;}
        $num++;
        // echo $name." : "; echo " name-> ". $value['name']; echo " size-> ". $value['size'];
        
        
        $targetDir = "../uploads/attached-documents/";
        $filename = "$voucher_no-doc$num";
        $imageFileType = strtolower(pathinfo($value['name'], PATHINFO_EXTENSION));

        $targetFile = $targetDir . $filename. ".$imageFileType";
        // $status = 1;
        $allowed = array('jpeg', 'png', 'jpg', 'pdf', 'doc', 'docx');
        // echo "<hr>". $imageFileType;
        // echo "<hr>". $targetFile;
        // echo "<hr><br><hr>";
        
        // Check file size. ensure its not greater than 2MB
        if($value['size'] <= 2097152) {
            // Allow certain file formats
            if(in_array($imageFileType, $allowed)){
                $upload_arr[] = ['temp_path'=>$value["tmp_name"], 'perm_path'=>$targetFile]; 
            }else{
                // echo "good path";
                // echo "document-$num Error -> Sorry, only JPG, JPEG, PNG, DOCX, DOC, PDF image files are allowed.";
                $message = "document-$num Error -> Sorry, only JPG, JPEG, PNG, DOCX, DOC, PDF image files are allowed.";
                $status = 4008; $upload_error = true;
                break;
            }
        }else{
            // echo "document-$num Error -> Sorry, your file is too large. It must be less than or equal to 2MB";
            $message = "document-$num Error -> Sorry, your file is too large. It must be less than or equal to 2MB";
            $status = 4007; $upload_error = true;
            break;
        }
    }

    // echo json_encode($upload_error); 

    if($upload_error === false){
        for($i = 0; $i < count($upload_arr); $i++){
            // echo "<hr>".json_encode($upload_arr[$i])."</hr>";
            if(move_uploaded_file($upload_arr[$i]["temp_path"], $upload_arr[$i]["perm_path"])){
                // echo $upload_arr[$i]["perm_path"]. " --upload succsessful---<hr>";
                if($i == 0){$doc1 = $upload_arr[$i]["perm_path"];}
                elseif($i == 1){$doc2 = $upload_arr[$i]["perm_path"];}
                elseif($i == 2){$doc3 = $upload_arr[$i]["perm_path"];}
                elseif($i == 3){$doc4 = $upload_arr[$i]["perm_path"];}
            }else{
                $message = "document-$i Error -> Something went wrong..pls contact administrator";
                $status = 4009;
            }
        }

        $response = $action->createVoucher($payee_name, $payee_email, $payee_phone, $payee_address, $voucher_no, $voucher_date, $payment_category, $voucher_type, $amount, $vat, $wht, $stamp_duty, $net_amount, $initiator, $initiator_comment, $doc1, $doc2, $doc3, $doc4);
        // echo $response; exit;
        if($response === true){
            $resp['message'] = "VOUCHER  HAS BEEN CREATED SUCCESSFULLY";
            $resp['status'] = 1001;
            //  echo "<script> alert('VOUCHER HAS BEEN REVIEWED SUCCESSFULL') ; location.replace('../view/voucher-list.php') </script>";
        }else{
            $resp['message'] = "VOUCHER COULD NOT BE CREATED";
            $resp['status'] = 4018;
            $resp['actual_error'] = $action->error;
        }

        // echo $doc1, $doc2, $doc3, $doc4; exit;      
        
    }else{
        $resp['message'] = $message;
        $resp['status'] = $status;
    }
    // exit;

    
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
    $initiator = $_SESSION['id'];
 
    // $initiator_comment = empty($action->validateInput($_POST['initiator_comment']) ? NULL : $action->validateInput($_POST['initiator_comment']);
    $initiator_comment = $action->validateInput($_POST['initiator_comment']);


    $response = $action->editVoucher($voucher_id,$payee_name, $payee_email, $payee_phone, $payee_address, $voucher_date, $payment_category, $voucher_type, $amount, $vat, $wht, $stamp_duty, $net_amount, $initiator, $initiator_comment);
    // echo $response; exit;
    if($response === true){
        $resp['message'] = "VOUCHER EDITED SUCCESSFULLY";
        $resp['status'] = 1001;
        //  echo "<script> alert('VOUCHER HAS BEEN REVIEWED SUCCESSFULL') ; location.replace('../view/voucher-list.php') </script>";
    }else{
        $resp['message'] = "VOUCHER COULD NOT BE EDITED";
        $resp['status'] = 4019;
        $resp['actual_error'] = $action->error;
    }
    
}elseif(in_array($_GET['action'], ['reviewed', 'approved', 'rejected'])){
    if($_GET['action'] == 'reviewed'){$level = 2; $act = "REVIEWED";}
    if($_GET['action'] == 'approved'){$level = 3; $act = "APPROVED";}
    if($_GET['action'] == 'rejected'){$level = 4; $act = "REJECTED";}

    // exit(json_encode(["action"=>$_GET['action'],"level"=>$level, "act"=>$act]));
    $voucher_id = $_GET['id'];
    $voucher_no = $_POST['voucher_no'];
    $date = date("Y-m-d H:i:s");
    $reason = isset($_POST['reject_reason']) ? $_POST['reject_reason'] : '' ;
    $response = $action->updateVoucherLevel($voucher_id, $_SESSION['id'], $level, $reason, $date);
    if($response === true){
        $resp['message'] = "VOUCHER - $voucher_no HAS BEEN $act";
        $resp['status'] = 1001;
        //  echo "<script> alert('VOUCHER HAS BEEN REVIEWED SUCCESSFULL') ; location.replace('../view/voucher-list.php') </script>";
    }else{
        $resp['message'] = "VOUCHER COULD NOT BE $act";
        $resp['status'] = 4012;
        $resp['actual_error'] = $action->error;
    }

}



echo json_encode($resp);


?>