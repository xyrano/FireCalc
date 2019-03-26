<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$districtId = @$_POST['districtId'];      // for Insert and Update
$municipalId = @$_POST['municipalId'];
$fireDept = urldecode(@$_POST['fireDepartment']);

$recId = @$_POST['recId'];           // for Update and Delete
$identifier = strtoupper(@$_POST['identifier']); // only for Delete
try
{
    //throw new Exception("[".$fireDept."]");
    // Delete
    if($recId && $identifier == "DELETE")
    {
        $T = new FireDeptTable($recId); 
        /* OLD Behaviour
        $ret = $FT->delete();
         * 
         */        
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
        $T = new FireDeptTable($recId);
        /* OLD Behaviour
        $FT->districtId($districtId);
        $FT->municipalId($municipalId);
        $FT->fireDept($fireDept);
        $ret = $FT->update();
         * 
         */        
        $T->ttsbegin();
        $T->fldDistrictId[FLDVALUE] = $districtId;
        $T->fldMunicipalId[FLDVALUE] = $municipalId;
        $T->fldFireDept[FLDVALUE] = $fireDept;
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
        $T = new FireDeptTable();
        /* OLD Behaviour
        $FT->districtId($districtId);
        $FT->municipalId($municipalId);
        $FT->fireDept($fireDept);
        $ret = $FT->insert();
         * 
         */
        $T->ttsbegin();
        $T->fldDistrictId[FLDVALUE] = $districtId;
        $T->fldMunicipalId[FLDVALUE] = $municipalId;
        $T->fldFireDept[FLDVALUE] = $fireDept;
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

