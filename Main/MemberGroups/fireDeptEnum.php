<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$contestId = @$_GET['idx'];
$groupRecId = @$_GET['recId']; // for Update
$fireDeptRecId = -1;
if($groupRecId)
{
    $M = new MemberGroupTable($groupRecId);
    $fireDeptRecId = $M->fldFireDeptId[FLDVALUE];
}


// Es dürfen nur die Feuerwehren angezeigt werden die auch erfasst wurden für den Admin
// Für benutzer dürfen nur Feuerwehren angezeigt werden die ihm zugeordnet sind
$T = new FireDeptTable();
$T->getRecords();
while($T->next()) 
{
    if(RegistrationTable::existRegistered($contestId, $T->fldRecId[FLDVALUE])) 
    {
        if($fireDeptRecId == $T->fldRecId[FLDVALUE])
        {
            $ret[] = array("recId" => $T->fldRecId[FLDVALUE], "value" => $T->fldFireDept[FLDVALUE], "selected" => true);
        }
        else
        {
            $ret[] = array("recId" => $T->fldRecId[FLDVALUE], "value" => $T->fldFireDept[FLDVALUE], "selected" => false);
        }
    }
}

if(count($ret) <= 0) {
    $ret[] = array("recId" =>  -1, "value" => "---");
}

echo json_encode($ret);
?>
