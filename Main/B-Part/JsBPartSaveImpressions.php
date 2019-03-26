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
    $T->who                             = $who;
 
    switch($who)
    {
        case 'L1': $T->fldL1[FLDVALUE] = $value; break;
        case 'L2': $T->fldL2[FLDVALUE] = $value; break;
        case 'L3': $T->fldL3[FLDVALUE] = $value; break;
        case 'L4': $T->fldL4[FLDVALUE] = $value; break;
        case 'L5': $T->fldL5[FLDVALUE] = $value; break;
        case 'L6': $T->fldL6[FLDVALUE] = $value; break;
        case 'L7': $T->fldL7[FLDVALUE] = $value; break;
        case 'L8': $T->fldL8[FLDVALUE] = $value; break;
        case 'L9': $T->fldL9[FLDVALUE] = $value; break;
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

