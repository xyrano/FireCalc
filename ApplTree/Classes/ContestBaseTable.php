<?php
//require_once("../../ExtendedDataTypes.php");

class ContestBaseTable extends SysTable
{
    /**
     * Holds the Tablename
     * @var str Tablename
     */
    public $tableName = "ContestBaseTable";
    
    /**
     * Holds the RecId
     * @var int RecId
     */
    public $fldRecId = FLDRECID;
    
    /**
     * Landkreis in dem der Wettbewerb stattfindet
     * @var str District Name
     */
    public $fldProvideInDistrict = FLDDISTRICT; 
    
    /**
     * Wettbewerbsname
     * @var str Contest name
     */
    public $fldContest = FLDCONTESTNAME;
    
    
    /**
     * Holds the Date of the Contest
     * @var Date date 
     */
    public $fldContestDate = FLDDATE;
    
    
    /**
     * Holds the OpenWater Flag
     * @var Boolean true if its openWater 
     */
    public $fldIsOpenWater = FLDISOPENWATER;
    
    
    /**
     * Hold the Calculated Flag
     * @var Boolean true if Contest is already calculated 
     */
    public $fldContestIsCalculated = FLDCONTESTISCALCULATED;
    
    /**
     * Gemeinde Tabellen ID 
     * @var int RecId
     */
    public $fldMunicipalId = FLDMUNICIPALID;
    
    
   /**
     * Holds a string of the venue (Austragungsort) of an match or contest
     * @var str Austragungsort
     */
    public $fldVenue = FLDVENUE;
    
    
    /**
     * Holds the RecId from SignatureTable - its the Leader ID
     * @var int RecId
     */
    public $fldContestLeader = FLDCONTESTLEADER;
    
    /**
     * Holds the RecId from SignatureTable - its the team Supervisor - Fachbereichsleiter Wettbewerbe
     * @var int RecId
     */
    public $fldContestTeamManager = FLDCONTESTTEAMMANAGER;
    
    
    private $districtTable;
    private $municipalTable;
    
    
    /**
     * Select only records which are open (date > now() and not calculated) by initiating
     * @var boolean true if it should be filtered
     */
    private $showOnlyOpenContests;
    
    /**
     * Select only records with are in the future
     * @var boolean true if only future contest should be shown
     */
    private $showOnlyFutureContests;
    
    
    /**
     * Construct a new Object of Contest Base Table
     * @param int $recId RecId of record
     * @param int $showOnlyOpenContests Shows only the Open Contest by gathering in getRecords
     * @param boolean $showOnlyFutureContest Show only Future Contest by gathering in getRecords
     */
    public function __construct($recId = null, $showOnlyOpenContests = null, $showOnlyFutureContest = false) {
        parent::__construct();
        
        $this->showOnlyFutureContests = $showOnlyFutureContest;
        $this->showOnlyOpenContests = $showOnlyOpenContests;
        
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
            
            $this->municipalTable = new MunicipalTable($this->fldMunicipalId[FLDVALUE]);
            $this->districtTable = new DistrictTable($this->municipalTable->fldDistrictId[FLDVALUE]);
        }
    }
    
    /**
     * Get the TableId
     * @return int TableId
     */
    public static function tableId() {
        return tablenum(new ContestBaseTable());
    }
    
    /**
     * Find an Record and returns the Obj
     * @param int $recId RecId of Contest
     * @return \ContestBaseTable
     */
    public static function find($recId) {
        return new ContestBaseTable($recId);
    }
    
    /**
     * Gets the DistrictTable based on MunicipalTable
     * @return \DistrictTable
     */
    public function districtTable() {
        if(!$this->districtTable)
        {
            return new DistrictTable(MunicipalTable::findRecId($this->fldMunicipalId[FLDVALUE])->fldDistrictId[FLDVALUE]);
        }
        return $this->districtTable;
    }
    
    /**
     * Gets the MunicipalTable base on the MunicipalId
     * @return \MunicipalTable
     */
    public function municipalTable() {
        if(!$this->municipalTable)
        {
            return new MunicipalTable($this->fldMunicipalId[FLDVALUE]);
        }
        return $this->municipalTable;
    }
    
    
    /**
     * Gathering all Records based on permissions by the Grouping
     * @throws Exception
     */
    public function getRecords() {
        $hideContestAfterToday = AdminSetup::findRecId()->fldHideContestAfterToday[FLDVALUE];
        if(sysIsUserAdmin()) 
        {
            // get all by admin
            if($hideContestAfterToday)
            {
                $this->initAll()->where($this->fldContestDate[FLDNAME]." > NOW()")->orderBy($this->fldContestDate[FLDNAME] . " DESC")->fetch();                      
            }
            else
            {
                $showOnlyOpenContests = "";
                if($this->showOnlyOpenContests)
                {
                    $showOnlyOpenContests = $this->fldContestIsCalculated[FLDNAME]." = 0";
                }

                $showOnlyFutureContests = "";
                if($this->showOnlyFutureContests)
                {
                    if($this->showOnlyOpenContests)
                    {
                        $showOnlyFutureContests = " AND ".$this->fldContestDate[FLDNAME] . " > NOW()";
                    }
                    else
                    {
                        $showOnlyFutureContests = $this->fldContestDate[FLDNAME] . " > NOW()";
                    }
                }

                $this->initAll()->where($showOnlyOpenContests ."".$showOnlyFutureContests)->orderBy($this->fldContestDate[FLDNAME] . " DESC")->fetch();     
            }
        }
        else
        {
            // get all by user
            // Iterate through map and form a where clause with districts
            $map = new Map();
            $map = $_SESSION[SysConstants::sysSessionDistrictMap];
            if(!is_object($map))
                throw new Exception(__CLASS__.".".__METHOD__." no Obj specified!");
            
            $MI = new MapIterator($map);
            $clause = "(";
            while($MI->next()){
                $clause .= $this->fldProvideInDistrict[FLDNAME]." = ".$MI->currentValue()." OR ";
            }
            //CUT LAST "OR " (3 digits)
            $clause = substr($clause, 0, strlen($clause)-3).")";
            
            $showOnlyOpenContests = "";
            if($this->showOnlyOpenContests) {
                $showOnlyOpenContests = $this->fldContestIsCalculated[FLDNAME] ." = 0 AND ";
            }
            
            $showOnlyFutureContests = "";
            if($this->showOnlyFutureContests) {
                $showOnlyFutureContests = $this->fldContestDate[FLDNAME] ." > NOW() AND ";
            }
            
            
            
            if($hideContestAfterToday)
            {
                $this->initAll()->where($showOnlyOpenContests."".$showOnlyFutureContests."".$clause . " AND " . $this->fldContestDate[FLDNAME]." > NOW()")->orderBy($this->fldContestDate[FLDNAME] . " DESC")->fetch();
            }
            else
            {            
                $this->initAll()->where($showOnlyOpenContests."".$showOnlyFutureContests."".$clause)->orderBy($this->fldContestDate[FLDNAME] . " DESC")->fetch();
            }                           
        }     
        
        //echo $this->getCurQuery();
    }
    
    
    /**
     * Deleting needs an validation<br>
     * In some cases the deleting is resticted
     * @throws Exception
     */
    public function validateDelete() {
        // kann nur gelöscht werden wenn noch nicht ausgewertet ...
        if($this->fldContestIsCalculated[FLDVALUE]) {
            throw new Exception("Wettbewerb wurde bereits ausgewertet, ein Löschen ist nicht möglich!");                       
        }
        
        // was soll passieren wenn Feuerwehren eingetragen wurden?
        
        // was soll passieren wenn Gruppen eingetragen wurden?
        
        // was soll passieren wenn A-Teile oder B-Teile erfasst wurden?
        
        // was soll passieren wenn Registrierungen vorhanden sind?
        if(RegistrationTable::amountOfDisclosedRegistrations($this->fldRecId[FLDVALUE]) > 0) {
            throw new Exception("Es sind noch offene Registrierungen vorhanden, ein Löschen ist nicht möglich!");
        }
        
    }
    
    /**
     * Override
     */
    public function delete() {         
        $this->validateDelete();        
        return parent::delete(); 
    }
    
    
    
     /**
    * Check if Contest is in Future and not already calculated
    * @return int num of Contests found with these criterias
    */
    public static function checkOnContestIsOpen() {
        $T = new ContestBaseTable();
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM ".$T->tableName." WHERE ".$T->fldContestDate[FLDNAME]." > NOW() AND ".$T->fldContestIsCalculated[FLDNAME]." = '0'";
        $rec = $T->fetchCounted();
        return $rec["ANZAHL"];
    }
         
}