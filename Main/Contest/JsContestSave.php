<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$contestDate = @$_POST['contestdate'];     
$contest = @$_POST['contest'];
$openWater = @$_POST['openwater'];
$districtId = @$_POST['districtId'];
$municipalId = @$_POST['municipalId'];
$venue = @$_POST['venue'];
$contestLeaderId = @$_POST['contestLeader'];
$contestTeamManagerId = @$_POST['contestTeamManager'];


$recId = @$_POST['recId'];           // for Update and Delete
$identifier = str2upper(@$_POST['identifier']); // only for Delete
try
{
    // Delete
    if($recId && $identifier == "DELETE")
    {
        $CT = new ContestBaseTable($recId);  
        $CT->ttsbegin();
        $ret = $CT->delete();
        if($ret === true)
        {
            $CT->ttscommit();
            $ret = "Entfernt";
        }
    }
    
    // Update
    if($recId && $identifier == "UPDATE")
    {
        $CT = new ContestBaseTable($recId);
        $CT->ttsbegin();
        $CT->fldProvideInDistrict[FLDVALUE] = $districtId;
        $CT->fldMunicipalId[FLDVALUE] = $municipalId;
        $CT->fldVenue[FLDVALUE] = $venue;
        $CT->fldContestDate[FLDVALUE] = $contestDate;
        $CT->fldContest[FLDVALUE] = $contest;
        $CT->fldContestTeamManager[FLDVALUE] = $contestTeamManagerId;
        $CT->fldContestLeader[FLDVALUE] = $contestLeaderId;
        $CT->fldIsOpenWater[FLDVALUE] = $openWater;
        $ret = $CT->update();
        if($ret === true)
        {
            $CT->ttscommit();
            $ret = "Aktualisiert";
        }
    }
    
    // Insert
    if(!$recId && $identifier == "CREATE")
    {
        $CT = new ContestBaseTable();
        $CT->ttsbegin();
        $CT->fldProvideInDistrict[FLDVALUE] = $districtId;
        $CT->fldMunicipalId[FLDVALUE] = $municipalId;
        $CT->fldVenue[FLDVALUE] = $venue;
        $CT->fldContestDate[FLDVALUE] = $contestDate;
        $CT->fldContest[FLDVALUE] = $contest;
        $CT->fldContestTeamManager[FLDVALUE] = $contestTeamManagerId;
        $CT->fldContestLeader[FLDVALUE] = $contestLeaderId;
        $CT->fldIsOpenWater[FLDVALUE] = $openWater;
        $ret = $CT->insert();
        if($ret === true)
        {
            $CT->ttscommit();
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

