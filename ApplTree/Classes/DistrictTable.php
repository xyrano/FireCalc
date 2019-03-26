<?php

class DistrictTable extends SysTable
{
    /**
     * Holds the tablename
     * @var str tablename
     */
    public $tableName   = "DistrictTable";
    
    /**
     * Holds the RecId
     * @var int RecId
     */
    public $fldRecId    = FLDRECID;
    
    /**
     * Holds the Districtname
     * @var str districtname
     */
    public $fldDistrict = FLDDISTRICT;
    
    
    /**
     * Construct an new Obj
     * @param int $recId RecId
     */
    public function __construct($recId = null) {
        parent::__construct();
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }
    }
    
    /**
     * Gets the tablenum
     * @return int TableId
     */
    public static function tableId() {
        return tablenum(new DistrictTable());
    }
    
    
    /**
     * Create an new Obj from RecId find
     * @param int $recId RecId
     * @return \DistrictTable DistrictTable Obj
     */
    public static function find($recId) {
        return new DistrictTable($recId);
    }
    
    /**
     * Hole Datensätze gefiltert nach Admin, GruppenBenutzer oder Benutzer
     */
    public function getRecords() {
        if(sysIsUserAdmin()) 
        {
            $this->initAll()->orderBy($this->fldDistrict[FLDNAME]." DESC")->fetch();
        } 
        else 
        {
            $map = new Map();
            $map = $_SESSION[SysConstants::sysSessionDistrictMap];
        
            $mapIterator = new MapIterator($map);
            $clause = "(";
            while($mapIterator->next()){
                $clause .= $this->fldRecId[FLDNAME]." = ".$mapIterator->currentValue()." OR ";
            }
            //CUT LAST "OR " (3 digits)
            $clause = substr($clause, 0, strlen($clause)-3).")";
            $this->initAll()->where($clause)->orderBy($this->fldDistrict[FLDNAME]." DESC")->fetch();
        } 
    }
    
}