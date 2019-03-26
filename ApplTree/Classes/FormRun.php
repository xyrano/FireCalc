<?php

/**
 * Description of FormRun
 *
 * @author tanzberg
 */
class FormRun 
{
    
    
    
    /**
     * Create The PageHeader with includes and provides a Menu
     * @param string $pageTitle PageTitle for this Window
     * @param boolean $showMenu Set True to provide the default menu if False no Menu will be provided
     * @param string $jqueryFile File or FilePath to JS File
     * @return string PageHeader
     */
    public static function createPageHeader($pageTitle = null, $showMenu = false, $jqueryFile = null) {
        $isOnline = isOnline();
        
        if(!isset($_SESSION))
        {
            session_start();
            $US = new UserSession();
            $US->updateTime();
        }
        $header = "<!DOCTYPE html>";
        $header .= "\r\n<html>";
        $header .= "\r\n<head>";
        $header .= "\r\n <meta charset=\"UTF-8\">";
        $header .= "\r\n   <title>".$pageTitle."</title>";
        $header .= "\r\n   <link rel=\"stylesheet\" type=\"text/css\" href=\"".sysGetBaseDir()."messi.min.css\" />";
        $header .= "\r\n   <link rel=\"stylesheet\" type=\"text/css\" href=\"".sysGetBaseDir()."design.css\" />";
        $header .= "\r\n   <link rel=\"stylesheet\" href=\"//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css\" />";
        
        if($isOnline)
        {
            $header .= "\r\n   <script src=\"http://code.jquery.com/jquery-latest.js\"></script>";
            $header .= "\r\n   <script src=\"http://code.jquery.com/ui/1.11.4/jquery-ui.js\"></script>"; 
        }
        else
        {
            $header .= "\r\n   <script src=\"". sysGetBaseDir()."jquery-3.2.1.min.js\"></script>";
            $header .= "\r\n   <script src=\"". sysGetBaseDir()."jquery-ui-1.11.4.js\"></script>"; 
        }
        
        $header .= "\r\n   <script src=\"".sysGetBaseDir()."messi.min.js\"></script>"; 
        $header .= "\r\n   <script src=\"".sysGetBaseDir()."MenuItems.js\"></script>";
        $header .= "\r\n   <script src=\"".sysGetBaseDir()."FormControl.js\"></script>";
        $header .= "\r\n   <script src=\"".sysGetBaseDir()."jquery.chained.js\"></script>";
        
        
        if($jqueryFile != null) {
            $header .= "\r\n   <script src=\"./".$jqueryFile."\"></script>";
        }
        
        $header .= "\r\n</head>";
        $header .= "\r\n<body style=\"font-size: 0.8em; margin: 0px; padding: 0px;\">";  

        
        if($showMenu) {
            $header .= self::createMenu2PageHeader();
        }
        
        $header .= "\r\n   <script src=\"".sysGetBaseDir()."windowProperties.js\"></script>";  
        
        if($isOnline == false) {
            $header .= "\r\n <fieldset><legend>info</legend><i>Note: you´re not connected with the www so some functions are not working!</i><br>"
                    . "<i>You´re using jquery 3.2.1.min local copy version</i><br>"
                    . "<i>and jquery UI 1.11.4 local copy version</i></fieldset>";
        }
        
        $header .= "\r\n\r\n";
         // present in every form an loading modal div
        $header .= "<div class=\"progressAniDiv\"><!-- loading element --></div>";
        
        return $header;
    }
    
    
    private static function createMenu2PageHeader() {   
        $idxAdd = "";
        if(@$_GET['idx']>0)
        {
            $idxAdd = "&idx=".$_GET['idx']; // for potentially recId carry over
        }
                
        $pageAdd = "";
        if(isset($_GET['page']))
        {
            $pageAdd = "&page=".$_GET['page'];
        }
        
        $header = "";
        $header .= "\r\n<table style=\"width: 100%; height: 30px; background-color: whitesmoke; border-bottom: black solid 1px;\">";
        $header .= "\r\n    <tr>";
        $header .= "\r\n        <td>";
        $header .= "\r\n        <table border=\"0\">";
        $header .= "\r\n            <tr>";
        $header .= "\r\n                <td><a id=\"start\" href=\" ".$_SERVER['PHP_SELF']."?ID=".session_id()."&do=start".$idxAdd."".$pageAdd."\">Start</a></td>";
        $header .= "\r\n                <td>|</td>";
        $header .= "\r\n                <td><a id=\"new\" href=\" ".$_SERVER['PHP_SELF']."?ID=".session_id()."&do=new".$idxAdd."".$pageAdd."\">Neu</a></td>";
        $header .= "\r\n                <td>|</td>";
        $header .= "\r\n                <td><a id=\"save\" href=\" ".$_SERVER['PHP_SELF']."?ID=".session_id()."&do=save".$idxAdd."".$pageAdd."\">Speichern</a></td>";
        $header .= "\r\n                <td>|</td>";
        $header .= "\r\n                <td><a id=\"update\" href=\" ".$_SERVER['PHP_SELF']."?ID=".session_id()."&do=edit".$idxAdd."".$pageAdd."\">&Auml;ndern</a></td>";
        $header .= "\r\n                <td>|</td>";
        $header .= "\r\n                <td><a id=\"delete\" href=\" ".$_SERVER['PHP_SELF']."?ID=".session_id()."&do=delete".$idxAdd."".$pageAdd."\">Entfernen</a></td>";
        $header .= "\r\n                <td style=\"width: 100%; text-align: right;\" ><a id=\"FormOptions\" href=\"\">Details</a>&nbsp;|&nbsp;<a id=\"help\" href=\"\">Hilfe</a></td>";
        $header .= "\r\n            </tr>";
        $header .= "\r\n        </table>";
        $header .= "\r\n        </td>";
        $header .= "\r\n    </tr>";
        $header .= "\r\n</table>";
                  
        return $header;
    }
    
    
    /**
     * Generate and shows the Footer Bar
     * @param boolean $showInfoBar show Info´s = true or otherwise only a Bar
     * @return string Footer Window Bar
     */
    public static function createPageFooter($showInfoBar = false){
        $footer =  "\r\n<br><br><table style=\"width: 100%; 
                                        height: 30px; 
                                        position: fixed;
                                        background-color: whitesmoke; 
                                        bottom: 0px;
                                        border-top: black solid 1px; 
                                        font-size: small;
                                        \">";
        $footer .= "\r\n<tr>";
        $footer .= "\r\n<td>";
        if($showInfoBar) {
            $footer .= self::createFooterInfoBar();
        }
        $footer .= "\r\n</td>";                                          
        $footer .= "\r\n</tr>";
        $footer .= "\r\n</table>";
        $footer .= "\r\n</body>";
        $footer .= "\r\n</html>";
        return $footer;
    }
    
    
    private static function createFooterInfoBar() {
        $typ = "Typ: ";
        $typ .= sysIsUserAdmin() ? "Admin" : "";
        $typ .= sysIsUserGroupUser() ? "Gruppenbenutzer" : "";
        $typ .= sysIsUserUser() ? "Benutzer" : "";
        
        
        $info = "\r\n<table style=\"width:100%;\" border=0>";
        $info .= "\r\n  <tr>";
        $info .= "\r\n      <td style=\"width:120px;\">Angmeldet als: ".UserOnline::find()->fldUserName[FLDVALUE]."</td>";
        $info .= "\r\n      <td style=\"width:150px;\">Landkreisgruppe: ".  GroupTable::find(@$_SESSION[SysConstants::sysSessionGroupId])->fldGroupName[FLDVALUE]."</td>";
        $info .= "\r\n      <td style=\"width:180px;\">".$typ."</td>";
        $info .= "\r\n      <td style=\"width:100px;\">Feuerwehr: ".  FireDeptTable::findRecId(@$_SESSION[SysConstants::sysSessionFireDeptId])->fldFireDept[FLDVALUE]."</td>";
        $info .= "\r\n      <td style=\" text-align: right;\">".DateTimeUtil::currentDateTime()."</td>";
        $info .= "\r\n  </tr>";
        $info .= "\r\n</table>";
        return $info;
    }
    
    
    
    /**
     * Provide a new Field with Parameter
     * @param FormRunFldType $fldType 1. Typeof Field
     * @param str $fldName 2. Name of field 
     * @param str $fldEnumDataUrl 3. Url to enum .php file e.g.: "./FireDpet/fireDeptEnum.php"
     * @param bool $fldEnumMultiple 4. change to multiple selctable enum
     * @param bool $fldMandatory 5. Is cell mandatory
     * @param bool $editable 6. Is cell editable yes or no
     * @param bool $create 7. Is Used in "new record Forms" to create new entry 
     * @param bool $visible 8. Should this element be visible? Default is yes
     * @param str $value 9. Any Value in str form
     * @return str Value
     */
    public static function newFld($fldType, 
            $fldName, 
            $fldEnumDataUrl = null,     // No Enum Fld per default
            $fldEnumMultiple = false,   // No Multiple Enum per default
            $fldMandatory = false,      // Mandatory is default set to False
            $editable = true,           // Editable is default set to True
            $create = false,            // Create is default False
            $visible = true,            // Visible is default True
            $value = null) {            // Null value per default
        $enumData = '';
        $enumMltpl = '';
        $fldCreate = '';
        $elemVisible = '';
        
        if($fldEnumDataUrl != null)
        {
            $enumData = "enumData=".$fldEnumDataUrl;
        }
        
        if($fldEnumMultiple == true)
        {
            $enumMltpl = "enumMultiple=".$fldEnumMultiple;
        }
        
        if($create == true) 
        {
            $fldCreate = "id='Create'";
        }
        
        if($editable == false) {
            $fldEditable = '0';
        } else {
            $fldEditable = '1';
        }
        
        if($visible == false) {
            $elemVisible = "style='display:none;'";
        }
        
        $span = "<span ".$fldCreate." ".$elemVisible." type=\"".$fldType."\" name=\"".$fldName."\" mandatory=\"".$fldMandatory."\" editable=\"".$fldEditable."\" ".$enumData." ".$enumMltpl.">".$value."</span>";
        
        return $span; // e.g. it´s a Field yeah ;_9
    }
}
