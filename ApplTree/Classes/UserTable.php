<?php

class UserTable extends SysTable
{
    public $tableName       = "UserTable";
    public $fldRecId        = FLDRECID;
    public $fldUsername     = FLDUSERNAME;
    public $fldPassword     = FLDPASSWORD;
    public $fldGroupId      = FLDGROUPID;
    public $fldFireDeptId   = FLDREFRECID;
    
    
    public function __construct($recId = null) {
        parent::__construct();
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }               
    }
    
    public static function tableId() {
        return tablenum(new UserTable());
    }
    
    public static function find($username) {
        $T = new UserTable();
        $T->query = "SELECT * FROM ".$T->tableName." WHERE ".$T->fldUsername[FLDNAME]." = '".$username."'";
        $T->fetch();
        return $T;
    }
    
    public static function numOfUser() {
        $T = new UserTable();
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM ".$T->tableName;
        $ret = $T->fetchCounted();
        return $ret["ANZAHL"];
    }
    
}
?>