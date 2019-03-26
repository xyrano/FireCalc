<?php
require_once("Functions.php");
require_once("Factory.php");



$windowTitle = @$_POST['windowTitle'];
$windowWidth = @$_POST['width'];
$windowHeight = @$_POST['height'];
$windowX = @$_POST['x'];
$windowY = @$_POST['y'];


try
{
    /* OLD Behaviour
    if(UserProperties::exists(UserOnline::find()->userRecId(), $windowTitle))
    {
        $T = UserProperties::find(UserOnline::find()->userRecId(), $windowTitle);
        $T->userRecId(UserOnline::find()->userRecId());    
        $T->windowTitle($windowTitle);
        $T->windowWidth($windowWidth);
        $T->windowHeight($windowHeight);
        $T->windowX($windowX);
        $T->windowY($windowY);
        $ret = $T->update();        
    }
    else
    {
        $T = new UserProperties();
        $T->userRecId(UserOnline::find()->userRecId());    
        $T->windowTitle($windowTitle);
        $T->windowWidth($windowWidth);
        $T->windowHeight($windowHeight);
        $T->windowX($windowX);
        $T->windowY($windowY);
        $ret = $T->insert();
    }
     * 
     */
    $T = UserProperties::find($windowTitle);
    $T->ttsbegin();
    if($T->fldRecId[FLDVALUE]>0) {
        $T->fldUserRecId[FLDVALUE] = UserOnline::find()->fldUserRecId[FLDVALUE];
        $T->fldWindowTitle[FLDVALUE] = $windowTitle;
        $T->fldWindowHeigth[FLDVALUE] = $windowHeight;
        $T->fldWindowWidth[FLDVALUE] = $windowWidth;
        $T->fldWindowX[FLDVALUE] = $windowX;
        $T->fldWindowY[FLDVALUE] = $windowY;
        $T->doUpdate();
    } else {
        $T->fldUserRecId[FLDVALUE] = UserOnline::find()->fldUserRecId[FLDVALUE];
        $T->fldWindowTitle[FLDVALUE] = $windowTitle;
        $T->fldWindowHeigth[FLDVALUE] = $windowHeight;
        $T->fldWindowWidth[FLDVALUE] = $windowWidth;
        $T->fldWindowX[FLDVALUE] = $windowX;
        $T->fldWindowY[FLDVALUE] = $windowY;
        $T->doInsert();
    }
    $T->ttscommit();
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

