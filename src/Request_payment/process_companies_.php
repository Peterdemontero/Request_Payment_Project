<?php

include_once("Lib/connect.php");
include_once("include/func_genralfunc_.php");


$func = new RequestPayment('peterdemontero', '61997');

$rt = $func->GetCompany();
//var_dump($rt);



// if($_SERVER["REQUEST_METHOD" ] = "GET"){

//    // $company = $_GET['company'];




// }