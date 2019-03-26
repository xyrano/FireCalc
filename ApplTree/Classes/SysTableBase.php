<?php

abstract class SysTableBase extends Database
{
    /**
     * Check if the field is an Database field<br>
     * Perform check on the first 3 chars = fld
     * @param str $potentialField str
     * @return boolean true if it is an Database Field
     */
    public static function isField($potentialField) {
        if(strtoupper(substr($potentialField, 0, 3)) == "FLD") {
            return true;
        }
        
        return false;
    }
    
    /**
     * Gets the Fieldlength without ( and )
     * @param Fld $field Field
     * @return int Length of Field without ()
     */
    public static function getFieldLength($field) {
        return substr($field[FLDLENGTH], 1, strlen($field[FLDLENGTH])-2);
    }
}
?>
