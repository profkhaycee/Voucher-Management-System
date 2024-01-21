<?php

include '../controller/controller.php';

// if(isset($_POST['category_code']) && isset($_POST['category_name'])){
$code = $action->validateInput($_POST['category_code']);
$name = $action->validateInput($_POST['category_name']);

$response = [];
if($_POST['action'] = 'create'){
    // $result = $action->createVoucherCategory($code, $name);
}elseif($_POST['action'] = 'edit'){
    $result = $action->editVoucherCategory($code, $name, $_POST['id']);
}
$result = true;
if($result === true){
    $response['status'] = 1001;
    // $response['msg'] = "CATEGORY ADDED SUCCESSFULLY";
    // echo "<script> alert('CATEGORY ADDED SUCCESSFULLY') ; location.replace('../view/voucher-category-list.php') </script>";
    
}else{
    $response['status'] = 4005;
    $response['error_msg'] = $action->error;
}
// }else{
//     echo "<script> alert('CATEGORY COULD NOT BE ADDED \n\n INVALID DATA') </script>";
// }

echo json_encode($response); return;

?>