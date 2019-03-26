<?php

/**
 * Description of ErrorTotals
 *
 * @author tanzberg
 */
class ErrorTotals extends SysTable
{
    /**
     * Holds the Table Name
     * @var str tablename
     */
    public $tableName               = "ErrorTotals";
   
    /**
     * Holds the RecId
     * @var int RecId
     */
    public $fldRecId                = FLDRECID;    
    
    /**
     * Holds the Contest RecId
     * @var int RecId
     */
    public $fldContestRecId         = FLDCONTESTID;
    
    /**
     * Holds the Contest indicator (ow oder ufh)
     * @var str Contest indicator
     */
    public $fldContestIndicator     = FLDINDICATOR; 
    
    /**
     * Holds the FireDept RecId
     * @var int RecId
     */
    public $fldFireDeptId           = FLDFIREDEPTID;
    
    /**
     * Holds the FireDept name
     * @var str FireDept name
     */
    public $fldFireDeptName         = FLDFIREDEPT;
    
    /**
     * Holds the Group RecId
     * @var int RecId
     */
    public $fldGroupId              = FLDGROUPID;
    
    /**
     * Holds the Group name
     * @var str Group name
     */
    public $fldGroupName            = FLDGROUPNAME;
    
    /**
     * Holds the average age
     * @var decimal Average age
     */
    public $fldAveAge               = FLDAVEAGE;
    
    /**
     * Holds the Competiton for A-Part (A-Teil)
     * @var str Competition
     */
    public $fldCompetitionA         = FLDCOMPETITIONTYPEA;
    
    /**
     * Holds the Competition for B-Part (B-Teil)
     * @var str Competition
     */
    public $fldCompetitionB         = FLDCOMPETITIONTYPEB;
    
    /**
     * Holds the Start Point for A-Part
     * @var int Start Points
     */
    public $fldStartPointsA         = FLDSTARTPOINTSA;
    
    /**
     * Holds the Start points for B-Part
     * @var int Start points
     */
    public $fldStartPointsB         = FLDSTARTPOINTSB;
    
    /**
     * Holds the Error Points for A-Part
     * @var int ErrorPoints A
     */
    public $fldErrorPointsA         = FLDERRORPOINTSA;
    
    /**
     * Holds the Error Points for B-Part
     * @var int ErrorPoints B
     */
    public $fldErrorPointsB         = FLDERRORPOINTSB;
    
    /**
     * Holds the Competition Time A
     * @var Time Competition Time A
     */
    public $fldCompetitionTimeA     = FLDCOMPETITIONTIMEA;
    
    /**
     * Holds the Competition Time B
     * @var Time Competition Time B
     */
    public $fldCompetitionTimeB     = FLDCOMPETITIONTIMEB;
    
    /**
     * Holds the Time error points for A-Part
     * @var int Time Error Points
     */
    public $fldTimeErrorPointsA     = FLDTIMEERRORPOINTSA;
    
    /**
     * Holds the Time error points for B-Part
     * @var int Time Error Points
     */
    public $fldTimeErrorPointsB     = FLDTIMEERRORPOINTSB;
    
    /**
     * Holds the whole Time only for A-Part
     * @var Time Time
     */
    public $fldTime                 = FLDTIME; 
    
    /**
     * Holds the Time Error points only for A-Part
     * @var int Time Error Points
     */
    public $fldTimeErrorPoints      = FLDTIMEERRORPOINTS;// only in A-Part
    
    /**
     * Holds the Impression for A-Part
     * @var Decimal Impression A
     */
    public $fldImpressionA          = FLDIMPRESSIONA;
    
    /**
     * Holds the Impression for B-Part
     * @var Decimal Impression B
     */
    public $fldImpressionB          = FLDIMPRESSIONB;
    
    /**
     * Holds the Disqualified Flag for A-Part
     * @var int Dusqualified
     */
    public $fldDisqualifiedA        = FLDDISQUALIFIEDA;
    
    /**
     * Holds the Disqualified Flag for B-Part
     * @var int Disqualified
     */
    public $fldDisqualifiedB        = FLDDISQUALIFIEDB;
    
    /**
     * Holds the Sum of Error points in A-part
     * @var Decimal Error points sum A  
     */
    public $fldErrorPointsSumA      = FLDERRORPOINTSSUMA;
    
    /**
     * Holds the Sum of Error points in B-part
     * @var Decimal Error Points sum B
     */
    public $fldErrorPointsSumB      = FLDERRORPOINTSSUMB;
    
    /**
     * Holds the whole Error Points cumulated by A-Part and B-Part
     * @var Decimal Global Error Points
     */
    public $fldErrorPointsTotal    = FLDERRORPOINTSTOTAL;
    
    
    /**
     * Holds the MemberGriupTable for further inquiries
     * @var MemberGroupTable
     */
    private $MemberGroupTable;
    
    
    
    
    public function __construct($recId = null, $groupRecId = null, $contestRecId = null, $orderBy = null) {
        try 
        {                  
            parent::__construct();
            $this->fldRecId[FLDVALUE] = $recId;
           
            
            if($recId != null && $groupRecId == null)
            {
                $this->init();
            }
            
            if($recId == null && $groupRecId != null)
            {
                $this->fldGroupId[FLDVALUE] = $groupRecId;
                $this->initFromGroup();
            }
            
            if($recId == null && $groupRecId == null && $contestRecId != null)
            {
                $this->fldContestRecId[FLDVALUE] = $contestRecId;
                $this->initFromContest($orderBy);
            }
            
        }
        catch(Exception $ex)
        {
            Obj::getException($ex);
        }
     }
    
     
    /**
      * Gets the TableId
      * @return int TableId
      */
     public static function tableId() {
         return tablenum(new ErrorTotals());
     }
     
    
    private function initFromGroup() {
        $T = new ErrorTotals();
        $T->query = "SELECT ".$T->fldRecId[FLDNAME]." FROM ".$T->tableName." WHERE ".$this->fldGroupId[FLDNAME]." = '".$this->fldGroupId[FLDVALUE]."' LIMIT 1";
        $rec = $T->fetchCounted();
        $this->fldRecId[FLDVALUE] = $rec[$T->fldRecId[FLDNAME]];
        $this->init();
    }
    
    
    
    private function initFromContest($orderBy) {
        $this->initAll()->where($this->fldContestRecId[FLDNAME] . " = " . $this->fldContestRecId[FLDVALUE])->orderBy($orderBy)->fetch();
    }
    
        
    final public static function numOfCalcGroupsInContest($contestRecId) {
        $T = new ErrorTotals();
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM ".$T->tableName." WHERE ".$T->fldContestRecId[FLDNAME]." = '".$contestRecId."'";
        $rec = $T->fetchCounted();
        return $rec['ANZAHL'];
    }
    
    /**
     * Check if a Group already exists
     * @param int $groupRecId RecId of Group
     * @return boolean true if a group exists otherwise false
     */
    final public static function groupExists($groupRecId) {
        $T = new ErrorTotals();
        $T->query = "SELECT ".$T->fldRecId[FLDNAME]." FROM ".$T->tableName." "
                . "WHERE ".$T->fldGroupId[FLDNAME]." = '".$groupRecId."' ";
        $rec = $T->fetchCounted();
        if($rec[$T->fldRecId[FLDNAME]] > 0) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Wrote to DB all fields of ErrorHelper
     * @param ErrorHelper $errHelp ErrorHelper Object
     */
    final public static function endCalc(ErrorHelper $errHelp)
    {
        // calculate only when group doesn´t exist
        if(!self::groupExists($errHelp->memberGroupTable()->fldRecId[FLDVALUE]))
        {           
            $ErrorTotals = new ErrorTotals();
            $ErrorTotals->ttsbegin();
            $conIndi = (ContestBaseTable::find($errHelp->memberGroupTable()->fldContestId[FLDVALUE])->fldIsOpenWater[FLDVALUE] == 1) ? "ow" : "ufh";
            $ErrorTotals->fldContestRecId[FLDVALUE]     = $errHelp->memberGroupTable()->fldContestId[FLDVALUE];
            $ErrorTotals->fldContestIndicator[FLDVALUE] = $conIndi;
            $ErrorTotals->fldGroupId[FLDVALUE]          = $errHelp->memberGroupTable()->fldRecId[FLDVALUE];
            $ErrorTotals->fldGroupName[FLDVALUE]        = $errHelp->memberGroupTable()->fldGroupName[FLDVALUE];
            $ErrorTotals->fldFireDeptId[FLDVALUE]       = $errHelp->memberGroupTable()->fldFireDeptId[FLDVALUE];
            $ErrorTotals->fldFireDeptName[FLDVALUE]     = $errHelp->memberGroupTable()->fireDeptTable()->fldFireDept[FLDVALUE];
            $ErrorTotals->fldAveAge[FLDVALUE]           = $errHelp->memberGroupTable()->getAverageAge();
            $ErrorTotals->fldCompetitionA[FLDVALUE]     = "A-Teil";
            $ErrorTotals->fldCompetitionB[FLDVALUE]     = "B-Teil";
            $ErrorTotals->fldStartPointsA[FLDVALUE]     = $errHelp->defaultErrorPointsA();
            $ErrorTotals->fldStartPointsB[FLDVALUE]     = $errHelp->defaultErrorPointsB();
            $ErrorTotals->fldErrorPointsA[FLDVALUE]     = $errHelp->cumulatedErrorPointsAPart();
            $ErrorTotals->fldErrorPointsB[FLDVALUE]     = $errHelp->cumulatedErrorPointsBPart();
            $ErrorTotals->fldCompetitionTimeA[FLDVALUE] = $errHelp->competitionTimeAPart();
            $ErrorTotals->fldCompetitionTimeB[FLDVALUE] = $errHelp->competitionTimeBPart();
            $ErrorTotals->fldTimeErrorPointsA[FLDVALUE] = $errHelp->competitionTimeErrorAPart();
            $ErrorTotals->fldTimeErrorPointsB[FLDVALUE] = $errHelp->competitionTimeErrorBPart();
            $ErrorTotals->fldTime[FLDVALUE]             = $errHelp->timing();
            $ErrorTotals->fldTimeErrorPoints[FLDVALUE]  = $errHelp->timingError();
            $ErrorTotals->fldImpressionA[FLDVALUE]      = $errHelp->impressionAPart();
            $ErrorTotals->fldImpressionB[FLDVALUE]      = $errHelp->impressionBPart();
            $ErrorTotals->fldDisqualifiedA[FLDVALUE]    = $errHelp->disqualifiedAPart();
            $ErrorTotals->fldDisqualifiedB[FLDVALUE]    = $errHelp->disqualifiedBPart();
            $ErrorTotals->fldErrorPointsSumA[FLDVALUE]  = $errHelp->summaryAPart();
            $ErrorTotals->fldErrorPointsSumB[FLDVALUE]  = $errHelp->summaryBPart();
            $ErrorTotals->fldErrorPointsTotal[FLDVALUE] = $errHelp->summary();
            $ErrorTotals->insert();
            $ErrorTotals->ttscommit();
        }
       
        // If calculated groups equals amount of Groups in Contest - set contest to calculated
        if(FireDept2ContestTable::numOfFireDepartmentsInContest($errHelp->memberGroupTable()->fldContestId[FLDVALUE]) 
                == self::numOfCalcGroupsInContest($errHelp->memberGroupTable()->fldContestId[FLDVALUE]))
        {
            $CONTEST = new ContestBaseTable($errHelp->memberGroupTable()->fldContestId[FLDVALUE]);
            $CONTEST->ttsbegin();
            $CONTEST->fldContestIsCalculated[FLDVALUE] = 1;
            $CONTEST->update();
            $CONTEST->ttscommit();
        }
    }
    
    /**
     * Get the current active MemberGroup
     * @return \MemberGroupTable MemberGroup
     */    
    public function memberGroup() {
        if($this->MemberGroupTable)
            return $this->MemberGroupTable;
        
        $this->MemberGroupTable = new MemberGroupTable($this->fldGroupId[FLDVALUE]);
        return $this->MemberGroupTable;
    }
    
    
}
