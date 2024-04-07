<?php
// Include the necessary files if not already included
// include('../adodb/adodb-php/adodb.inc.php');
// include_once("_databasetranslogger_.php");

class RequestPayment extends databaseTransLogger {
    private $dbLogger;

    public function __construct($username, $password) {
        $this->dbLogger = new databaseTransLogger($username, $password);
        parent::__construct($username, $password);
    }

//     public function requestPayment($company, $amount, $currency, $name, $email, $contact) {

//         $conn = $this->dbLogger->mysql_conn();
//         if ($conn === -1) {
//             echo "Failed to connect to the database.";
//             return false;
//         }
        
//         $sql = "insert into Test_db(name,amount,currency,email,contact,company) Values('$name','$amount','$currency','$email','$contact','$company')";
//         $stmt = $conn->Prepare($sql);
//         $params = array($name, $amount, $currency, $email, $contact, $company);

//         $result = $conn->Execute($sql, $params);

//         // Check if query execution was successful
//         if ($result === false) {
//             echo "Failed to insert payment request.";
//             return false;
//         }

//         $conn->Close();
//         return true; // Payment request inserted successfully

public function requestPayment($company, $amount, $currency, $name, $email, $contact) {
    $conn = $this->dbLogger->mysql_conn();
    if ($conn === -1) {
        echo "Failed to connect to the database.";
        return false;
    }

    $sql = "INSERT INTO Test_db (name, amount, currency, email, contact, company) VALUES ('$name','$amount','$currency','$email','$contact','$company')";
    $stmt = $conn->Prepare($sql);
    if (!$stmt) {
        echo "Failed to prepare the SQL statement.";
        $conn->Close();
        return false;
    }

    $params = array($name, $amount, $currency, $email, $contact, $company);
    $result = $conn->Execute($stmt, $params);

    // Check if query execution was successful
    if ($result === false) {
        echo "Failed to insert payment request.";
        $conn->Close();
        return false;
    }

    $conn->Close();
    return true; // Payment request inserted successfully
}

//     }
 }


?>
