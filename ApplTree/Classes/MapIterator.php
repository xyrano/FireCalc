<?php
/**
 * Description of MapIterator
 *
 * @author tanzberg
 */
require_once("Map.php");
final class MapIterator extends Obj
{
    
    /**
     * Holds the Map
     * @var array Map
     */
    private $map;
    /**
     * Holds the Amount of the current Map values
     * @var int Amount
     */
    private $numArgs;
    /**
     * Holds the next Index for a Map
     * @var int Index
     */
    private $next;
    /**
     * Holds the Current Index for a Map
     * @var int Index
     */
    private $index;
    
    
    /**
     * Constructs a new MapIterator Object<br>
     * You have two Options:<br>
     * 1. you get MapIterator from <b>$MAP->getIterator()</b><br>
     * 2. you get MapIterator from <b>ITERATOR = new MapIterator(MAP)</b>
     * @param Map $map Object
     */
    public function __construct(Map $map) {
        $this->map      = $map->map();
        $this->numArgs  = $map->numKeys();
        $this->next     = -1;
        $this->index    = $this->numArgs;
    }
    
    /**
     * Gets the next Index for a loop through the Map
     * @return int Index
     */
    public function next() {
        $next = $this->numArgs;
        
        if($this->numArgs > 0) {
            $this->numArgs = ($this->numArgs - 1);
        }
       
        if($this->index > $this->next) {
            $this->next = ($this->next + 1);
        }
        
        return $next;
    }
    
    /**
     * Gets the current value where the Pointer are on
     * @return mixed Value
     */
    public function currentValue() {
        try
        {
            if($this->currentKey() == -1)
            {
                echo "Wrong usage of ".__CLASS__."/".__FUNCTION__."<br>Wrong Index";
            }
            else
            {
                return $this->map[$this->currentKey()];
            }
        } catch (Exception $ex) {
            Obj::getException($ex);
        }   
    }
    
    /**
     * Get the current Index where the pointer is current on it
     * @return int Index
     */
    public function currentKey() {
        return $this->next;
    }
    
    /**
     * Get the current initialized Map
     * @return Map map
     */
    public function map() {
        $MAP = new Map();
        $MAP = $this->map;
        return $MAP;
    }
}
