<?php
/**
 * Description of DateTimeUtil
 *
 * @author tanzberg
 */
class DateTimeUtil extends Obj
{ 
    const dateDay           = "d";
    const dateMonth         = "m";
    const dateYear          = "Y";
    const timeHour          = "H";
    const timeMin           = "i";
    const timeSec           = "s";
    const dateTimePattern   = "Y-m-d H:i:s";
    const datePattern       = "Y-m-d";
    const timePattern       = "H:i:s";
    
    private $date;
    private $time;
    private $dateTime;
    
    
    /**
     * Create a new Object if no dateTime parm is given the currentDateTime will be used
     * @param str $dateTime DateTime string e.g. 2017-02-24 18:13:30
     */
    public function __construct($dateTime = null) {
            
        if(is_object($dateTime))
        {           
            // maybe DateTimeUtil::dateNull -> new DateTime Object
            $this->parmDateTime($dateTime);
        }
        else
        {
            if($dateTime != null)
            {
                $this->parmDate($dateTime);       
                $this->parmTime($dateTime);        
                $this->parmDateTime($dateTime);            
            }  
            else
            {
                $this->parmDate($this->curDateTime()->format(self::datePattern));
                $this->parmTime($this->curDateTime()->format(self::timePattern));
                $this->parmDateTime($this->curDateTime()->format(self::dateTimePattern));
            }
        }
    }
    
    
    final public static function populateGermanDateTimeFormat() {
        return self::dateDay.".".self::dateMonth.".".self::dateYear." ".self::timeHour.":".self::timeMin.":".self::timeSec;
    }
    
    
    
    /**
     * Store and return the given Date by creating an instance of the obj
     * @param DateTime $date the given date
     * @param string $format Pattern from DateTimeUtil to format the Date
     * @return Date date whitch is given by Object creating
     */
    public function parmDate($date = null, $format = self::datePattern) {
        if($date != null)
        {            
            $this->date = new DateTime($date);           
        }
        return $this->date->format($format);
    }
    
    /**
     * Store and return the given Time by creating an instance of the obj
     * @param DateTime $time DateTime Object
     * @param str $format Format the return DateTimeObject
     * @return Time time whitch is given by Object creating
     */
    public function parmTime($time = null, $format = self::timePattern) {
        if($time != null)
        {
            $this->time = new DateTime($time); 
        }
        return $this->time->format($format);
    }
    
    /**
     * Store and return the given DateTime by creating an instance of the obj
     * @param DateTime $dateTime DateTime String or Object
     * @return DateTime dateTime whitch is given by Object creating
     */
    public function parmDateTime($dateTime = null, $format = self::dateTimePattern) {
        if(is_object($dateTime))
        {            
            $this->dateTime = $dateTime->format($format);
        }
        
        if($dateTime != null && !is_object($dateTime))
        {
            $dateTime = new DateTime($dateTime);
            $this->dateTime = $dateTime->format($format);
        }
       
        return $this->dateTime;
    } 
    
    /**
     * Returns a new DateTime obj - DateTime from creating
     * @return \DateTime dateTime
     */
    public function curDateTime() {
        return new DateTime();
    }
    
    /**
     * Get the DateTime string in format
     * @param str $dateTime specified DateTime
     * @param str $format optional Format pattern default is self::dateTimePattern
     * @return string DateTime with format 
     */
    public static function dateTime($dateTime, $format = self::dateTimePattern) {
        $dt = new DateTime($dateTime);
        return $dt->format($format);
    }
    
    public static function dateTimeFromTimestamp($timestamp, $format) {
        $dt =  new DateTime(date(self::dateTimePattern, $timestamp));
        return $dt->format($format);
    }
    
    
    /**
     * Validate a date, throws a exception if its not valid
     * @param string $date any format but date
     * @return boolean true if its valid
     * @throws Exception if Date is not valid
     */
    public static function validateDate($date) {
        if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) // has to be YYYY-MM-DD
        {
            $dt = new DateTime($date);
            $d = $dt->format(self::dateDay);
            $m = $dt->format(self::dateMonth);
            $y = $dt->format(self::dateYear);
            if(!checkdate($m, $d, $y))
            {
                throw new Exception("Das Datum [".$date."] entspricht keinem g&uuml;ltigen Format");
            }
            else
            {
                return true; 
            }
        }
        else
        {
            throw new Exception("Das Datum [".$date."] entspricht nicht dem Format 'YYYY-MM-DD'");
        }
    }
    
    /**
     * validate the Time and throws an Eception if its not valid
     * @param string $time any Format but time
     * @return boolean true if Time is valid
     * @throws Exception if Time is not valid
     */
    public static function validateTime($time) {
        $dt = new DateTime($time);
        $h = $dt->format(self::timeHour);
        $i = $dt->format(self::timeMin);
        $s = $dt->format(self::timeSec);
        $valid = new DateTimeUtil();
        if(!$valid->checktime($h, $i, $s))
        {
            throw new Exception("Das Zeitformat [".$time."] entspricht keinem g&uuml;ltigen Format");
        }
        else
        {
            return true;
        }
    }
    
    
    private function checktime($hour, $min, $sec) {
        if ($hour < 0 || $hour > 23 || !is_numeric($hour)) {
            return false;
        }
        if ($min < 0 || $min > 59 || !is_numeric($min)) {
            return false;
        }
        if ($sec < 0 || $sec > 59 || !is_numeric($sec)) {
            return false;
        }
        
        return true;
    } 
    
    /**
     * Get the years till now of an individual Date
     * @param Date $date Date
     * @return int Age (years)
     */
    public static function getAge($date) {
        $d = new DateTime($date);
        $t = new DateTime(self::currentDateTime(self::datePattern));
        $interval = $t->diff($d);
        
        $years = $interval->format("%Y");
        if($years == date(self::dateYear,time()))
        {
            return 0;
        }
        else
        {
            return $years;
        }        
    }
    
    /**
     * Gets an static curDateTime obj with format if exists<br>
     * if no format exists, default = DateTimeUtil::dateTimePattern
     * @param string $format
     * @return Obj DateTime string
     */
    public static function currentDateTime($format = null) {
        $dt = new DateTimeUtil();
        if($format == null) {
            $format = DateTimeUtil::dateTimePattern;
        }
        return $dt->curDateTime()->format($format);
    }
    
    /**
     * Get the Diff from two times<br>
     * 
     * @param DateTime $dateTime1 FirstDateTime Parameter
     * @param DateTime $dateTime2 SecondDateTime Parameter
     * @param string $value format, default is seconds (DateTimeUtil::)
     * @return mixed default is seconds
     */
    public static function diffFromDateTimes($dateTime1, $dateTime2, $value = DateTimeUtil::timeSec) {
        //echo $dateTime1." - ".$dateTime2 . "<br>";
        $dt1 = new DateTime($dateTime1);
        $dt2 = new DateTime($dateTime2);
        $interval = $dt2->diff($dt1);

        $mixed = $interval->format("%".$value);
        return $mixed;
    }
    
    /**
     * Tranlate an Num of Month into Name of month in specific Language
     * @param int $monthNum Numeric format of Month
     * @return String string of Monthname in Language
     */
    public static function monthNum2Name($monthNum) {
        return DateTimeTxt::monthNames(IsoCodes::$isoDE)[$monthNum];        
    }
    
    
    /**
     * Add Seconds to a DateTime Object and return the DateTime Object
     * @param DateTime $dateTime DateTime Object
     * @param int $sec Seconds to add
     * @return \DateTime Object
     */
    public static function addTimeSec2DateTime(DateTime $dateTime, $sec) {
        $dateTime->add(new DateInterval("PT".$sec."S"));
        return $dateTime;
    }
    
    
    /**
     * Add or sub a day/s by typing -3 or 17<br>
     * You get back an DateTime formated object
     * @param int $day Day to sub or add
     * @param str $format Date Format default by self::datePattern
     * @return DateTime->format dateTime formated obj
     */
    public function addYears($year, $format = self::datePattern) {
        $date = new DateTime($this->parmDate());
        if($year < 0)
        {
            $date->sub(new DateInterval("P".abs($year)."Y"));
        }
        else
        {
            $date->add(new DateInterval("P".$year."Y"));
        }
        return $date->format($format);        
    }
    
    
    /**
     * Add or sub a day/s by typing -3 or 17<br>
     * You get back an DateTime formated object
     * @param int $day Day to sub or add
     * @param str $format Date Format default by self::datePattern
     * @return DateTime->format dateTime formated obj
     */
    public function addDays($day, $format = self::datePattern) {
        $date = new DateTime($this->parmDate());
        if($day < 0)
        {
            $date->sub(new DateInterval("P".abs($day)."D"));
        }
        else
        {
            $date->add(new DateInterval("P".$day."D"));
        }
        return $date->format($format);        
    }
    
    /**
     * Add or sub a hour/s Min/s Sec/s by typing -3 or 17<br>
     * You get back an DateTime formated object
     * @param int $value Value to sub or add
     * @param str $format Time Format default by self::datePattern
     * @return DateTime->format dateTime formated obj
     */
    public function add($value, $timeUnit, $format = self::timePattern)
    {
        try
        {                   
            $time = new DateTime($this->parmTime());
            if($value < 0)
            {
                //$time->sub(new DateInterval("PT".abs($hour)."H"));
                $time->sub(new DateInterval("PT".abs($value)."".$timeUnit));
            }
            else
            {
                //$time->add(new DateInterval("PT".$hour."H"));
                $time->add(new DateInterval("PT".$value."".$timeUnit));
            }
           
            return $time->format($format);
        }
        catch(Exception $ex)
        {
            return $ex->getMessage();
        }
    }
    
    /**
     * Get an HTML Time Enum (0-23)h
     * @param string $elemName HTML Element Name
     * @param string $elemId HTML Element ID
     * @return string HTML Enum (<select name="" id=""><option value="">content</option></select>)
     */
    public static function timeEnum($elemName, $elemId) {
        $enum = "";
        $body = "";
        $header = "<select name=\"".$elemName."\" id=\"".$elemId."\">";
        for($i=0; $i<=23; $i++) 
        {
            if($i<10)
            {
                $body .= "<option value=\"0".$i.":00\">0".$i.":00</option>";
            }
            else 
            {
                $body .= "<option value=\"".$i.":00\">".$i.":00</option>";
            }
        }
        $footer = "</select>";
        
        $enum .= $header;
        $enum .= $body;
        $enum .= $footer;
        
        return $enum;        
    }
    
    
    public static function enumMonths() {
        $enum = "";
        $body = "";
        $header = "<select name=\"month\" id=\"month\">";
        foreach(DateTimeTxt::monthNames(CalendarParameter::find()->isoCode()) as $key => $monthName) {
            $body .= "<option value=\"".$key."\">".$monthName."</option>";
        }
        $footer = "</select>";
        
        $enum .= $header;
        $enum .= $body;
        $enum .= $footer;
        
        return $enum;
    }
    
    /**
     * Get an constant null value of an date which is defined into sysConstants
     * @param str $format <b>Optional</b> return dateTime in format otherwise DateTime Obj
     * @return \DateTime "Null" value of date <b>or</b> formated str 
     */
    public static function dateNull($format = null) {
        $dt = new DateTime(SysConstants::sysDateNull);
        if($format != null)
        {
            return $dt->format($format);
        }
        return $dt;
    }
    
}
