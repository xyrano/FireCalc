<?php
/**
 * Description of ErrorImpressions
 * Eindruck Table
 * @author tanzberg
 */
class ErrorImpressions extends SysTable
{
    /**
     * Holds the Tablename
     * @var str Tablename 
     */
    public $tableName           = "ErrorImpressions";
    
    /**
     * Holds the RecId
     * @var int RecId
     */
    public $fldRecId            = FLDRECID;
    
    /**
     * Holds the ContestID
     * @var int RecId
     */
    public $fldContestId        = FLDCONTESTID;
    
    /**
     * Holds the CompetitionType (A-Teil oder B-Teil)
     * @var str CompetitionType
     */
    public $fldCompetitionType  = FLDCOMPETITIONTYPE;
    
    /**
     * Holds the Group RecId
     * @var int RecId
     */
    public $fldGroupRecId       = FLDGROUPID;
    
    /**
     * Holds the indicator (ow oder ufh)
     * @var str Indicator
     */
    public $fldIndicator        = FLDINDICATOR;
    
    /**
     * Holds the Error Value for Gruppenführer/Melder
     * @var int ErrorValue
     */
    public $fldGFME             = FLDGFME;
    
    /**
     * Holds the Error Value for Maschinist
     * @var int ErrorValue
     */
    public $fldMA               = FLDMA;
    
    /**
     * Holds the Error Value for Angriffstrupp
     * @var int ErrorValue
     */
    public $fldAT               = FLDAT;
    
    /**
     * Holds the Error Value for Wassertrupp
     * @var int ErrorValue
     */
    public $fldWT               = FLDWT;
    
    /**
     * Holds the Error Value for Schlauchtrupp
     * @var int ErrorValue
     */
    public $fldST               = FLDST;
    
    /**
     * Holds the Error Value for Läufer1
     * @var int ErrorValue
     */
    public $fldL1               = FLDL1;
    
    /**
     * Holds the Error Value for Läufer2
     * @var int ErrorValue
     */
    public $fldL2               = FLDL2;
    
    /**
     * Holds the Error Value for Läufer3
     * @var int ErrorValue
     */
    public $fldL3               = FLDL3;
    
    /**
     * Holds the Error Value for Läufer4
     * @var int ErrorValue
     */
    public $fldL4               = FLDL4;
    
    /**
     * Holds the Error Value for Läufer5
     * @var int ErrorValue
     */
    public $fldL5               = FLDL5;
    
    /**
     * Holds the Error Value for Läufer6
     * @var int ErrorValue
     */
    public $fldL6               = FLDL6;
    
    /**
     * Holds the Error Value for Läufer7
     * @var int ErrorValue
     */
    public $fldL7               = FLDL7;
    
    /**
     * Holds the Error Value for Läufer8
     * @var int ErrorValue
     */
    public $fldL8               = FLDL8;
    
    /**
     * Holds the Error Value for Läufer9
     * @var int ErrorValue
     */
    public $fldL9               = FLDL9;
    
    
    
    public $who;
    
     /**
     * Construct new Object
     * <b>RecId for an explicite Object</b><br>
     * <b>groupId & competitionType is neccessary for Error calculation based on the Group</b>
     * @param int $recId RecId
     * @param int $groupId Group RecId
     * @param string $competitionType (A-Teil o. B-Teil)
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
            $this->fldCompetitionType[FLDVALUE] = $competitionType;
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
        return tablenum(new ErrorImpressions());
    }
    
    /**
     * Find an Record to an specific Recid
     * @param int $recId RecId
     * @return \ErrorImpressions Record
     */
    public static function findRecId($recId) {
        return new ErrorImpressions($recId);
    }
    
    
     private function findRecIdForUpdate() {
        $T = new ErrorImpressions();
        $T->query = "SELECT ".$T->fldRecId[FLDNAME]." FROM ".$T->tableName." "
            . "WHERE ".$this->fldCompetitionType[FLDNAME]." = '".$this->fldCompetitionType[FLDVALUE]."' "
                . "AND ".$this->fldGroupRecId[FLDNAME]." = '".$this->fldGroupRecId[FLDVALUE]."' "                              
                . "AND ".$this->fldIndicator[FLDNAME]." = '".$this->fldIndicator[FLDVALUE]."'";
        $rec = $T->fetchCounted();
        return $rec[$T->fldRecId[FLDNAME]];
    }
    
    
    /**
     * Insert or Update the record
     * @return boolean true if it´s inserted or updated into DB
     */
    public function insertOrUpdate() {
        $recId = $this->findRecIdForUpdate();
        if($recId)
        {
            // Update
            $obj = new ErrorImpressions($recId);
            $obj->ttsbegin();
            $obj->fldGFME[FLDVALUE] = ($this->fldGFME[FLDVALUE] > 0) ? $this->fldGFME[FLDVALUE] : $obj->fldGFME[FLDVALUE];
            $obj->fldMA[FLDVALUE]   = ($this->fldMA[FLDVALUE] > 0) ? $this->fldMA[FLDVALUE] : $obj->fldMA[FLDVALUE];
            $obj->fldAT[FLDVALUE]   = ($this->fldAT[FLDVALUE] > 0) ? $this->fldAT[FLDVALUE] : $obj->fldAT[FLDVALUE];
            $obj->fldWT[FLDVALUE]   = ($this->fldWT[FLDVALUE] > 0) ? $this->fldWT[FLDVALUE] : $obj->fldWT[FLDVALUE];
            $obj->fldST[FLDVALUE]   = ($this->fldST[FLDVALUE] > 0) ? $this->fldST[FLDVALUE] : $obj->fldST[FLDVALUE];
            
            $obj->fldL1[FLDVALUE]   = ($this->fldL1[FLDVALUE] > 0) ? $this->fldL1[FLDVALUE] : $obj->fldL1[FLDVALUE];
            $obj->fldL2[FLDVALUE]   = ($this->fldL2[FLDVALUE] > 0) ? $this->fldL2[FLDVALUE] : $obj->fldL2[FLDVALUE];
            $obj->fldL3[FLDVALUE]   = ($this->fldL3[FLDVALUE] > 0) ? $this->fldL3[FLDVALUE] : $obj->fldL3[FLDVALUE];
            $obj->fldL4[FLDVALUE]   = ($this->fldL4[FLDVALUE] > 0) ? $this->fldL4[FLDVALUE] : $obj->fldL4[FLDVALUE];
            $obj->fldL5[FLDVALUE]   = ($this->fldL5[FLDVALUE] > 0) ? $this->fldL5[FLDVALUE] : $obj->fldL5[FLDVALUE];
            $obj->fldL6[FLDVALUE]   = ($this->fldL6[FLDVALUE] > 0) ? $this->fldL6[FLDVALUE] : $obj->fldL6[FLDVALUE];
            $obj->fldL7[FLDVALUE]   = ($this->fldL7[FLDVALUE] > 0) ? $this->fldL7[FLDVALUE] : $obj->fldL7[FLDVALUE];
            $obj->fldL8[FLDVALUE]   = ($this->fldL8[FLDVALUE] > 0) ? $this->fldL8[FLDVALUE] : $obj->fldL8[FLDVALUE];
            $obj->fldL9[FLDVALUE]   = ($this->fldL9[FLDVALUE] > 0) ? $this->fldL9[FLDVALUE] : $obj->fldL9[FLDVALUE];
            $ret = $obj->update();                    
            $obj->ttscommit();
            return $ret;
        }
        else
        {
            // Insert
            return $this->insert();
        }
    }
    
    /**
     * Berechne den Eindruck einer Gruppe zu A oder B Teil
     * @param int $groupRecId Gruppen RecId
     * @param string $competitionType A-Teil oder B-Teil
     * @param string $indicator <b>Optional</b> ufh o. ow (Unterflurhydrant oder Offens Gewässer) 
     * @param int $round <b>Optional</b> Round to x Decimals, if 0 then no decimals are present
     * @return int Average Num of Impression
     */
    final public static function getAverageImpress($groupRecId, $competitionType, $indicator = null, $round = null) {
        $T = new ErrorImpressions();  // Only for FieldNames        
        $T->query = "SELECT ".$T->fldRecId[FLDNAME]." FROM ".$T->tableName." "
            . "WHERE ".$T->fldCompetitionType[FLDNAME]." = '".$competitionType."' "
                . "AND ".$T->fldGroupRecId[FLDNAME]." = '".$groupRecId."' "                              
                . "AND ".$T->fldIndicator[FLDNAME]." = '".$indicator."'";
        $rec = $T->fetchCounted();
        $EI = new ErrorImpressions($rec[$T->fldRecId[FLDNAME]]);
        switch($competitionType)
        {
            case 'A-Teil':
                (int) $p = (((int)$EI->fldGFME[FLDVALUE] + (int)$EI->fldMA[FLDVALUE] + (int)$EI->fldAT[FLDVALUE] + (int)$EI->fldST[FLDVALUE] + (int)$EI->fldWT[FLDVALUE]) / 5);
                break;
            case 'B-Teil':
                (int) $p = (((int)$EI->fldL1[FLDVALUE] + (int)$EI->fldL2[FLDVALUE] + (int)$EI->fldL3[FLDVALUE] + (int)$EI->fldL4[FLDVALUE] + (int)$EI->fldL5[FLDVALUE] + (int)$EI->fldL6[FLDVALUE] + (int)$EI->fldL7[FLDVALUE] + (int)$EI->fldL8[FLDVALUE] + (int)$EI->fldL9[FLDVALUE]) / 9);
                break;
            default:
                $p = 0;
                break;
        }
             
        if($round != null)
        {
            if($round == 0)
            {
                return round($p);
            }
            return round($p, $round);
        }            
        return $p;
    }
    
    
}