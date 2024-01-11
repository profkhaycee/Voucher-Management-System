<?php
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

    public function validate($textInput){
        $textInput = trim($textInput);
        $textInput = stripslashes($textInput);
        $textInput = strip_tags($textInput);
        $textInput = htmlspecialchars($textInput);
        $textInput = $this->connect->real_escape_string($textInput); 

    
        return $textInput;
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

    public function createVoucher($payee_name, $payee_email, $payee_phone, $payee_address, $voucher_date, $payment_category, $voucher_type, $amount, $vat, $wht, $stamp_duty, $net_amount, $initiator_comment){
        $voucher_no = $this->generateVoucherNo();
        $initiator = 1;
        $sql = "INSERT INTO `voucher`(`payee_name`, `payee_email`, `payee_phone`, `payee_address`, `voucher_no`, `voucher_date`,  `payment_category`, `voucher_type`, `amount`, `vat`, `wht`, `stamp_duty`, `net_amount`, `initiator`,  `initiator_comment`) 
                    VALUES('$payee_name', '$payee_email', '$payee_phone', '$payee_address', '$voucher_no', '$voucher_date', $payment_category, '$voucher_type', $amount, $vat, $wht, $stamp_duty, $net_amount, $initiator, '$initiator_comment') ";
        $result = $this->query($sql);
        // return $result;
        return $sql;

    }


    public function editVoucher($voucher_id, $payee_name, $payee_email, $payee_phone, $payee_address, $voucher_date, $payment_category, $voucher_type, $amount, $vat, $wht, $stamp_duty, $net_amount, $initiator_comment){
        $sql = " UPDATE `voucher` SET `payee_name`='$payee_name',`payee_address`='$payee_address',`payee_email`='$payee_email',`payee_phone`='$payee_phone', `voucher_date`='$voucher_date',`voucher_type`='$voucher_type',`payment_category`=$payment_category,`amount`=$amount,`vat`=$vat,`wht`=$wht,`stamp_duty`=$stamp_duty,`net_amount`=$net_amount,`initiator_comment`='$initiator_comment' where id = $voucher_id ";
        $result = $this->query($sql);
        // return $result;
        return $sql;
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



}


$action = new Controller();


?>