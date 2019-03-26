<?php

class GroupSuffix extends Obj
{
    private static $suffixes = array(0 => "A1", 1 => "A2", 3 => "A3", 4 => "B1", 5 => "B2", 6 => "B3", 7 => "C1", 8 => "C2", 9 => "C3", 10 => "K1", 11 => "K2");
    
    
    /**
     * Get HTML Enum of Suffixes
     * @param str $elemId id of Html Element
     * @param int $selected set selected value to value
     * @return HTML-Enum enum
     */
    public static function getEnum($elemId, $selected) {
        
        $header = '<select id="'.$elemId.'">';
        $body = '';
        foreach(self::$suffixes as $key => $val)
        {
            $sel = ($selected == $val) ? "selected": "";
            $body .= '<option value='.$key.' '.$sel.'>'.$val.'</option>';
        }
        $footer = '</select>';
        
        return $header.$body.$footer;
    }
    
    
    public static function id2Suffix($id) {
        foreach(self::$suffixes as $key => $val) {
            if($key == $id)
                return $val;
        }
    }
    
    public static function suffix2Id($suffix) {
        foreach(self::$suffixes as $key => $val) {
            if($val == $suffix)
                return $key;
        }
    }
    
}
