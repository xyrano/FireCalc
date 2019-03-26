<?php
/**
 * Mapping Table - Bringt die Stammdaten zu Wettbewerbsteilnehmer zusammen
 * Diese Tabelle speichert die feuerwehren die für einen Wettbewerb in Frage kommen
 * dabei stützt die Tabelle sich auf die DistrictTable sprich ein Zuordnung zum Landkreis
 * Felder sind districtId (Landkreis), municipalId (Gemeinde), fireDeptId (Feuerwehr), ContestId (Wettbewerb)
 *  => Diese Daten speisen sich aus unterschiedlichen anderen Tabellen  
 */
class FireDept2ContestTable extends SysTable
{
    public $tableName = "FireDept2ContestTable";
    public $fldRecId = FLDRECID;
    public $fldDistrictId = FLDDISTRICTID;
    public $fldMunicpilaId = FLDMUNICIPALID;
    public $fldFireDeptId = FLDFIREDEPTID;
    public $fldContestId = FLDCONTESTID;
    
    private $contestTable;
    
    private $fireDeptTable;
    
    public function __construct($recId = null, $contestId = null) {
        parent::__construct();
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();     
            
            $this->contestTable = new ContestBaseTable($this->fldContestId[FLDVALUE]);
            $this->fireDeptTable = new FireDeptTable($this->fldFireDeptId[FLDVALUE]);
        }
        
        if($recId == null && $contestId != null) {
            $this->fldContestId[FLDVALUE] = $contestId;
        }
    }
    
    public static function tableId() {
        return tablenum(new FireDept2ContestTable());
    }
    
    public static function find($recId) {
        return new FireDept2ContestTable($recId);
    }
    
    /**
     * Get ContestTable
     * @return \ContestBaseTable
     */
    public function contestTable() {
        if($this->contestTable)
            return $this->contestTable;
        else
            return new ContestBaseTable($this->fldContestId[FLDVALUE]);
    }
    
    /**
     * Get FireDeptTable
     * @return \FireDeptTable 
     */
    public function fireDeptTable() {
        if($this->fireDeptTable)
            return $this->fireDeptTable;
        else
            return new FireDeptTable($this->fldFireDeptId[FLDVALUE]);
    }
    
    public function getRecords() {
        if($this->fldContestId[FLDVALUE]) {
            $this->initAll()->where($this->fldContestId[FLDNAME] . " = ".$this->fldContestId[FLDVALUE])->fetch();
        } else {
            $this->initAll()->fetch();
        }        
    }
    
    
    public function validateDelete() {
        parent::validateDelete();
        // Wenn keine Registrierungen ausstehen können diese gelöscht werden
        if(RegistrationTable::amountOfDisclosedRegistrations($this->fldContestId[FLDVALUE]) > 0) {
            $R = new RegistrationTable(NULL, $this->fldContestId[FLDVALUE], true);
            $R->ttsbegin();
            $R->getRecords();
            $R->doDelete();
            $R->ttscommit();
        }
        
        if(RegistrationTable::amountOfClosedRegistrations($this->fldContestId[FLDVALUE]) > 0) {
            throw new Exception("Es exisiteren bereits abgeschlossene Registrierungen, kein entfernen möglich!");
        }
    }
    
    public function delete() {
        $this->validateDelete();
        return parent::doDelete(); // parent::delete() won´t work here
    }
    
    
    /**
     * Returns the Amount of FireDepartments in this Contest
     * @param int $contestId Contest RecId
     * @return int Amount of FireDepartments in this Contest
     */
    public static function numOfFireDepartmentsInContest($contestId) {
        $T = new FireDept2ContestTable(); // For Field purposes only
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM ".$T->tableName." WHERE ".$T->fldContestId[FLDNAME]." = '".$contestId."'";
        $rec = $T->fetchCounted();
        return $rec['ANZAHL'];
    }
    
    
    /**
     * Checks if an Record already exist
     * @param int $contestRecId RecId of the Contest
     * @param int $fireDeptRecId RecId of the Fire Department
     * @return boolean true if found otherwise false
     */
    public static function exist($contestRecId, $fireDeptRecId)
    {
        $T = new FireDept2ContestTable();
        $T->query = "SELECT COUNT(".$T->fldRecId[FLDNAME].") AS ANZAHL FROM ".$T->tableName." WHERE ".$T->fldContestId[FLDNAME]."='".$contestRecId."' AND ".$T->fldFireDeptId[FLDNAME]."='".$fireDeptRecId."'";
        $rec = $T->fetchCounted();
        if($rec['ANZAHL']>0)
            return true;
        
        return false;
    }
    
}