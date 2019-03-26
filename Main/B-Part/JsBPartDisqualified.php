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
    $T->contestId($contestId);
    $T->competitionType($competitionType);
    $T->groupRecId($groupRecId);
    $T->indicator($indicator);    
    $T->disqualified(1);
 
    if($T->insertOrUpdateDisqualified())
    {
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

