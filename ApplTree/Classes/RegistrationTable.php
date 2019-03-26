<?php
/**
 * Description of RegistrationTable
 *
 * @author tanzberg
 */
class RegistrationTable extends SysTable
{
    public $tableName = "RegistrationTable";
    
    public $fldRecId = FLDRECID;
    
    /**
     * Wettbewerbs ID
     * @var int ContestId
     */
    public $fldContestId = FLDCONTESTID;
    
    /**
     * Feuerwehr ID
     * @var int FireDeptId
     */
    public $fldFireDeptId = FLDFIREDEPTID;
    
    /**
     * Bestätungsdatum
     * @var DateTime ConfirmedDate Time
     */
    public $fldConfirmedDate = FLDCONFIRMEDDATE;
    
    /**
     * Nickname vom Benutzer der Bestätigt hat
     * @var string Nickname
     */
    public $fldConfirmedFrom = FLDCONFIRMEDFROM;
    
    /**
     * If the record was nested in the FireDeptContest Table this record will be closed
     * @var boolean
     */
    public $fldClosed = FLDCLOSED;
    
    
    private $contestId;
    
    private $showOpenRegistrations;
    
    /**
     * Construct a new Object
     * @param int $recId RecId concrete Objectbuild
     * @param int $contestId RecId of Contest
     * @param boolean $showOpenRegistrations Show Only Open Registrations
     */
    public function __construct($recId = null, $contestId = null, $showOpenRegistrations = false) {        
        parent::__construct();    
        
        $this->contestId = $contestId;
        $this->showOpenRegistrations = $showOpenRegistrations;
        
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();                       
        }
    }
    
    public static function tableId() {
        return tablenum(new RegistrationTable());
    }
    
    public static function find($recId) {
        return new RegistrationTable($recId);
    }
    
    
    public static function findFromContest($contestId, $fireDeptId) {
        $T = new RegistrationTable();
        $T->query = "SELECT " . $T->fldRecId[FLDNAME] . " FROM " . $T->tableName . " WHERE " . $T->fldContestId[FLDNAME] . " = " . $contestId . " AND " . $T->fldFireDeptId[FLDNAME] . " = " . $fireDeptId;
        $rec = $T->fetchCounted();
        return new RegistrationTable($rec[$T->fldRecId[FLDNAME]]);
    }
    
    public function getRecords() {
        if($this->contestId)
        {
            if($this->showOpenRegistrations)
            {
                $this->initAll()->where($this->fldContestId[FLDNAME] ." = ".$this->contestId ." AND ".$this->fldClosed[FLDNAME] ." = 0")->orderBy($this->fldCreatedDateTime[FLDNAME] . " DESC")->fetch();
            }
            else
            {
                $this->initAll()->where($this->fldContestId[FLDNAME] ." = ".$this->contestId)->orderBy($this->fldCreatedDateTime[FLDNAME] . " DESC")->fetch();
            }
        }
        else
        {
            $this->initAll()->orderBy($this->fldCreatedDateTime[FLDNAME]." DESC")->fetch();
        }
        //echo $this->getCurQuery();
    }
    
    
    /**
     * Get the Amount of disclosed Registration depneds on the Contest
     * @param int $contestRecId RecId of Contest
     * @return int Amount of disclosed registrations
     */
    final public static function amountOfDisclosedRegistrations($contestRecId) {
        $T = new RegistrationTable();// only for field purposes        
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM ".$T->tableName." WHERE ".$T->fldClosed[FLDNAME]."='0' AND ".$T->fldContestId[FLDNAME]."='".$contestRecId."'";
        $ret = $T->fetchCounted();
        return $ret['ANZAHL'];
    }
    
    /**
     * Get the Amount of closed Registrations depends on the Contest
     * @param int $contestRecId RecId of Contest
     * @return int Amount of closed Registrations
     */
    final public static function amountOfClosedRegistrations($contestRecId) {
        $T = new RegistrationTable();// only for field purposes        
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM ".$T->tableName." WHERE ".$T->fldClosed[FLDNAME]."='1' AND ".$T->fldContestId[FLDNAME]."='".$contestRecId."'";
        $ret = $T->fetchCounted();
        return $ret['ANZAHL'];
    }
    
    
    /**
     * Override
     * @throws Exception
     */
    public function validateWrite() {
        // check if record already exists
        $T = new RegistrationTable();
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM ".$T->tableName." WHERE ".$T->fldContestId[FLDNAME] ." = ".$this->fldContestId[FLDVALUE]." AND ".$T->fldFireDeptId[FLDNAME]." = ".$this->fldFireDeptId[FLDVALUE];
        $num = $T->fetchCounted();
        if($num['ANZAHL'] > 0) {
            throw new Exception("Datensatz bereits vorhanden!");
        }
        parent::validateWrite();
    }
    
    
    /**
     * Override 
     */
    public function insert() {
        $this->validateWrite();        
        return parent::doInsert(); // parent::insert() won't work ?!
    }
    
    /**
     * Is FireDept Registered into this Contest
     * @param int $contestId Contest RecId
     * @param int $fireDeptId FirDept RecId
     * @return bool True if a Firedept is registered
     */
    public static function existRegistered($contestId, $fireDeptId) {
        if(!$contestId)
            throw new Exception ("No ContestId is set: " . __METHOD__);
        
        if(!$fireDeptId)
            throw new Exception ("No FireDeptId is set: " . __METHOD__);


        $T = new RegistrationTable();
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM " . $T->tableName . " WHERE " . $T->fldContestId[FLDNAME] . " = " . $contestId . " AND " . $T->fldFireDeptId[FLDNAME] . " = " . $fireDeptId . " AND " . $T->fldClosed[FLDNAME] . " = '1'";        
        $rec = $T->fetchCounted();
        return ($rec['ANZAHL']>0) ? true : false;
    }
    
}