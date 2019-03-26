<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$district = @$_POST['district'];      // for Insert and Update
$recId = @$_POST['recId'];           // for Update and Delete
$identifier = @$_POST['identifier']; // only for Delete
$ret = "init";

try
{
    // Delete
    if($recId && strtoupper($identifier) == "DELETE")
    {
        /* OLD Behaviour
        $DT = new DistrictTable($recId);        
        $ret = $DT->delete();
         */
        $T = new DistrictTable($recId);
        $T->ttsbegin();
        $ret = $T->doDelete();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Entfernt";
        }
    }
    
    // Update
    if($recId && strtoupper($identifier) == "UPDATE")
    {
        /* OLD Behaviour
        $DT = new DistrictTable($recId);
        $DT->district($district);
        $ret = $DT->update();
         */
        $T = new DistrictTable($recId);
        $T->ttsbegin();
        $T->fldDistrict[FLDVALUE] = $district;
        $ret = $T->doUpdate();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Aktualisiert";
        }
    }
    
    // Insert
    if(!$recId && strtoupper($identifier) == "CREATE")
    {
        /* OLD Beahaviour
        $DT = new DistrictTable();
        $DT->district($district);
        $ret = $DT->insert();
         */
        $T = new DistrictTable();
        $T->ttsbegin();
        $T->fldDistrict[FLDVALUE] = $district;
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
    //$ret = $ex->getTraceAsString()."\r\n";
    //$ret .= "Line: ".$ex->getLine()." in ".$ex->getFile()."\r\n";
    $ret = $ex->getMessage();    
}

$data = array("journalMessage" => $ret);

echo json_encode($data);
?>

