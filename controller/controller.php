<?php
session_start();
// include 'session.php';

 ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class Controller extends mysqli{

    function __construct() {
        parent::__construct("localhost:8889","test","","vm_portal");
    }

    public function validateInput($input){
        $valid_input = trim($input);
        $valid_input = stripslashes($input);
        $valid_input = strip_tags($input);
        $valid_input = htmlspecialchars($input);
        $valid_input = $this->real_escape_string($input);

        return $valid_input;        
    }

    public function createVoucherCategory($code, $name){
        return $this->query("insert into payment_category (code, name) values('$code', '$name')");

    }

    public function fetchVoucherCategory($id){
        $where = is_numeric($id) ? " where id = $id " : " ";
        $result = $this->query("select id, code, name from payment_category $where ORDER BY id DESC");
        $data = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }else{
            return "No Data to fetch";
        }
    }

    public function createVoucher($payee_name, $payee_email, $payee_phone, $payee_address, $voucher_date, $payment_category, $voucher_type, $amount, $vat, $wht, $stamp_duty, $net_amount, $initiator, $initiator_comment){
        $voucher_no = $this->generateVoucherNo();
        $sql = "INSERT INTO `voucher`(`payee_name`, `payee_email`, `payee_phone`, `payee_address`, `voucher_no`, `voucher_date`,  `payment_category`, `voucher_type`, `amount`, `vat`, `wht`, `stamp_duty`, `net_amount`, `initiator`,  `initiator_comment`) 
                    VALUES('$payee_name', '$payee_email', '$payee_phone', '$payee_address', '$voucher_no', '$voucher_date', $payment_category, '$voucher_type', $amount, $vat, $wht, $stamp_duty, $net_amount, $initiator, '$initiator_comment') ";
        $result = $this->query($sql);
        return $result;

    }


    public function editVoucher($voucher_id, $payee_name, $payee_email, $payee_phone, $payee_address, $voucher_date, $payment_category, $voucher_type, $amount, $vat, $wht, $stamp_duty, $net_amount, $initiator, $initiator_comment){
        $sql = " UPDATE `voucher` SET `payee_name`='$payee_name',`payee_address`='$payee_address',`payee_email`='$payee_email',`payee_phone`='$payee_phone', `voucher_date`='$voucher_date',`voucher_type`='$voucher_type',`payment_category`=$payment_category,`amount`=$amount,`vat`=$vat,`wht`=$wht,`stamp_duty`=$stamp_duty,`net_amount`=$net_amount,`initiator_comment`='$initiator_comment' where id = $voucher_id ";
        $result = $this->query($sql);
        return $result;
    }


    public function updateVoucherLevel($voucher_id, $user, $level, $reason, $date){
        if($level == 2){
            // $sql = "update voucher set reviewer = $user, approval_level = $level, date_reviewed = '$date', reviewer_comment='$comment' where id = $voucher_id";
            $sql = "update voucher set reviewer = $user, approval_level = $level, date_reviewed = '$date' where id = $voucher_id";
        }elseif($level == 3){
            // $sql = "update voucher set approver = $user, approval_level = $level, date_approved = '$date', approver_comment='$comment' where id = $voucher_id";
            $sql = "update voucher set approver = $user, approval_level = $level, date_approved = '$date' where id = $voucher_id";
        }elseif($level == 4){
            $sql = "update voucher set rejected_by = $user, approval_level = $level, date_rejected = '$date', reject_reason='$reason' where id = $voucher_id";
        }
        $result = $this->query($sql);
        return $result;
    }

    public function fetchVoucher($id){
        $where = is_numeric($id) ? " where id = $id " : " ";
        $result = $this->query("select * from voucher $where ORDER BY id DESC");
        $data = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }else{
            return "No Data to fetch";
        }
    }

    public function generateVoucherNo(){
        $result = $this->query("select id from voucher order by id desc limit 1");
        if($result->num_rows > 0){
            $id = $result->fetch_assoc()['id'];
        }else{
            $id = 0;
        }

        $id++;
        if(strlen($id) == 1){
            $voucher_no = "VOU-0000".$id;
        }elseif(strlen($id) == 2){
            $voucher_no = "VOU-000".$id;
        }elseif(strlen($id) == 3){
            $voucher_no = "VOU-00".$id;
        }elseif(strlen($id) == 4){
            $voucher_no = "VOU-0".$id;
        }elseif(strlen($id) == 5){
            $voucher_no = "VOU-".$id;
        }else{
            $voucher_no = "VOU-";
        }

        return $voucher_no;
        
    }

    public function fetchUserType($id){
        $where = is_numeric($id) ? " where id = $id " : " ";
        $result = $this->query("select id, name from user_type $where ORDER BY id ASC");
        $data = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }else{
            return "No Data to fetch";
        }
    }

    public function createUser($firstname, $lastname, $email, $phone, $password, $userType, $imgPath){
        $sql = " INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `phone`, `user_type`, `signature`) VALUES ('$firstname', '$lastname', '$email', '$password', '$phone', $userType, '$imgPath' ) ";
        $result = $this->query($sql);
        return $result;
    }

    public function login($email, $password){
        // $pwd = password_verify($password, )
        $response = $this->checkUserExist($email);
        if($response['status'] === true){
            $user = $response['data'];
            $pwd = $user['password'];
            if($password == $pwd){
                // session_start();
                $_SESSION = $user;
                $_SESSION['last_activity'] = time();
                // $_SESSION['isAdmin'] = $user['isAdmin'];
                // $_SESSION['password_changed'] = $user['isLoggedIn'];
                // $_SESSION['user_id'] = $user['id'];

                return ['status'=>1001, 'message'=>'Login Successfull'];
            }else{
                // echo "<script> alert('INVALID PASSWORD') ; location.replace('../view/login.php'); </script>";
                return ['status'=> 4002, 'message'=>'Invalid Password'];
            }
        }else{
            // echo "<script> alert('Email does not exist on this platform') ; location.replace('../view/login.php'); </script>";
            return ['status'=> 4004, 'message'=>'Email does not exist on this platform'];
        }
        // $result = $this->query("select * from users where email = '$email' and password = '$password' ");
        // if($result->num_rows > 0){
        // }else{
        //     return false;
        // }
    }

    public function updatePassword($password, $user_id){
        $result = $this->query(" update users set password = '$password', password_changed = 1 where id = $user_id ");
        return $result;
    }

    public function checkUserExist($email){
        $result = $this->query("select * from users where email = '$email' ");
        if($result->num_rows > 0){
            return ['status'=>true, 'data'=>$result->fetch_assoc()];
        }else{
            return ['status'=>false, 'data'=>NULL];
        }
    }

    public function fetchUser($id){
        $where = is_numeric($id) ? " where  id = $id " : " ";
        $result = $this->query("select * from users $where  ORDER BY id DESC");
        $data = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }else{
            return "No Data to fetch";
        }
    }

    public function fetchJournalReport(){
        $result = $this->query(" select * from voucher where is_paid = 1 order by created_at desc ");
        $data = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }else{
            return "No Data to fetch";
        }


    }

    


}


$action = new Controller();


?>