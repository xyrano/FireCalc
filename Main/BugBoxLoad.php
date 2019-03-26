<?php
require_once("../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$ret = "";
try
{
    $BBTS = new BugBoxTable();
    $BBTSMI = new MapIterator($BBTS->recIdMap);
    while($BBTSMI->next()) {
        $BBT = new BugBoxTable($BBTSMI->currentValue());
        $ret .= "<span style=\"font-size: 12px\">Geschrieben von: [".$BBT->createdBy()."] - [".$BBT->createdDateTime(DateTimeUtil::populateGermanDateTimeFormat())."]</span><br>";
        $ret .= "<span style=\"font-size: 14px;\">".$BBT->message()."</span>";
        if(sysIsUserAdmin())
        {
            $ret .= "<br><a id=\"deleteBugBoxPost?id=".$BBT->recId."\"><span style=\"font-size: 12px\">Eintrag Löschen</span></a>";
        }
        $ret .= "<br><hr>";        
    }
}
catch(Exception $ex)
{
    $ret = $ex->getTraceAsString()."\r\n";
    $ret .= "Line: ".$ex->getLine()." in ".$ex->getFile()."\r\n";
    $ret .= $ex->getMessage();    
}

$data = array("journalMessage" => $ret);

//echo json_encode($data);
echo $ret;

?>
