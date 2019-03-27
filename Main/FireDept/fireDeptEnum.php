<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$ret = null;
$T = new FireDeptTable();
$T->getRecords();
while($T->next()) {
    $ret[] = array("recId" => $T->fldRecId[FLDVALUE], "value" => $T->fldFireDept[FLDVALUE]);
}

echo json_encode($ret);
?>
