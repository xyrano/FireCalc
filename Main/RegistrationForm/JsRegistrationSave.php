<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$contestId = @$_POST['contestId'];     
$fireDeptId = @$_POST['fireDeptId'];
$confirmedDate = new DateTimeUtil();

$recId = @$_POST['recId'];           // for Update and Delete
$identifier = @$_POST['identifier']; // only for Delete
try
{
    // Delete
    if($recId && $identifier == "delete")
    {        
        if($ret === true)
        {
            $ret = "Entfernt";
        }
    }
    
    // Update
    if($recId && !$identifier)
    {        
        if($ret === true)
        {
            $ret = "Aktualisiert";
        }
    }
    
    // Insert
    if(!$recId && $identifier == "insert")
    {
        $T = new RegistrationTable();
        $T->ttsbegin();
        $T->fldContestId[FLDVALUE] = $contestId;
        $T->fldFireDeptId[FLDVALUE] = $fireDeptId;
        $T->fldConfirmedFrom[FLDVALUE] = Obj::user()->fldUsername[FLDVALUE];
        $T->fldConfirmedDate[FLDVALUE] = $confirmedDate->curDateTime()->format(DateTimeUtil::datePattern);
        $ret = $T->insert();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Gespeichert";
        }
    }
}
catch(Exception $ex)
{
    //$ret = $ex->getTraceAsString()."\r\n";
    //$ret .= "Line: ".$ex->getLine()." in ".$ex->getFile()."\r\n";
    $ret = $ex->getMessage();    
}

$data = array("journalMessage" => $ret);

echo json_encode($data);
?>

