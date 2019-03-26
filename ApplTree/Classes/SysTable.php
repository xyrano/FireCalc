<?php

abstract class SysTable extends SysTableBase
{
    /**
     * Field TableId
     * @var int TableId
     */
    public $fldTableId = FLDTABLEID;
    /**
     * Field Created DateTime
     * @var DateTime CreatedDateTime
     */
    public $fldCreatedDateTime = FLDCREATEDDATETIME;
    /**
     * Field Creted by
     * @var str Created by
     */
    public $fldCreatedBy = FLDCREATEDBY;
    /**
     * Field Modified DateTime
     * @var DateTime Modified DateTime
     */
    public $fldModifiedDateTime = FLDMODIFIEDDATETIME;
    /**
     * Field Modified by
     * @var str Modified by
     */
    public $fldModifiedBy = FLDMODIFIEDBY;
    
    
    /**
     * Delete from DB without any validation
     * @return boolean true if deleteing was successful otherwise false
     * @throws Exception when a Transaction is not set
     */
    public function doDelete() {          
        $vars = get_object_vars($this);
        $fldVal = "";
        foreach($vars as $key => $value) {
            if(self::isField($key) && $value[FLDVALUE] != null 
                    && $value[FLDNAME] != $this->fldCreatedDateTime[FLDNAME] // nicht CreatedDateTime
                    && $value[FLDNAME] != $this->fldCreatedBy[FLDNAME] // nicht CreatedBy
                    && $value[FLDNAME] != $this->fldModifiedDateTime[FLDNAME] // nicht CreatedDateTime
                    && $value[FLDNAME] != $this->fldModifiedBy[FLDNAME] // nicht CreatedBy                    
                ) {
                $fldVal .= strtoupper($value[FLDNAME]). " = '".$value[FLDVALUE]."' AND ";
            }
        }
        $ret = substr($fldVal, 0, strlen($fldVal)-(strlen(" AND ")));
        $this->query = "DELETE FROM $this->tableName WHERE ". $ret ." LIMIT 1";

        if(!$this->ttsBeginIsSet)
            throw new Exception("Transaction was not set, deleting cannot be proceed!");
        
        return $this->executeStmt();
    }
    
    /**
     * Delete an record with validation
     * @return mixed true otherweise false or error txt
     */
    public function delete() {   
        if($this->validateDelete()) {            
            return $this->doDelete();
        }
        return false;
    }
    
    /**
     * Check if the record is valid to delete
     * @return boolean true otherwise false
     */
    public function validateDelete() {
        $ret = false;
        $vars = get_object_vars($this);
        foreach($vars as $key => $value) {
            if(self::isField($key) && $value[FLDNAME] == TABLEIDX && $value[FLDVALUE] > 0) {
                $ret = true;
            }
        }
        
        if(!$ret) {            
            throw new Exception("Cannot find any RecId to delete this Record");            
        }
        
        return $ret;
    }
    
    /**
     * Updates an record in Database<br>
     * If no RecId is given false returns
     * @return boolean true otherweise false
     */
    public function doUpdate() {
        $vars = get_object_vars($this);
        $fldValSet = "";
        foreach($vars as $key => $value) {
            
            // SET Field=Value
            if(self::isField($key) 
                    && $value[FLDNAME] != TABLEIDX  // nicht RECID
                    && $value[FLDNAME] != $this->fldCreatedDateTime[FLDNAME] // nicht CreatedDateTime
                    && $value[FLDNAME] != $this->fldCreatedBy[FLDNAME] // nicht CreatedBy
                )
            {
                switch(strtoupper($value[FLDNAME]))
                {
                    case $this->fldModifiedDateTime[FLDNAME]:
                        $fldValSet .= strtoupper($value[FLDNAME])." = NOW(),";                        
                        break;
                    
                    case $this->fldModifiedBy[FLDNAME]:
                        $fldValSet .= strtoupper($value[FLDNAME])." = '". UserOnline::find()->fldUserName[FLDVALUE]."',";
                        break;
                    
                    default:
                        $fldValSet .= strtoupper($value[FLDNAME])." = '".$value[FLDVALUE]."',";
                        break;
                }                
            }
            
            
            if(self::isField($key) && $value[FLDNAME] == TABLEIDX) {
                $recId = $value[FLDVALUE];
            }
        }
        
        if(!$recId) {
            throw new Exception(sprintf("Cannot perform an update because no RecId is given"));
        }
        $this->query = "UPDATE ".$this->tableName." SET ".$this->cutLastComma($fldValSet)." WHERE ".TABLEIDX." = ".$recId;
        return $this->executeStmt();
    }
    
    /**
     * Update an record in Database
     * @return boolean true otherweise false
     */
    public function update() {
        if(!$this->ttsBeginIsSet) {            
            throw new Exception("<u>Es wurde keine Transaktion begonnen, daher kann der Datensatz nicht gespeichert werden!</u>");            
        }
        
        if($this->validateWrite()) {
            return $this->doUpdate();
        }
        return false;
    }
            
    
    /**
     * Insert into DB without any validation
     * @return true otherweise false
     */
    public function doInsert() {
        $vars = get_object_vars($this);
        $flds = "";
        $vals = "";
        foreach($vars as $key => $value)
        {
            if(self::isField($key) && $value[FLDNAME] != TABLEIDX) {
                switch(strtoupper($value[FLDNAME]))                        
                {
                    case $this->fldCreatedDateTime[FLDNAME]:
                        $flds .= strtoupper($value[FLDNAME]).",";
                        $vals .= "NOW(),";
                        break;
                    
                    case $this->fldModifiedDateTime[FLDNAME]:
                        $flds .= strtoupper($value[FLDNAME]).",";
                        $vals .= "NOW(),";
                        break;
                    
                    case $this->fldCreatedBy[FLDNAME]:
                        $flds .= strtoupper($value[FLDNAME]).",";
                        $vals .= "'".UserOnline::find()->fldUserName[FLDVALUE]."',";
                        break;
                    
                    case $this->fldTableId[FLDNAME]:
                        $flds .= strtoupper($value[FLDNAME]).",";
                        // Abfrage an SysTableReference wenn name noch nicht vorahnden erstelle Id = RecId und gib diese zurück   
                        if($this->tableName == "TABLEREFERENCE") {
                            $vals .= "1,";
                        } else {
                            $vals .= SysTableIdReference::findOrCreate($this->tableName)->fldRecId[FLDVALUE].",";                         
                        }
                        break;
                    
                    default:
                        $flds .= strtoupper($value[FLDNAME]).",";
                        $vals .= "'".$value[FLDVALUE]."',";
                        break;
                }
            }
        }
        $this->query = "INSERT INTO ".$this->tableName." (".$this->cutLastComma($flds).") VALUES (".$this->cutLastComma($vals).")";  
        return $this->executeStmt();
    }
    
    
  
    /**
     * Write record to Database with validation before
     * @return boolean true if record is stored otherweise false
     */
    public function insert() {
        if(!$this->ttsBeginIsSet) {           
            throw new Exception("<u>Es wurde keine Transaktion begonnen, daher kann der Datensatz nicht gespeichert werden!</u>");            
        }
        
            
        if($this->validateWrite()) {
            return $this->doInsert();
        }
        return false;
    }
    
    /**
     * Checks if record is writeable
     * @return boolean true or false
     * @throws Exception
     */
    public function validateWrite() {       
        $vars = get_object_vars($this);
        foreach($vars as $key => $value) {
            if(self::isField($key) && $value[FLDISMANDATORY] == true && $value[FLDVALUE] == null) {
                throw new Exception(sprintf("Field %s [%s] is mandatory but it has no value", strtoupper($value[FLDNAME]), $value[FLDLABEL]["de"] ));
            }
            // check if Date is valid
            if(self::isField($key) && strtoupper($value[FLDTYPE]) == "DATE") {
                // Date has to be formed like this: yyyy-mm-dd
                $ret = (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $value[FLDVALUE]));
                if($ret === 0)
                    throw new Exception (sprintf("Field %s [%s] is not formed like an Date", strtoupper($value[FLDNAME]), $value[FLDLABEL]["de"] ));
            }
        }
        return true;
    }
    
    /**
     * Initiate a record by RecId
     */
    public function init() {
        $this->query = "SELECT * FROM ".$this->tableName." WHERE ".TABLEIDX." = ".$this->fldRecId[FLDVALUE];
        $this->fetch();        
    }
    
    /**
     * Perform an query with select * from tableName
     * @return $this Obj
     */
    public function initAll() {        
        $this->query = "SELECT * FROM ".$this->tableName." ";
        return $this;
    }
    
    /**
     * Sets the Limit of an query
     * @param int $limit Only Limit or with second parm combined a page iteration
     * @param int $nextAmountOfRecords next records if you want to have a pagination
     * @return $this Obj
     */
    public function setLimit($limit, $nextAmountOfRecords = null) {
        if($nextAmountOfRecords == null) {
            $this->query .= " LIMIT ".$limit;
        } else {
            $this->query .= " LIMIT ".$nextAmountOfRecords.", ".$limit;
        }
        return $this;
    }
    
    /**
     * Perform an orderBy to given Query Obj
     * @param type $orderBy
     * @return $this Object Für weitere Verwendung
     */
    public function orderBy($orderBy) {
        $this->query .= " ORDER BY " . strtoupper($orderBy);
        return $this;
    }
    
    
    /**
     * Perform where on given query
     * @param str $whereCondition Where
     * @return $this Obj
     */
    public function where($whereCondition) {
        if(strlen($whereCondition) > 0) {
            $this->query .= "WHERE ".$whereCondition;
        }
        return $this;
    }
    
}
