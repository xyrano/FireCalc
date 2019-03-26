<?php
class UserProperties extends SysTable
{
    /**
     * Holds the Tablename
     * @var str tablename
     */
    public $tableName       = "UserWindowProperties";
    public $fldRecId        = FLDRECID;
    public $fldUserRecId    = FLDREFRECID;
    public $fldWindowTitle  = FLDWINDOWTITLE;
    public $fldWindowWidth  = FLDWINDOWWIDTH;
    public $fldWindowHeigth = FLDWINDOWHEIGHT;
    public $fldWindowX      = FLDWINDOWX;
    public $fldWindowY      = FLDWINDOWY;
    
    
    public function __construct($recId = null) {
        parent::__construct();
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }
    }
    
    public static function tableId() {
        return tablenum(new UserProperties());
    }
    
    public static function findRecId($recId) {
        return new UserProperties($recId);
    }
    
    public static function find($windowTitle) {
        $T = new UserProperties();
        $T->query = "SELECT ".$T->fldRecId[FLDNAME]." FROM ".$T->tableName." WHERE ".$T->fldWindowTitle[FLDNAME]." = '".$windowTitle."' AND ".$T->fldUserRecId[FLDNAME]." = '".UserOnline::find()->fldUserRecId[FLDVALUE]."' LIMIT 1";
        $ret = $T->fetchCounted();
        return new UserProperties($ret[$T->fldRecId[FLDNAME]]);
    }
    
}