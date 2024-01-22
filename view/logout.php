<?php
if($_GET['session']=='expire'){
    echo "<script> alert('--- Please log in to access this page  ---- ') ; </script>";
}
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>
