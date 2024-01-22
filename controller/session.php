<?php
// session_start();

$timeout = 3000; // 

if(isset($_SESSION['email'])){

  if(isset($_SESSION['password_changed']) && $_SESSION['password_changed'] == 0){
    $url = "change-password.php?id=". $_SESSION['id'];
    ?>
    <script> 
      Swal.fire({icon:"error", title: "<h3 style='color:red'>Default Password Not Changed</h3>", text:'PLEASE CHANGE DEFAULT PASSWORD'}) ; 
      setTimeout(() => {location.replace('<?= $url ?>'); }, 3000);
    </script>
              
    <?php 
    exit; 
  }

  if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    //  echo "<script> alert('--- YOU HAVE BEEN LOGGED OUT DUE TO INACTIVITY  ---- ') ; location.replace('logout.php'); </script>";  ?>
    <script> 
         Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:'YOU HAVE BEEN LOGGED OUT DUE TO INACTIVITY'}) ; 
         setTimeout(() => {location.replace('logout.php'); }, 3000);
     </script>
                  
     <?php 
     exit; 
  }
  $_SESSION['last_activity'] = time();

}else{ 
  // header("Location: login.php?session=expire");

  // echo "<script> alert('--- Please log in to access this page  ---- ') ; location.replace('logout.php'); </script>"; 
  // echo "<script> alert('--- Please log in to access this page  ---- ') ; location.href = 'logout.php?session=expire'; </script>"; ?>

  <script> 
         Swal.fire({icon:"error", title: "<h3 style='color:red'>Error</h3>", text:'Please log in to access this page'}) ; 
         setTimeout(() => {location.replace('logout.php'); }, 3000);
     </script>
<?php exit;
}



/*


// if($_SESSION['isLoggedIn'] != 1){
//     echo "<script> alert('YOU HAVE NOT CHANGED YOUR DEFAULT PASSWORD') ; location.replace('change-password.php'); </script>";
// }


*/

?>

