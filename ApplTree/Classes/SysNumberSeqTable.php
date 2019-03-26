<?php
/**
 * Description of SysNumberSeqTable
 *
 * @author tanzberg
 */
class SysNumberSeqTable extends xTable implements xTblIface
{
    private static $tablename = "SysNumberSeqTable";
    private static $tableId = 18;
    public $recId;
    public $recIdMap;
    
    private $fldNumberSeqFormat;
    private $fldNextNum;
    private $fldNumberSeqLowest;
    private $fldNumberSeqHighest;
    
    
    public function __construct($recId = null, $format = null) {
        try 
        {                  
            $this->initFields();
            $this->recId = $recId;
            $this->recIdMap = new Map();

            parent::__construct(self::$tablename, true); 

            $this->xGenerateFieldSet($this);
            if($recId && $format == null)
            {
                $this->init(); // initiate Single record
            }  
            else if($recId == null && $format)
            {
                $this->formatNum($format);
                $this->findFromFormat();
                if($this->recId)
                    $this->init();
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
        return SysNumberSeqTable::$tableId;
    }
    
    private function initFields() {
        $this->fldNextNum = SysPropertys::fldProp("NEXTNUM", "VARCHAR(50)");
        $this->fldNumberSeqFormat = SysPropertys::fldProp("NUMBERSEQFORMAT", "VARCHAR(50)");
        $this->fldNumberSeqLowest = SysPropertys::fldProp("NUMBERSEQLOWEST", "BIGINT");
        $this->fldNumberSeqHighest = SysPropertys::fldProp("NUMBERSEQHIGHEST", "BIGINT");        
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
        $this->recIdMap = $this->selectAllOrderBy();        
    }
    
    public function insert() {
        return $this->xInsert($this);
    }
    
    public function update(){
        return $this->xUpdate($this);
    }
    
    public function delete() {
        return $this->xDelete($this);
    }
    
    private function findFromFormat() {
        $SQL = new Sql(self::$tablename, true);
        $recId = $SQL->findRecId("SELECT ".SysConstants::sysDbFldIndex." FROM ".self::$tablename." WHERE ".$this->fldNumberSeqFormat[sysFldName]." = '".$this->formatNum()."' LIMIT 1");
        if($recId) {
            $this->recId = $recId;
        }
    }
    
    
    
    public function nextNum($nextNum = null) {
        if($nextNum != null) {
            $this->fldNextNum[sysFldValue] = $nextNum;
        }
        
        return $this->fldNextNum[sysFldValue];
    }
    
    
    public function formatNum($format = null) {
        if($format != null) {
            $this->fldNumberSeqFormat[sysFldValue] = $format;
        }
        
        return $this->fldNumberSeqFormat[sysFldValue];
    }
    
    
    public function lowestNum($lowestNum = null) {
        if($lowestNum != null) {
            $this->fldNumberSeqLowest[sysFldValue] = $lowestNum;
        }
        
        return $this->fldNumberSeqLowest[sysFldValue];
    }
    
    public function highestNum($highestNum = null) {
        if($highestNum != null) {
            $this->fldNumberSeqHighest[sysFldValue] = $highestNum;
        }
        
        return $this->fldNumberSeqHighest[sysFldValue];
    }
    
    
    public static function newNum($format) {
        $SEQ = new SysNumberSeqTable(null, $format);
        $SEQ->formatNum($format);
        $num = str_replace("#", "0", $SEQ->formatNum());
        $realNum = substr($num, 1);
        
        $SEQ->highestNum(999999);
        $SEQ->lowestNum(100000);
        
        if($realNum < $SEQ->lowestNum()) {
            $realNum = $SEQ->lowestNum() + 1;
        }
        
        if($realNum >= $SEQ->highestNum()) {
            throw new Exception("Number Sequence is out of range!");
        }
        
        if(!$SEQ->nextNum()) {
            $SEQ->nextNum(substr($SEQ->formatNum(), 0, 1) . "".$realNum);
        } else {
            // Num +1
            $nextNum = $SEQ->nextNum();
            $realNum = null;
            $realNum = substr($nextNum, 1) + 1;           
            $SEQ->nextNum(substr($SEQ->formatNum(), 0, 1) . "".$realNum);
        }
                        
        if($SEQ->recId)
        {
            $SEQ->update();
        }
        else
        {
            $SEQ->insert();
        }
        return $SEQ->nextNum();
    }
    
}
