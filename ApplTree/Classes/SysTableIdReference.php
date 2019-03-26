<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SysTableIdReference
 *
 * @author tanzberg
 */
class SysTableIdReference extends SysTable
{
    public $tableName = "TABLEREFERENCE";
    public $fldRecId = FLDRECID;
    public $fldSysTableName = FLDSYSTABLENAME;
    
    final public function __construct($tableName = null) {
        parent::__construct(); // Database construct
        if($tableName != null) {
            $this->fldSysTableName[FLDVALUE] = $tableName;
            if(SysTableIdReference::find($tableName)->fldRecId[FLDVALUE] > 0)
                $this->init();
            else
                $this->doInsert ();
        }
    }
    
    /**
     * Find an TableId Reference Obj
     * @param type $tableName
     * @return \SysTableIdReference
     */
    final public static function find($tableName) {
        $T = new SysTableIdReference();
        $T->query = "SELECT * FROM ".$T->tableName." WHERE ".$T->fldSysTableName[FLDNAME]." = '".$tableName."'";
        $T->fetch();
        return $T;       
    }
    
    /**
     * Table NUm 2 Table name
     * @param int $tablenum Table Num
     * @return str Table name
     */
    final public static function tableNum2TableName($tablenum) {
        $T = new SysTableIdReference();
        $T->query = "SELECT ".$T->fldSysTableName[FLDNAME] . " FROM ".$T->tableName . " WHERE ". $T->fldRecId[FLDNAME] . " = " . $tablenum . " LIMIT 1";
        $rec = $T->fetchCounted();
        return $rec[$T->fldSysTableName[FLDNAME]];
    }
    
    final public static function findOrCreate($tableName) {        
        if(SysTableIdReference::find($tableName)->fldRecId[FLDVALUE] > 0)
        {
            return SysTableIdReference::find($tableName);            
        }
        else
        {
            $T = new SysTableIdReference();
            $T->fldSysTableName[FLDVALUE] = $tableName;
            $T->ttsbegin();
            $T->doInsert();
            $T->ttscommit();
            return SysTableIdReference::find($tableName);
        }
    }
       
}
