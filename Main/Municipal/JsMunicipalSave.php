<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$districtId = @$_POST['districtId'];      // for Insert and Update
$municipal = @$_POST['municipal'];
$recId = @$_POST['recId'];           // for Update and Delete
$identifier = strtoupper(@$_POST['identifier']); // only for Delete
try
{
    // Delete
    if($recId && $identifier == "DELETE")
    {
        $T = new MunicipalTable($recId);        
        //$ret = $T->delete();
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
        $T = new MunicipalTable($recId);
        /* OLD Behaviour
        $T->districtId($districtId);
        $T->municipal($municipal);
        $ret = $T->update();
         */
        $T->ttsbegin();
        $T->fldDistrictId[FLDVALUE] = $districtId;
        $T->fldMunicipal[FLDVALUE] = $municipal;
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
        $T = new MunicipalTable();
        /* OLD Behaviour
        $T->districtId($districtId);
        $T->municipal($municipal);
        $ret = $T->insert();*/
        $T->ttsbegin();
        $T->fldDistrictId[FLDVALUE] = $districtId;
        $T->fldMunicipal[FLDVALUE] = $municipal;
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

