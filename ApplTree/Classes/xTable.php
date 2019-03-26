<?php
/**
 * Description of xTable
 *
 * @author tanzberg
 */
class xTable extends Obj
{
    
    /**
     * Class SQL Object
     * @var SQL SQL Object attribute
     */
    private $SQL;
    
    /**
     * Prefix for Fields to identify the SQL Fields
     * @var String Field Prefix for TableFields
     */
    private static $fldPrfx = "fld";
    
    /**
     * Holds the Table cache by initiating
     * @var Obj Original Table Cache
     */
    protected $origTbl;
    
    /**
     * Map with SQL Fields
     * @var Map Map of Fields 
     */
    protected $fieldMap; 
    
    
    /**
     * Gets the DateTime which the was created
     * @var DateTime Created DateTime
     */
    protected $createdDateTime;
    
    /**
     * Gets the CreatedBy User Abbreveation
     * @var string CreatedBy 
     */
    protected $createdBy;
    
    /**
     * Geht the DateTime which the record was last modified
     * @var DateTime Modified DateTime
     */
    protected $modifiedDateTime;
    
    /**
     * Gets the ModifiedBy User Abbreveation
     * @var string Modified By
     */
    protected $modifiedBy;
    
    /**
     * Construct a new SQL Object<br>
     * Prevent loading by blocking with <b>true</b><br>
     * otherweise the table will be Preinitilaized
     * @param String $tableName "Table name" string
     * @param Boolean $blockLoading "Block initial loading" increase perfomance (true if should be blocked)
     */
    public function __construct($tableName, $blockLoading = false) {
        $this->SQL = new Sql($tableName, $blockLoading);
    }
    
    /**
     * Gets the Original Table cache<br>
     * Refers to methods and attributes to current cached Table<br>
     * <b>It have to be initiated first, otherwise attributes are empty</b>
     * @return Obj TableCache
     */
    final public function orig() {
        return $this->origTbl;
    }
    
    /**
     * Gets an Map with all RecId´s
     * @return Map map with all recid
     */
    final protected function selectAll(){        
        return $this->SQL->selectRecIdAll(); // MAP
    }
    
    /**
     * Selects all RecIds with given orderby Or Where clause and return a map<br>
     * <b>Where is also acceptable - then declare $this->selectAllOrderBy("WHERE xxx=yyyy")</b>
     * @param string $orderBy RecId normally it can be overwritten
     * @return Map map with RecId
     * @throws Exception
     */
    final protected function selectAllOrderBy($orderBy = null) {
        if($orderBy == null)
            $orderBy = " ORDER BY ".SysConstants::sysDbFldIndex;
        
        if(!isset($this->fieldMap) || $this->fieldMap->getLength() <= 0)
        {
            throw new Exception(__FUNCTION__ ." in ".__CLASS__ ." Map is empty!");
        }
        
        return $this->SQL->selectRecIdAllOrderBy($orderBy, $this->fieldMap); 
    }
    
    /**
     * Get the current setted Statement
     * @return string Current statement
     */
    final public function getCurStmt() {
        return $this->SQL->getCurrentStatement();
    }
    
    /**
     * 
     * @param int $recStart Num of who the record started
     * @param int $numOfRecords Num of records to receive
     * @return Map i guess :-|
     */
    final protected function selectAllPerPage($recStart, $numOfRecords) {
        return $this->SQL->selectRecIdAllPerPage($recStart, $numOfRecords);
    }
    
    /**
     * Generate a FieldMap for specified Object
     * @param Obj $obj Object to initiate
     */
    final protected function xGenerateFieldSet($obj) {
        $fldMap = new Map();
        $reflection = new ReflectionClass($obj);
        foreach($reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $prop ) 
        {  
            // check on TableId exists
            if(strtoupper($prop->name) == SysConstants::sysDbTableId)
            {
                $refProp = $reflection->getProperty($prop->name);
                $refProp->setAccessible(true);
                $value = $refProp->getValue($obj); // value is the TableId
                $fldMap->insert(SysPropertys::fldProp($prop->name, "INT(5)", $value));                                        
                 //echo var_dump($fldMap)."<br>".$value."<hr>";        
            }
            
            // Identifizierung der Feldnamen
            if(substr($prop->name, 0, strlen(self::$fldPrfx)) == self::$fldPrfx) 
            {                           
                $refProp = $reflection->getProperty($prop->name);
                $refProp->setAccessible(true);   
                $value = $refProp->getValue($obj);
                $fldMap->insert($value);            // value equals an array (FIELDNAME => "name", VALUE => "value", DBTYPE => "DbType")
            }
        }
                      
        $this->fieldMap = $fldMap;         
    }
    
    /**
     * Load an Object from an existing Session that were temporaly stroed before<br>
     * first save Object to Session: should look like: $key, Map $parameterMap - > <b>Session[key][value]</b><br>
     * second: load Object on a other time where it will be used with Object and the SessionKey e.g. <b>loadObjectFromSession($this, $_SESSION[key])</b>
     * @param Class $object Object what will be loaded
     * @param Session $storedObjectSession Session wich the saved object is in
     */
    final protected function loadObjectFromSession($object, $storedObjectSession) {
        $reflection = new ReflectionClass($object);
        foreach($reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $prop ) 
        {
            if(substr($prop->name, 0, strlen(self::$fldPrfx)) == self::$fldPrfx)
            {
                $refProp = $reflection->getProperty($prop->name);
                $refProp->setAccessible(true);
                $fieldVal = $refProp->getValue($object);
                $fieldname = $fieldVal[SysConstants::sysFldName];
                if(key($storedObjectSession) == $fieldname)
                {
                    $value = SysPropertys::fldProp($fieldVal[SysConstants::sysFldName], $fieldVal[SysConstants::sysFldType], $storedObjectSession[$fieldname]);
                    next($storedObjectSession);                     
                    $refProp->setValue($object, $value); 
                }
            }
        }
    }
    
    
    /**
     * Initiate all Table Object attributes with relevant SQL Values<br>
     * it will be initiated by given recId
     * @param Obj $obj Table Object
     */
    final protected function xInit($obj) {  
        $fldMap = new Map();
        $map = $this->SQL->select($obj->recId);
        $reflection = new ReflectionClass($obj);
        foreach($reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $prop ) 
        {
            if(substr($prop->name, 0, strlen(self::$fldPrfx)) == self::$fldPrfx)
            {
                $refProp = $reflection->getProperty($prop->name);
                $refProp->setAccessible(true);
                $fieldVal = $refProp->getValue($obj);
                $fieldname = strtoupper($fieldVal[SysConstants::sysFldName]);
                if($map->keyExists($fieldname))
                {    
                    $fldMap->insert($fieldVal); // build FieldMap
                    $value = SysPropertys::fldProp($fieldVal[SysConstants::sysFldName], $fieldVal[SysConstants::sysFldType], $map->getValue($fieldname));
                    $refProp->setValue($obj, $value);                                 
                }                   
            }
        } 
        $this->createSysFields($map);
        $this->SQL->createFieldsIfNotExists(new MapIterator($fldMap));
        
        $this->origTbl = clone($this); // Initiate the TableCache - usefull for validating old values with news values
    }
    
    
    /**
     * Do an Insert with given <b>fld</b> Attribute prefixes<br>
     * into the specified table
     * @param Obj $obj Table Object
     * @return Boolean return true if it´s inserted otherwise returns false
     */
    final protected function xInsert($obj) {  
        try
        {
            $fldMap = new Map();
            $valMap = new Map();

            $reflection = new ReflectionClass($obj);
            foreach($reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $prop ) {  
                // check on TableId exists
                if(strtoupper($prop->name) == SysConstants::sysDbTableId)
                {
                    $refProp = $reflection->getProperty($prop->name);
                    $refProp->setAccessible(true);
                    $value = $refProp->getValue($obj);
                    $valMap->insert($value); // normal value
                    $fldMap->insert(SysPropertys::fldProp($prop->name, "INT(5)", $value));               
                }
                
                // Identifizierung der Feldnamen
                if(substr($prop->name, 0, strlen(self::$fldPrfx)) == self::$fldPrfx) 
                {                           
                    $refProp = $reflection->getProperty($prop->name);
                    $refProp->setAccessible(true);                  
                    $value = $refProp->getValue($obj);
                    $valMap->insert($value[SysConstants::sysFldValue]);
                    $fldMap->insert($value); // sollte ein Array mit den PropertyDefinitionen sein
                }
            }
            
            return $this->SQL->insert(new MapIterator($fldMap), new MapIterator($valMap));   
        }
        catch(Exception $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    
    
    /**
     * Do an Update for given RecId<br>
     * Iterating through all Fields for this Table Object
     * @param Obj $obj Table Object
     * @return Boolean return true if it´s updated otherwise returns false
     * @throws Exception Throws Exception if RecId isn´t set
     */
    final protected function xUpdate($obj) {        
        $recId = null;            
        $fldMap = new Map(); // new map which holds the SQL Fields
        $reflection = new ReflectionClass($obj);
        $recId = $this->getRecIdFromObj(clone $obj);
        
        if($recId == null) {
            throw new Exception("Kernel: Update cannot be executed because no recId were found");
        }
        
        foreach($reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $prop ) 
        {
            // check on TableId exists
            if(strtoupper($prop->name) == SysConstants::sysDbTableId)
            {
                $refProp = $reflection->getProperty($prop->name);
                $refProp->setAccessible(true);
                $value = $refProp->getValue($obj);                
                $fldMap->insert(SysPropertys::fldProp($prop->name, "INT(5)", $value));               
            }
            
            if(substr($prop->name, 0, strlen(self::$fldPrfx)) == self::$fldPrfx) 
            {
                $refProp = $reflection->getProperty($prop->name);
                $refProp->setAccessible(true);                  
                $value = $refProp->getValue($obj);
                $fldMap->insert($value); // sollte ein Array mit den PropertyDefinitionen sein
            }
        }    
        return $this->SQL->update($obj->recId, new MapIterator($fldMap));//, new MapIterator($valMap));        
    }
    
    /**
     * Gets the RecId from given Oject<br>
     * It´s private and used for update query
     * @param TableObject $obj
     * @return int RecId
     */
    final private function getRecIdFromObj($obj) {
        $reflect = new ReflectionClass($obj);
        foreach($reflect->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {               
            if(strtoupper($property->name) == SysConstants::sysFldPrimaryKey) {
                $refProp = $reflect->getProperty($property->name);
                $refProp->setAccessible(true);
                return $refProp->getValue($obj);
            }
        }
    }
    
    
    /**
     * Delete a record by given <b>recId</b>
     * @param Obj $obj Table Object
     * @return Boolean returns true if it´s Deleted otherwise it will return false
     */
    final protected function xDelete($obj) {
        if($obj->recId != 0) {
            return $this->SQL->delete($obj->recId);
        } else {
            return false;
        }            
    }
    
    
    
    /***
     * Create only System Fields
     */
    final private function createSysFields(Map $map) {
        if($map->keyExists(SysConstants::sysSqlModifiedDateTime)) {
            $this->modifiedDateTime = $map->getValue(SysConstants::sysSqlModifiedDateTime);
        }
        if($map->keyExists(SysConstants::sysSqlCreatedDateTime)) {
            $this->createdDateTime = $map->getValue(SysConstants::sysSqlCreatedDateTime);
        }
        if($map->keyExists(SysConstants::sysSqlCreatedyBy)) {
            $this->createdBy = $map->getValue(SysConstants::sysSqlCreatedyBy);
        }
        if($map->keyExists(SysConstants::sysSqlModifiedBy)) {
            $this->modifiedBy = $map->getValue(SysConstants::sysSqlModifiedBy);
        }
    }
    
    /**
     * Get the DateTime where the Record was created
     * @param string $format Format from DateTimeUtil
     * @return DateTime dateTime
     */   
    final public function createdDateTime($format = null) {
        if($format != null)
        {
            return DateTimeUtil::dateTime($this->createdDateTime, $format);
        }
        return $this->createdDateTime;
    }
    
    
    /**
     * Get the DateTime where the Record was last modified
     * @param string $format Format from DateTimeUtil
     * @return DateTime dateTime
     */
    final public function modifiedDateTime($format = null) {
        if($format != null)
        {
            return DateTimeUtil::dateTime($this->createdDateTime, $format);
        }
        return $this->modifiedDateTime;
    }
    
    /**
     * Get the Username of the user who created the record
     * @return str Username
     */
    final public function createdBy() {
        return $this->createdBy;
    }
    
    
    /**
     * Get the Username of the <b>last</b> user who modified the record
     * @return str Username
     */
    final public function modifiedBy() {
        return $this->modifiedBy;
    }
    
   
    
}
