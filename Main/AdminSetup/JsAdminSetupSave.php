<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$idleTime = @$_POST['idleTime'];      // for Insert and Update
$idleTimeFormat = @$_POST['idleTimeFormat'];
$pageRefreshUpdatesIdleTime = @$_POST['pageRefreshUpdatesIdleTime'];
$deleteUploadedMemberFiles = @$_POST['deleteUploadedMemberFiles'];
$hideContestAfterToday = @$_POST['hideContestAfterToday'];
$deleteMemberAtAgeOf = @$_POST['deleteMemberAtAgeOf'];
$errorPointsPerDefault = @$_POST['errorPointsPerDefault'];
$timePerDefault = @$_POST['timePerDefault'];
$timePerDefaultOW = @$_POST['timePerDefaultOW'];
$errorPointsPerDefaultBPart = @$_POST['errorPointsPerDefaultBPart'];
$autoMemberIdentId = @$_POST['autoMemberIdentId'];



$recId = @$_POST['recId'];           // for Update and Delete
$identifier = @$_POST['identifier']; // only for Delete
try
{        
    // Update
    if($recId && !$identifier)
    {
        $T = new AdminSetup($recId);
        /* OLD Behaviour
        $T->idleTime($idleTime);
        $T->idleTimeFormat($idleTimeFormat);
        $T->pageRefreshUpdatesIdleTime($pageRefreshUpdatesIdleTime);
        $T->deleteUploadedMemberFiles($deleteUploadedMemberFiles);
        $T->hideContestAfterToday($hideContestAfterToday);
        $T->deleteMemberAtAgeOf($deleteMemberAtAgeOf);
        $T->errorPointsPerDefault($errorPointsPerDefault);
        $T->timePerDefaultUFH($timePerDefault);
        $T->timePerDefaultOW($timePerDefaultOW);
        $T->errorPointsPerDefaultBPart($errorPointsPerDefaultBPart);
        $T->autoMemberIdentificationID($autoMemberIdentId);
        $ret = $T->update();
         */
        $T->ttsbegin();
        $T->fldIdleTime[FLDVALUE] = $idleTime;
        $T->fldIdleTimeFormat[FLDVALUE] = $idleTimeFormat;
        $T->fldPageRefreshUpdatesIdleTime[FLDVALUE] = $pageRefreshUpdatesIdleTime;
        $T->fldDeleteUploadedMemberFiles[FLDVALUE] = $deleteUploadedMemberFiles;
        $T->fldHideContestAfterToday[FLDVALUE] = $hideContestAfterToday;
        $T->fldDeleteMemberAtAgeOf[FLDVALUE] = $deleteMemberAtAgeOf;
        $T->fldErrorPointsPerDefault[FLDVALUE] = $errorPointsPerDefault;
        $T->fldTimePerDefaultUFH[FLDVALUE] = $timePerDefault;
        $T->fldTimePerDefaultOW[FLDVALUE] = $timePerDefaultOW;
        $T->fldErrorPointsPerDefaultBPart[FLDVALUE] = $errorPointsPerDefaultBPart;
        $T->fldAutoMemderIdentificationID[FLDVALUE] = $autoMemberIdentId;        
        $ret = $T->doUpdate();
        
        
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Aktualisiert";
        }
    }
      
}
catch(Exception $ex)
{
    $ret = $ex->getTraceAsString()."\r\n";
    $ret .= "Line: ".$ex->getLine()." in ".$ex->getFile()."\r\n";
    $ret .= $ex->getMessage();    
}

$data = array("journalMessage" => $ret);

echo json_encode($data);
?>

