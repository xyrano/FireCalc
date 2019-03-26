<?php

/**
 * Description of ErrorHelper
 *
 * @author tanzberg
 */
class ErrorHelper 
{
    /**
     * Hold the Group 
     * @var MemberGroupTable Member
     */
    private $MemberGroupTable;
    
    /**
     * Hold an instance of the Setup
     * @var AdminSetup AdminSetup
     */
    private $AdminSetup;

    /**
     * Hold the indicator of the contest
     * @var str contestIndicator ufh or ow
     */
    private $contestIndicator;
    
    /**
     * Hold the Default Error Points of Part A
     * @var int Default Error Points
     */
    private $defaultErrorPointsAPart;
    
    /**
     * Hold the Default Error Points of Part B
     * @var int Default Error Points
     */
    private $defaulterrorPointsBPart;
    
    /**
     * Hold the Error Points of Part A
     * @var int Cumulated Error Points
     */
    private $cumulatedErrorPointsAPart;
    
    /**
     * Hold the Error Points of Part B
     * @var int Cumulated Error Points
     */
    private $cumulatedErrorPointsBpart;
    
    /**
     * Hold the Competition Time of Part A
     * @var Time competition Time
     */
    private $competitionTimeAPart;
    
    /**
     * Hold the Competition Time of Part B
     * @var Time Competition Time
     */
    private $competitionTimeBPart;
    
    /**
     * Hold the Time Error of Part A
     * @var int Time Error
     */
    private $competitionTimeErrorAPart;
    
    /**
     * Hold the Time Error of Part B
     * @var int Time Error
     */
    private $competitionTimeErrorBPart;
    
    /**
     * Hold the Timing of Part A <br>
     * <b>Part B has no Timing!</b>
     * @var Time Timing (Zeittakt)
     */
    private $timingAPart;
    
    /**
     * Hold the Error depening on the Timing of Part A
     * <br><b>Part B has no Timing and related to that no Timing Error!</b>
     * @var int Timing Error
     */
    private $timingErrorAPart;
    
    /**
     * Hold the Disqualified Param of Part A
     * @var int Disqualified
     */
    private $disqualifiedAPart;
    
    /**
     * Hold the Disqualified param of Part B
     * @var int Disqualified
     */
    private $disqualifiedBPart;
    
    /**
     * Hold the Impression of Part A
     * @var float Impression
     */
    private $impressionAPart;
    
    /**
     * Hold the Impression of Part B
     * @var float Impression
     */
    private $impressionBPart;
    
    /**
     * Hold the Summray Points of Part A
     * @var float Summary
     */
    private $summaryAPart;
    
    /**
     * Hold the Summary Points of Part B
     * @var float Summary
     */
    private $summaryBPart;
    
    /**
     * Hold the Summary cumulated form Part A + Part B
     * @var float End Summary
     */
    private $summary;
    
    /**
     * Hold the ErrorTotals Obj
     * @var ErrorTotals
     */
    public $errorTotals;
    
    
    /**
     * Construct a new ErrorHelper and Calculate sums
     * @param int $MemberGroupRecId MemberGroup RecId
     * @param bool $calc2End Should data to be post and stored in DB? Its the final post
     */
    public function __construct($MemberGroupRecId, $calc2End = false) {                        
        try 
        {                 
            // Wenn der datensatz für die Gruppe bereits ausgewertet wurde (In DB eingetragen)
            // dann berechne nicht alles neu (Performance) sondern lade die Daten anhand der gruppe                   
            if(ErrorTotals::groupExists($MemberGroupRecId))
            {
                // Get all from DB
                $this->initByErrorTotals($MemberGroupRecId);                
            }
            else
            {     
                // temp Calculation    
                $this->MemberGroupTable         = new MemberGroupTable($MemberGroupRecId);
                $this->contestIndicator         = (ContestBaseTable::find($this->memberGroupTable()->fldContestId[FLDVALUE])->fldIsOpenWater[FLDVALUE] == 1) ? "ow" : "ufh";
                
                $this->AdminSetup               = AdminSetup::findRecId();
                $this->defaultErrorPointsAPart  = $this->AdminSetup->fldErrorPointsPerDefault[FLDVALUE];
                $this->defaulterrorPointsBPart  = $this->AdminSetup->fldErrorPointsPerDefaultBPart[FLDVALUE];
                
                $this->calculateErrorPointsSummary();
                $this->calculateTimings();
                $this->calculateImpression();
                $this->calculateSummarys(); 
            }

            // gets from evaluation Form link => Übertragen und Auswertung beenden
            if($MemberGroupRecId && $calc2End === true)
            {                
                ErrorTotals::endCalc($this);
            }
        } 
        catch (Exception $ex) 
        {
            Obj::getException($ex);
        }
    }
    
    
    public function initByErrorTotals($groupRecId) {  
        try
        {
            $ErrorTotals = new ErrorTotals(null, $groupRecId);
            $this->MemberGroupTable             = MemberGroupTable::findRecId($groupRecId);
            $this->contestIndicator             = $ErrorTotals->fldContestIndicator[FLDVALUE];
            $this->defaultErrorPointsAPart      = $ErrorTotals->fldStartPointsA[FLDVALUE];
            $this->defaulterrorPointsBPart      = $ErrorTotals->fldStartPointsB[FLDVALUE];
            $this->cumulatedErrorPointsAPart    = $ErrorTotals->fldErrorPointsA[FLDVALUE];
            $this->cumulatedErrorPointsBpart    = $ErrorTotals->fldErrorPointsB[FLDVALUE];
            $this->competitionTimeAPart         = $ErrorTotals->fldCompetitionTimeA[FLDVALUE];
            $this->competitionTimeBPart         = $ErrorTotals->fldCompetitionTimeB[FLDVALUE];
            $this->competitionTimeErrorAPart    = $ErrorTotals->fldTimeErrorPointsA[FLDVALUE];
            $this->competitionTimeErrorBPart    = $ErrorTotals->fldTimeErrorPointsB[FLDVALUE];
            $this->timingAPart                  = $ErrorTotals->fldTime[FLDVALUE];
            $this->timingError                  = $ErrorTotals->fldTimeErrorPoints[FLDVALUE];
            //$this->timingErrorAPart             = $ErrorTotals->fldTim;
            $this->disqualifiedAPart            = $ErrorTotals->fldDisqualifiedA[FLDVALUE];
            $this->disqualifiedBPart            = $ErrorTotals->fldDisqualifiedB[FLDVALUE];
            $this->impressionAPart              = $ErrorTotals->fldImpressionA[FLDVALUE];
            $this->impressionBPart              = $ErrorTotals->fldImpressionB[FLDVALUE];
            $this->summaryAPart                 = $ErrorTotals->fldErrorPointsSumA[FLDVALUE];
            $this->summaryBPart                 = $ErrorTotals->fldErrorPointsSumB[FLDVALUE];
            $this->summary                      = $ErrorTotals->fldErrorPointsTotal[FLDVALUE];
            $this->errorTotals                  = $ErrorTotals;
        }
        catch(Exception $ex)
        {
            Obj::getException($ex);
        }        
    }
    
    /**
     * Get´s the MemberGroupTable
     * @return MemberGroupTable
     */
    public function memberGroupTable() {
        return $this->MemberGroupTable;
    }
    
    /**
     *  Calculate ErrorPoints summary
     */
    private function calculateErrorPointsSummary() {
        $this->cumulatedErrorPointsAPart = ErrorValues::getSummaryPoints($this->memberGroupTable()->fldRecId[FLDVALUE], "A-Teil");
        $this->cumulatedErrorPointsBpart = ErrorValues::getSummaryPoints($this->memberGroupTable()->fldRecId[FLDVALUE], "B-Teil");
    }
    
    
    private function calculateTimings() {
        // A_TEIL
        $EAAPart = new ErrorAdditions(null, $this->memberGroupTable()->fldRecId[FLDVALUE], "A-Teil");                
        while($EAAPart->next())
        {
            $this->competitionTimeAPart         = $EAAPart->getCompetitionTime();
            $this->competitionTimeErrorAPart    = $EAAPart->getCompetitionTimeError();
            $this->timingAPart                  = $EAAPart->getTiming();
            $this->timingErrorAPart             = $EAAPart->getTimingError();
            $this->disqualifiedAPart            = $EAAPart->fldDisqualified[FLDVALUE];
        }
        
        // B_TEIL
        $EABPart = new ErrorAdditions(null, $this->memberGroupTable()->fldRecId[FLDVALUE], "B-Teil");
        while($EABPart->next())
        {
            $this->competitionTimeBPart         = $EABPart->getCompetitionTime();
            $this->competitionTimeErrorBPart    = $EABPart->getCompetitionTimeError();
//            $this->timingBPart                = $EA->getTiming();         // no needs in BPart
//            $this->timingErrorBPart           = $EA->getTimingError();    // no needs in BPart
            $this->disqualifiedBPart            = $EABPart->fldDisqualified[FLDVALUE];
        }
    }
    
    /**
     * Berechne den Eindruck der Gruppe für A und B Teil
     */
    private function calculateImpression() {
        $this->impressionAPart = ErrorImpressions::getAverageImpress($this->memberGroupTable()->fldRecId[FLDVALUE], "A-Teil", $this->contestIndicator, 2); // TODO: better a field in table and calculate at every update
        $this->impressionBPart = ErrorImpressions::getAverageImpress($this->memberGroupTable()->fldRecId[FLDVALUE], "B-Teil", "BP", 2); // BP is indicator for BPart
    }
    
   
    private function calculateSummarys() {
        if($this->disqualifiedAPart) {
            $this->summaryAPart = 0;
        } else {
            $this->summaryAPart = ($this->defaultErrorPointsA() - $this->cumulatedErrorPointsAPart() - $this->competitionTimeErrorAPart() - $this->timingError() - $this->impressionAPart()); 
        }
        
        if($this->disqualifiedBPart) {
            $this->summaryBPart = 0;
        } else {
            $this->summaryBPart = ($this->defaultErrorPointsB() - $this->cumulatedErrorPointsBPart() - $this->impressionBPart());
            // Wenn eine bessere Laufzeit erreicht wurde als die Sollzeit dann gibt es hier Bonuspunkte
            if($this->competitionTimeBPart() > ErrorHelper::getToTime4Group($this->memberGroupTable()->getAverageAge(0)))
            {
                $this->summaryBPart = $this->summaryBPart - $this->competitionTimeErrorBPart();
            }
            else
            {
                $this->summaryBPart = $this->summaryBPart + $this->competitionTimeErrorBPart();
            }
        }
        
        $this->summary = ($this->summaryAPart + $this->summaryBPart);
    }
    
    /**
     * Get the Default Error Points from Part A
     * @return int Default Error Points
     */
    public function defaultErrorPointsA() {
        return $this->defaultErrorPointsAPart;
    }
    
    /**
     * Get the Defeault Error Points from Part B
     * @return int Default Error Points
     */
    public function defaultErrorPointsB() {
        return $this->defaulterrorPointsBPart;
    }
    
    
    public function cumulatedErrorPointsAPart() {
        return $this->cumulatedErrorPointsAPart;
    }
    
    public function cumulatedErrorPointsBPart() {
        return $this->cumulatedErrorPointsBpart;
    }
    
    public function competitionTimeAPart() {
        return $this->competitionTimeAPart;
    }
    
    public function competitionTimeBPart() {
        return $this->competitionTimeBPart;
    }
    
    public function competitionTimeErrorAPart() {
        return $this->competitionTimeErrorAPart;
    }
    
    /**
     * Holt die Zeitfehler anhand der Übungszeit die am Durchschnittsalter der Gruppe ermittelt wird
     * @return int Zeitfehler
     */
    public function competitionTimeErrorBPart() {
        return $this->competitionTimeErrorBPart;
    }
    
    public function disqualifiedAPart() {
        return $this->disqualifiedAPart;
    }
    
    public function disqualifiedBPart() {
        return $this->disqualifiedBPart;
    }
    
    public function timing() {
        return $this->timingAPart;
    }
    
    public function timingError() {
        return $this->timingErrorAPart;
    }
    
    public function impressionAPart() {
        return $this->impressionAPart;
    }
    
    public function impressionBPart() {
        return $this->impressionBPart;
    }
    
    public function summaryAPart() {
        return $this->summaryAPart;
    }
    
    /**
     * 
     * @return type
     */
    public function summaryBPart() {
        return $this->summaryBPart;
    }
    
    /**
     * Hold the Summary Points of both Parts
     * @return float Summary
     */
    public function summary() {
        return $this->summary;
    }
    
    
    /**
     * Get the ToTime for every group based on the Average Age of the group
     * @param int $averageAge Age of Group
     * @return DateTime toTime 
     */
    public static function getToTime4Group(int $averageAge) {
        switch($averageAge)
        {
            case 10:
                $time = DateTimeUtil::dateTime("00:02:40", DateTimeUtil::timePattern);
                break;
            case 11:
                $time = DateTimeUtil::dateTime("00:02:35", DateTimeUtil::timePattern);
                break;
            case 12:
                $time = DateTimeUtil::dateTime("00:02:30", DateTimeUtil::timePattern);
                break;
            case 13:
                $time = DateTimeUtil::dateTime("00:02:25", DateTimeUtil::timePattern);
                break;
            case 14:
                $time = DateTimeUtil::dateTime("00:02:20", DateTimeUtil::timePattern);
                break;
            case 15:
                $time = DateTimeUtil::dateTime("00:02:15", DateTimeUtil::timePattern);
                break;
            case 16:
                $time = DateTimeUtil::dateTime("00:02:10", DateTimeUtil::timePattern);
                break;
            case 17:
                $time = DateTimeUtil::dateTime("00:02:05", DateTimeUtil::timePattern);
                break;
            case 18:
                $time = DateTimeUtil::dateTime("00:02:00", DateTimeUtil::timePattern);
                break;
        }
        
        return $time;
    }
    
}
