<?php
/**
 * Description of AdminSetup
 *
 * @author tanzberg
 */
class AdminSetup extends SysTable
{
    public $tableName = "AdminSetupTable";
    public $fldRecId = FLDRECID;
    public $fldIdleTime = FLDIDLETIME;
    public $fldIdleTimeFormat = FLDIDLETIMEFORMAT;
    public $fldPageRefreshUpdatesIdleTime = FLDPAGEREFRESHUPDATESIDLETIME;
    public $fldDeleteUploadedMemberFiles = FLDDELETEUPLOADEDMEMBERFILES;
    /**
     * Blende Wettbewerbe aus die älter als heute sind
     * @var int 1 or 0
     */
    public $fldHideContestAfterToday = FLDHIDECONTESTAFTERTODAY; 
    public $fldDeleteMemberAtAgeOf = FLDDELETEMEMBERATAGEOF; // Lösche Mitglieder die Älter als xx sind (-1 werden keine Gelöscht)
    /**
     * Automatische Ausweisnummer erzeugen?
     * @var int1 AutoMemberIdentificationID
     */
    public $fldAutoMemderIdentificationID = FLDAUTOMEMBERIDENTID;
    
    public $fldErrorPointsPerDefault = FLDERRORPOINTSPERDEFAULT; // Vorgabe fehlerpuinkte (Default 1000)
    
    /**
     * Vorgabezeit zur Übung (Default 6min) (Unterflurhydrant)
     * @var time Default Time 
     */
    public $fldTimePerDefaultUFH = FLDTIMEPERDEFAULTUFH; 
    
    /**
     * Vorgabezeit zur Übung (Default 7min) (Offenes Gewässer)
     * @var time Default Time
     */
    public $fldTimePerDefaultOW = FLDTIMEPERDEFAULTOW;
    
    
    /**
     * Vorgabe Fehlerpunkte B-Teil Standard 400 Punkte
     * @var int Vorgabe Fehlerpunkte
     */
    public $fldErrorPointsPerDefaultBPart = FLDERRORPOINTSPERDEFAULTBPART;
    
    public function __construct($recId = null) {
        parent::__construct();
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }
    }
    
    public static function tableId() {
        return tablenum(new AdminSetup());
    }
    
    public static function initValuesFirstTime() {
        $T = new AdminSetup();
        $T->query = "SELECT COUNT(*) AS ANZAHL FROM ".$T->tableName;
        $ret = $T->fetchCounted();
        if($ret['ANZAHL'] == 0) {
            $T = null;
            $a = new AdminSetup();
            $a->ttsbegin();
            $a->fldIdleTime[FLDVALUE] = 10;
            $a->fldIdleTimeFormat[FLDVALUE] = "M";
            $a->fldDeleteMemberAtAgeOf[FLDVALUE] = -1;
            $a->fldErrorPointsPerDefault[FLDVALUE] = 1000;
            $a->fldErrorPointsPerDefaultBPart[FLDVALUE] = 400;
            $a->fldTimePerDefaultOW[FLDVALUE] = "00:07:00";
            $a->fldTimePerDefaultUFH[FLDVALUE] = "00:06:00";
            $a->doInsert();
            $a->ttscommit();
        }
    }
    
    public static function getLastRecId() {
        $T = new AdminSetup();
        $T->query = "SELECT MAX(RECID) as LASTRECID FROM ".$T->tableName;
        $ret = $T->fetchCounted();
        return $ret['LASTRECID'];
    }
    
    public static function findRecId($recId = null) {
        $recId = (!$recId) ? self::getLastRecId() : $recId;
        return new AdminSetup($recId);
    }
}