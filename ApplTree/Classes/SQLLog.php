<?php
/**
 * Description of SQLLog
 *
 * @author tanzberg
 */
class SQLLog 
{
    private $filename;
    private $statement;
    private $dateTime;
    private $user;
    private $tableName;
    private $tableId;
    private $recId;
    
   
    
    /**
     * Create And Updates a LOG
     * @param type $_sqlStatement
     * @param type $_on Parm to activate an logging
     */
    public static function createOrUpdate($_sqlStatement, $_on = false) {
        if($_on)
        {
            $LOG = new SQLLog();
            $LOG->statement = $_sqlStatement;
            $LOG->dateTime = DateTimeUtil::currentDateTime(DateTimeUtil::dateTimePattern);
            $LOG->user = Obj::user()->username();
            $LOG->tableName = "";
            $LOG->tableId = "";
            $LOG->recId = "";
            $LOG->createLogFile();
            $LOG->writeLog();
        }
    }
    
    private function createLogFile() {
        $this->filename = "LOG_".DateTimeUtil::currentDateTime(DateTimeUtil::datePattern);
        if(!file_exists($this->filename)) {
            mkdir($this->filename, 0777, true);
        }
        $this->filename .= "/log_".DateTimeUtil::currentDateTime(DateTimeUtil::datePattern).".log";
    }
    
    private function writeLog() {
        $logStr = $this->dateTime . " - " . $this->user . " - " . $this->tableName . " - " . $this->tableId . " - " . $this->recId . " - " . $this->statement . "\r\n"; 
        file_put_contents($this->filename, $logStr, FILE_APPEND);
        chmod($this->filename, fileperms($this->filename) | 128 + 16 + 2);
    }
}
