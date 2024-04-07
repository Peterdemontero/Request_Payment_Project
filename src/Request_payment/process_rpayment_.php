<?php


include_once("Lib/connect.php");
include_once("include/func_genralfunc_.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $company  = $_POST["company"];
    $amount   = $_POST["amount"];
    $currency = $_POST["currency"];
    $name     = $_POST["name"];
    $email    = $_POST["email"];
    $contact  = $_POST["contact"];
    

    // Create an instance of Request_Payment class
    $func = new RequestPayment('', '');
    // $func->set_dbserverName('localhost');
    // $func->set_databaseName('Rpayment_db');
    //var_dump($func);

    // Call the requestPayments method to insert data into the database
    $rt = $func->requestPayment($company, $amount, $currency, $name, $email, $contact);
    if ($rt === 1) {
        echo '{"success": true, "message": "Payment Request Successful"}';
    } else {
        echo '{"success": false, "errors": {"reason": "Failed to process payment request"}}';
    }
// }

}
?>
