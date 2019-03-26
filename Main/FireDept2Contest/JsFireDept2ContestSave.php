<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");


$recId = @$_POST['recId'];           // for Update and Delete
$identifier = @$_POST['identifier']; // Identifier
$ret = "";
try
{
    // Delete
    if($recId && str2upper($identifier) == "DELETE")
    {        
        $T = new FireDept2ContestTable($recId);     
        $T->ttsbegin();
        $ret = $T->delete();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Entfernt";
        }
    }
    
    // Update
    if($recId && str2upper($identifier) == "UPDATE")
    {
        $T = new FireDept2ContestTable($recId);
        $T->ttsbegin();
        $ret = $T->update();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Aktualisiert";
        }
    }
    
    // Insert
    if($recId && str2upper($identifier) == "CREATE")
    {
        $ret = true;
        if($ret === true)
        {
            $ret = "no logic implemented yet, because Creating comes from RegistrationTable";
        }
    }
}
catch(Exception $ex)
{
    //$ret = $ex->getTraceAsString()."\r\n";
    //$ret .= "Line: ".$ex->getLine()." in ".$ex->getFile()."\r\n";
    $ret = $ex->getMessage();    
}

$data = array("journalMessage" => $ret);

echo json_encode($data);
?>

