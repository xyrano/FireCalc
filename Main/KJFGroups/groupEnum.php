<?php
try
{
    require_once("../../Functions.php");
    require_once(sysGetBaseDir()."/Factory.php");

/* OLD Behaviour
    $T = new GroupTable();
    $MI = new MapIterator($T->recIdMap);
    $ret = array();

    while($MI->next())
    {
        $T = null;
        $T = new GroupTable($MI->currentValue());

        $ret[] = array("recId" => $T->recId, "value" => $T->groupName());     
    }
 * 
 */
    $T = new GroupTable();
    $T->initAll()->fetch();
    while($T->next()) {
        $ret[] = array("recId" => $T->fldRecId[FLDVALUE], "value" => $T->fldGroupName[FLDVALUE]);
    }

    echo json_encode($ret);
}
catch(Exception $ex)
{
    $ret[] = array("error" => $ex->getMessage());
    echo json_encode($ret);
}
?>
