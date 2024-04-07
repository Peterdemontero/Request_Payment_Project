<?php
include('../adodb/adodb-php/adodb.inc.php');

class connections{

function connection()
{
}

function mysql_conn()
{
	$db = ADONewConnection('mysql'); 
		
	$db->Connect('localhost','peterdemontero', '61997','Rpayment_db');	
	            
 return $db;
 }
 
 

 function RunSQL($strSQL =""){
   
     $conn = $this->mysql_conn();
	 //$conn->debug =true;
	 $ok = $conn->Execute($strSQL);
	 
	 //return $ok;
	if(!$ok)
	 {
	   return -1;
	 }else{ 
	    return 1;
	}
	   
}

function RunSQLRetRC($strSQL = "")
{
    $conn = $this->mysql_conn();
	 //$conn->debug =true;
	 $rs = $conn->Execute($strSQL);
	 
	 return $rs->RecordCount();
}

//This is KD function
function RunSQLRetRS($strSQL = "")
{
    $conn = $this->mysql_conn();
	 //$conn->debug =true;
	 $rs = $conn->Execute($strSQL);
	 
	 return $rs;
}


function RunSQLRetRSRow($strSQL = "")
{
    $conn = $this->mysql_conn();
	 //$conn->debug =true;
	 $rs = $conn->Execute($strSQL);
	 
	 if($rs->RecordCount() <= 0)
	 {
	   return -1;
	    
	   }
	    else{ 
	 return $rs->FetchRow();
	 }
}


function RunSQLRetRSArray($strSQL = "")
{
    $conn = $this->mysql_conn();
	 //$conn->debug =true;
	 $rs = $conn->Execute($strSQL);
	 
	if($rs->RecordCount() <= 0)
	 {
	   return -1;
	   }
	    else{ 
	 return $rs->GetArray();
	 }
}

function RunSQLWithTrans($strSQL="")
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
  

 
}

?>