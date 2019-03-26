<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$groupName = @$_POST['groupName'];      // for Insert and Update
$groupDescription = @$_POST['groupDescription'];
$array = explode(",", @$_POST['districtIdArray']);
$map = new Map();
$map->array2map($array);

$recId = @$_POST['recId'];           // for Update and Delete
$identifier = strtoupper(@$_POST['identifier']); // only for Delete
try
{
    // Delete
    if($recId && $identifier == "DELETE")
    {
        $T = new GroupTable($recId);     
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
        $T = new GroupTable($recId);
        /* OLD Beahaviour
        $T->groupName($groupName);
        $T->groupDescription($groupDescription);
        $T->districtMap($map);
        $ret = $T->update();
         * 
         */
        $T->ttsbegin();
        $T->fldGroupName[FLDVALUE] = $groupName;
        $T->fldGroupDescription[FLDVALUE] = $groupDescription;
        $T->districtMap($map);
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
        $T = new GroupTable();
         /* OLD Beahaviour
        $T->groupName($groupName);
        $T->groupDescription($groupDescription);
        $T->districtMap($map);
        $ret = $T->update();
         * 
         */
        $T->ttsbegin();
        $T->fldGroupName[FLDVALUE] = $groupName;
        $T->fldGroupDescription[FLDVALUE] = $groupDescription;
        $T->districtMap($map);
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
    $ret = $ex->getTraceAsString()."\r\n";
    $ret .= "Line: ".$ex->getLine()." in ".$ex->getFile()."\r\n";
    $ret .= $ex->getMessage();    
}

$data = array("journalMessage" => $ret);

echo json_encode($data);
?>

