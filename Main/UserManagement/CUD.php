<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");

$username = @$_POST['username'];      // for Insert and Update
$password = @$_POST['password'];        
$groupId = @$_POST['groupId'];
$fireDeptId = @$_POST['fireDeptId'];

$recId = @$_POST['recId'];           // for Update and Delete
$identifier = strtoupper(@$_POST['identifier']); // only for Delete


try
{
    // Delete
    if($recId && $identifier == "DELETE")
    {
        $T = new UserTable($recId);  
        /* OLD Behaviour
        $ret = $T->delete();
         * 
         */
        $T->ttsbegin();
        $ret = $T->doDelete();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Entfernt";
        }
    }
    
    // Update
    if($recId && $identifier == "UPDATE")
    {
        $T = new UserTable($recId);
        /* OLD Behaviour
        $T->username($username);
        $T->groupId($groupId);
        $T->fireDeptId($fireDeptId);
        $ret = $T->update();
         * 
         */
        $T->ttsbegin();
        $T->fldUsername[FLDVALUE] = $username;
        $T->fldGroupId[FLDVALUE] = $groupId;
        $T->fldFireDeptId[FLDVALUE] = $fireDeptId;
        $ret = $T->doUpdate();
        if($ret === true)
        {
            $T->ttscommit();
            $ret = "Aktualisiert";
        }
    }
    
    // Insert
    if(!$recId && $identifier == "CREATE")
    {
        $T = new UserTable();
        /* OLD Behaviour
        $T->username($username);
        $T->password(LoginLogout::getPasswordHash($password));        
        $T->groupId($groupId);
        $T->fireDeptId($fireDeptId);
        $ret = $T->insert();
         * 
         */
        $T->ttsbegin();
        $T->fldUsername[FLDVALUE] = $username;
        $T->fldPassword[FLDVALUE] = LoginLogout::getPasswordHash($password);
        $T->fldGroupId[FLDVALUE] = $groupId;
        $T->fldFireDeptId[FLDVALUE] = $fireDeptId;
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

