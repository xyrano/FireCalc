<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$T = new MunicipalTable();
$T->initAll()->fetch();
while($T->next()) {
    $ret[] = array("recId" => $T->fldRecId[FLDVALUE], "class" => $T->fldDistrictId[FLDVALUE], "value" => $T->fldMunicipal[FLDVALUE]); // Class is for chained select
}

echo json_encode($ret);
?>
