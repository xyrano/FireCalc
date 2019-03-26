<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$contestId = @$_POST['contestId'];
$competitionType = @$_POST['competitionType'];      
$groupRecId = @$_POST['groupRecId'];
$indicator = @$_POST['indicator'];

try
{
    $T = new ErrorAdditions();
    $T->ttsbegin();
    $T->fldContestId[FLDVALUE]          = $contestId;
    $T->fldCompetitionType[FLDVALUE]    = $competitionType;
    $T->fldGroupRecId[FLDVALUE]         = $groupRecId;
    $T->fldIndicator[FLDVALUE]          = $indicator;    
    $T->fldDisqualified[FLDVALUE]       = 1; //Disqualified
 
    if($T->insertOrUpdateDisqualified())
    {
        $T->ttscommit();
        $ret = "Gruppe wurde Disqualifiziert!";
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

