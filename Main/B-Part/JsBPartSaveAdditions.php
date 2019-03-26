<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$contestId = @$_POST['contestId'];
$competitionType = @$_POST['competitionType'];      
$groupRecId = @$_POST['groupRecId'];
$indicator = @$_POST['indicator'];
$who = @$_POST['who'];
$value = @$_POST['value'];

$hasExc = false;
try
{
    $T = new ErrorAdditions();
    $T->ttsbegin();
    $T->fldContestId[FLDVALUE]          = $contestId;
    $T->fldCompetitionType[FLDVALUE]    = $competitionType;
    $T->fldGroupRecId[FLDVALUE]         = $groupRecId;
    $T->fldIndicator[FLDVALUE]          = $indicator;
    $T->who                             = $who;
    $T->timeValue                       = $value;
    if($T->insertOrUpdate())
    {
        $T->ttscommit();
        $ret = "Eingetragen";
    }
}
catch(Exception $ex)
{
    $hasExc = true;
    $ret = $ex->getTraceAsString()."\r\n";
    $ret .= "Line: ".$ex->getLine()." in ".$ex->getFile()."\r\n";
    $ret .= $ex->getMessage();    
}

$data = array("journalMessage" => $ret);

echo json_encode($data, $hasExc);
?>

