<?php

include('../adodb/adodb-php/adodb.inc.php');
include_once("../Lib/connection.php");



class connection extends MainConnect{


function __construct($username, $szpassword)
{
    parent::__construct($username, $szpassword);
    parent::set_dbuserName($username);
    parent::set_dbpassword($szpassword);

}





}



?>

