<?php
session_start();


if(isset($_SESSION['email']) ){
    header("location:view/voucher-list.php");
}else{
    header("location:view/login.php");
}



?>