<?php

/**
 * Get the current IP Address
 * @return string IP Address
 */
function sysGetIpAddress() {
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * Start a session if it not started at all<br>
 * and return the sesion_id()
 * @return session_id()
 */
function sysGetSessionId() {
    if(!isset($_SESSION)) {
        session_start();
    }
    return session_id();
}

/**
 * Get and/or add parameter to URL
 * @param array $additions Parameter additions e.g.: array("key"=>"val") to get &key=val
 * @return string URL with parameter
 */
function sysGetPhpSelf(array $additions = null) {
    $url = explode("?", $_SERVER['PHP_SELF'])[0]; // Cut str after ?
    
    if($_GET)
    {
        $first = true;
        foreach($_GET as $key => $val) {
            if($first)
            {
                $url .= "?".$key."=".$val;
            }
            else 
            {
                $url .= "&".$key."=".$val;
            }
            $first = false;
        }
    }
    
    if($additions != null){       
        foreach($additions as $keyAdd => $valAdd) {
            if(Obj::strFind($url, "?")) {
                $url .= "&". $keyAdd."=".$valAdd;
            } else {
                $url .= "?" . $keyAdd."=".$valAdd;
            }
        }
    }
    
    return $url;
}

/**
 * Recover a userLogin and proceed some checks
 * @return type
 */
function sysRecoverLoginOrLogout() {
    
    if($_SESSION[SysConstants::sysNickname] && $_SESSION[SysConstants::sysLoggedIn] == true)
    {
        
        if(sysGetIpAddress() != $_SESSION[SysConstants::sysIp])
        {
            $_SESSION[SysConstants::sysLoggedIn] = false;
            return null;
        }
        $idleTime = new DateTime();
        $idleTime->setTimestamp(time()-$_SESSION[SysConstants::sysLoggedInIdleTimeSec]);
        echo DateTimeUtil::dateTime($idleTime);
    }
}

/**
 * Resolve the BaseDirPath an include the Factory site to mange all classes
 */
function sysResolveAndInitFactory() {       
    require_once(sysGetBaseDir()."Factory.php");
}

/**
 * Get the relative BaseDir ../ or ../../
 * @return string BaseDir rel ../
 */
function sysGetBaseDir() {
    $BASEDIR = str_repeat('../', substr_count($_SERVER['REQUEST_URI'], '/')-2);
    return $BASEDIR;
}

function sysCreatePageHeader($title = null, $showMenu = true, $jqueryFile = null) {
    if($title == null) {
        $title = basename($_SERVER["SCRIPT_FILENAME"], '.php');
    }
    if($jqueryFile == null) {             
        $fileName = $title.".js";
        if(file_exists($fileName)) {
            $jqueryFile = $fileName;
        }
    }
    echo FormRun::createPageHeader($title, $showMenu, $jqueryFile);
}


function sysCreatePageFooter($showInfos = true) {
    echo FormRun::createPageFooter($showInfos);
}


/** 
 * Get the Char behind the enum value to indicate Men or Women | Boy or Girl
 * @param int $id Id from Enum
 * @return string w or m
 */
function genderId2GenderName($id) {
    if($id == 1) {
        return "weiblich";
    }
    
    return "männlich";
}

/**
 * Checks if the Application has an connection to the www
 * @return boolean true if Application has an online connection
 */
function isOnline() {
    $connected = @fsockopen("www.google.com", 80);  //website, port  (try 80 or 443)
    if ($connected) {
        $is_conn = true; //action when connected
        fclose($connected);
    } else {
        $is_conn = false; //action in connection failure
    }
    return $is_conn;
}

/**
 * is the User Admin?
 * @return boolean true if the Current User is Admin
 */
function sysIsUserAdmin() {
    sysGetSessionId(); // Call Session Start if a window will be opened outside Main window
    if(@$_SESSION[SysConstants::sysSessionIsAdminSession] || @$_SESSION[SysConstants::sysSessionIsAdminSession] == 1)
    {
        return true;
    }
    
    // 'Admin in spe' sind auch Benutzer die keiner Landkreisgruppe UND Feuerwehr zugehörig sind
    if(!@$_SESSION[SysConstants::sysSessionGroupId] && !@$_SESSION[SysConstants::sysSessionGroupId])
    {
        return true;
    }
    
    return false;
}


/**
 * is the User Group User only?
 * @return boolean true if the Current User is Group User only
 */
function sysIsUserGroupUser() {
    sysGetSessionId(); // Call Session Start if a window will be opened outside Main window
    if(@$_SESSION[SysConstants::sysSessionGroupId] && @$_SESSION[SysConstants::sysSessionFireDeptId] == -1)
    {
        return true;
    }
    
    return false;
}

/**
 * is the user a User only?
 * @return boolean true if the Current User is an User only
 */
function sysIsUserUser() {
    sysGetSessionId(); // Call Session Start if a window will be opened outside Main window
    if(@$_SESSION[SysConstants::sysSessionGroupId] && @$_SESSION[SysConstants::sysSessionFireDeptId] != -1)
    {
        return true;
    }
    
    return false;
}

/**
 * Get the ID of Group which a User is in
 * @return RecId GroupRecId
 */
function sysGetGroupIdOfUser() {
    sysGetSessionId();
    return @$_SESSION[SysConstants::sysSessionGroupId];
}

 
/**
 * Abbreveation of strtoupper
 * @param str $str
 * @return str in Uppercase letters
 */
function str2upper($str) {
    return strtoupper($str);
}

/**
 * Get the TableId
 * @param Obj $table
 * @return int Table ID
 */
function tablenum($table){
    return SysTableIdReference::findOrCreate($table->tableName)->fldRecId[FLDVALUE];
}


/**
 * Get the Length of an spefic Field
 * @param Fld $field Fld from ExtendesDataTypes
 * @return int Length of the Field
 */
function fieldLength($field) {
    return SysTableBase::getFieldLength($field);
}

/**
 * Get an Object/Record based on TableId and RecId
 * @param int $tablenum TableNum
 * @param int $recId RecId
 * @return \tableName Table with Record
 */
function getRecord($tablenum, $recId) {
    try
    {
        if($tablenum == -1 && $recId == -1)
            return null;
        
        $tableName = SysTableIdReference::tableNum2TableName($tablenum);
        $obj = new $tableName($recId);
        if(is_object($obj))
            return $obj;

        return null;
    }
    catch(Exception $ex)
    {
        return null;
    }
}

/**
 * Get all Fields of Table
 * @param Object $table TableObject e.g. "new DistrictTable()"
 * @return \Map map of Fields
 */
function getFields($table) {
    $reflectionClass = new ReflectionClass($table);
    // Durchlaufe Propertys der Klasse
    $map = new Map();
    foreach($reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC) as $prop ) 
    {  
        if(SysTableBase::isField($prop->name)) {
            // Dann erzeuge referenz auf das aktuelle Property
            $refProp = $reflectionClass->getProperty($prop->name);
            $fieldVal = $refProp->getValue($table);
            $map->insert($fieldVal);
        }
    }
    return $map;
}

/**
 * returns a string of formated part of html Table<br>
 * only the part <tr>td fields</tr>
 * @param Object $table e.g. "new DisttrictTable()"
 * @return string part of HtmlTable 
 */
function getFieldsHelpTable($table) {
    $ret = "\n";
    $fieldMap = getFields($table);
    $fieldMapIterator = new MapIterator($fieldMap);
    while($fieldMapIterator->next()) 
    {
        $ret .= "<tr>\n";
        $ret .= "<td>".$fieldMapIterator->currentValue()[FLDNAME]."</td>\n";
        $ret .= "<td>".$fieldMapIterator->currentValue()[FLDLABEL]['de']."</td>\n";
        $ret .= "<td>".$fieldMapIterator->currentValue()[FLDTYPE]."</td>\n";
        $ret .= "<td>".$fieldMapIterator->currentValue()[FLDISMANDATORY]."</td>\n";
        $ret .= "<td>".$fieldMapIterator->currentValue()[FLDLENGTH]."</td>\n";
        $ret .= "<td>".$fieldMapIterator->currentValue()[FLDDEVDOC]['de']."</td>\n";
        $ret .= "</tr>\n";        
    }
    return $ret;
}

/**
 * Returns an str in an echo so you can put $ret and $exceptionThrown<br>
 * to handle further with <b>journalMessage</b> and <b>ExceptionThrown</b> in js files
 * @param mixed $ret
 * @param boolean $exceptionThrown
 */
function getJsonReturn($ret, $exceptionThrown = false) {    
    $data = array("journalMessage" => $ret, "ExceptionThrown" => $exceptionThrown);
    echo json_encode($data);
}

?>
