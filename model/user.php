<?php

include '../controller/controller.php';

// echo json_encode($_POST); echo json_encode($_FILES); exit;
$response = [];
if($_GET['action'] == 'create'){

   /**** UPLOAD SIGNATURE IMAGE AND GET PATH */
   
   $targetDir = "../uploads/signatures/";
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
                  $firstname = $action->validateInput($_POST['first_name']);
                  $lastname = $action->validateInput($_POST['last_name']);
                  $email = $action->validateInput($_POST['email']);
                  $phone = $action->validateInput($_POST['phone']);
                  $userType = $action->validateInput($_POST['user_type']);
                  $password = '12345';
                  // $path = $targetDir.$_FILES["signature"]['name'];

                  $result = $action->createUser($firstname, $lastname, $email, $phone, $password, $userType, $targetFile );
                  if($result === true){
                     $message = "USER CREATED SUCCESFULLY";
                     $status = 1001;
                  }else{
                     $message = "USER COULD NOT BE CREATED.... SOMETHING WENT WRONG";
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

   echo json_encode($response); return;
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
   
   echo json_encode($response); return;

   
}


?>