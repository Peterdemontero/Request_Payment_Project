
<?php

class logger {


    public static function createReportFile($reportfilePath=""){

            if(!file_exists($reportfilePath)){
                @mkdir($reportfilePath, 0777, true);
            }else{
                ///
            }

    }

    public static function createLogFile($logFIlePath="", $filename=""){

        @$logfile = $logFIlePath . "Report";
        if(!file_exists($logfile)){
            @mkdir($logfile, 0777, true);
        }

        $filename = $logFIlePath ." / ". $filename;

        $eXist = logger::FileExist($filename);
        if($eXist == false){
            $create = fopen($filename, 'w');
        }

        return $filename;
    }

    public static function createFile($logFIlePath="", $filename=""){

        @$logfile = $logFIlePath . "Report";
        if(!file_exists($logfile)){
            @mkdir($logfile, 0777, true);
        }

        $filename = $logFIlePath ." / ". $filename;

        $eXist = logger::FileExist($filename);

        if($eXist == false){

            $create = fopen($filename, 'w');
        }

        return $filename;

    }

    public static function FileExist($filename=""){
        if(file_exists($filename)){
            return true;
        }else{
            return false;
        }
    }

    public static function LogSQLFile($fileName="",$data=""){

        @$Hndl = fopen($fileName,'a');
        @fwrite($Hndl,$data,strlen($data));
        //echo "Success, wrote ($data) to file ($fileName)";
        @fclose($Hndl);

    }




}





?>