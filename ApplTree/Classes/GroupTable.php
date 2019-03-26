<?php
class GroupTable extends SysTable
{
    public $tableName = "GroupTable";
    public $fldRecId = FLDRECID;
    public $fldGroupName = FLDGROUPNAME;
    public $fldGroupDescription = FLDGROUPDESCRIPTION;
    /**
     * set = serialize(Map) and use base64_encode<br>
     * get = base64_decode and unserialize
     * @var serialized Map
     */
    public $fldDistrictMap = FLDDISTRICTMAP;
    
    public function districtMap(Map $districtMap = null) {
        if($districtMap != null) {
            $this->fldDistrictMap[sysFldValue] = base64_encode(serialize($districtMap));
        }
        
        return unserialize(base64_decode($this->fldDistrictMap[sysFldValue]));
    }
    
    
    public function __construct($recId = null) {
        parent::__construct();
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }
    }
    
    public static function tableId() {
        return tablenum(new GroupTable());
    }
    
    public static function find($recId) {
        return new GroupTable($recId);
    }
}