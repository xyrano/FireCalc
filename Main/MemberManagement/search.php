<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");


$searchVal = @$_GET['searchVal'];


$SQL = new Sql("MemberTable");

// Wenn ein leerzeichen eingegeben wurde ist davon auszugehen das nachname und vorname eingegeben wurde
if(Obj::strFind($searchVal, " "))
{
    $ret = explode(" ", $searchVal);
    $searchSurname = $ret[0];
    $searchForename = $ret[1];
    
    $recId = $SQL->findRecId("SELECT RECID FROM MEMBERTABLE WHERE (SURNAME LIKE '%".$searchSurname."%' AND FORENAME LIKE '%".$searchForename."%')");
    if($recId <= 0)
    {
        // evtl. wurden nachname und vorname von der Reihenfolge verdreht, dann suche entsprechend anders herum
        $recId = $SQL->findRecId("SELECT RECID FROM MEMBERTABLE WHERE (FORENAME LIKE '%".$searchSurname."%' AND SURNAME LIKE '%".$searchForename."%')");
    }
}
else
{
    $recId = $SQL->findRecId("SELECT RECID FROM MEMBERTABLE WHERE IDENTITYNUM LIKE '%".$searchVal."%' OR SURNAME LIKE '%".$searchVal."%' OR FORENAME LIKE '%".$searchVal."%'");
}



if($recId > 0)
{
    $MT = new MemberTable($recId);
    $recId = $recId;
    $identityNum = $MT->identityNum();
    $firstName = $MT->forename();
    $lastName = $MT->surname();
    $birthday = $MT->birthday();
    $entryDate = $MT->entryDate();
    $fireDeptId = $MT->fireDeptId();
    $gender = $MT->gender();
}
else
{
    $recId = "";
    $identityNum = "";
    $firstName = "";
    $lastName = "";
    $birthday = "";
    $entryDate = "";
    $fireDeptId = "";
    $gender = "";
}

//build the JSON array for return
$json = array(array('field' => 'recId', 'value' => $recId),
              array('field' => 'identityNum', 'value' => $identityNum),
              array('field' => 'gender', 'value' => $gender),
              array('field' => 'forename', 'value' => $firstName), 
              array('field' => 'surname', 'value' => $lastName),
              array('field' => 'birthday', 'value' => $birthday),
              array('field' => 'entryDate', 'value' => $entryDate),
              array('field' => 'fireDeptId', 'value' => $fireDeptId));

echo json_encode($json );
?>

