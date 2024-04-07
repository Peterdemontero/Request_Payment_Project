<?php 

include('../adodb/adodb-php/adodb.inc.php');
include_once("_logger_.php");
include_once("_databasetranslogger_.php");




$func = new databaseTransLogger('peterdemontero','61997');

$func->set_dbserverName('localhost');
$func->set_databaseName('Rpayment_db');


$conn = $func->mysql_conn();
//var_dump($conn);

// Check connection status
if ($conn instanceof mysqli) {
    echo "Connection successful!";
} else {
    echo "Failed to connect to the database.";
}