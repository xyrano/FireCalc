<?php
require_once("../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$message = @$_POST['message'];      // for Insert and Update


try
{
    $T = new BugBoxTable();
    $T->message($message);
    $ret = $T->insert();
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

