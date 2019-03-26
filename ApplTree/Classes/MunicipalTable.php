<?php

class MunicipalTable extends SysTable
{
    public $tableName = "MunicipalTable";
    public $fldRecId = FLDRECID;
    public $fldDistrictId = FLDREFRECID;
    
    /**
     * Holds the Municipal name
     * @var str Municipal name
     */
    public $fldMunicipal = FLDMUNICIPAL;
    
    public function __construct($recId = null) {
        parent::__construct();
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }
    }
    
    public static function tableId() {
        return tablenum(new MunicipalTable());
    }
    
     public static function findRecId($recId) {
        return new MunicipalTable($recId);
    }
    
    
    public static function numOfMunicipalsInDistrict($districtId) {
        $T = new MunicipalTable();
        $T->query = "SELECT COUNT(*) as AMOUNT FROM ".$T->tableName." WHERE ".$T->fldDistrictId[FLDNAME]." = ".$districtId;
        $ret = $T->fetchCounted();   
        return $ret["AMOUNT"];
    }
    
    /**
     * Hole Datensätze gefiltert nach Admin, GruppenBenutzer oder Benutzer
     */
    public function getRecords() {
        if(sysIsUserAdmin()) {
            $this->initAll()->orderBy($this->fldDistrictId[FLDNAME]." DESC, ". $this->fldMunicipal[FLDNAME]." DESC")->fetch();
        } else {
            $map = new Map();
            $map = @$_SESSION[SysConstants::sysSessionDistrictMap];
        
            $mapIterator = new MapIterator($map);
            $clause = "(";
            while($mapIterator->next()){
                $clause .= $this->fldDistrictId[FLDNAME]." = ".$mapIterator->currentValue()." OR ";
            }
            //CUT LAST "OR " (3 digits)
            $clause = substr($clause, 0, strlen($clause)-3).")";
            
            if(sysIsUserUser()) {
                // Rausfinden in welcher Gemeinde der Benutzer drin ist (Zuordnung zum user erfolgt über Landkreis und Feuerwehr)
                // in FireDeptTable.RefRecId ist die zugehörige Gemeinde
                $F = new FireDeptTable(@$_SESSION[SysConstants::sysSessionFireDeptId]);
                $this->initAll()->where($clause." AND ".$this->fldRecId[FLDNAME]."=".$F->fldMunicipalId[FLDVALUE])->orderBy($this->fldDistrictId[FLDNAME]." DESC, ". $this->fldMunicipal[FLDNAME]." DESC")->fetch();
            } else {
                $this->initAll()->where($clause)->orderBy($this->fldDistrictId[FLDNAME]." DESC, ". $this->fldMunicipal[FLDNAME]." DESC")->fetch();
            }
        }
    }
    
    
    public function DistrictTable() {
        return new DistrictTable($this->fldDistrictId[FLDVALUE]);
    }
}