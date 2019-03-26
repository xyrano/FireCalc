<?php
/**
 * Description of ErrorValues
 *
 * @author tanzberg
 */
class ErrorAdditions extends SysTable
{
    /**
     * Tablename
     * @var str Tablename 
     */
    public $tableName = "ErrorAdditions";
    
    /**
     * Holds the RecId
     * @var int RecId
     */
    public $fldRecId = FLDRECID;
    
    /**
     * Holds the ContestId
     * @var int RecId
     */
    public $fldContestId = FLDCONTESTID;
    
    /**
     * Holds the RecId
     * @var int RecId 
     */
    public $fldGroupRecId = FLDGROUPID;
    
    
    /**
     * Holds the Competition Type (A-Teil o B-Teil)
     * @var str CompetitionType
     */
    public $fldCompetitionType = FLDCOMPETITIONTYPE;
    
    /**
     * Holds the indicator (ow oder ufh)
     * @var str indicator 
     */
    public $fldIndicator = FLDINDICATOR;
    
    /**
     * Holds the Flag Disqualified
     * @var int Disqualified
     */
    public $fldDisqualified = FLDDISQUALIFIED;
    
    /**
     * Holds the Contest Time for Gruppenführer
     * @var Time ContestTimeGF
     */
    public $fldContestTimeGF = FLDCONTESTTIMEGF;
    
    /**
     * Holds the Contest Time for Maschinist
     * @var Time ContestTimeMA
     */
    public $fldContestTimeMA = FLDCONTESTTIMEMA;
    
    /**
     * Holds the Time for Knotting Angriffstrupp
     * @var Time TimeKnotsAT
     */
    public $fldTimeKnotsAT = FLDTIMEKNOTSAT;
    
    /**
     * Holds the Time for Knotting Wassertrupp
     * @var Time TimeKnotsWT
     */
    public $fldTimeKnotsWT = FLDTIMEKNOTSWT;
    
    
    public $who;                // Wer (also wer hat den Fehler verursacht) z.b.: ME = Melder oder ATF oder AT oder ATM (Angriffstrupp- führer, mann oder Trupp)
    public $timeValue;
    
    
    /**
     * Construct a new Object
     * @param int $recId RecId
     * @param int $groupId GroupRecId
     * @param str $competitionType A-Teil oder B-Teil
     */
    public function __construct($recId = null, $groupId = null, $competitionType = null) 
    {
        parent::__construct();
        if($recId != null && $groupId == null && $competitionType == null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }
        
        if($groupId)
        {
            if(!$competitionType) {
                throw new Exception("CompetitionType have to be declared to get an exclusive map of Errors!");
            }
            $this->fldCompetitionType[FLDVALUE]= $competitionType;
            $this->fldGroupRecId[FLDVALUE] = $groupId;
            $this->initFromGroupRecId();
        }
    }
    
    /**
     * Initiate all Error Value Records based on GroupRecId and CompetitionType (A-Teil oder B-Teil)
     */
    public function initFromGroupRecId() {
        $this->initAll()->where($this->fldGroupRecId[FLDNAME]." = '".$this->fldGroupRecId[FLDVALUE]."'"
                . " AND ".$this->fldCompetitionType[FLDNAME]." = '".$this->fldCompetitionType[FLDVALUE]."'")->fetch();       
    }
    
    /**
     * Gets the TableId
     * @return int TableId
     */
    public static function tableId() {
        return tablenum(new ErrorAdditions());
    }
    
    /**
     * Find an Record to an specific Recid
     * @param int $recId RecId
     * @return \ErrorValues Record
     */
    public static function findRecId($recId) {
        return new ErrorAdditions($recId);
    }
    
    
    public static function find($competitionType, $groupRecId, $indicator) {
        $T = new ErrorAdditions();
        $T->query = "SELECT " . $T->fldRecId[FLDNAME] . " FROM " . $T->tableName . " "
                . " WHERE " . $T->fldCompetitionType[FLDNAME] . " = '" . $competitionType . "' "
                . " AND " . $T->fldGroupRecId[FLDNAME] . " = '" . $groupRecId . "' "
                . " AND " . $T->fldIndicator[FLDNAME] . " = '" . $indicator . "'";
        $rec = $T->fetchCounted();
        return new ErrorAdditions($rec[$T->fldRecId[FLDNAME]]);
    }
    
    
    /**
     * Returns a RecId which is ready to update
     * @return int RecId
     */
    private function findRecIdForUpdate() {
        $T = new ErrorAdditions();
        $T->query = "SELECT ".$T->fldRecId[FLDNAME]." FROM ".$T->tableName." "
            . "WHERE ".$this->fldCompetitionType[FLDNAME]." = '".$this->fldCompetitionType[FLDVALUE]."' "
                . "AND ".$this->fldGroupRecId[FLDNAME]." = '".$this->fldGroupRecId[FLDVALUE]."' "                              
                . "AND ".$this->fldIndicator[FLDNAME]." = '".$this->fldIndicator[FLDVALUE]."' "
                . "AND ".$this->fldContestId[FLDNAME]." = '".$this->fldContestId[FLDVALUE]."'";
        $rec = $T->fetchCounted();
        return $rec[$T->fldRecId[FLDNAME]];
    }
    
    /**
     * Insert Or Updates an Record to perform Disqualifing
     * @return type
     */
    public function insertOrUpdateDisqualified() {      
        $recId = $this->findRecIdForUpdate();            
        if($recId > 0)
        {
            // Update
            $EA = new ErrorAdditions($recId);  
            $EA->ttsbegin();
            $EA->fldDisqualified[FLDVALUE] = $this->fldDisqualified[FLDVALUE];
            $ret = $EA->update();         
            $EA->ttscommit();
            return $ret;
        }
        else
        {
            // Insert
            return $this->insert();
        }       
    }
    
    
    /**
     * Insert or Updates an Record
     * @return boolean true if it´s stored
     */
    public function insertOrUpdate() {               
        $dtu = new DateTimeUtil();
        $time = $dtu->parmTime($this->timeValue);


        $recId = $this->findRecIdForUpdate();    
        if($recId > 0)
        {
            // Update
            $EA = new ErrorAdditions($recId);     
            $EA->ttsbegin();
            switch($this->who)
            {
                case 'L1':
                case 'l1': // Now Time of Runner 1
                case 'gf':                        
                    $EA->fldContestTimeGF[FLDVALUE] = $time;
                    break;

                case 'L2':
                case 'l2': // Now Time of Runnter 2 (control time)
                case 'ma':
                    $EA->fldContestTimeMA[FLDVALUE] = $time;
                    break;

                case 'at':
                    $EA->fldTimeKnotsAT[FLDVALUE] = $time;
                    break;

                case 'wt':
                    $EA->fldTimeKnotsWT[FLDVALUE] = $time;
                    break;                                      
            }
            $ret = $EA->update();
            $EA->ttscommit();
            return $ret;
        }
        else
        {
            // Insert    
            switch($this->who)
            {
                case 'L1':
                case 'l1':
                case 'gf':                        
                    $this->fldContestTimeGF[FLDVALUE] = $time;
                    break;

                case 'L2':
                case 'l2':
                case 'ma':
                    $this->fldContestTimeMA[FLDVALUE] = $time;
                    break;

                case 'at':
                    $this->fldTimeKnotsAT[FLDVALUE] = $time;
                    break;

                case 'wt':
                    $this->fldTimeKnotsWT[FLDVALUE] = $time;
                    break;                                     
            }
            return $this->insert();                
        }        
    }
    
    
    /**
     * Get the whole competition time rounded from both times from GF an MA
     * @return str time e.g.: 00:05:35 (5min 35seconds)
     */
    final public function getCompetitionTime() {
        $time1 = $this->fldContestTimeGF[FLDVALUE]; // it is also L1
        $time2 = $this->fldContestTimeMA[FLDVALUE]; // it is also L2
        
        if($time1 == $time2)
        {
            return $time1;
        }
        else
        {            
            if($time1 > $time2)
            {
                $seconds = round(DateTimeUtil::diffFromDateTimes($time1, $time2) / 2); // wird zur zweiten Zeit dazugerechnet
                $time = DateTimeUtil::addTimeSec2DateTime(new DateTime($time2), $seconds);
                return $time->format(DateTimeUtil::timePattern);
            }
            else
            {
                $seconds = round(DateTimeUtil::diffFromDateTimes($time2, $time1) / 2); // wird zur ersten Zeit dazugerechnet
                $time = DateTimeUtil::addTimeSec2DateTime(new DateTime($time1), $seconds);
                return $time->format(DateTimeUtil::timePattern);
            }
        }        
    }
    
    
    /**
     * 
     * @param type $defaultTime
     * @return int Zeitfehler Berechnung
     */
    final private function calculateTimeErrorPoints($defaultTime)
    {
        // Wenn Übungszeit (competitionTime) größer als die Vorgabezeit ($defaultTime) dann berechne Minuspunkte:
        // pro sekunde einen Fehlerpunkt
        if($this->getCompetitionTime() > $defaultTime)
        {
            $dt1 = new DateTime($this->getCompetitionTime());
            $dt2 = new DateTime($defaultTime);
            $diff = $dt1->diff($dt2);
            $min = $diff->format('%I');
            $sec = $diff->format('%S');
            return ($min*60)+$sec;
        }
        else if($this->getCompetitionTime() < $defaultTime && $this->fldCompetitionType[FLDVALUE] == "B-Teil") // Bonuspunkte gelten nur für den B-Teil
        {            
            // Wenn Übungszeit (comeptitionTime) kleiner als Vorgabezeit (defaultTime) dann berechne Pluspunkte
            // Logik: Sollzeit (02:20) - Übungszeit (02:07) = +13 Punkte
            $dt1 = new DateTime($this->getCompetitionTime());
            $dt2 = new DateTime($defaultTime);
            $diff = $dt2->diff($dt1);
            $min = $diff->format('%I');
            $sec = $diff->format('%S');
            return ($min*60)+$sec; // min*60 = sekunden + normale sekunden
        }
        else
        {
            // sonst null
            return 0;
        }    
    }
    
    /**
     * Get Error points of this Competition based on Time
     * @return int Error points
     */
    final public function getCompetitionTimeError() {
        try
        {                    
            if($this->fldCompetitionType[FLDVALUE] == "A-Teil")
            {
                // Decision ufh or ow because ufh has 6min and ow has 7min default time
                if($this->fldIndicator[FLDVALUE] == "ufh") {
                    $defaultTime = AdminSetup::findRecId()->fldTimePerDefaultUFH[FLDVALUE]; // 6min
                } else {
                    $defaultTime = AdminSetup::findRecId()->fldTimePerDefaultOW[FLDVALUE]; // 7min
                }

                return $this->calculateTimeErrorPoints($defaultTime);
            }
            else
            {
                // precise defaultTime
                // get from http://www.jugendfeuerwehr.de/uploads/media/Bundeswettbewerb_Wettbewerbsordnung.pdf page 40
                // need avg age from Group
                $GROUP = new MemberGroupTable($this->fldGroupRecId[FLDVALUE]);            
                switch($GROUP->getAverageAge(0))
                {
                    case 10: case '10':
                        $DT = new DateTimeUtil(DateTimeUtil::dateNull(DateTimeUtil::datePattern)." 00:02:40"); 
                        $defaultTime = $DT->parmTime(null, DateTimeUtil::timePattern); break;
                    case 11: case '11': 
                        $DT = new DateTimeUtil(DateTimeUtil::dateNull(DateTimeUtil::datePattern)." 00:02:35"); 
                        $defaultTime = $DT->parmTime(null, DateTimeUtil::timePattern); break;
                    case 12: case '12': 
                        $DT = new DateTimeUtil(DateTimeUtil::dateNull(DateTimeUtil::datePattern)." 00:02:30"); 
                        $defaultTime = $DT->parmTime(null, DateTimeUtil::timePattern); break;
                    case 13: case '13': 
                        $DT = new DateTimeUtil(DateTimeUtil::dateNull(DateTimeUtil::datePattern)." 00:02:25"); 
                        $defaultTime = $DT->parmTime(null, DateTimeUtil::timePattern); break;
                    case 14: case '14': 
                        $DT = new DateTimeUtil(DateTimeUtil::dateNull(DateTimeUtil::datePattern)." 00:02:20"); 
                        $defaultTime = $DT->parmTime(null, DateTimeUtil::timePattern); break;
                    case 15: case '15': 
                        $DT = new DateTimeUtil(DateTimeUtil::dateNull(DateTimeUtil::datePattern)." 00:02:15"); 
                        $defaultTime = $DT->parmTime(null, DateTimeUtil::timePattern); break;
                    case 16: case '16': 
                        $DT = new DateTimeUtil(DateTimeUtil::dateNull(DateTimeUtil::datePattern)." 00:02:10"); 
                        $defaultTime = $DT->parmTime(null, DateTimeUtil::timePattern); break;
                    case 17: case '17': 
                        $DT = new DateTimeUtil(DateTimeUtil::dateNull(DateTimeUtil::datePattern)." 00:02:05"); 
                        $defaultTime = $DT->parmTime(null, DateTimeUtil::timePattern); break;
                    case 18: case '18': 
                        $DT = new DateTimeUtil(DateTimeUtil::dateNull(DateTimeUtil::datePattern)." 00:02:00"); 
                        $defaultTime = $DT->parmTime(null, DateTimeUtil::timePattern); break;
                }

                if(Obj::isValEmpty($defaultTime)) {
                    throw new Exception("Zeit zur Berechnung ist leer, stimmt das Durchschnittsalter der Gruppe?");
                }
                
                return $this->calculateTimeErrorPoints($defaultTime);
            }
        }
        catch(Exception $ex)
        {
            Obj::getException($ex);
        }
    }
    
    
    /**
     * Get highest Time from Knotting
     * @return Time 
     */
    final public function getTiming() {
        $time1 = $this->fldTimeKnotsAT[FLDVALUE];
        $time2 = $this->fldTimeKnotsWT[FLDVALUE];
        
        if($time1 == $time2) 
        {
            return $time1;
        }
        else
        {
            if($time1 > $time2)
            {
                $seconds = round(DateTimeUtil::diffFromDateTimes($time1, $time2) / 2); // wird zur zweiten Zeit dazugerechnet
                $time = DateTimeUtil::addTimeSec2DateTime(new DateTime($time2), $seconds);
                return $time->format(DateTimeUtil::timePattern);
            }
            else
            {
                $seconds = round(DateTimeUtil::diffFromDateTimes($time2, $time1) / 2); // wird zur ersten Zeit dazugerechnet
                $time = DateTimeUtil::addTimeSec2DateTime(new DateTime($time1), $seconds);
                return $time->format(DateTimeUtil::timePattern);
            }
        }
    }
    
    
    /**
     * Get the Time Error Points
     * @return int Seconds
     */
    final public function getTimingError() {
        // Every second is an error
        $time = $this->getTiming();
        $min = DateTimeUtil::dateTime($time, DateTimeUtil::timeMin);
        $sec = DateTimeUtil::dateTime($time, DateTimeUtil::timeSec);
        return ($min*60)+$sec;
    }
    
}