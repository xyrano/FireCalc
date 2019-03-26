<?php
/**
 * Description of SysPropertys
 *
 * @author tanzberg
 */
class SysPropertys 
{
    /**
     * Generate an array from name, type and optional value<br>
     * and get it back as an System Field Property for all DB Fields
     * @param string $fldname The Internal Name of the Field (Is formed in Capital Letters)
     * @param string $fldType The Database Field Type e.g. vahrchar or int etc.
     * @param string $fldValue The Value if this Field is pre initiated
     * @return Array fieldProperty FieldProperty
     */
     public static function fldProp($fldname, $fldType, $fldValue = null) {
        return array(sysFldName => strtoupper($fldname), sysFldValue => $fldValue, sysFldType => $fldType);
    }
}
