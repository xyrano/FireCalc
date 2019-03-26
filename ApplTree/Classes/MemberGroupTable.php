<?php

class MemberGroupTable extends SysTable
{
    public $tableName = "MemberGroupTable";
    /**
     * Holds the RecId
     * @var int RecId
     */
    public $fldRecId        = FLDRECID;
    
    /**
     * Holds the Contest RecId
     * @var int Contest RecId
     */
    public $fldContestId    = FLDCONTESTID;
    
    /**
     * Holds the District RecId
     * @var int District RecId
     */
    public $fldDistrictId   = FLDDISTRICTID;
    
    /**
     * Holds the Fire Dept RecId
     * @var int Firedepartment RecId
     */
    public $fldFireDeptId   = FLDFIREDEPTID;
    
    /**
     * Holds the Groupname
     * @var str Groupname
     */
    public $fldGroupName    = FLDGROUPNAME;
    
    /**
     * Holds the serialized Map of Member<br>
     * <b>SET</b> -> fldMemberIdMap[FLDVALUE] = base64_encode(serialize($memberMap));<br>
     * <b>GET</b> <- Map $map = unserialize(base64_decode(fldMemberIdMap[FLDVALUE]));<br>
     * <b>otherwise use MemberIdMap()</b>
     * @var Map MemberMap 
     */
    public $fldMemberIdMap  = FLDMEMBERMAP;
    
    
    /**
     * Holds the FireDeptTable
     * @var /FireDeptTable
     */
    private $fireDept;
    
    
    
    /**
     * Constrcut a new Object
     * @param int $recId RecId
     * @param int $contestId Contest RecId
     */
    public function __construct($recId = null, $contestId = null) {
        parent::__construct();
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();            
        }
        
        if($recId == null && $contestId != null) {
            $this->fldContestId[FLDVALUE] = $contestId;
        }
    }
    
    /**
     * Get or Sets an Member Map
     * @param Map $memberIdMap
     * @return Map MemberMap
     */
    public function memberIdMap(Map $memberIdMap = null) {
        if($memberIdMap != null) {
            
            $encMap = base64_encode(serialize($memberIdMap));
            if(strlen($encMap) > 200 && strlen($encMap) <= 300)
                $this->fldMemberIdMap[FLDVALUE] = $encMap;
            else
                throw new Exception ("Error in length of Map");
        }
        
        return unserialize(base64_decode($this->fldMemberIdMap[FLDVALUE]));
    }
    
    /**
     * Gets the tableId
     * @return int TableId
     */
    public static function tableId() {
        return tablenum(new MemberGroupTable());
    }    
    
    /**
     * Find a record by given RecId
     * @param int $recId RecId
     * @return \MemberGroupTable MemberGroupTable
     */
    public static function findRecId($recId) {
        return new MemberGroupTable($recId);
    }
    
    
    
    /**
     * Gets the average Age from this group<br>
     * <b>Optional use round (2) to round on 2 digits after comma</b><br>
     * <b>Use 0 to round without comma decimals</b>
     * @param int $round number to round
     * @return float
     */
    public function getAverageAge($round = null) {
        $sumOfAge = 0;
        $memberIdMap = unserialize(base64_decode($this->fldMemberIdMap[FLDVALUE]));
        $mi = new MapIterator($memberIdMap);
        while($mi->next())
        {
            $sumOfAge += DateTimeUtil::getAge(MemberTable::findRecId($mi->currentValue())->fldBirthday[FLDVALUE]);
        }
        
        if($round !== null)
        {
            if($round == 0)
            {
                return round($sumOfAge/$memberIdMap->getLength());
            }
            return round($sumOfAge/$memberIdMap->getLength(), $round);
        }
        return $sumOfAge/$memberIdMap->getLength();
    }
    
    
    public function getRecords() {
        if($this->fldContestId[FLDVALUE]) {
            $this->initAll()->where($this->fldContestId[FLDNAME] . " = " . $this->fldContestId[FLDVALUE])->fetch();
        } else {
            $this->initAll()->fetch();
        }
    }
    
    
    /**
     * Give the Amount of Groups for eacht FireDepartment in this Contest
     * @param int $contestId Contest RecId
     * @param int $fireDeptId FireDepartment RecId
     * @return int Amount of Groups in this Contest of the FireDepartment
     */
    public static function numGroupsOfFireDept($contestId, $fireDeptId) {
        $T = new MemberGroupTable();
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM " . $T->tableName . " WHERE ".$T->fldContestId[FLDNAME] . " = " . $contestId . " AND " . $T->fldFireDeptId[FLDNAME] . " = " . $fireDeptId;
        $rec = $T->fetchCounted();
        return $rec['ANZAHL'];
    }
    
    /**
     * Get the Current FireDeptTable
     * @return FireDeptTable FireDeptTable
     */
    public function fireDeptTable() {
        if(!$this->fireDept) {
            $this->fireDept = new FireDeptTable($this->fldFireDeptId[FLDVALUE]);
            return $this->fireDept;
        } else {
            return $this->fireDept;
        }
    }
      
}