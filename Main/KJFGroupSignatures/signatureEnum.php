<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$T = new SignatureTable();
$T->initAll()->fetch();


while($T->next())
{    
    $ret[] = array("recId" => $T->fldRecId[FLDVALUE], "class" => $T->fldRecId[FLDVALUE], "value" => $T->fldFunction[FLDVALUE]);  // Class is for chained select   
}

if(!isset($ret) && count($ret) < 1) {
    $ret[] = array("recId" => -1, "class" => 0, "value" => "nicht vorhanden");
}

echo json_encode($ret);
?>
