<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");


$DT = new DistrictTable();
/* OLD Behaviour
$MI = new MapIterator($DT->recIdMap);


while($MI->next())
{
    $DT = null;
    $DT = new DistrictTable($MI->currentValue());
    
    $ret[] = array("recId" => $DT->recId, "value" => $DT->district());     
}
*/
$DT->initAll()->fetch();
while($DT->next()) {
    $ret[] = array("recId" => $DT->fldRecId[FLDVALUE], "value" => $DT->fldDistrict[FLDVALUE]);
}

echo json_encode($ret);
?>
