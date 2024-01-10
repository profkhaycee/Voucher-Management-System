<?php
 ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class Controller extends mysqli{

    function __construct() {
        parent::__construct("localhost:8889","test","","vm_portal");
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



}


$action = new Controller();


?>