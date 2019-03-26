<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
try
{
    $contestId = @$_POST['contestId'];                  // for Insert and Update
    $fireDeptId = @$_POST['fireDeptId'];        
    $groupName = @$_POST['groupName'];
    //$suffix = @$_POST['suffix'];                        // obsolete 2019-01-03
    $memberIdsArray = explode(",", @$_POST['AddParam']);// was changed into "AddParam" by FormControl Framework
    $map = new Map();
    $map->array2map($memberIdsArray);

    $recId = @$_POST['recId'];           // for Update and Delete
    $identifier = @$_POST['identifier']; // only for Delete

    $ret = "";
    // Delete
    if($recId && str2upper($identifier) == "DELETE")
    {
        $T = new MemberGroupTable($recId);   
        $T->ttsbegin();
        $ret = $T->delete();
        if($ret)
        {
            $T->ttscommit();
            $ret = "Entfernt";
        }
    }
    
    
    // Update
    if($recId && str2upper($identifier) == "UPDATE")
    {
        $T = new MemberGroupTable($recId);
        $T->ttsbegin();
        // Three params below are not changeable from Form
        //$T->fldContestId[FLDVALUE] = $contestId;
        //$T->fldDistrictId[FLDVALUE] = ContestBaseTable::find($contestId)->fldProvideInDistrict[FLDVALUE];
        //$T->fldFireDeptId[FLDVALUE] = $fireDeptId;      
        
        $T->fldGroupName[FLDVALUE] = $groupName;        
        //$T->fldMemberIdMap[FLDVALUE] = base64_encode(serialize($map));
        $T->memberIdMap($map);
        $ret = $T->update();
        if($ret)
        {
            $T->ttscommit();
            $ret = "Aktualisiert";
        }
    }
    
    
     // Insert
    if(!$recId && str2upper($identifier) == "CREATE")
    {
        $T = new MemberGroupTable();
        $T->ttsbegin();
        $T->fldContestId[FLDVALUE] = $contestId;
        $T->fldDistrictId[FLDVALUE] = ContestBaseTable::find($contestId)->fldProvideInDistrict[FLDVALUE];
        $T->fldFireDeptId[FLDVALUE] = $fireDeptId;      
        $T->fldGroupName[FLDVALUE] = $groupName;        
        //$T->fldMemberIdMap[FLDVALUE] = base64_encode(serialize($map));
        $T->memberIdMap($map);
        $ret = $T->insert();
        if($ret)
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

