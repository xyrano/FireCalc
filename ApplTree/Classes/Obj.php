<?php
/**
 * Description of Object
 *
 * @author tanzberg
 */
class Obj 
{
    /**
     * Represent this Object to a formated string
     */
    public function toString() {
        echo "<pre>";
        echo var_dump($this);
        echo "</pre>";
    }
    
    
    /**
     * Check a FieldValue if value is empty, return TRUE if its empty
     * <b>base method</b>
     * @param mixed $fieldValue any FieldValue
     * @return boolean TRUE if its empty otherwise FALSE
     */
    final protected function isValueEmpty($fieldValue)
    {
        if($fieldValue == '' 
        || $fieldValue == "" 
        || $fieldValue == null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
    /**
     * Check if a DateTimeUtil -> parmDateTime value is empty - if so then return true
     * @param DateTimeUtil $dateTimeUtil DateTimeUtil Object
     * @return boolean true if it´s 'empty'
     */
    final protected function isValueEmptyDateTime(DateTimeUtil $dateTimeUtil) {        
        if($dateTimeUtil->parmDateTime() == DateTimeUtil::dateTime(SysConstants::sysDateNull))
        {
            return true;
        }
        
        return false;
    }
    
    /**
     * Check if a DateTimeUtil ->parmTime() value is empty - if it´s empty return true
     * @param DateTimeUtil $dateTimeUtil Object
     * @return boolean true if it´s empty
     */
    final protected  function isValueEmptyTime(DateTimeUtil $dateTimeUtil) {
        if($dateTimeUtil->parmTime(null, DateTimeUtil::timePattern) == DateTimeUtil::dateTime(SysConstants::sysDateNull, DateTimeUtil::timePattern)) {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * Check if a DateTimeUtil ->parmTime() value is empty - if it´s empty return true
     * @param DateTimeUtil $dateTimeUtil dateTime Object
     * @return boolean true if it´s empty
     */
    final public static function isTimeValueEmpty(DateTimeUtil $dateTimeUtil) {
        $obj = new Obj();
        if($obj->isValueEmptyTime($dateTimeUtil)) {
            return true;
        }
        return false;
    }


    
    /**
     * Checks if a value is empty and return true otherweise return false<br>
     * <b>static method</b>
     * @param mixed $value any Value to check
     * @return boolean True if its empty otherwise false
     */
    final public static function isValEmpty($value) {
        $obj = new Obj();
        if($obj->isValueEmpty($value)) {
            return true;
        } 
        return false;
    }
    
    
    /**
     * Return "ja" or "nein" if int is 1 or 0
     * @param int $num Num from Enum
     * @return string Ja or Nein
     */
    public static function num2NoYes($num) {
        if($num == 0) {
            return "Nein";
        } else {
            return "Ja";
        }
    }
    
    /**
     * Gets an formated structure of an Exception<br>
     * You can get also without details or with details by specify the $onlyMessage Attr
     * @param Exception $ex Exception
     * @param boolean $onlyMessage true if you want to get only the Message
     */
    final public static function getException(Exception $ex, $onlyMessage = false) {
        if($onlyMessage)
        {
            echo "<fieldset><legend>Error</legend>";
            echo "Message: ".$ex->getMessage();
            echo "</fieldset>";
        }
        else
        {
            echo "<fieldset><legend>Error</legend>";
            echo "<pre>";
            echo $ex->getTraceAsString();
            echo "</pre><br>";
            echo "Line: ".$ex->getLine()." in ".$ex->getFile()."<br>";
            echo "Message: ".$ex->getMessage();   
            echo "</fieldset>";
        }
    }
    
    
    /**
     * return true if the searched needle were found in the haystack
     * @param str $str Source String
     * @param str $find str to be find in the source String
     * @return boolean true if $find were found
     */
    final public static function strFind($str, $find) {
        if(strpos($str, $find) !== false) {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * Was the Page refrsehd by hitting F5 or Ctrl + F5 then return true otherwise return false
     * @return boolean true if page was refreshed
     */
    final public static function isPageRefreshed() {
        $pageWasRefreshed = false;
        
        $a = new AdminSetup(AdminSetup::getLastRecId());
        // If admin have checked that the idleTime should be updated by F5 refresh, then the code into the braces is executed
        if(!$a->fldPageRefreshUpdatesIdleTime[FLDVALUE]) {
            $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0'; // get true if it´s refreshed
        }
        return $pageWasRefreshed;
    }
    
    
    /**
     * Hold the User Object
     * @return \UserTable
     */
    final public static function user() {
        return new UserTable(UserOnline::find()->fldUserRecId[FLDVALUE]);
    }
    
    /**
     * 
     * @param type $tableName
     * @param type $recId
     * @return \tableName
     */
    final public function Table($tableName, $recId){
        $obj = new $tableName($recId);
        if(is_object($obj))
        {
            return $obj;
        }
    }
}
