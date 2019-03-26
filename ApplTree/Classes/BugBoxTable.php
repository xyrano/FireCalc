<?php
/**
 * Description of BugBoxTable
 *
 * @author tanzberg
 */
class BugBoxTable extends xTable implements xTblIface
{
    private static $tablename = "BugBoxTable";
    private static $tableId = 2;
    public $recId;
    public $recIdMap;
    
    private $fldMessage;    // Landkreis in dem der Wettbewerb stattfindet
    
    
    public function __construct($recId = null) {
        try 
        {                  
            $this->initFields();
            $this->recId = $recId;
            $this->recIdMap = new Map();

            parent::__construct(self::$tablename, true); 

            $this->xGenerateFieldSet($this);
            if($recId)
            {
                $this->init(); // initiate Single record
            }  
            else
            {
                $this->initAll();
            }          
        } 
        catch (Exception $ex) 
        {
            throw new Exception($ex);
        }
    }
    
    public static function tableId() {
        return BugBoxTable::$tableId;
    }
    
    private function initFields() {        
        $this->fldMessage = SysPropertys::fldProp("MESSAGE", "TEXT");        
    }
    
    
    public function init($recId = null) {
        if($recId != null)
        {
            $this->recId = $recId;
        }
        if($this->recId == "" || $this->recId == null)
        {
            echo "init not possible!<br>". __CLASS__ ."/". __METHOD__ ."";
        }
        else
        {
            $this->xInit($this);
        }
    }
    
    
    private function initAll() {
        $this->recIdMap = $this->selectAllOrderBy("ORDER BY ".SysConstants::sysSqlCreatedDateTime."");
    }
    
    
    public function insert() {
        try
        {                         
            return $this->xInsert($this);
        }
        catch(Exception $ex)
        {
            //echo str_replace("\n", "<br>", $ex->getTraceAsString());
            throw new Exception($ex->getMessage());            
        }
    }
    
    public function update(){
        try
        {           
            return $this->xUpdate($this);
        }
        catch(Exception $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    
    public function delete() {
        try
        {           
            return $this->xDelete($this);
        }
        catch(Exception $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    
    
    public function message($message = null) {
        if($message != null) {
            $this->fldMessage[sysFldValue] = $message;
        }
        
        return $this->fldMessage[sysFldValue];
    }

}
