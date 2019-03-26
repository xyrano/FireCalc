<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$identityNum = @$_POST['identityNum'];      // for Insert and Update
$surname = @$_POST['surname'];
$forename = @$_POST['forename'];
$birthday = @$_POST['birthday'];
$entryDate = @$_POST['entryDate'];
$fireDeptId = @$_POST['fireDeptId'];
$gender = @$_POST['gender'];


$recId = @$_POST['recId'];           // for Update and Delete
$identifier = strtoupper(@$_POST['identifier']); // only for Delete
try
{    
    // Delete
    if($recId && $identifier == "DELETE")
    {
        $T = new MemberTable($recId); 
        $T->ttsbegin();
        $ret = $T->doDelete();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Entfernt";
        }
    }
    
    // Update
    if($recId && $identifier == "UPDATE")
    {
        $birthdate = new DateTime($birthday);
        $entryDate = ($entryDate) ? new DateTime($entryDate) : DateTimeUtil::dateNull();
        
        $T = new MemberTable($recId);
        $T->ttsbegin();
        $T->fldIdentityNum[FLDVALUE] = $identityNum;
        $T->fldGender[FLDVALUE] = $gender;
        $T->fldSurname[FLDVALUE] = $surname;
        $T->fldForename[FLDVALUE] = $forename;        
        $T->fldBirthday[FLDVALUE] = $birthdate->format(DateTimeUtil::datePattern);        
        $T->fldEntryDate[FLDVALUE] = $entryDate->format(DateTimeUtil::datePattern);
        $T->fldFireDept[FLDVALUE] = $fireDeptId;
        $T->fldFireDeptName[FLDVALUE] = FireDeptTable::findRecId($fireDeptId)->fldFireDept[FLDVALUE];
        $ret = $T->doUpdate();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Aktualisiert";
        }
    }
    
    // Insert
    if(!$recId && $identifier == "CREATE")
    {
        $birthdate = new DateTime($birthday);
        $entryDate = ($entryDate) ? new DateTime($entryDate) : DateTimeUtil::dateNull();
        
        $T = new MemberTable();
        $T->ttsbegin();
        $T->fldIdentityNum[FLDVALUE] = $identityNum;
        $T->fldGender[FLDVALUE] = $gender;
        $T->fldSurname[FLDVALUE] = $surname;
        $T->fldForename[FLDVALUE] = $forename;        
        $T->fldBirthday[FLDVALUE] = $birthdate->format(DateTimeUtil::datePattern);        
        $T->fldEntryDate[FLDVALUE] = $entryDate->format(DateTimeUtil::datePattern);
        $T->fldFireDept[FLDVALUE] = $fireDeptId;
        $T->fldFireDeptName[FLDVALUE] = FireDeptTable::findRecId($fireDeptId)->fldFireDept[FLDVALUE];
        $ret = $T->doInsert();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Gespeichert";
        }
    }
}
catch(Exception $ex)
{   
    $ret = $ex->getMessage();    
}

$data = array("journalMessage" => $ret);

echo json_encode($data);
?>

