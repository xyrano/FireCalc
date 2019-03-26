<?php
require_once("Functions.php");
require_once("Factory.php");


$windowTitle = @$_GET['windowTitle'];

/* OLD BEHAVIOUR
$SQL = new Sql("UserProperties");
$recId = $SQL->findRecId("SELECT RECID FROM USERPROPERTIES WHERE USERRECID = '".UserOnline::find()->fldUserRecId[FLDVALUE]."' AND WINDOWTITLE = '".$windowTitle."'");

$windowHeight = "";
$windowWidth = "";
$windowX = "";
$windowY = "";


if($recId > 0)
{
    $UP = new UserProperties($recId);
    $recId = $recId;
    $windowHeight = $UP->windowHeight();
    $windowWidth = $UP->windowWidth();
    $windowX = $UP->windowX();
    $windowY = $UP->windowY();
}
 * 
 */
$T = UserProperties::find($windowTitle);
$recId = $T->fldRecId[FLDVALUE];
$windowHeight = $T->fldWindowHeigth[FLDVALUE];
$windowWidth = $T->fldWindowWidth[FLDVALUE];
$windowX = $T->fldWindowX[FLDVALUE];
$windowY = $T->fldWindowY[FLDVALUE];       



//build the JSON array for return
$json = array(array('field' => 'recId', 'value' => $recId),
              array('field' => 'windowHeight', 'value' => $windowHeight),
              array('field' => 'windowWidth', 'value' => $windowWidth),
              array('field' => 'windowX', 'value' => $windowX), 
              array('field' => 'windowY', 'value' => $windowY));

echo json_encode($json );
?>

