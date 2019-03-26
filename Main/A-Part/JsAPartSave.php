<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$contestId = @$_POST['contestId'];
$competitionType = @$_POST['competitionType'];      // for Insert and Update
$groupRecId = @$_POST['groupRecId'];
$countingType = @$_POST['countingType'];
$errorNum = @$_POST['errorNum'];
$errorSubNum = @$_POST['errorSubNum'];
$errorValue = @$_POST['errorValue'];
$indicator = @$_POST['indicator'];
$who = @$_POST['who'];
$errorNumCount = @$_POST['errorNumCount'];


$recId = @$_POST['recId'];           // for Update and Delete
$identifier = @$_POST['identifier']; // only for Delete
try
{
    // Delete
    if($recId && str2upper($identifier) == "DELETE")
    {
        $T = new ErrorValues($recId);
        $T->ttsbegin();
        $ret = $T->doDelete();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Entfernt";
        }
    }
    
    // Update
    if($recId && str2upper($identifier) == "UPDATE")
    {
        $T = new ErrorValues($recId);
        $T->ttsbegin();
        $T->fldContestId[FLDVALUE]          = $contestId;
        $T->fldCompetitionType[FLDVALUE]    = $competitionType;
        $T->fldCountingType[FLDVALUE]       = $countingType;
        $T->fldErrorNum[FLDVALUE]           = $errorNum;
        $T->fldErrorSubNum[FLDVALUE]        = $errorSubNum;
        $T->fldErrorValue[FLDVALUE]         = $errorValue;
        $T->fldGroupRecId[FLDVALUE]         = $groupRecId;
        $T->fldIndicator[FLDVALUE]          = $indicator;
        $T->fldWho[FLDVALUE]                = $who;
        $T->fldErrorNumCount[FLDVALUE]      = $errorNumCount;
        $ret = $T->update();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Aktualisiert";
        }
    }
    
    // Insert
    if(!$recId && !$identifier)
    {
        $T = new ErrorValues();
        $T->ttsbegin();
        $T->fldContestId[FLDVALUE]          = $contestId;
        $T->fldCompetitionType[FLDVALUE]    = $competitionType;
        $T->fldCountingType[FLDVALUE]       = $countingType;
        $T->fldErrorNum[FLDVALUE]           = $errorNum;
        $T->fldErrorSubNum[FLDVALUE]        = $errorSubNum;
        $T->fldErrorValue[FLDVALUE]         = $errorValue;
        $T->fldGroupRecId[FLDVALUE]         = $groupRecId;
        $T->fldIndicator[FLDVALUE]          = $indicator;
        $T->fldWho[FLDVALUE]                = $who;
        $T->fldErrorNumCount[FLDVALUE]      = $errorNumCount;
        $ret = $T->insertRealError();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Gespeichert";
        }
    }
}
catch(Exception $ex)
{
    $hasExc = true;
    $ret = $ex->getTraceAsString()."\r\n";
    $ret .= "Line: ".$ex->getLine()." in ".$ex->getFile()."\r\n";
    $ret .= $ex->getMessage();    
}
getJsonReturn($ret, $hasExc);
?>

