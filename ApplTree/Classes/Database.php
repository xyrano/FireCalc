<?php

abstract class Database extends Base
{
    /**
     * Holds the Myqli object
     * @var mysqli
     */
    private $mysqli;
 
    /**
     * Hold the current num of Records
     * @var int Number of Records
     */
    private $numOfRows;
    
    /**
     * Holds the resultRows if more then one record found
     * @var array resultRow 
     */
    private $resultRow;
    
    /**
     * Holds the index for iterating though resultRows
     * @var int resultRow Index
     */
    private $resultRowIndex;
    
    
    /**
     * Checks if ttsbegin is set
     * @var boolean is ttsBegin already set?
     */
    protected $ttsBeginIsSet = false;
    
    /**
     * Construct a new Database Obj
     * @param boolean $autocommit [Optional] default is false
     */
    public function __construct($autocommit = false) {
        $this->creteDbIfNotExist();
        $this->openConnection();
        
        $this->mysqli->autocommit($autocommit); // be carefull by using ttsbegin the autocommit is always set to false
    }
    
    
    /**
     * Opend up a new mysqli Connection
     */
    private function openConnection() {
        $this->mysqli = new mysqli(SysConstants::sysDatabaseHost, SysConstants::sysDatabaseUser, SysConstants::sysDatabasePwd, SysConstants::sysDatabaseName);
        if ($this->mysqli->connect_errno) 
        {
            throw new Exception(sptrintf("%s - %s <br>Failed to connect to MySQL: (%s) %s", $this->mysqli->connect_errno, $this->mysqli->errno, $this->mysqli->connect_errno, $this->mysqli->connect_error));
        }
    }
    
    /**
     * Creates a new Database if not exists
     */
    private function creteDbIfNotExist() {
        if(!SysConstants::sysDatabaseHost || !SysConstants::sysDatabaseName || !SysConstants::sysDatabasePwd || !SysConstants::sysDatabaseUser)
        {
            throw new Exception("Datenbankparameter fehlen!");
        }
        
        $mysqli = new mysqli(SysConstants::sysDatabaseHost, SysConstants::sysDatabaseUser, SysConstants::sysDatabasePwd);
        $query = "CREATE DATABASE IF NOT EXISTS ".SysConstants::sysDatabaseName;
        if ($mysqli->query($query) === FALSE){
            echo "New Database created!";
        }
    }
    
    /**
     * Destruct an Database Obj and free the query result
     */
    public function __destruct() {
        if(is_object($this->mysqli)) {
            $this->mysqli->close();
        }
    }
    
    
    /**
     * Execute an statement
     * @return boolean true if query is valid otherwise false
     */
    protected function executeStmt() {
        $this->createTableIfNotExists();
        $this->mysqli->autocommit(false);
        if($this->mysqli->query($this->query) === true) {            
            return true;
        }
        else
        {
            if($this->mysqli->errno > 0) {
                $this->resolveError();
            }
            return false;
        }
    }
    
    
    /**
     * Gets an Assoziative array from sql Query<br>
     * <b>use row["ANZAHL"] or similar</b>
     * @return array Assoziative Array
     */
    public function fetchCounted() {
        // erstelle ggf. neue Felder
        $this->createFields();
        $result = $this->mysqli->query($this->query); 
        if($this->mysqli->errno) {
            throw new Exception("Error: " . $this->mysqli->error . " Statement:  [" . $this->query . "] ");
        }
        $row = mysqli_fetch_assoc($result); 
        mysqli_free_result($result); // free memory from result        
        return $row;
    }
    
    
    /**
     * Generate Obj and init<br>
     * call init or initAll before 
     */
    public function fetch() {
        // erstelle ggf. neue Felder
        $this->createFields();
        // Frage mit Query DB.Tabelle ab
        $result = $this->mysqli->query($this->query);   
        //echo $this->query."<br>";
        // Property num rows setzen
        $this->numOfRows = (is_object($result) && $result->num_rows) ? $result->num_rows : 0;
        // Nur ausführen wenn mehr als 0 Zeilen gefunden wurden, normal sollte es hier eine eizige sein
        if($this->numOfRows == 1) {
            // Hole einzelne Zeile von DB Tabelle
            $row = mysqli_fetch_assoc($result); 
            // erzeuge Reflection der Klasse
            $reflection = new ReflectionClass($this);
            // Durchlaufe Propertys der Klasse
            foreach($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $prop ) {  
                // Wenn das Feld ein DB Feld ist ... (gekennzeichnet durch fld Präfix
                if(SysTableBase::isField($prop->name)) {
                    // Dann erzeuge referenz auf das aktuelle Property
                    $refProp = $reflection->getProperty($prop->name);
                    // Setze das Property auf änderbar
                    $refProp->setAccessible(true);
                    // Holle den aktuellen Value aus dem Property
                    $fieldVal = $refProp->getValue($this);
                    // Hole den Feldnamen aus dem Value (weil ist ja inder Tabelle defeniert (array( ...)
                    $fieldname = strtoupper($fieldVal[FLDNAME]);
                    // Durchlaufe nun alle values der DB Tabellenzeile ...
                    foreach($row as $dbKey => $dbValue) {
                        // Wenn der DB Tabellenfeldname mit dem der Klasse übereinstimmt ...
                        if($dbKey == $fieldname) {       
                            // setze den Feldvalue im gesamtvalue auf den aus der DB.Tabelle
                            $fieldVal[FLDVALUE] = $dbValue;  
                            // und zum Schluss noch das ganze gesamtvalue (array) dem Property zuweisen - fertig ;-)
                            $refProp->setValue($this, $fieldVal);
                        }
                    }                    
                }
            }         
        } else if($this->numOfRows > 1) {  
            while($row = $result->fetch_assoc()) {                
                $this->resultRow[] = $row;
            }   
        } else {        
            //echo sprintf("Cannot allocate any record<br>");
            return false;
        }
        mysqli_free_result($result); // free memory from result
    }
    
    /**
     * Initiate the table by single record<br>
     * Is called by next method
     * @param array $row singele Record
     */
    private function initSingleRow($row) {
        // erzeuge Reflection der Klasse
        $reflection = new ReflectionClass($this);
        // Durchlaufe Propertys der Klasse
        foreach($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $prop ) {  
            // Wenn das Feld ein DB Feld ist ... (gekennzeichnet durch fld Präfix
            if($this->isField($prop->name)) {
                // Dann erzeuge referenz auf das aktuelle Property
                $refProp = $reflection->getProperty($prop->name);
                // Setze das Property auf änderbar
                $refProp->setAccessible(true);
                // Holle den aktuellen Value aus dem Property
                $fieldVal = $refProp->getValue($this);
                // Hole den Feldnamen aus dem Value (weil ist ja inder Tabelle defeniert (array( ...)
                $fieldname = strtoupper($fieldVal[FLDNAME]);
                // Durchlaufe nun alle values der DB Tabellenzeile ...               
                foreach($row as $dbKey => $dbValue) {
                    // Wenn der DB Tabellenfeldname mit dem der Klasse übereinstimmt ...
                    if($dbKey == $fieldname) {       
                        // setze den Feldvalue im gesamtvalue auf den aus der DB.Tabelle
                        $fieldVal[FLDVALUE] = $dbValue;  
                        // und zum Schluss noch das ganze gesamtvalue (array) dem Property zuweisen - fertig ;-)
                        $refProp->setValue($this, $fieldVal);
                    }
                }                    
            }
        }
    }
    
    /**
     * Iterate through records wich are performed by fetch()<br>
     * before you use next() call fetch()
     * @return boolean true if records still exists otherwise false
     */
    final public function next() {          
        // Wenn Index erreicht wurde return false um aus schleife zu springen
        if($this->resultRowIndex >= $this->numOfRows ) {
            return false;
        } else {                    
            // Wenn Index gleich "gar nichts" ist setze es auf 0
            if($this->resultRowIndex == "") {
                $this->resultRowIndex = 0;
            }
            
            // Indiziere das Objekt anhand des Indexes
            if($this->numOfRows != 1) {
                $this->initSingleRow($this->resultRow[$this->resultRowIndex]);
            }
            
            // Erhöhre den Index um 1
            $this->resultRowIndex = $this->resultRowIndex + 1;
            // return true um durch schleifen weiter zu laufen
            return true;
        }
    }
    
    
    /**
     * Try to fix an specific error 
     */
    private function resolveError() {        
        switch($this->mysqli->errno) {
            case 1054: // unknown field -> so create the field/s
                $this->createFields();
                break;
            
            case 1064: // misunderstood command
                throw new Exception(sprintf("<b>Cannot understand this command: [<u>%s</u>]</b><br>Error: %s<br>", $this->query, $this->mysqli->error));
                break;
            
            default:
                throw new Exception(sprintf("Unknown error [%s] with errorNum [%s]<br>Statement: %s <br>", $this->mysqli->error, $this->mysqli->errno, $this->query));
                break;
        }
    }
    
    
    /**
     * Create new Fields if they do not exists
     */
    private function createFields() {        
        $this->createTableIfNotExists();        
        $vars = get_object_vars($this);
        foreach($vars as $key => $value) {
            if($this->isField($key)) {
                $phrase = "SHOW COLUMNS FROM `".$this->tableName."` LIKE '".strtoupper($value[FLDNAME])."'";
                $this->mysqli->begin_transaction();
                $result = $this->mysqli->query($phrase);
                if($result->num_rows == 0) {
                    // Kein Feld gefunden d.h. neues anlegen
                    $fldName = strtoupper($value[FLDNAME]);
                    $fldType = $value[FLDTYPE];
                    $fldLenght = $value[FLDLENGTH];
                    $alterPhrase = "ALTER TABLE ".$this->tableName." ADD ".$fldName." ".$fldType."".$fldLenght." NOT NULL";                    
                    $this->mysqli->query($alterPhrase);
                }
                if($this->mysqli->errno != 0) {
                    $this->resolveError();
                }
                $this->mysqli->commit();
                $result->close();
            }
        }
    }
    
    
    /**
     * Create a new Table if it not exist
     */
    private function createTableIfNotExists() {
        $phrase = "CREATE TABLE IF NOT EXISTS `".$this->tableName."`
                             (
                                `".FLDTABLEID[FLDNAME]."`  INT(5)    NOT NULL,
                                `".TABLEIDX."`  BIGINT(4)     AUTO_INCREMENT,
                                `".FLDCREATEDDATETIME[FLDNAME]."`  DATETIME    NOT NULL,
                                `".FLDCREATEDBY[FLDNAME]."`  VARCHAR(10)     NOT NULL,
                                `".FLDMODIFIEDDATETIME[FLDNAME]."`  DATETIME    NOT NULL,
                                `".FLDMODIFIEDBY[FLDNAME]."`  VARCHAR(10)     NOT NULL,
                                PRIMARY KEY (`".TABLEIDX."`)
                            )
                            ENGINE=INNODB";
        $this->mysqli->begin_transaction();
        $this->mysqli->query($phrase);
        $this->mysqli->commit();        
    }
    
    
    /**
     * Gets the current Error which is thrown in execute
     * @return str Error
     */
    public function getError() {
        return $this->mysqli->error;
    }
    
    
    /**
     * Gets the num of Rows in current query
     * @return int NumOf Rows
     */
    public function getNumOfRows() {
        return $this->numOfRows;
    }
    
    
    /**
     * Gets the current setted Query
     * @return str sql statement
     */
    public function getCurQuery() {
        return $this->query;
    }
    
    /**
     * Begin a Transaction
     */
    public function ttsbegin() {
        $this->ttsBeginIsSet = true;
        $this->mysqli->autocommit(false);
        $this->mysqli->begin_transaction();
    }
    
    
    /**
     * Commit an Transaction
     */
    public function ttscommit() {        
        $this->mysqli->commit();        
    }
    
    /**
     * Abort an Transaction
     */
    public function ttsabort() {
        $this->mysqli->rollback();
    }
   
}
