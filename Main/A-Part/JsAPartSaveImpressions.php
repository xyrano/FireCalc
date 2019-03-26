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
    $T = new ErrorImpressions();
    $T->ttsbegin();
    $T->fldContestId[FLDVALUE]          = $contestId;
    $T->fldCompetitionType[FLDVALUE]    = $competitionType;
    $T->fldGroupRecId[FLDVALUE]         = $groupRecId;
    $T->fldIndicator[FLDVALUE]          = $indicator;
 
    switch($who)
    {
        case 'gfme': $T->fldGFME[FLDVALUE] = $value; break;
        case 'ma': $T->fldMA[FLDVALUE] = $value; break;
        case 'at': $T->fldAT[FLDVALUE] = $value; break;
        case 'st': $T->fldWT[FLDVALUE] = $value; break;
        case 'wt': $T->fldST[FLDVALUE] = $value; break;
    }
    
    $ret = $T->insertOrUpdate();
    if($ret)
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

getJsonReturn($ret, $hasExc);
?>

