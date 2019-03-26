<?php


abstract class Base
{
    /**
     * Cut the last comma from a string
     * @param str $str String with comma at the end
     * @return str String without comma at last char
     */
    public function cutLastComma($str) {
        return substr($str, 0, strlen($str)-1);
    }
    
    /**
     * Represent Obj to string
     * @param mixed $obj [Optional] Mixed var
     */
    public function toString($obj = null) {
        echo "<pre>";
        if($obj != null)
            echo var_dump($obj);
        else 
           echo var_dump($this);
        echo "</pre>";
    }
}
