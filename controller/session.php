<?php
session_start();

$timeout = 6000; // 

if(isset($_SESSION['email'])){

  if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
     echo "<script> alert('--- YOU HAVE BEEN LOGGED OUT DUE TO INACTIVITY  ---- ') ; location.replace('logout.php'); </script>";  
    // <script> 
    //      Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:'YOU HAVE BEEN LOGGED OUT DUE TO INACTIVITY'}) ; 
    //      setTimeout(() => {location.replace('logout.php'); }, 3000);
    //  </script>
                  
    // <?php 
    // exit; 
  }
}else{ 
  
  echo "<script> alert('--- Please log in to access this page  ---- ') ; location.replace('logout.php'); </script>"; 
//   <script> 
//          Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:'Please log in to access this page'}) ; 
//          setTimeout(() => {location.replace('logout.php'); }, 3000);
//      </script>
// <?php exit;
}
  $_SESSION['last_activity'] = time();



/*


// if($_SESSION['isLoggedIn'] != 1){
//     echo "<script> alert('YOU HAVE NOT CHANGED YOUR DEFAULT PASSWORD') ; location.replace('change-password.php'); </script>";
// }


*/

?>

