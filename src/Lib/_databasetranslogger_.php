<?php
@session_start();

include('../adodb/adodb-php/adodb.inc.php');
include_once("_logger_.php");
@include_once("../defines/defines.php");




class databaseTransLogger{

    private $usename;
	private $_databaseName;
	private $_dbserverName;
	private $_dbuserName;
	private $_dbpassword;

function __construct($username, $password)
    {
        $this->_dbuserName = $username;
        $this->_dbpassword = $password;
    }

    function get_databaseName(){

        return $this->_databaseName;
    }

function set_databaseName($_databaseName){

    return $this->_databaseName = $_databaseName;
}

function get_dbserverName(){

    return $this->_dbserverName;
}

function set_dbserverName($_dbserverName){

    return $this->_dbserverName = $_dbserverName;
}


function get_dbuserName(){

    return $this->_dbuserName;
}

function set_dbuserName($_dbuserName){

    return $this->_dbuserName = $_dbuserName;
}

function get_dbpassword(){

    return $this->_dbpassword;
}

function set_dbpassword($_dbpassword){

    return $this->_dbpassword = $_dbpassword;
}


function mysql_conn()
{
	$host     = $_ENV['DB_HOST'];
	$database = $_ENV['DATABASE'];
	$user     = $_ENV['DB_USER']; 
	$password = $_ENV['DB_PASSWORD'];
	$port     = $_ENV['DB_PORT'];
     
	//echo $host."<br>".$database."<br>".$user."<br>".$password."<br>".$port;
	 try{
		// $driver = 'mysqli';
		// $DSN    = "root:2p@ssw0rd_2@localhost/ikolilu_db";
		// $db     = adoNewConnection($driver . '://' . $DSN);

	    $db = adoNewConnection('mysqli'); 
		
		$hostport =  $host.':'.$port;
		$db->Connect($hostport,$user,$password,$database);
	
		//var_dump($db);
	  }catch(Exception $e)
		  {
			 echo $e;
			  return -1;
		  }          
 return $db;


}

function RunSQLWithTrans($strSQL)
{
   $conn = $this->mysql_conn();
	//$conn->debug = true;
	 $conn->StartTrans();
	 
	  for($j=0;$j<count($strSQL);$j++){
	    $conn->Execute($strSQL[$j]);
		   $CheckRecord = $conn->HasFailedTrans();
		   if($CheckRecord){
		       $conn->FailTrans();
		       $conn->CompleteTrans();
		    return -1;
		   }
		}
		
	 $conn->CompleteTrans();
     return 1;  	   
 }

 function RunSQLWithTransTest($strSQL,$op="",$username="")
{ 
   $date     = date("Ymd");
   $file =  $date.".sql";
   //$file = "../Logs/".$filename;
  @$filename = logger::createLogFile(LOGFILEPATH,$file);
    $conn = $this->mysql_conn();
	 $conn->StartTrans();
	  for($j=0;$j<count($strSQL);$j++)
	  {
		 /* if($strSQL[$j] == NULL || $strSQL[$j] == "" || $strSQL[$j] == '')
		  {
			  continue;
		  }*/
		   $conn->debug = true;
	       $conn->Execute($strSQL[$j]);
		   $CheckRecord = $conn->HasFailedTrans();
		   if($CheckRecord){
		       $conn->FailTrans();
		       //$conn->CompleteTrans();
		    return -1;
		   }
		   @$str    =  $strSQL[$j].";^".$_SESSION['userid']."^".date('Y-m-d H:i:s').PHP_EOL;
	 	   logger::LogSQLFile($filename,$str);	
		}
	  //$conn->debug = true;
	 $conn->CompleteTrans();
	 
	// $this->LoggTransactions(date("h:i:s A"),date("F j Y"),$username,$strSQL);
	 
     return 1;  	   
 }


 }
 
  













































