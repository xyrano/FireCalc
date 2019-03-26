<?php
class FireDeptTable extends SysTable
{
    public $tableName = "FireDeptTable";
    public $fldRecId = FLDRECID;
    public $fldDistrictId = FLDDISTRICTID;
    public $fldMunicipalId = FLDREFRECID;
    
    /**
     * Holds the name of the FireDepartment
     * @var str Fire Dept name
     */
    public $fldFireDept = FLDFIREDEPT;
       
    
    public function __construct($recId = null) {
        parent::__construct();
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();            
        }
    }
    
    public static function tableId() {
        return tablenum(new FireDeptTable());
    }    
    
    public static function findRecId($recId) {
        return new FireDeptTable($recId);
    }
    
    public static function findFromUser() {
        return new FireDeptTable(UserTable::find(UserOnline::find()->fldUserName[FLDVALUE])->fldFireDeptId[FLDVALUE]);
    }
    
    public static function numOfFireDeptsInMunicipal($municipalId) {
        $T = new FireDeptTable();
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM ".$T->tableName." WHERE ".$T->fldMunicipalId[FLDNAME]." = ".$municipalId;
        $ret = $T->fetchCounted();
        return $ret["ANZAHL"];
    }
    
    /**
     * 
     * @return \MunicipalTable
     */
    public function municipalTable() {
        return new MunicipalTable($this->fldMunicipalId[FLDVALUE]);
    }
    
    /**
     * 
     * @return \DistrictTable
     */
    public function districtTable() {
        return new DistrictTable($this->fldDistrictId[FLDVALUE]);
    }
    
    
    /**
     * Hole Datensätze gefiltert nach Admin, GruppenBenutzer oder Benutzer
     */
    public function getRecords() {
        if(sysIsUserAdmin()) {
            // Show All for Admin
            $this->initAll()->fetch();
        } else {
            // show much less as Admin
            $map = new Map();
            $map = $_SESSION[SysConstants::sysSessionDistrictMap];       
            $mapIterator = new MapIterator($map);
            $clause = "(";
            while($mapIterator->next()){
                $clause .= $this->fldDistrictId[FLDNAME]." = ".$mapIterator->currentValue()." OR ";
            }
            //CUT LAST "OR " (3 digits)
            $clause = substr($clause, 0, strlen($clause)-3).")";
            
            if(sysIsUserUser()) {
                // Wir haben hier einen konkreten benutzer mit Landkreisgruppe und Feuerwehr
                $this->initAll()->where($clause." AND ".$this->fldRecId[FLDNAME]." = ".$_SESSION[SysConstants::sysSessionFireDeptId])->fetch();
            } else {
                $this->initAll()->where($clause)->fetch();
            }                
        }
    }
       
    public function getNumOfMemberInFireDept() {
        $M = new MemberTable();
        $this->query = "SELECT COUNT(*) AS ANZAHL FROM ".$M->tableName." WHERE ".$M->fldFireDept[FLDNAME]."='".$this->fldRecId[FLDVALUE]."'";
        $ret = $this->fetchCounted();
        return $ret['ANZAHL'];
    }
    
}





//class FireDeptTable_OLD extends xTable implements xTblIface
//{
//    private static $tablename = "FireDeptTable";
//    private static $tableId = 9;
//    public $recId;
//    /**
//     * RecIdMap
//     * @var Map
//     */
//    public $recIdMap;
//    
//    private $fldDistrictId;
//    private $fldMunicipalId;
//    private $fldFireDept;
//    
//    
//    public function __construct($recId = null, $fireDept = null, $districtId = null) {
//        try 
//        {                  
//            $this->initFields();
//            $this->recId = $recId;
//            $this->recIdMap = new Map();
//
//            parent::__construct(self::$tablename, true); 
//
//            $this->xGenerateFieldSet($this);
//            
//            if($recId && $fireDept == null && $districtId == null)
//            {
//                $this->init(); // initiate Single record
//            }  
//            
//            if($recId == null && $fireDept == null && $districtId == null)
//            {
//                $this->initAll(); // initiate a recId map because all params are empty
//            }
//
//            if($recId == null && $fireDept && $districtId == null)
//            {
//                $this->fireDept($fireDept);
//                $this->initFromFireDept();
//            }
//            
//            if($recId == null && $fireDept == null && $districtId)
//            {
//                $this->districtId($districtId);
//                $this->initFromDistrict();
//            }
//            
//        } 
//        catch (Exception $ex) 
//        {
//            throw new Exception($ex);
//        }
//    }
//    
//    public static function tableId() {
//        return FireDeptTable::$tableId;
//    }
//    
//    private function initFields() {
//        $this->fldDistrictId = SysPropertys::fldProp("DistrictId", "Int(10)");   
//        $this->fldMunicipalId = SysPropertys::fldProp("MunicipalId", "Int(10)");
//        $this->fldFireDept = SysPropertys::fldProp("FireDept", "VARCHAR(70)");
//    }
//    
//    public function districtId($districtId = null) {
//        if($districtId != null) {
//            $this->fldDistrictId[sysFldValue] = $districtId;
//        }
//        
//        return $this->fldDistrictId[sysFldValue];
//    }
//    
//    public function municipalId($municipalId = null) {
//        if($municipalId != null) {
//            $this->fldMunicipalId[sysFldValue] = $municipalId;
//        }
//        
//        return $this->fldMunicipalId[sysFldValue];
//    }
//    
//    /**
//     * Get or Sets the Fire Department name
//     * @param str $fireDept name of Fire Department
//     * @return str Fire Department name
//     */
//    public function fireDept($fireDept = null) {
//        if($fireDept != null) {
//            $this->fldFireDept[sysFldValue] = $fireDept;
//        }
//        
//        return $this->fldFireDept[sysFldValue];
//    }
//    
//    
//    public function numOfMemberInFireDept() {
//        return MemberTable::numOfMemberOfFireDept($this->recId);
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
//    /**
//     * Initiate a recIdMap from FireDeptId
//     */
//    public function initFromFireDept() {
//        $SQL = new SQL(self::$tablename, true);        
//        $recId = $SQL->findRecId("SELECT ".SysConstants::sysFldPrimaryKey." FROM ".self::$tablename." "
//                    . "WHERE ".$this->fldFireDept[sysFldName]." = '".$this->fldFireDept[sysFldValue]."'");
//        $this->recId = $recId;
//        $this->xInit($this);
//    }
//    
//    /**
//     * Inititate a recIdMap from DistrictId
//     */
//    public function initFromDistrict() {
//        $SQL = new SQL(self::$tablename, true);        
//        $recId = $SQL->findRecId("SELECT ".SysConstants::sysFldPrimaryKey." FROM ".self::$tablename." "
//                    . "WHERE ".$this->fldDistrictId[sysFldName]." = '".$this->districtId()."'");
//        $this->recId = $recId;
//        $this->xInit($this);
//    }
//    
//    public static function find($recId) {
//        return new FireDeptTable($recId);
//    }
//    
//    /**
//     * Return the num of Fire Departments for an given Municipal
//     * @param int $municipalId Municipal RecId
//     * @return int num Of FireDepartments in Municipal
//     */
//    public static function numOfFireDeptsInMunicipal($municipalId) {
//        $T = new FireDeptTable(); // For Field purposes only
//        $SQL = new Sql(self::$tablename, true);        
//        $num = $SQL->allocateRows("SELECT * FROM ".self::$tablename." WHERE ".$T->fldMunicipalId[sysFldName]."='".$municipalId."'");
//        return $num;
//    }
//    
//    private function initAll() {
//        // Inititate only these records which are in the map of the user       
//        if(sysIsUserAdmin()) // admin session
//        {            
//            $this->recIdMap = $this->selectAllOrderBy(); 
//        }
//        else
//        {
//            // Iterate through map and form a where clause with districts
//            $map = new Map();
//            $map = $_SESSION[SysConstants::sysSessionDistrictMap];
//        
//            $MI = new MapIterator($map);
//            $clause = "(";
//            while($MI->next()){
//                $clause .= $this->fldDistrictId[sysFldName]." = ".$MI->currentValue()." OR ";
//            }
//            //CUT LAST "OR " (3 digits)
//            $clause = substr($clause, 0, strlen($clause)-3).")";
//            
//            if(sysIsUserUser())
//            {                
//                // In case user is defined with one FireDeptId
//                $this->recIdMap = $this->selectAllOrderBy(" WHERE ".$clause." AND ".SysConstants::sysDbFldIndex." = ".$_SESSION[SysConstants::sysSessionFireDeptId]." ORDER BY ".$this->fldDistrictId[sysFldName] . " DESC");                
//            }
//            else
//            {
//                
//                $this->recIdMap = $this->selectAllOrderBy(" WHERE ".$clause." ORDER BY ".$this->fldDistrictId[sysFldName] . " DESC");  
//            }
//            
//        }
//    }
//    
//  
//    private function validate() {
//        if($this->isValueEmpty($this->fireDept()))
//        {
//            throw new Exception("Keine Feuerwehr zum Speichern hinterlegt!");
//        }
//    }
//    
//    public function insert() {
//        try
//        {              
//            $this->validate();            
//            return $this->xInsert($this);
//        }
//        catch(Exception $ex)
//        {
//            //echo str_replace("\n", "<br>", $ex->getTraceAsString());
//            throw new Exception($ex->getMessage());            
//        }
//    }
//    
//    public function update(){
//        return $this->xUpdate($this);
//    }
//    
//    public function delete() {
//        return $this->xDelete($this);
//    }
//    
//    /**
//     * Get the related MunicipalTable
//     * @return \MunicipalTable
//     */
//    final public function municipalTable(){
//        return new MunicipalTable($this->municipalId());
//    }
//   
//}
