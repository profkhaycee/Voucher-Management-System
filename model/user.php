<?php

include '../controller/controller.php';

// echo json_encode($_POST); echo json_encode($_FILES); exit;
$response = [];
if($_GET['action'] == 'create' || $_GET['action'] == 'edit'){

   $firstname = $action->validateInput($_POST['first_name']);
   $lastname = $action->validateInput($_POST['last_name']);
   $email = $action->validateInput($_POST['email']);
   $phone = $action->validateInput($_POST['phone']);
   $userType = isset($_POST['user_type']) ? $action->validateInput($_POST['user_type']) : null ;
   $password = '12345';

   if($_GET['action'] == 'create'){
      $result = $action->createUser($firstname, $lastname, $email, $phone, $password, $userType );
      $str = "CREATED";
   }elseif($_GET['action'] == 'edit'){
      $str = "UPDATED";
      $result = $action->updateUser($firstname, $lastname, $email, $phone, $_SESSION['id']);
   }
 
   if($result === true){
      $message = "USER PROFILE $str SUCCESFULLY";
      $status = 1001;
      
   }else{
      $message = "USER PROFILE COULD NOT BE $str .... SOMETHING WENT WRONG";
      $status = 4002;
      $response['actual_error'] = $action->error;
   }
               

   $response['message'] = $message;
   $response['status'] = $status;

   // echo json_encode($response); return;
   //    if($response === true){
   //       echo "<script> alert('User Created SUCCESSFULLY') ; location.replace('../view/user-list.php') </script>";
   //   }else{
   //       echo $action->error;
   //   }

}

if($_GET['action'] == 'login'){
   $email = $action->validateInput($_POST['email']);
   $password = $action->validateInput($_POST['password']);

   $response = $action->login($email, $password);
   
   // echo json_encode($response); return;
   
}

if($_GET['action'] == 'change_password'){
   $password = $action->validateInput($_POST['password']);
   $user_id = $_POST['id'];
   // echo json_encode($_POST); exit;
   $result = $action->updatePassword($password, $user_id);
   if($result === true){
      $response['status'] = 1001;
      $response['message'] = "Password Changed Successfully";
      // $_SESSION['password_changed'] = 1;
   }else{
      $response['status'] = 5017;
      $response['message'] = "Password could not be changed. Pls Try Again";
      $response['actual_error'] = $action->error;
   }

}

if($_GET['action'] == 'upload_signature'){

    /**** UPLOAD SIGNATURE IMAGE AND GET PATH */
    $firstname = $_SESSION['first_name'];
   // $firstname = $action->validateInput($_POST['first_name']);
   // $user_id = $_POST['id'];
    $targetDir = "../uploads/signatures/$firstname-";
    $targetFile = $targetDir . basename($_FILES["signature"]["name"]);
    // $status = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowed = array('jpeg', 'png', 'jpg');
 
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["signature"]["tmp_name"]);
    if($check !== false) {
       // Check if file already exists
       if(!file_exists($targetFile)) {
          // Check file size. ensure its not greater than 2MB
          if($_FILES["signature"]["size"] <= 2097152) {
             // Allow certain file formats
             if(in_array($imageFileType, $allowed)){
                if(move_uploaded_file($_FILES["signature"]["tmp_name"], $targetFile)) {
                   
                   // $path = $targetDir.$_FILES["signature"]['name'];
 
                   $result = $action->updateSignature($targetFile, $_SESSION['id']);
                   if($result === true){
                      $message = "SIGNATURE UPDATED SUCCESFULLY";
                      $status = 1001;
                     $_SESSION['signature'] = $targetFile;
                   }else{
                      $message = "SIGNATURE COULD NOT BE UPDATED.... SOMETHING WENT WRONG";
                      $status = 4002;
                      $response['actual_error'] = $action->error;
                   }
                } else {
                   $message = "Sorry, there was an error uploading your signature Image... Please Try Again";
                   $status = 4009;
                }
             }else{
                $message = "Sorry, only JPG, JPEG, PNG image files are allowed.";
                $status = 4008;
             }
          }else{
             $message = "Sorry, your file is too large.";
             $status = 4007;
          }
       }else{
          $message ="Sorry, signature image already exists.";
          $status = 4006;
       }
    }else{
       $message = "File is not an image.";
       $status = 4003;
    }
 
    $response['message'] = $message;
    $response['status'] = $status;
}


if($_GET['action'] == 'activate'){
   $user_id = $_POST['id'];
   if($_POST['action_type'] == 'Enable'){
      $isActive = 1;
   }elseif($_POST['action_type'] == 'Disable'){
      $isActive = 0;
   }

   $result = $action->activateUser($isActive, $user_id);
   if($result === true){
      $response['status'] = 1001;
      $response['message'] = "User Profile ".$_POST['action_type']."d";
   }else{
      $response['status'] = 5021;
      $response['message'] = "User Profile could not be ".$_POST['action_type']."d. Pls Try Again";
      $response['actual_error'] = $action->error;
   }
}

if($_GET['action'] == 'reset-password'){
   $result = $action->resetPassword($_POST['id']);
   if($result === true){
      $response['status'] = 1001;
      $response['message'] = "Password Reset Successful ";
   }else{
      $response['status'] = 5021;
      $response['message'] = "Password Could Not Be Reset. Pls Try Again";
      $response['actual_error'] = $action->error;
   }
}

echo json_encode($response); return;


?>