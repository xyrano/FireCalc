<?php
class MemberTable extends SysTable
{
    /**
     * Holds the Tablename
     * @var str tablename
     */
    public $tableName = "MemberTable";
    
    /**
     * Holds the RecId
     * @var int RecId 
     */
    public $fldRecId = FLDRECID;
    /**
     * Holds the IdentityNum (Ausweinsummer)
     * @var str IdentityNum
     */
    public $fldIdentityNum = FLDIDENTITYNUM; 
    /**
     * Holds the Forename
     * @var str Forename
     */
    public $fldForename = FLDFORENAME;       
    
    /**
     * Holds the Surname
     * @var str Surename
     */
    public $fldSurname = FLDSURNAME;        
    /**
     * Holds the Birthdate
     * @var Date Birthdate
     */
    public $fldBirthday = FLDBIRTHDATE;      
    /**
     * Holds the Entydate
     * @var Date EntryDate
     */
    public $fldEntryDate = FLDDATE;     
    /**
     * Holds the recId from FireDept
     * @var int FireDeptId
     */
    public $fldFireDept = FLDREFRECID;       // Feuerwehr [optional] (filter for user)
    /**
     * Holds the Fire Department name for each user
     * @var str Fire Department name 
     */
    public $fldFireDeptName = FLDFIREDEPT;   
    /**
     * Hold the Gender
     * @var Boolean gender
     */
    public $fldGender = FLDGENDER;         // Geschlecht
    
    
    /**
     * Holds the amount of current Pages
     * @var int current pages
     */
    private $pages;
    
    
    public function __construct($recId = null) {
        parent::__construct();
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }
    }
    
    public static function tableId() {
        return tablenum(new MemberTable());
    }
    
    public static function findRecId($recId) {
        return new MemberTable($recId);
    }
    
    /**
     * Get an new MemberTable Obj from IdentityNum
     * @param str $identityNum IdentityNum (Ausweisnummer)
     * @return \MemberTable MemberTable
     */
    public static function findFromIdentityNum($identityNum) {
        $T = new MemberTable();
        $T->query = "SELECT RECID FROM ".$T->tableName." WHERE ".$T->fldIdentityNum[FLDNAME] . " = " . $identityNum . " LIMIT 1";
        $rec = $T->fetchCounted();
        return new MemberTable($rec['RECID']);
    }
    
    public function getPages() {
        if($this->pages > 0) {
            return round($this->pages / 10);
        } else {
            $O = new MemberTable();
            if(sysIsUserAdmin()) {
                $O->query = "SELECT COUNT(*) AS ANZAHL FROM ".$O->tableName;
            } else {
                $fireDeptId = @$_SESSION[SysConstants::sysSessionFireDeptId];
                $where = "(".$this->fldFireDept[FLDNAME]."=".$fireDeptId." OR ".$this->fldFireDeptName[FLDNAME]."='".FireDeptTable::findRecId($fireDeptId)->fldFireDept[FLDVALUE]."')";
                $O->query = "SELECT COUNT(*) AS ANZAHL FROM ".$O->tableName." WHERE ".$where;
            }
            $ret = $O->fetchCounted();
            return round($ret['ANZAHL'] / 10);
        }
    }
    
    
    public function getRecords() {
        if(sysIsUserAdmin()) 
        {
            if(isset($_GET['page'])) {              
                $this->initAll()->orderBy($this->fldSurname[FLDNAME]." ASC LIMIT ".(@$_GET['page']*10).", 10")->fetch();
            } else if(isset($_GET['char'])) {
                $this->initAll()->where($this->fldSurname[FLDNAME]." LIKE '".@$_GET['char']."%'")->orderBy($this->fldSurname[FLDNAME]." ASC")->fetch();
            } else {            
                $this->initAll()->orderBy($this->fldSurname[FLDNAME]." ASC")->fetch();
            }    
        } 
        else 
        {
            if(sysIsUserUser()) 
            {
                // Benutzer sieht nur Mitglieder seiner eigenen Feuerwehr
                $fireDeptId = @$_SESSION[SysConstants::sysSessionFireDeptId];
                $where = "(".$this->fldFireDept[FLDNAME]."=".$fireDeptId." OR ".$this->fldFireDeptName[FLDNAME]."='".FireDeptTable::findRecId($fireDeptId)->fldFireDept[FLDVALUE]."')";
                if(isset($_GET['page'])) {
                    $this->initAll()->where($where)->orderBy($this->fldSurname[FLDNAME]." ASC LIMIT ".($_GET['page']*10).", 10")->fetch();
                } else if(isset($_GET['char'])) {
                    $this->initAll()->where($where." AND ".$this->fldSurname[FLDNAME]." LIKE '".$_GET['char']."%'")->orderBy($this->fldSurname[FLDNAME]." ASC")->fetch();
                } else {
                    $this->initAll()->where($where)->orderBy($this->fldSurname[FLDNAME]." ASC")->fetch();
                }                                
            } 
            else 
            {
               // Benutzer ist Gruppen benutzer, dh. darf er alle Mitglieder seines Landkreises sehen
               // Das bedeutet das er alle Feuerwehren des Landkreises sehen darf               
               $F = new FireDeptTable();
               $F->getRecords();
               $where = "(";
               while($F->next()) {
                   $where .= $this->fldFireDept[FLDNAME]."=".$F->fldRecId[FLDVALUE]." OR ";
               }
                //cust last comma and close the brace
                $where = substr($where, 0, strlen($where)-4).")";
                
                if(isset($_GET['page'])) {
                    $this->initAll()->where($where)->orderBy($this->fldSurname[FLDNAME]." ASC LIMIT ".(@$_GET['page']*10).", 10")->fetch();
                } else if(isset($_GET['char'])) {
                    $this->initAll()->where($where." AND ".$this->fldSurname[FLDNAME]." LIKE '".@$_GET['char']."%'")->orderBy($this->fldSurname[FLDNAME]." ASC")->fetch();
                } else {
                    $this->initAll()->where($where)->orderBy($this->fldSurname[FLDNAME]." ASC")->fetch();
                }                   
            }
        }
    }
    
    
    public function insertOrUpdate() {
        $T = new MemberTable();
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM ".$T->tableName." WHERE " . $T->fldIdentityNum[FLDNAME] . " = " . $this->fldIdentityNum[FLDVALUE];
        $rec = $T->fetchCounted();
        if($rec['ANZAHL'] > 0) {
            $this->update();
        } else {
            $this->insert();
        }
    }
    
    
    /**
     * Formated Name
     * @param boolean $surnameAtFirst if true so surname comes at first
     * @return str formated Name
     */
    public function name($surnameAtFirst = false) {
        if($surnameAtFirst) {
            return $this->fldSurname[FLDVALUE] . ", " . $this->fldForename[FLDVALUE];
        }
        
        return $this->fldForename[FLDVALUE] . " " . $this->fldSurname[FLDVALUE];
    }
    
}
