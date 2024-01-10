<?php

include '../controller/controller.php';

if(isset($_POST['category_code']) && isset($_POST['category_name'])){
    $code = $_POST['category_code'];
    $name = $_POST['category_name'];

    $response =$action->createVoucherCategory($code, $name);

    if($response === true){
        echo "<script> alert('CATEGORY ADDED SUCCESSFULLY') ; location.replace('../view/voucher-category-list.php') </script>";
        
    }else{
        echo $action->error;
    }
}else{
    echo "<script> alert('CATEGORY COULD NOT BE ADDED') </script>";
}

?>