<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");


$ret[] = array("recId" => 0, "value" => "männlich");
$ret[] = array("recId" => 1, "value" => "weiblich");

echo json_encode($ret);
?>
