<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$sigFunction    = @$_POST['sigFunction'];      // for Insert and Update
$sigDescription = @$_POST['sigDescription'];
$sigFile        = @$_POST['sigFile'];
$recId          = @$_POST['recId'];           // for Update and Delete
$identifier     = strtoupper(@$_POST['identifier']); // only for Delete


try
{    
    // Delete
    if($recId && $identifier == "DELETE")
    {
        $T = new SignatureTable($recId);
        $T->ttsbegin();        
        $ret = $T->delete();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Entfernt";
        }
    }
    
    // Update
    if($recId && $identifier == "UPDATE")
    {
        $T = new SignatureTable($recId);
        $T->ttsbegin();
        $T->signatureFunction($sigFunction);
        $T->signatureDescription($sigDescription);
        $T->signature($imageData);
        $ret = $T->update();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Aktualisiert";
        }
    }
    
    // Insert
    if(!$recId && $identifier == "CREATE")
    {
         if (array_key_exists('sigFile',$_FILES)) {
            $tmpname = $_FILES['sigFile']['tmp_name'];
            $type = $_FILES['sigFile']['type'];

			$extension = $type;

            $hndFile = fopen($tmpname, "r");
            $data = addslashes(fread($hndFile, filesize($tmpname)));
            $imageData = $data;
        } else {
            throw new Exception("<br>Bild exisitiert nicht!");
        }
        
        $T = new SignatureTable();
        $T->ttsbegin();
        $T->fldFunction[FLDVALUE]       = $sigFunction;
        $T->fldSigDescription[FLDVALUE] = $sigDescription;
        $T->signature($imageData);
        $T->fldSigImageExt[FLDVALUE]    = $extension;
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

