<?php
include_once("_logger_.php");
include_once("_databasetranslogger_.php");
//include('../adodb/adodb-php/adodb.inc.php');


class MainConnect extends databaseTransLogger{



function __construct($username,$szpassword)
{

	     parent::__construct($username,$szpassword);
	    // parent::set_dbuserName($username);
	    //parent::set_dbpassword($szpassword);

}

//JQuery JSON Handlers
function RunCodeReturnJsonJQueryData($fields="",$res="")
{
   $col = array();
   $var = array();
   $item = array();
   //col = array("");
  for($i=0;$i<count($res);$i++)
  {
     for($u=0;$u<count($fields);$u++)
	 {
	   if($u == 0)
	   {
	        $var = '"'.$res[$i][$u].'"';
	   }else
	   {
		    $var = $var.',"'.$res[$i][$u].'"';
	   }
	 }
	 	$item[$i] = '['.$var.']';//preg_replace('/"/',' ','['.$var.']');
  }

  $results = '{
                "draw":1,
				"recordsTotal":'.count($item).',
				"recordsFiltered":'.count($item).',
			    "data":[';
  for($m=0;$m<count($item);$m++)
  {
     if($m == 0)
	 {
		$results .= $item[$m];
	 }else
	 {
		$results .= ','.$item[$m];
	 }
  }
    $results .= ']}';

   echo $results;
}
function RunCodeReturnJsonJQuery($fields="",$res="")
{
   $col = array();
   $var = array();
   $item = array();
   //col = array("");
  for($i=0;$i<count($res);$i++)
  {
     for($u=0;$u<count($fields);$u++)
	 {
	   if($u == 0)
	   {
	        $var = "'".$fields[$u]."':'".$res[$i][$u]."'";
	   }else
	   {
		    $var = $var.",'".$fields[$u]."':'".$res[$i][$u]."'";
	   }
	 }
	 	$item[$i] = '{'.$var.'}';
  }

   $results = preg_replace('/"/',' ',json_encode(Array('data'=>$item)));
   $results = str_replace("'",'"',$results);
   echo $results;
   //echo json_encode(Array('aaData'=>$item);
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
  


function RunCodeReturnJsonAB($fields="",$res="")
{
   $col = array();
   $var = array();
   $item = array();
   //col = array("");
  for($i=0;$i<count($res);$i++)
  {
     for($u=0;$u<count($fields);$u++)

	 {
	   if($u == 0)
	   {
	        $var = "'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";
	   }else
	   {
		    $var = $var.",'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";
	   }
	 }

	 	$item[$i] = '{'.$var.'}';
  }
   echo preg_replace('/"/',' ',json_encode(Array('data'=>$item)));
}


function RunCodeReturnJson($fields="",$res="")
{
   $col = array();
   $var = array();

   //col = array("");
   $item = array(); //count($res)
  for($i=0;$i<count($res);$i++)
  {

     for($u=0;$u<count($fields);$u++)
	  {
	   if($u == 0)
	   {
	        $var = "'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";

	   }else
	   {
		    @$var = $var.",'".$fields[$u]."':'".utf8_encode($this->removeQuotesFromString($res[$i][$u]))."'";
	   }
	 }
	 	$item[$i] = '{'.$var.'}';
  }
   echo preg_replace('/"/',' ',json_encode(Array('results'=>$item,'totalCount' => count($item))));
}


function RunCodeReturnJsonMobile($fields="",$res="")
{
   $col = array();
   $var = array();
   $item = array();
   //col = array("");
   $h=0;
  for($i=0;$i<count($res);$i++)
  {
     //$myarray=array();
     for($u=0;$u<count($fields);$u++)
	 {

	   if($u == 0)
	   {
	        $var = "'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";

	   }else
	   {
		    @$var = $var.",'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";
	   }
	 }
	 	$item[$i] = "{".$var."}";
  }

   //$results = json_encode(Array("results"=>$item,"totalCount"=>count($item)));
   //$results = str_replace("'",'"',$results);
   //echo $results;
   $results =  preg_replace("/'/",'"',json_encode(Array("results"=>$item,"totalCount" => count($item))));
   $results = str_replace('"{','{',$results);
   $results = str_replace('}"','}',$results);
   echo $results;
}


function RunCodeReturnJson_Mobile($fields="",$res="")
{
   $col = array();
   $var = array();

   //col = array("");
   $item = array();
  for($i=0;$i<count($res);$i++)
  {

     for($u=0;$u<count($fields);$u++)
	 {
	   if($u == 0)
	   {
	        $var = "'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";

	   }else
	   {
		    @$var = $var.",'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";
	   }


	 }
	 	$item[$i] = '{'.$var.'}';

  }

   echo json_encode(Array('results'=>$item,'totalCount' => count($item)));
}

function RunCodeReturnJson_MobileA($fields="",$res="")
{
   $col = array();
   $var = array();

   //col = array("");
   $item = array();
  for($i=0;$i<count($res);$i++)
  {

     for($u=0;$u<count($fields);$u++)
	 {
	   if($u == 0)
	   {
	        $var = "'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";

	   }else
	   {
		    @$var = $var.",'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";
	   }


	 }
	 	$item[$i] = '{'.$var.'}';

  }

   echo json_encode(Array('results'=>$item,'success'=>true,'totalCount' => count($item)));
}

function RunCodeReturnJsonForAngular($fields="",$res="")
{
  $info = array();
 //col = array("");
 $item = array();

for($i=0;$i<count($res);$i++)
{

   for($u=0;$u<count($fields);$u++)
    {

       $data[$fields[$u]] = $this->removeQuotesFromString($res[$i][$u]);

    }

   $item[] = $data;
}

 echo json_encode($item);
}

function  RunCodeReturnJson_A($fields="",$res="")
{
   $col = array();
   $var = array();

   //col = array("");
   $item = array();
  for($i=0;$i<count($res);$i++)
  {

     for($u=0;$u<count($fields);$u++)
	 {
	   if($u == 0)
	   {
	        $var = "'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";

	   }else
	   {
		    @$var = $var.",'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";
	   }


	 }
	 	$item[$i] = '{'.$var.'}';

  }

   return preg_replace('/"/',' ',json_encode($item));
}



function RunCodeReturnJson_B($fields="",$res="")
{
   $col = array();
   $var = array();

   //col = array("");
   $item = array();
   //$var = "[";
  for($i=0;$i<count($res);$i++)
  {

     for($u=0;$u<count($fields);$u++)
	 {
	   if($u == 0)
	   {
	        $var = $var."'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";

	   }else
	   {
		    @$var = $var.",'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";
	   }


	 }
	 	$item[$i] = '{'.$var.'}';

  }
   //$var = $var."]";

   return preg_replace('/"/',' ',json_encode($item));
}


function RunCodeReturnJsonA($fields="",$res="")
{
   $col = array();
   $var = array();

   //col = array("");
  for($i=0;$i<count($res);$i++)
  {

     for($u=0;$u<count($fields);$u++)
	 {
	   if($u == 0)
	   {
	        $var = "'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";

	   }else
	   {
		    $var = $var.",'".$fields[$u]."':'".$this->removeQuotesFromString($res[$i][$u])."'";
	   }


	 }
	 	$item[$i] = '{'.$var.'}';

  }

   echo preg_replace('/"/',' ',json_encode(Array('data'=>$item)));
}


function RunCodeReturnJsonRC($fields="",$res="")
{
   $col = array();
   $var = array();

   //col = array("");
  for($i=0;$i<count($res);$i++)
  {

     for($u=0;$u<count($fields);$u++)
	 {
	   if($u == 0)
	   {
	        $var = "".$fields[$u].":'".$this->removeQuotesFromString($res[$i][$u])."'";

	   }else
	   {
		    $var = $var.",".$fields[$u].":'".$this->removeQuotesFromString($res[$i][$u])."'";
	   }


	 }
	 	$item[$i] = $var;

  }

   $retval = str_replace('"',' ',json_encode(Array('success'=>true,'data' => $item)));
   $jsonval1 = str_replace('[','{',$retval);
   $jsonval2 = str_replace (']','}',$jsonval1);
   //str_
   return $jsonval2;
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



 function RunSQLWithTransNew($strSQL="",$strSQL1="",$strSQL2="",$strSQLL="")
{
   $conn = $this->mysql_conn();
	//$conn->debug = true;
	 $conn->StartTrans();
	 $filename = logger::createLogFile();

	  for($u=0;$u<count($strSQL);$u++){
	    $conn->Execute($strSQL[$u]);
		   $CheckRecord = $conn->HasFailedTrans();
		   if($CheckRecord){
		       $conn->FailTrans();
		       $conn->CompleteTrans();
		    return -1;
		   }
		    $str    =  $strSQL[$u]."\n";
	 	   logger::LogSQLFile($filename,$str);

		}

		for($m=0;$m<count($strSQLL);$m++){
	    $conn->Execute($strSQLL[$m]);
		   $CheckRecord = $conn->HasFailedTrans();
		   if($CheckRecord){
		       $conn->FailTrans();
		       $conn->CompleteTrans();
		    return -1;
		   }
		    $str    =  $strSQL[$m]."\n";
	 	   logger::LogSQLFile($filename,$str);
		}
	  //$conn->debug = true;
	  for($j=0;$j<count($strSQL1);$j++){
	    $conn->Execute($strSQL1[$j]);
		   $CheckRecord = $conn->HasFailedTrans();
		   if($CheckRecord){
		       $conn->FailTrans();
		       $conn->CompleteTrans();
		    return -1;
		   }
		   $str    =  $strSQL[$j]."\n";
	 	   logger::LogSQLFile($filename,$str);
		}
	//$conn->debug = true;
	 for($k=0;$k<count($strSQL2);$k++){
	    $conn->Execute($strSQL2[$k]);
		   $CheckRecord = $conn->HasFailedTrans();
		   if($CheckRecord){
		       $conn->FailTrans();
		       $conn->CompleteTrans();
		    return -1;
		   }
		  $str    =  $strSQL[$k]."\n";
	 	   logger::LogSQLFile($filename,$str);
		}

	 $conn->CompleteTrans();

     return 1;
 }

function RunSQLWithTransSpecial($strSQL="")
{
   $conn = $this->mysql_conn();
	$filename = logger::createLogFile();//$conn->debug = true;
	 $conn->StartTrans();

	  for($j=0;($j < count($strSQL) - 1);$j++){
		$conn->Execute($strSQL[$j]);
		   $CheckRecord = $conn->HasFailedTrans();
		   if($CheckRecord){
		       $conn->FailTrans();
		       $conn->CompleteTrans();
		    return -1;
		   }
		   $str    =  $strSQL[$j]."\n";
	 	   logger::LogSQLFile($filename,$str);
		}

	 $conn->CompleteTrans();
     return 1;
 }

}

?>
