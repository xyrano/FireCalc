<?php
error_reporting(E_ALL);
require_once("SysConstants.php");

final class Sql extends Obj
{
    private static $db_host = ""; // Comes from SysConstants
    private static $db_name = ""; // Comes from SysConstants
    private static $db_user = ""; // Comes from SysConstants
    private static $db_pswd = ""; // Comes from SysConstants
    
    private $dbResource;
    
    private $tableName;
    /**
     * Holds the Current selected tableId
     * @var int tableId num of current selected Table
     */
    private $tableId;
    private $numOfRecords;
    private $lastRecId;
    private $blockLoading;
    private $currentDbName;    
    private $currentFieldSetMap;    
    private $curStmt;
    
    private $recordStart;
    private $recordLimit;
    private $performedTypeChanges;
    
    /**
     * Create a new Table Object with an initial loading<br>
     * where you can block by set param $blockloading
     * @param string $tablename Tablename
     * @param boolean $blockLoading true if you want to block initial loading<br>
     * that increase performance but decide wisly
     */
    public function __construct($tablename = null, $blockLoading = false) {
        try
        {
            $this->blockLoading = $blockLoading;
            $this->tableName = $tablename;            
            $this->connect2DB();
            $this->createTable();       // Create the current Table 
            $this->resolveTableId(); // Because we have no Parameter for the TableId so try with Reflection to indicate the TableId

                       
            $this->initTable();
            //$this->checkTypeChanges();                        
        }
        catch(Exeption $ex)
        {
            throw $ex;
        }
    }
    
    
    final private function resolveTableId() {
        // another solution: Try to select first row in table and get the tableId
        if($this->tableName)
        {
            $SQL = new Sql();
            $row = $SQL->individualStmt("SELECT TABLEID FROM ".$this->tableName." LIMIT 1");
            $this->tableId = $row['TABLEID'];
            $this->createOrUpdateSysTable();
        }        
    }
   
    /**
     * Establish a connection to the Database
     * @return type
     * @throws Exception 
     */
    final private function connect2DB() {
        try
        {
            mysqli_report(MYSQLI_REPORT_STRICT);
            self::$db_host = SysConstants::sysDatabaseHost;
            self::$db_name = SysConstants::sysDatabaseName;
            self::$db_user = SysConstants::sysDatabaseUser;
            self::$db_pswd = SysConstants::sysDatabasePwd;
            
            $this->validateLogin();
            
            $link = mysqli_connect(self::$db_host, self::$db_user, self::$db_pswd);//, self::$db_name);                                    
            if($link == false || !$link)
            {
                throw new Exception("Fehler in der DB Verbindung: ". mysqli_connect_error());
            }
                                    
            $this->dbResource = $link;
            
            $bool = mysqli_select_db($this->dbResource, self::$db_name);
            if(!$bool)
            {
                //throw new Exception("Fehler bei der DB Selektion (Falsche DB gewaehlt?): ".mysqli_error($this->dbResource));
                // NO DB available so create the DB
                if(mysqli_query($this->dbResource, "CREATE DATABASE ".self::$db_name) OR DIE(mysqli_error($link)))
                {
                    echo "1. Database <b>".self::$db_name."</b> crated successfully ...";                    
                }
            }   
            $this->dbResource = null;
            $this->dbResource = mysqli_connect(self::$db_host, self::$db_user, self::$db_pswd, self::$db_name); 
            mysqli_select_db($this->dbResource, self::$db_name);
            
            mysqli_set_charset($this->dbResource, "utf8"); // SET to UTF-8
            $this->currentDbName = self::$db_name;
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }
    
    
    final private function validateLogin() {
        if($this->isValueEmpty(self::$db_host)) {
            throw new Exception("Database Host is empty!");
        }
        
        if($this->isValueEmpty(self::$db_name)) {
            throw new Exception("Database Name is empty!");
        }
        
        if($this->isValueEmpty(self::$db_pswd)) {
            throw new Exception("Database Password is empty!");
        }
        
        if($this->isValueEmpty(self::$db_user)) {
            throw new Exception("Database User is empty!");
        }
    }
    
    /**
     * Gets the Current DB Name
     * @return string DB Name
     */
    public function getCurDbName() {
        return $this->currentDbName;
    }
   
    /**
     * Gets the current active Table name
     * @return string Table name
     */
    public function getCurTableName() {
        return $this->tableName;
    }
    
    /**
     * Gets the current active Table Id
     * @return int TableId
     */
    public function getCurTableId() {
        return $this->tableId;
    }
    
    /**
     * Get the number of Records of the current active Table
     * @return int Number of Records
     */
    public function getNumOfRecords(){
        return $this->numOfRecords;
    }
    
    /**
     * Get the last inserted RecId
     * @return int Last Inserted RecId
     */
    public function getLastRecId() {
        return $this->lastRecId;
    }
    
    /**
     * Gets a Map of SQL Fields which where current active for Table
     * @return Object/Map Map of Fields
     */
    public function getCurrenFieldSetMap() {
        return $this->currentFieldSetMap;
    }
    
    /**
     * Gets the current active SQL Statement
     * @return string SQL Statement
     */
    public function getCurrentStatement() {        
        return $this->curStmt."<br>";
    }
    
    /**
     * Create a new Table if it not exists with initiated Fields like <br>
     * <b>TABLEID</b> - INT - TABLE ID (alwys)<br>
     * <b>RECID</b> - INT - PRIMARY KEY (always)<br>
     * <b>CREATEDDATETIME</b> - DATETIME<br>
     * <b>CREATEDBY</b> - VARCHAR(10) - OWNER OF RECORD (optional - efforts manually editing)<br>
     * <b>MODIFIEDDATETIME</b> - DATETIME<br>
     * <b>MODIFIEDBY</b> - VARCHAR(10) - MODIFIED By (optional - efforts manually editing)<br>
     */
    private function createTable() {
        try
        {
            if(!$this->isValueEmpty($this->tableName))
            {
                $phrase = 
                "CREATE TABLE IF NOT EXISTS `".$this->getCurTableName()."`
                             (
                                `".SysConstants::sysDbTableId."`  INT(5)    NOT NULL,
                                `".SysConstants::sysDbFldIndex."`  BIGINT(4)     AUTO_INCREMENT,
                                `".SysConstants::sysSqlCreatedDateTime."`  DATETIME    NOT NULL,
                                `".SysConstants::sysSqlCreatedyBy."`  VARCHAR(10)     NOT NULL,
                                `".SysConstants::sysSqlModifiedDateTime."`  DATETIME    NOT NULL,
                                `".SysConstants::sysSqlModifiedBy."`  VARCHAR(10)     NOT NULL,
                                PRIMARY KEY (`".SysConstants::sysDbFldIndex."`)
                            )
                            ENGINE=INNODB";

                if(!mysqli_query($this->dbResource, $phrase))
                {
                    throw new Exception(mysqli_error($this->dbResource));
                }
            }
        }
        catch(Exception $e)
        {
           throw $e; 
        }
    }
    
    
    /**
     * Initiate a given Table and loads the RecIds if the blockLoading param is false
     */
    private function initTable() {
        if(!$this->isValueEmpty($this->getCurTableName()) && !$this->blockLoading)
        {
            $result = mysqli_query($this->dbResource, "SELECT ".SysConstants::sysDbFldIndex." FROM ".$this->getCurTableName()." ORDER BY ".SysConstants::sysDbFldIndex." DESC");
            
            $this->numOfRecords = mysqli_num_rows($result);
           
            $rec = mysqli_fetch_assoc($result);
            $this->lastRecId = $rec[SysConstants::sysDbFldIndex];
            
            $this->initFieldSet();
        }
        else
        {
            $this->numOfRecords = 0;
        }
    }
    
    /**
     * Initiate the Fieldset of a Table
     */
    private function initFieldSet() {
        if(!$this->getCurrenFieldSetMap())
        {
            $result = mysqli_query($this->dbResource, "SELECT `COLUMN_NAME` 
                                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                                            WHERE `TABLE_SCHEMA`='".$this->getCurDbName()."' 
                                            AND `TABLE_NAME`='".$this->getCurTableName()."';");
            $FieldSetMap = new Map();
            $i = 0;
            while($row = mysqli_fetch_row($result))
            {
                $FieldSetMap->insert($row[0], $i);
                $i++;
            }             
            $this->currentFieldSetMap = $FieldSetMap;
        }
    }
    
    /**
     * Gets the amount of Records with given Statement<br>
     * <b>NOTE: Write a statment without count() conditions!</b><br>
     * <b>If no statment is given a normal select * from table is formed</b>
     * @param string $stmt inividual SQL Statement
     * @return int NumberOfRecords, no RecId!!!
     */
    final public function allocateRows($stmt = null) { 
        try
        {
            if($stmt == null) {
                $stmt = "SELECT * FROM ".$this->tableName;
            }
            $this->curStmt = $stmt;
            $con = new mysqli(self::$db_host, self::$db_user, self::$db_pswd, self::$db_name);
            // Check connection
            if (mysqli_connect_errno())
            {
                throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
            }
            $num = 0;     
            $result = mysqli_query($con, $stmt);
            if ($result)
            {
                // Return the number of rows in result set
                $num = mysqli_num_rows($result);
                mysqli_close($con);
            }

            return $num;
        }
        catch(Exception $ex)
        {
            throw new Exception($ex->getMessage());
        }        
    }
    
    /**
     * Gets a RECID from individual SQL Statement
     * @param string $stmt SQL Statement e.g.: (SELECT RECID FROM TABLE WHERE FIELD=y)
     * @return int RECID
     */
    public function findRecId($stmt) {
        try 
        {        
            $this->curStmt = $stmt;
            $result = mysqli_query($this->dbResource, $stmt);
            if(!$result)
                throw new Exception("Kernel Error - statement is:" . $stmt);
            
            $rec = mysqli_fetch_assoc($result);                
            return $rec[SysConstants::sysFldPrimaryKey];   
        } 
        catch (Exception $ex) 
        {
            throw Exception($ex->getMessage());
        }
    }
    
    
    /**
     * Send an Individual Statement and return the result Array<br>
     * If $getAsArray is false you can work with the result in form like <br>
     * <b>$ret['index'] in select statement</b><br>
     * If $getAsArray is true you can work as like as an array furhter<br>
     * <b>for($ret as $key => $val) ...</b>
     * @param string $stmt Individual statement
     * @param boolean $getAsArray true if the return should be an Array of values
     * @return mixed
     */
    final public function individualStmt($stmt, $getAsArray = false) {
        try 
        {                   
            $this->curStmt = $stmt;
            $result = mysqli_query($this->dbResource, $stmt);
            if(is_bool($result)) {
                throw new Exception("Boolean is not allowed!<br>Info: " . mysqli_error($this->dbResource));
            }
            
            if($getAsArray)
            {
                $ret = mysqli_fetch_all($result);
            }
            else
            {
                $ret = mysqli_fetch_assoc($result);  
            }
            return $ret;
        } 
        catch (Exception $ex)
        {
            Obj::getException($ex);  
        }
    }
    
    
    
    /**
     * Get an Map with all RecId´s for this Table
     * @param type $afterFromClause [optional] you can specifiy a static sql clause directly afer  "... FROM Tablename" => 
     * @return \Map Map with all RecIds for this Table
     */
    public function selectRecIdAll($afterFromClause = null) {
        if($afterFromClause != null) {
            $stmt = "SELECT ".SysConstants::sysDbFldIndex." FROM ".$this->getCurTableName()." ".$afterFromClause."";
        } else {
            $stmt = "SELECT ".SysConstants::sysDbFldIndex." FROM ".$this->getCurTableName()."";
        }
        $map = new Map();
        $res = mysqli_query($this->dbResource, $stmt);
        while($row = mysqli_fetch_assoc($res))
        {
            $map->insert($row[SysConstants::sysDbFldIndex]);
        }
        return $map;
    }
    
    
    
    
    /**
     * Selects all RecIds with given orderby Or Where clause and return a map<br>
     * Where is also acceptable
     * @param type $orderBy Given statement after ... FROM Table"
     * @return \Map Map with RecId´s
     */
    public function selectRecIdAllOrderBy($orderBy, Map $fldMap) {
        // In addition Fields in ORDER BY clause maybe not present so evaluate and recreate table for fields which not exists
        // =>    
        try
        {
            $this->createFieldsIfNotExists(new MapIterator($fldMap));
            // Normal case here:
            $stmt = "SELECT ".SysConstants::sysDbFldIndex." FROM ".$this->getCurTableName()." ".$orderBy;
            $map = new Map();
            $res = mysqli_query($this->dbResource, $stmt);
            if($res != false)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $map->insert($row[SysConstants::sysDbFldIndex]);
                }
            }
            else
            {
                throw new Exception("DB [".$this->currentDbName."] - Error in Statement: '". $stmt."' caught by '".  mysqli_error($this->dbResource)."'");
            }
            $this->curStmt = $stmt;     

            return $map;
        }
        catch(exception $ex)
        {
            throw new Exception($ex);
        }
    }
    
    
   
    
    /**
     * Gets a Map with RecId Values from given Startpoint in combination <br>
     * with number of records which should be selected
     * @param int $recStart Number to start of select
     * @param int $numOfRecords Number of Records
     * @return \Map Map with RecId values
     */
    public function selectRecIdAllPerPage($recStart, $numOfRecords) {
        $stmt = "SELECT ".SysConstants::sysDbFldIndex." FROM ".$this->getCurTableName()." LIMIT ".$recStart.", ".$numOfRecords."";
        $map = new Map();
        $res = mysql_query($stmt);
        while($row = mysql_fetch_assoc($res))
        {
            $map->insert($row[SysConstants::sysDbFldIndex]);
        }
        return $map;
    }
    
    
    
    /**
     * Gets a Map with Values and Keys(SQL Fields) from given recId
     * @param int $recId RecId
     * @return \Map Map with RecIds and SQL Fields
     */
    public function select($recId) {
        
        if($recId != null) {
            $selStmt = "SELECT * FROM ".$this->getCurTableName()." WHERE ".SysConstants::sysDbFldIndex." = '".$recId."' LIMIT 1";
        } else {
            $selStmt = "SELECT ".SysConstants::sysDbFldIndex." FROM ".$this->getCurTableName()."";
        }
        
        $sql = mysqli_query($this->dbResource, $selStmt)OR DIE(mysql_error());        
        $map = new Map();
        
        if($this->allocateRows($selStmt) > 0)
        {
            $row = mysqli_fetch_assoc($sql);
            foreach($row as $key => $value) 
            {
                $map->insert($value, strtoupper($key));
            }
        }
        return $map;
    }
    
    /**
     * Insert Statement for current Table<br>
     * <b>RECID</b> is not affected at this point
     * @param MapIterator $fieldSet The Fieldset for an Insert (e.g.: FIELD1, FIELD2, FIELD3 ...)
     * @param MapIterator $valueSet The Valueset for an Inser (e.g.: VALUE1, VALUE2, VALUE3 ...)
     */
    public function insert(MapIterator $fieldSet, MapIterator $valueSet) {        
        try
        {            
            $fieldSetClone = clone $fieldSet;
           
            $ret = $this->createFieldsIfNotExists($fieldSet); //, $valueSet); 
            
            $insStm = "INSERT INTO ".$this->getCurTableName()." (".SysConstants::sysSqlCreatedDateTime.",".SysConstants::sysSqlCreatedyBy.",";
            while($fieldSetClone->next())
            {
                $attr = $fieldSetClone->currentValue();
                $fieldName = $attr[SysConstants::sysFldName];
                if(strtoupper($fieldName) != SysConstants::sysDbFldIndex)
                {
                    $insStm .= $fieldName.",";
                }
            }
            $insStm = substr($insStm, 0, strlen($insStm)-1);
            
            $insStm .= ") VALUES (NOW(),'".UserOnline::find()->username()."',";

            while($valueSet->next())
            {
                $insStm .= "'".mysqli_real_escape_string($this->dbResource, $valueSet->currentValue())."',";
            }
            $insStm = substr($insStm, 0, strlen($insStm)-1);
            $insStm .= ")";

            $this->curStmt = $insStm;
            SQLLog::createOrUpdate($insStm);
            //throw new Exception($this->curStmt);
            //return $this->curStmt;
            return $this->doInsert();
        }
        catch(Exception $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    
    private function doInsert(){             
        $ret = mysqli_query($this->dbResource, $this->curStmt);// OR DIE(mysql_error());
        $error = mysqli_error($this->dbResource);
        
        if($error != "") {
            throw new Exception("Insert new Record: ". $error."<br>The statment is: [". $this->curStmt."]");
        }

        return $ret;       
    }
    
    /**
     * Updates a record with an given RecId and the Fieldset
     * @param int $recId The RecId which should be updated
     * @param MapIterator $fldSet it´s used to iterate all Tablefields from the TableClass
     * @return boolean true if update was successful otherwise false or level up with Exception
     * @throws Exception 
     */
    public function update($recId, MapIterator $fldSet){
        try
        {
            if($recId)
            {            
                $fieldSetClone = clone $fldSet;
                $this->createFieldsIfNotExists($fldSet); // Create SQL Fields if they dosn´t exists
                $updStm = "UPDATE ".$this->getCurTableName()." SET ".SysConstants::sysSqlModifiedDateTime."=NOW(), ".SysConstants::sysSqlModifiedBy."='".UserOnline::find()->fldUserName[FLDVALUE]."',";

                while($fieldSetClone->next()) 
                {
                    $attr = $fieldSetClone->currentValue();
                    $value = $attr[SysConstants::sysFldValue];
                    $fldName = $attr[SysConstants::sysFldName];
                    $updStm .= $fldName."='".$value."',";
                }

                $updStm = substr($updStm, 0, strlen($updStm)-1);
                $updStm .= " WHERE ".SysConstants::sysDbFldIndex." = '".$recId."' LIMIT 1";
                $this->curStmt = $updStm;
                SQLLog::createOrUpdate($updStm, false); // set to true if you want to activate SQl logging
                
                return $this->doUpdate();
            }
            else 
            {
                return false;
            }
        }
        catch(Exception $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    
    /**
     * Perform the Update
     * @return mixed 
     * @throws Exception
     */
    private function doUpdate() {           
        $ret = mysqli_query($this->dbResource, $this->curStmt);
        $error = mysqli_error($this->dbResource);
        if($error != "")
        {
            throw new Exception("Update Record: ". $error."<br>The statment is: [".$this->curStmt."]");
        }
        return $ret;
    }
    
    
    public function delete($recId) {
        try
        {
            if($this->exists($recId))
            {
                $delStm = "DELETE FROM ".$this->getCurTableName()." WHERE ".SysConstants::sysDbFldIndex." = '".$recId."' LIMIT 1";
                $this->curStmt = $delStm;
                return $this->doDelete();
            }
            else
            {
                throw new Excepetion("record with ID '".$recId."' dosn´t exist!<br> The statement is: [".$this->curStmt."]");
            }
        }
        catch(Exception $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    private function doDelete() {
        $ret = mysqli_query($this->dbResource, $this->curStmt);
        $error = mysqli_error($this->dbResource);
        if($error != "")
            throw new Exception($error."<br>The statment is: [".$this->curStmt."]");
        
        return $ret;
    }
    
    protected function exists($recId) {
        $exStm = "SELECT COUNT(*) AS ANZAHL FROM ".$this->getCurTableName()." WHERE ".SysConstants::sysDbFldIndex." = '".$recId."' ";
        $ret = mysqli_query($this->dbResource, $exStm);
        
        $error = mysqli_error($this->dbResource);
        if($error != "") {
            throw new Exception($error."<br>The statment is: [".$exStm."]");
        }
        
        $row = mysqli_fetch_assoc($ret);
        if($row['ANZAHL']>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Create Fileds if they doesn´t exist and perform an TypeChange if it happens
     * @param MapIterator $fieldSet
     * @throws Exception
     */
    public function createFieldsIfNotExists(MapIterator $mapIterator){//, MapIterator $valueIt) {
        $notNull = "NOT NULL";        
        try
        {                   
            while($mapIterator->next())
            {                              
               
                $attrVal = $mapIterator->currentValue();            // Value        
                $dataType = $attrVal[SysConstants::sysFldType];     // Type            
                $dataFldName = $attrVal[SysConstants::sysFldName];  // Name
                
                // Check on Type Changes and change them if need
                $this->checkTypeChanges($dataFldName, $dataType);
                set_time_limit(30);
                $phrase = "SHOW COLUMNS FROM `".$this->getCurTableName()."` LIKE '".$dataFldName."'";
                $result = mysqli_query($this->dbResource, $phrase);
                // require_once './SQLLog.php';
                SQLLog::createOrUpdate($phrase); // SQLLOG

                $error = mysqli_error($this->dbResource);
                if($error != "") {
                    throw new Exception($error."<br>The statment is: [".$phrase."]<br>Field is: <b>".$dataFldName."</b>");
                }

                $exists = (mysqli_num_rows($result)) ? true : false;
                if($exists==false)
                {
                    $alterPhrase = "ALTER TABLE ".$this->getCurTableName()." ADD ".$dataFldName." ".$dataType." ".$notNull;
                    mysqli_query($this->dbResource, $alterPhrase);
                    SQLLog::createOrUpdate($alterPhrase); // SQLLOG
                    $error = mysqli_error($this->dbResource);
                    if($error != "") {
                        throw new Exception($error."<br>The statment is: [".$alterPhrase."]<br>Field is: <b>".$dataFldName."</b>");
                    }
                }
            }
        }
        catch(exception $ex)
        {
            throw new Exception($ex);
        }
    }
    
    private function checkTypeChanges($fieldName, $fieldType) 
    {
        // SQL Statement:
        //  SELECT column_name, 
        //          character_maximum_length 
        //          FROM   information_schema.columns 
        //          WHERE  table_schema = 'umlauf'        
        //              and table_name = 'user'         
        //              and column_name = 'Username'
        if(!$this->isValueEmpty($this->tableName))
        {        
            // Select FieldName (system) and Character Max length
            $phrase = "SELECT column_name, character_maximum_length FROM information_schema.columns WHERE "
                   . "table_schema = '".$this->getCurDbName()."' AND table_name = '".$this->getCurTableName()."' "
                   . "AND column_name = '".$fieldName."'"; 
                        
            $result = mysqli_query($this->dbResource, $phrase) OR DIE(mysql_error());   
            while($row = mysqli_fetch_assoc($result))
            {
                $found = false;
                $dateTimeFound = false;
                $alterPhrase = "";
                // try to resolve TYPE(xx) values to get TYPE Name only
                if (strpos($fieldType, '(') !== false && strpos($fieldType, ')' !== false)) 
                {
                    $ret = explode("(", $fieldType); // create from varchar(50) => [0]= varchar( [1] = 50)
                    $ret = explode(")", $ret[1]); // get [0] = 50 [1] = )
                    $found = true;
                }
                else
                {
                    // GET TIME, DATE or DATETIME
                    if($fieldType == "TIME" || $fieldType == "DATE" || $fieldType == "DATETIME")
                    {
                        $found = true;
                        $dateTimeFound = true;
                    }
                }
                
                // Normal TYPES INT, BOOLEAN, CHAR, VARCHAR etc.
                if($found && (@$ret[0] && !$dateTimeFound))
                {
                    //echo $row['column_name']."==".$fieldName." && ".$row['character_maximum_length']."!=".$ret[0];
                    if($row['column_name'] == $fieldName && $row['character_maximum_length'] != $ret[0])
                    {
                        //$alterPhrase = "ALTER TABLE `".$this->getCurTableName()."` CHANGE `".$fieldName."` `".$fieldName."` VARCHAR(".$ret[0].")";                       
                        $alterPhrase = "ALTER TABLE `".$this->getCurTableName()."` CHANGE `".$fieldName."` `".$fieldName."` ".$fieldType."(".$ret[0].")";                       
                    }                    
                }
                
                // DATE, TIME or DATETIME Types
                if($found && (@$ret[0] || $dateTimeFound) && $row['column_name'] == $fieldName)
                {
                    $alterPhrase = "ALTER TABLE `".$this->getCurTableName()."` CHANGE `".$fieldName."` `".$fieldName."` ".$fieldType."";
                }
                
                if($alterPhrase != "")
                {
                    //echo $alterPhrase;
                    mysqli_query($this->dbResource, $alterPhrase) OR DIE(mysql_error());
                }
            }           
        }
    }
    
    /***
     * Create an entry about the TableId and TableName
     */  
    final private function createOrUpdateSysTable() {
        try
        {            
            if($this->tableName && $this->tableId)
            {
                $phrase = 
                "CREATE TABLE IF NOT EXISTS `SysTableId2TableName`
                             (
                                `TABLEID`  INT(5)    NOT NULL,
                                `TABLENAME`  VARCHAR(20)     NOT NULL,                                
                                PRIMARY KEY (`TABLEID`)
                            )
                            ENGINE=INNODB";
                if(!$this->dbResource)
                {
                    $this->connect2DB();
                }
                
                if(!mysqli_query($this->dbResource, $phrase))
                {
                    throw new Exception(mysqli_error($this->dbResource));
                }
                // Table is Created so check now if tableId & tablename exists
                
                $SQL = new Sql();
                $row = $SQL->allocateRows("SELECT * FROM SysTableId2TableName WHERE TABLEID = '".$this->getCurTableName()."' OR TABLEID '".$this->getCurTableId()."'");
                if($row <= 0)
                {
                    $insStm = "INSERT INTO SysTableId2TableName (TABLENAME, TABLEID) VALUES ('".$this->getCurTableName()."','".$this->getCurTableId()."')";
                    mysqli_query($this->dbResource, $insStm);
                }
            }
        }
        catch(Exception $e)
        {
           throw $e; 
        }
    }
    
    /**
     * Create an Object of an given tableId and recId
     * @param int $tableId TableId
     * @param int $recId RecId
     * @return /Object
     */
    final public static function getTableRecord($tableId, $recId) {
        $SQL = new Sql();
        $REC = $SQL->individualStmt("SELECT TABLENAME FROM SysTableId2TableName WHERE TABLEID = '".$tableId."'");
        if($REC['TABLENAME'])
        {
            $obj = new Obj();
            return $obj->Table($REC['TABLENAME'], $recId);            
        }
    }
    
    
    
}
