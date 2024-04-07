<?php
include_once('include/func_genralfunc_.php');
include('../adodb/adodb-php/adodb.inc.php');
include_once('Lib/connect.php');



class RequestPayment extends MainConnect {

private $username;
private $userpass;

function __construct($username, $szpassword){

    $this->username = $username;
	$this->userpass = $szpassword;

        parent::__construct($username, $szpassword);
        parent::set_dbuserName($username);
        parent::set_dbpassword($szpassword);
    }


function requestPayment($company, $amount, $currency, $name, $email, $contact){

  $db = new connection($this->username, $this->userpass);
  $conn = $db->mysql_conn();

  $unique_token = uniqid("REQPAY", true);
  $payment_url = "http://192.168.0.174:8002/Request_payment/payment.php?token=" . urlencode($unique_token);
  //echo $payment_url;

  $strSQL[0] = "insert into users(name, email, contact, company) values ('$name','$email','$contact','$company')";
  $strSQL[1] = "insert into payment_requests(requester_id, amount, currency, unique_token, payment_url) values ((select id from users where email = '$email'),'$amount','$currency','$unique_token','$payment_url')";
  $retval = $db->RunSQLWithTrans($strSQL);
  return $retval;
}


public function GetRequestDetailsFromToken($token){

  $db = new Connection($this->username, $this->userpass);
  $conn = $db->mysql_conn();

  $strSQL = "select a.id, a.company, a.name, b.requester_id ,b.amount, b.currency, b.unique_token from  users a, payment_requests b where a.id = b.requester_id and b.unique_token = '$token'"; 
  //$conn->debug = true;
  $retdata = $conn->Execute($strSQL);
  if($retdata){
    $retArray = $retdata->GetArray();
  }
  return $retArray;

}













  


}