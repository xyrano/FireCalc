<?php
/**
 * Description of Map
 *
 * @author tanzberg
 */
final class Map extends Obj
{
    /**
     * Holds the amount of given Values
     * @var int numKeys
     */
    private $numKeys;
    /**
     * Hold the current genrated map
     * @var array map
     */
    private $map;
    
    
    /**
     * Constructs a new Object<br>
     * Its possible to genrate null value Map<br>
     * Define new Map with <b>new Map(value1, value2, ...)</b><br>
     * Or generate an Instance and set values with<br>
     * <b>$MAP->insert(value1)</b><br>
     * Remove values with <b>$MAP->remove(index)</b>
     */
    public function __construct() {
        $numArgs    = func_num_args();
        $args       = func_get_args();
        $this->generateMap($args);     
    }
    
    /**
     * Transform an Array to an Map
     * @param array $array Array which will be converted to the Map
     * @return Map
     */
    public function array2map(array $array)
    {
        $this->generateMap($array);
        return $this->map();
    }
    
    /**
     * Generate a Map from an given array
     * @param array $map Array
     */
    private function generateMap(array $map)
    {
        $this->map = $map;
        $this->numKeys = count($map);
    }
    
    /**
     * Gets an Value from an defined Index 
     * @param int $index
     * @return mixed Value of Current Index
     */
    public function getValue($index) {
        try
        {  
            if(count($this->map) > $index)
            {
                return $this->map[$index];
            }
            else
            {
                throw new Exception("Der Index liegt ausserhalb der Verfuegbarkeit");
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    /**
     * Gets an instance of an Map Object
     * @return Obj Map
     */
    public function mapObj() {
        return $this;
    }
    
    /**
     * Returns a Map, not an Object
     * @return Map 
     */
    public function map() {
        return $this->map;
    }
    
    /**
     * Gets Amount of Map Keys
     * @return int Amount
     */
    public function numKeys() {
        return $this->numKeys;
    }
    
    /**
     * Gets an MapIterator Object<br>
     * You can use the next method directly:<br>
     * <b>Map->getIterator()->next()</b>
     * @return \MapIterator Obj
     */
    public function getIterator() {
        return new MapIterator($this);
    }
    
    /**
     * Insert a value to a Map
     * @param mixed $value Value for a Map
     * @param int $key Key for a Map
     * @throws Exception if something is wrong
     */
    public function insert($value, $key = null) {
        try
        {
            if(!$key)
            {
                array_push($this->map, $value);
            }
            else
            {
                if(is_int($key))
                {
                    if($key == $this->numKeys)
                    {
                         $this->map[$key] = $value;
                    }
                    else
                    {
                        throw new Exception("Der Wert kann dem gegebenen Index nicht hinzugefuegt werden!<br>Der naechste Index ist: ".$this->numKeys);
                    }
                }
                else if(is_string($key))
                {
                    $this->map[$key] = $value;
                }
                else
                {
                    throw new Exception("Es darf kein String als Index existieren!");
                }

            }
            $this->generateMap($this->map);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    
    /**
     * Removes a value from a Map a generate new Keys
     * @param mixed $key Value for a Map
     * @param int $value Key for a Map
     * @throws Exception if something is wrong
     */
    public function remove($key = null, $value = null) {
        try
        {
            if($key == null && $value == null)
            {
                throw Exception("Kein Identifier zum entfernen gesetzt!");
            }
            else
            {
                if($key)
                {
                    unset($this->map[$key]);
                }
                
                if($value)
                {
                    $key = array_search($value,$this->map);
                    if($key !== false)
                    {
                        unset($this->map[$key]);
                    }
                }
                $this->generateMap(array_values($this->map));
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    /**
     * Merge two Maps<br>
     * You can merge more if you need use more method after<br>
     * Don´t forget to clean Redundant data if you want
     * @param Map $map1 Map
     * @param Map $map2 Map
     */
    public function merge(Map $map1, Map $map2) {
        $newMap = array_merge($map1->map(), $map2->map());
        $this->generateMap($newMap);
    }
    
    
    /**
     * If a key exist return True otherwise False
     * @return boolean True Or False
     */
    public function keyExists($key) {
        return array_key_exists($key, $this->map());
    }
    
    /**
     * If a value in the map exits return True otherwise false
     * @param mixed $value2seek value to search for
     * @return boolean True or False
     */
    public function valueExists($value2seek) {
        return in_array($value2seek, $this->map());
    }
    
    /**
     * Clear a Map Completly
     */
    final public function clear() {
        $this->generateMap(array());
    }
    
    /**
     * Get the current Length of Map
     * @return int Length of current Map
     */
    public function getLength() {
        if($this->map() && $this->map() != null) {
            return count($this->map());
        } else {
            return 0;
        }
    }
    
    
    /**
     * Delete values which exists twice or more times<br>
     * It cleans the map from Redunant Data
     */
    final public function cleanRedundantData() {
        $this->map = array_unique($this->map);
        $this->map = array_values($this->map);
        $this->numKeys = count($this->map);
    }
}
