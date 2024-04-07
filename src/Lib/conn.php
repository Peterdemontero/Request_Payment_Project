<?php 
// Include necessary files
include('../adodb/adodb-php/adodb.inc.php');
include_once("_logger_.php");
include_once("_databasetranslogger_.php");



// Start session (if not already started)
@session_start();




// Create an instance of databaseTransLogger class
$logger = new databaseTransLogger('peterdemontero', '61997');

// Set database connection parameters
$logger->set_dbserverName('localhost');
$logger->set_databaseName('Rpayment_db');
// You may not need to set these if you're using environment variables ($_ENV)

// Call the mysql_conn() method to establish a connection
$conn = $logger->mysql_conn();
//var_dump($conn);

// Check if connection was successful
if ($conn === -1) {
    echo "Failed to connect to the database.";
} else {
    echo "Connected to the database successfully.";

    // Now you can run your other operations that require database connection

    // Don't forget to close the connection when you're done
    $conn->Close();
}




// $strSQL[0] = "insert into Test_db(name, amount, currency, email, contact, company) values ('$name','$amount','$currency','$email','$contact','$company')";
  
// $retval = $logger->RunSQLWithTrans($strSQL);
// return $retval;





?>