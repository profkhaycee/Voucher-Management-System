<?php

include '../controller/controller.php';


$response = [];

if($_GET['action'] == 'create' || $_GET['action'] == 'edit'){
    $code = $action->validateInput($_POST['category_code']);
    $name = $action->validateInput($_POST['category_name']);

    if($_GET['action'] == 'create'){
        $result = $action->createVoucherCategory($code, $name);
    }
    if($_GET['action'] == 'edit'){
        $result = $action->editVoucherCategory($code, $name, $_POST['id']);
    }
    
}

if($_GET['action'] == 'delete'){
    $result = $action->deleteVoucherCategory($_POST['id']);
}

if($result === true){
    $response['status'] = 1001;
    $response['message'] = "SUCCESSFULL ";
}else{
    $response['status'] = 4005;
    $response['message'] = "error -- something went wrong";
    $response['actual_error'] = $action->error;
} 



echo json_encode($response); return;

?>