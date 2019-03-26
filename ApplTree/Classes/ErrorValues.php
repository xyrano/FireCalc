<?php
/**
 * Description of ErrorValues
 *
 * @author tanzberg
 */
class ErrorValues extends SysTable
{
    /**
     * Holds the Tablename
     * @var str TableName
     */
    public $tableName = "ErrorValues";
    
    /**
     * Holds the RecId
     * @var int RecId
     */
    public $fldRecId = FLDRECID;
    
    /**
     * Holds the Contest ID
     * @var int Contest RecId
     */
    public $fldContestId = FLDCONTESTID;
    
    /**
     * Holds the Competition Type<br>
     * A-Teil or B-Teil
     * @var str Competition Type
     */
    public $fldCompetitionType = FLDCOMPETITIONTYPE;
    
    
    /**
     * Holds the Group RecId of an MemberGroup
     * @var int RecId
     */
    public $fldGroupRecId = FLDGROUPID;
    
    
    /**
     * Holds the Error Number
     * @var int Error Number
     */
    public $fldErrorNum = FLDERRORNUM;
    
    
    /**
     * Holds the Error Sub Number<br>
     * its separated by e.g. 10-2-ow... 
     * @var int Error Sub Number
     */
    public $fldErrorSubNum = FLDERRORSUBNUM;
    
    
    /**
     * Holds the Indicator
     * Is it Open Water (ow) or not (ufh)
     * @var str Indicator
     */
    public $fldIndicator = FLDINDICATOR;
    
    
    /**
     * Holds who made this error<br> 
     * @var str Who
     */
    public $fldWho = FLDWHO;
    
    /**
     * Holds the Error Value
     * @var int Error Value
     */
    public $fldErrorValue = FLDERRORVALUE;
    
    
    /**
     * Amount of Errors which made
     * @var int Error Number Amount
     */
    public $fldErrorNumCount = FLDERRORNUMCOUNT;
    
    public $fldCountingType = FLDCOUNTINGTYPE;
    
    
    /**
     * Construct a new Object
     * @param int $recId RecId
     * @param int $groupId GroupRecId
     * @param str $competitionType A-Teil oder B-Teil
     */
    public function __construct($recId = null, $groupId = null, $competitionType = null) 
    {
        parent::__construct();
        if($recId != null && $groupId == null && $competitionType == null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }
        
        if($groupId)
        {
            if(!$competitionType) {
                throw new Exception("CompetitionType have to be declared to get an exclusive map of Errors!");
            }
            $this->fldCompetitionType[FLDVALUE]= $competitionType;
            $this->fldGroupRecId[FLDVALUE] = $groupId;
            $this->initFromGroupRecId();
        }
    }
    
    /**
     * Initiate all Error Value Records based on GroupRecId and CompetitionType (A-Teil oder B-Teil)
     */
    public function initFromGroupRecId() {
        $this->initAll()->where($this->fldGroupRecId[FLDNAME]." = '".$this->fldGroupRecId[FLDVALUE]."'"
                . " AND ".$this->fldCompetitionType[FLDNAME]." = '".$this->fldCompetitionType[FLDVALUE]."'")->fetch();       
    }
    
    /**
     * Gets the TableId
     * @return int TableId
     */
    public static function tableId() {
        return tablenum(new ErrorValues());
    }
    
    /**
     * Find an Record to an specific Recid
     * @param int $recId RecId
     * @return \ErrorValues Record
     */
    public static function findRecId($recId) {
        return new ErrorValues($recId);
    }
    
        
    
    /**
     * get Summary error Points for a group
     * @param int $groupRecId Group RecId
     * @param string $competitionType competitionType (A-Teil or B-teil)
     * @return int sum
     */
    final public static function getSummaryPoints($groupRecId, $competitionType) {
        $T = new ErrorValues();
        $T->query = "SELECT SUM(".$T->fldErrorValue[FLDNAME].") as POINTS "
                . "FROM ".$T->tableName." "
                . "WHERE ".$T->fldGroupRecId[FLDNAME]." = '".$groupRecId."' AND ".$T->fldCompetitionType[FLDNAME]." = '".$competitionType."'";
        $rec = $T->fetchCounted();
        if($rec['POINTS'])
        {
            return $rec['POINTS'];
        }
        
        return 0;
    }
    
    
    /**
     * Find a record which is indentically with same error that should be inserted
     * @return int RecId
     */
    private function findRecIdForDeleting() {
        $T = new ErrorValues();
        $T->query = "SELECT ".$this->fldRecId[FLDNAME]." FROM ".$this->tableName." "
                . "WHERE ".$this->fldCompetitionType[FLDNAME]." = '".$this->fldCompetitionType[FLDVALUE]."' "
                . "AND ".$this->fldGroupRecId[FLDNAME]." = '".$this->fldGroupRecId[FLDVALUE]."' "
                . "AND ".$this->fldCountingType[FLDNAME]." = 'add' "
                . "AND ".$this->fldErrorNum[FLDNAME]." = '".$this->fldErrorNum[FLDVALUE]."'"
                . "AND ".$this->fldErrorSubNum[FLDNAME]." = '".$this->fldErrorSubNum[FLDVALUE]."'"
                . "AND ".$this->fldIndicator[FLDNAME]." = '".$this->fldIndicator[FLDVALUE]."'"
                . "AND ".$this->fldWho[FLDNAME]." = '".$this->fldWho[FLDVALUE]."'";
        $rec = $T->fetchCounted();
        return $rec[$this->fldRecId[FLDNAME]];
    }
    
    
    
    /**
     * Wenn ein "sub" fehler geschickt wird, kann der "add" Fehlerwert entfernt werden
     * @throws type
     */
    public function insertRealError() {
        try
        {
            $ret = false;
            $noInsert = false;
            $VALID = new ErrorValues($this->findRecIdForDeleting()); // for Validating
            
            if($this->fldCountingType[FLDVALUE] == "sub" && $this->fldErrorNumCount[FLDVALUE] <= 1 && $VALID->fldErrorNumCount[FLDVALUE] == 1)
            {
                // Der zugehörige "sub" Fehler kann entfernt werden
                // Auf null setzen
                $T = new ErrorValues($this->findRecIdForDeleting());
                $T->ttsbegin();
                $ret = $T->doDelete();
                $T->ttscommit();
            }
            else
            {
                // Wenn der errorNumCount > 1 ist dann kann voriger Fehler entfernt werden
                // und der jetzige Fehler muss um den Fehler wert (errorValue) voriger Fehler + (errorValue) jetziger Fehler gerechnet werden
                if($this->fldCountingType[FLDVALUE] == "add" && $this->fldErrorNumCount[FLDVALUE] > 1)
                {
                    $T = new ErrorValues($this->findRecIdForDeleting());
                    $T->ttsbegin();
                    $this->fldErrorValue[FLDVALUE] = ($this->fldErrorValue[FLDVALUE] + $T->fldErrorValue[FLDVALUE]);
                    $ret = $T->doDelete();
                    $T->ttscommit();
                }
                
                // Wenn der "je Fall" oder "je Schlauch" Fehler verringert wird, muss ein Update auf diesen Fehler gemacht werden
                // ErrorValue von DB - jetziger ErrorValue und ErrorNumCount um 1 verringern 
                if($this->fldCountingType[FLDVALUE] == "sub" && $VALID->fldErrorNumCount[FLDVALUE] >= 0)
                {
                    $T = new ErrorValues($this->findRecIdForDeleting());
                    $T->ttsbegin();
                    $T->fldErrorValue[FLDVALUE] = ($T->fldErrorValue[FLDVALUE] - $this->fldErrorValue[FLDVALUE]);
                    $T->fldErrorNumCount[FLDVALUE] = ($T->fldErrorNumCount[FLDVALUE] - 1);
                    if($T->fldErrorValue[FLDVALUE] == 0)
                    {
                        $ret = $T->delete();
                    }
                    else
                    {    
                        $ret = $T->update();
                    }
                    $T->ttscommit();
                    $noInsert = true;                    
                }
              
                if(!$noInsert) 
                {
                    $ret = $this->insert();                       
                }
            }
            return $ret;
        } 
        catch (Exception $ex) {
            throw new Eception($ex);
        }
    }
}