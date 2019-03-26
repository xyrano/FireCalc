<?php

/**
 * Description of UserOnline
 *
 * @author tanzberg
 */
class UserOnline extends SysTable
{
    public $tableName       = "UserOnline";
    
    /**
     * Hold the User RecId
     * @var int User RecId
     */
    public $fldUserRecId    = FLDREFRECID;
    
    /**
     * Hold the Username
     * @var str UserName
     */
    public $fldUserName     = FLDUSERNAME;
    
    /**
     * Hold the RecId of Record
     * @var int RecId
     */
    public $fldRecId        = FLDRECID;
    
    /**
     * Hold the session Id
     * @var str Session ID
     */
    public $fldSessionId    = FLDSESSIONID;
        
    
    /**
     * construct an new Obj
     * @param int $recId RecId
     */
    public function __construct($recId = null) {
        parent::__construct();
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }
    }
    
    
    /**
     * Get the TableNum
     * @return int TableNum
     */
    public static function tableId() {
        return tablenum(new UserOnline());
    }
    
    
    /**
     * Get UserOnline Obj
     * @return \UserOnline UserOnline Obj
     */
    public static function find() {
        if(!isset($_SESSION)) 
        {
            session_start();
        }
        $username = @$_SESSION[SysConstants::sysUsername];
        $sessionId = @$_SESSION[SysConstants::sysSessionId];
        
        if($username && $sessionId)
        { 
            $T = new UserOnline();
            $T->query = "SELECT ".$T->fldRecId[FLDNAME]." FROM ".$T->tableName." WHERE ".$T->fldUserName[FLDNAME]." = '".$username."' AND ".$T->fldSessionId[FLDNAME]." = '".$sessionId."'";
            $ret = $T->fetchCounted();
            $recId = $ret[$T->fldRecId[FLDNAME]];
            
            /* Nicht nutzbar da bei Anmeldung noch kein Online User vorhanden ist
            if(!$recId)
                throw new Exception("Cannot resolve any RecId for User " . __METHOD__);
            */
            
            return new UserOnline($recId);
        }
        else
        {
            return new UserOnline();
        }        
    }
}






//class UserOnline_OLD extends xTable implements xTblIface
//{
//    private static $tablename = "UserOnline";
//    private static $tableId = 15;
//    private $fldUserRecId;
//    private $fldUserName;
//    private $fldSessionId;
//    public $recId;
//    public $recIdMap;
//    
//    
//    public function __construct($recId = null) {
//        $this->initFields();
//        $this->recId = $recId;
//        $this->resultMap = new Map();
//        parent::__construct(self::$tablename, true);   
//        $this->xGenerateFieldSet($this);
//        if($recId)
//        {
//            $this->init(); // initiate Single record
//        }  
//        else
//        {
//            $this->initAll();
//        }
//    }
//    
//    public static function tableId() {
//        return UserOnline::$tableId;
//    }
//    
//    private function initFields()
//    {
//        $this->fldUserName = SysPropertys::fldProp("Username", "VARCHAR(20)");
//        $this->fldUserRecId = SysPropertys::fldProp("UserRecId", "INT(10)");
//        $this->fldSessionId = SysPropertys::fldProp("SessionId", "VARCHAR(60)");
//    }
//    
//    
//    public function username($username = null) {
//        if($username != null) {
//            $this->fldUserName[sysFldValue] = $username;
//        }
//        
//        return $this->fldUserName[sysFldValue];
//    }
//    
//    
//    public function userRecId($userRecId = null) {
//        if($userRecId != null) {
//            $this->fldUserRecId[sysFldValue] = $userRecId;
//        }
//        
//        return $this->fldUserRecId[sysFldValue];
//    }
//    
//    public function sessionId($sessionId = null) {
//        if($sessionId != null) {
//            $this->fldSessionId[sysFldValue] = $sessionId;
//        }
//        
//        return $this->fldSessionId[sysFldValue];
//    }
//    
//    
//    public static function find() {                
//        if(!isset($_SESSION)) 
//        {
//            session_start();
//        }
//        $username = @$_SESSION[SysConstants::sysUsername];
//        $sessionId = @$_SESSION[SysConstants::sysSessionId];
//        
//        if($username && $sessionId)
//        { 
//            $T = new UserOnline(); // For Field purposes only
//            $SQL = new SQL(self::$tablename, true);
//            $rec = $SQL->findRecId("SELECT ".SysConstants::sysFldPrimaryKey." FROM ".self::$tablename." WHERE ".$T->fldUserName[sysFldName]." = '".$username."' AND ".$T->fldSessionId[sysFldName]." = '".$sessionId."'");
//            if($rec)
//            {
//                return new UserOnline($rec);
//            }
//            else
//            {
//                return new UserOnline();
//            }
//        }
//        else
//        {
//            return new UserOnline();
//        }
//    }
//    
//    
//    private function initAll() {
//        $this->recIdMap = $this->selectAllOrderBy(" ORDER BY ".$this->fldUserName[sysFldName]." "); 
//    }
//    
//    public function init($recId = null) {
//        if($recId != null)
//        {
//            $this->recId = $recId;
//        }
//        if($this->recId == "" || $this->recId == null)
//        {
//            echo "init not possible!<br>". __CLASS__ ."/". __METHOD__ ."";
//        }
//        else
//        {
//            $this->xInit($this);
//        }
//    }
//    
//    public function insert(){
//        $this->xInsert($this);
//    }
//    
//    public function update(){
//        $this->xUpdate($this);
//    }
//    
//    
//    private function validateDelete() {
//        if($this->isValueEmpty($this->recId))
//        {
//            throw new Exception("Record cannot be deleted because no ID was given! (".__CLASS__.".".__FUNCTION__."())");
//        }
//    }
//    
//    public function delete() {
//        try
//        {
//            $this->validateDelete();
//            $this->xDelete($this);
//        }
//        catch(Exception $ex)
//        {
//            throw new Exception("Error while deleting a record: <br>".$ex->getMessage());
//        }
//    }
//    
//}
