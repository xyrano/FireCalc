<?php
/**
 * Field Value
 */
define("FLDVALUE", "VALUE");
/**
 * Field Type
 */
define("FLDTYPE", "TYPE");      // Varchar, char, boolean, int etc.
/**
 * Field Length
 */
define("FLDLENGTH", "LENGTH");  // (20)
/**
 * Field Label
 */
define("FLDLABEL", "LABEL");
/**
 * Field DevDoc for Documentation
 */
define("FLDDEVDOC", "DEVDOC");
/**
 * Field Name (Database Table name)
 */
define("FLDNAME", "NAME");
/**
 * Field is mandatory
 */
define("FLDISMANDATORY", "MANDATORY");
/**
 * Table Primary Index
 */
define("TABLEIDX", "RECID");

// Works only with phpversion >= 7.1
/**
 * Field Crated DateTime
 */
define("FLDCREATEDDATETIME", 
        array(FLDVALUE => "", 
            FLDNAME => "CREATEDDATETIME", 
            FLDTYPE => "DATETIME", 
            FLDLENGTH => "", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Erstellt am", "en"=>"Created at"),
            FLDDEVDOC => array("de" => "Speichert das Datum und die Uhrzeit wann ein Datensatz angelegt wurde.", "en" => "Save the date an time when a record is created.")));
/**
 * Field Created By
 */
define("FLDCREATEDBY",          
        array(FLDVALUE => "", 
            FLDNAME => "CREATEDBY", 
            FLDTYPE => "VARCHAR", 
            FLDLENGTH => "(10)", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Erstellt von", "en"=>"Created by"),
            FLDDEVDOC => array("de" => "Benutzer der den Datensatz ertellt hat.", "en" => "Username who created the record.")));
/**
 * Field Modified DateTime
 */
define("FLDMODIFIEDDATETIME",   
        array(FLDVALUE => "", 
            FLDNAME => "MODIFIEDDATETIME", 
            FLDTYPE => "DATETIME", 
            FLDLENGTH => "", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Geändert am", "en"=>"Moified at"),            
            FLDDEVDOC => array("de" => "Änderungsdatum und Uhrzeit wann der Datensatz letzmalig geändert wurde.", "en" => "Change date and time when the record was last changed.")));
/**
 * Field Modified By
 */
define("FLDMODIFIEDBY",         
        array(FLDVALUE => "", 
            FLDNAME => "MODIFIEDBY", 
            FLDTYPE => "VARCHAR", 
            FLDLENGTH => "(10)", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Geändert von", "en"=>"Modified by"),            
            FLDDEVDOC => array("de" => "Benutzer der den Datensatz letzmalig geändert hat.", "en" => "User who changed the record.")));
/**
 * Field TableId
 */
define("FLDTABLEID",            
        array(FLDVALUE => "", 
            FLDNAME => "TABLEID", 
            FLDTYPE => "INT", 
            FLDLENGTH => "(20)", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Tabellen ID", "en"=>"Table Id"), 
            FLDDEVDOC => array("de" => "Eindeutige Tabellen ID.", "en" => "Unique Table ID.")));
/**
 * Field RecId
 */
define("FLDRECID",              
        array(FLDVALUE => "", 
            FLDNAME => TABLEIDX, 
            FLDTYPE => "BIGINT", 
            FLDLENGTH => "", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"RecId", "en"=>"RecId"), 
            FLDDEVDOC => array("de" => "Eindeutige Datensatzkennung.", "en" => "Unique record ID.")));
/**
 * Field Forename
 */
define("FLDFORENAME",           
        array(FLDVALUE => "", 
            FLDNAME => "FORENAME", 
            FLDTYPE => "VARCHAR", 
            FLDLENGTH => "(20)", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Vorname", "en"=>"Forename"), 
            FLDDEVDOC => array("de" => "Vorname der Person.", "en" => "Persons forename.")));
/**
 * Field Surname
 */
define("FLDSURNAME",            
        array(FLDVALUE => "", 
            FLDNAME => "SURNAME", 
            FLDTYPE => "VARCHAR", 
            FLDLENGTH => "(30)", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Nachname", "en"=>"Surname"), 
            FLDDEVDOC => array("de" => "Nachname der Person.", "en" => "Persons surname.")));
/**
 * Field Username/Nickname
 */
define("FLDUSERNAME",           
        array(FLDVALUE => "", 
            FLDNAME => "USERNAME", 
            FLDTYPE => "VARCHAR", 
            FLDLENGTH => "(10)", 
            FLDISMANDATORY => true, 
            FLDLABEL => array("de"=>"Benutzername", "en"=>"Nickname"), 
            FLDDEVDOC => array("de" => "Username oder Nickname des Benutzers.", "en" => "Username or nickname of the user.")));
/**
 * Field ConfirmedFrom
 */
define("FLDCONFIRMEDFROM",           
        array(FLDVALUE => "", 
            FLDNAME => "CONFIRMEDFROM", 
            FLDTYPE => "VARCHAR", 
            FLDLENGTH => "(10)", 
            FLDISMANDATORY => true, 
            FLDLABEL => array("de"=>"Benutzername", "en"=>"Nickname"), 
            FLDDEVDOC => array("de" => "Bestätigt durch Benutzer xxx.", "en" => "Confirmed from user xxx.")));
/**
 * Field User Password
 */
define("FLDPASSWORD",           
        array(FLDVALUE => "", 
            FLDNAME => "PASSWORD", 
            FLDTYPE => "VARCHAR", 
            FLDLENGTH => "(60)", 
            FLDISMANDATORY => true, 
            FLDLABEL => array("de"=>"Passwort", "en"=>"Password"), 
            FLDDEVDOC => array("de" => "Benutzerpasswort.", "en" => "Userpassword.")));
/**
 * Field GroupId => Benutzer GruppenId
 */
define("FLDGROUPID",           array(FLDVALUE => "", FLDNAME => "GROUPID", FLDTYPE => "INT", FLDLENGTH => "(2)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Gruppen ID", "en"=>"Group ID"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field Birthdate
 */
define("FLDBIRTHDATE",           array(FLDVALUE => "", FLDNAME => "Birthdate", FLDTYPE => "DATE", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Geburtsdatum", "en"=>"Birthdate"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field Birthdate
 */
define("FLDSYSTABLENAME",        array(FLDVALUE => "", FLDNAME => "TABLENAME", FLDTYPE => "VARCHAR", FLDLENGTH => "(50)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Tabellenname", "en"=>"Tablename"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field DistrictId = Recid von DistrictTable für andere Tabellen
 */
define("FLDDISTRICTID",            array(FLDVALUE => "", FLDNAME => "DISTRICTID", FLDTYPE => "BIGINT", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Landkreis ID", "en"=>"District ID"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field District = Landkreis
 */
define("FLDDISTRICT",            array(FLDVALUE => "", FLDNAME => "DISTRICT", FLDTYPE => "VARCHAR", FLDLENGTH => "(20)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Landkreis", "en"=>"District"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field District = Landkreis
 */
define("FLDREFRECID",            array(FLDVALUE => "", FLDNAME => "REFRECID", FLDTYPE => "BIGINT", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Referenz ID", "en"=>"Reference ID"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field Municipal ID = Recid von MunicipalTable (Gemeinde)
 */
define("FLDMUNICIPALID",            array(FLDVALUE => "", FLDNAME => "MUNICIPALID", FLDTYPE => "BIGINT", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Gemeinde ID", "en"=>"Municipal ID"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field Municipal = Gemeinde
 */
define("FLDMUNICIPAL",           array(FLDVALUE => "", FLDNAME => "DISTRICT", FLDTYPE => "VARCHAR", FLDLENGTH => "(30)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Gemeinde", "en"=>"Municpal"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field FireDeptID = Recid von FireDeptTable 
 */
define("FLDFIREDEPTID",            array(FLDVALUE => "", FLDNAME => "FIREDEPTID", FLDTYPE => "BIGINT", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Feuerwehr ID", "en"=>"Fire department ID"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field FireDept = Feuerwehr
 */
define("FLDFIREDEPT",           array(FLDVALUE => "", FLDNAME => "FIREDEPT", FLDTYPE => "VARCHAR", FLDLENGTH => "(50)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Feuerwehr", "en"=>"Fire department"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field AdminSetupTable.IdleTime 
 */
define("FLDIDLETIME",           array(FLDVALUE => "", FLDNAME => "IDLETIME", FLDTYPE => "INT", FLDLENGTH => "(2)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Inaktivitätszeit", "en"=>"Idle time"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field AdminSetupTable.IdleTimeFormat (Format ob H oder I oder S) 
 */
define("FLDIDLETIMEFORMAT",           array(FLDVALUE => "", FLDNAME => "IDLETIMEFORMAT", FLDTYPE => "VARCHAR", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Inaktivitätszeitformat", "en"=>"Idle timeformat"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field AdminSetupTable.AutoMemberIdentId 
 */
define("FLDAUTOMEMBERIDENTID",           array(FLDVALUE => "", FLDNAME => "AutoMemberIdentID", FLDTYPE => "INT", FLDLENGTH => "(2)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field AdminSetupTable.PageRefreshUpdatesIdleTime 
 */
define("FLDPAGEREFRESHUPDATESIDLETIME",           array(FLDVALUE => "", FLDNAME => "PAGEREFRESHUPDATESIDLETIME", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field AdminSetupTable.DeleteUploadedMemberFiles 
 */
define("FLDDELETEUPLOADEDMEMBERFILES",           array(FLDVALUE => "", FLDNAME => "DELETEUPLOADEDMEMBERFILES", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field AdminSetupTable.HideContestAfterToday 
 */
define("FLDHIDECONTESTAFTERTODAY",           array(FLDVALUE => "", FLDNAME => "HIDECONTESTAFTERTODAY", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field AdminSetupTable.DeleteMemberAtAgeOf 
 */
define("FLDDELETEMEMBERATAGEOF",           array(FLDVALUE => "", FLDNAME => "DELETEMEMBERATAGEOF", FLDTYPE => "INT", FLDLENGTH => "(2)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field AdminSetupTable.ErrorPointsPerDefault 
 */
define("FLDERRORPOINTSPERDEFAULT",           array(FLDVALUE => "", FLDNAME => "ERRORPOINTSPERDEFAULT", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field AdminSetupTable.ErrorPointsPerDefaultBPart 
 */
define("FLDERRORPOINTSPERDEFAULTBPART",           array(FLDVALUE => "", FLDNAME => "ERRORPOINTSPERDEFAULTBPART", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field AdminSetupTable.TimePerDefaultUFH 
 */
define("FLDTIMEPERDEFAULTUFH",           array(FLDVALUE => "", FLDNAME => "TIMEPERDEFAULTUFH", FLDTYPE => "TIME", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field AdminSetupTable.TimePerDefaultOW 
 */
define("FLDTIMEPERDEFAULTOW",           array(FLDVALUE => "", FLDNAME => "TIMEPERDEFAULTOW", FLDTYPE => "TIME", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field UserOnline.fldSessionId 
 */
define("FLDSESSIONID",           array(FLDVALUE => "", FLDNAME => "SESSIONID", FLDTYPE => "VARCHAR", FLDLENGTH => "(60)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"SESSION ID", "en"=>"SESSION ID"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field UserOnline.fldGroupname 
 */
define("FLDGROUPNAME",           array(FLDVALUE => "", FLDNAME => "GROUPNAME", FLDTYPE => "VARCHAR", FLDLENGTH => "(30)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Gruppen Id", "en"=>"Group Id"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field UserOnline.fldSessionId 
 */
define("FLDGROUPDESCRIPTION",           array(FLDVALUE => "", FLDNAME => "DESCRIPTION", FLDTYPE => "VARCHAR", FLDLENGTH => "(100)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Beschreibung", "en"=>"Description"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field UserOnline.fldSessionId 
 */
define("FLDDISTRICTMAP",           array(FLDVALUE => "", FLDNAME => "DISTRICTMAP", FLDTYPE => "VARCHAR", FLDLENGTH => "(200)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Landkreis Zuordnung", "en"=>"District map"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field MemberTable.Gender 
 */
define("FLDGENDER",           array(FLDVALUE => "", FLDNAME => "GENDER", FLDTYPE => "BOOLEAN", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Geschlecht", "en"=>"Gender"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field MemberTable.EntryDate 
 */
define("FLDDATE",           array(FLDVALUE => "", FLDNAME => "DATE", FLDTYPE => "DATE", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Datum", "en"=>"Date"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field MemberTable.EntryDate 
 */
define("FLDCONFIRMEDDATE",           array(FLDVALUE => "", FLDNAME => "CONFIRMEDDATE", FLDTYPE => "DATE", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Bestätigungsdatum", "en"=>"Cofirmation date"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field MemberTable.IdentityNum (ausweisnummer) 
 */
define("FLDIDENTITYNUM",           array(FLDVALUE => "", FLDNAME => "IDENTITYNUM", FLDTYPE => "VARCHAR", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Ausweisnummer", "en"=>"Identity num"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field UserWindowProperties.WindowTitle
 */
define("FLDWINDOWTITLE",           array(FLDVALUE => "", FLDNAME => "WINDOWTITLE", FLDTYPE => "VARCHAR", FLDLENGTH => "(20)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fenster Titel", "en"=>"Window title"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field UserWindowProperties.Window
 */
define("FLDWINDOWWIDTH",           array(FLDVALUE => "", FLDNAME => "WIDTH", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field UserWindowProperties.Window
 */
define("FLDWINDOWHEIGHT",           array(FLDVALUE => "", FLDNAME => "HEIGHT", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field UserWindowProperties.Window
 */
define("FLDWINDOWX",           array(FLDVALUE => "", FLDNAME => "X", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field UserWindowProperties.Window
 */
define("FLDWINDOWY",           array(FLDVALUE => "", FLDNAME => "Y", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field ContestID = Recid von ContestTable 
 */
define("FLDCONTESTID",            array(FLDVALUE => "", FLDNAME => "CONTESTID", FLDTYPE => "BIGINT", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Wettbewerbs ID", "en"=>"Contest ID"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field Contest = Wettbewerbsname
 */
define("FLDCONTESTNAME",            array(FLDVALUE => "", FLDNAME => "CONTESTNAME", FLDTYPE => "VARCHAR", FLDLENGTH => "(20)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Wettbewerbsname", "en"=>"Contestname"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field NOYES 
 */
define("FLDISOPENWATER",           array(FLDVALUE => "", FLDNAME => "ISOPENWATER", FLDTYPE => "BOOLEAN", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Offenes Gewässer", "en"=>"Open Water"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field MemberTable.Gender 
 */
define("FLDCONTESTISCALCULATED",           array(FLDVALUE => "", FLDNAME => "CONTESTISCALCULATED", FLDTYPE => "BOOLEAN", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Ausgewertet", "en"=>"Calculated"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field Venue = Austragungsort
 */
define("FLDVENUE",            array(FLDVALUE => "", FLDNAME => "VENUE", FLDTYPE => "VARCHAR", FLDLENGTH => "(100)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Austragungsort", "en"=>"Venue"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field ContestLeader
 */
define("FLDCONTESTLEADER",           array(FLDVALUE => "", FLDNAME => "CONTESTLEADER", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field ContestTeamManager
 */
define("FLDCONTESTTEAMMANAGER",           array(FLDVALUE => "", FLDNAME => "CONTESTTEAMMANAGER", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field RegistrationTable.Closed 
 */
define("FLDCLOSED",           array(FLDVALUE => "", FLDNAME => "CLOSED", FLDTYPE => "BOOLEAN", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"", "en"=>""), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field MemberIdMap = Mitglieder Map 
 */
define("FLDMEMBERMAP",            array(FLDVALUE => "", FLDNAME => "MEMBERMAP", FLDTYPE => "VARCHAR", FLDLENGTH => "(250)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Mitglieder", "en"=>"Member"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorValues.CompetitionType = A-Teil oder B-Teil
 */
define("FLDCOMPETITIONTYPE",            array(FLDVALUE => "", FLDNAME => "COMPETITIONTYPE", FLDTYPE => "VARCHAR", FLDLENGTH => "(6)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Wettbewerbs Typ", "en"=>"Competitiontype"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorTotals.CompetitionType = A-Teil
 */
define("FLDCOMPETITIONTYPEA",            array(FLDVALUE => "", FLDNAME => "COMPETITIONTYPEA", FLDTYPE => "VARCHAR", FLDLENGTH => "(6)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"A-Teil", "en"=>"A-Part"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.CompetitionType = B-Teil
 */
define("FLDCOMPETITIONTYPEB",            array(FLDVALUE => "", FLDNAME => "COMPETITIONTYPEB", FLDTYPE => "VARCHAR", FLDLENGTH => "(6)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"B-Teil", "en"=>"B-Part"), FLDDEVDOC => array("de" => "", "en" => "")));



/**
 * Field ErrorValues.ErrorNum = Integer
 */
define("FLDERRORNUM",            array(FLDVALUE => "", FLDNAME => "ERRORNUM", FLDTYPE => "INT", FLDLENGTH => "(2)", FLDISMANDATORY => true, FLDLABEL => array("de"=>"Fehlernummer", "en"=>"Errornumber"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorValues.ErrorSubNum = Integer
 */
define("FLDERRORSUBNUM",            array(FLDVALUE => "", FLDNAME => "ERRORSUBNUM", FLDTYPE => "INT", FLDLENGTH => "(2)", FLDISMANDATORY => true, FLDLABEL => array("de"=>"Fehler unternummer", "en"=>"Error subnum"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorValues.Indicator = Offenes Gewässer = ow oder Unterflurhydrant (ufh)
 */
define("FLDINDICATOR",            array(FLDVALUE => "", FLDNAME => "INDICATOR", FLDTYPE => "VARCHAR", FLDLENGTH => "(3)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Indikator", "en"=>"Indicator"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorValues.Who = Who made this error
 */
define("FLDWHO",            array(FLDVALUE => "", FLDNAME => "WHO", FLDTYPE => "VARCHAR", FLDLENGTH => "(3)", FLDISMANDATORY => true, FLDLABEL => array("de"=>"Fehlerverursacher", "en"=>"Error polluters"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorValues.ErrorValue = integer
 */
define("FLDERRORVALUE",            array(FLDVALUE => "", FLDNAME => "ERRORVALUE", FLDTYPE => "INT", FLDLENGTH => "(3)", FLDISMANDATORY => true, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorvalue"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorValues.ErrorNumCount = Anzahl der Fehler die gemacht wurden
 */
define("FLDERRORNUMCOUNT",            array(FLDVALUE => "", FLDNAME => "ERRORNUMERCOUNT", FLDTYPE => "INT", FLDLENGTH => "(3)", FLDISMANDATORY => true, FLDLABEL => array("de"=>"Fehleranzahl", "en"=>"Error amount"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorValues.CountingType = add or sub
 */
define("FLDCOUNTINGTYPE",            array(FLDVALUE => "", FLDNAME => "COUNTINGTYPE", FLDTYPE => "VARCHAR", FLDLENGTH => "(3)", FLDISMANDATORY => true, FLDLABEL => array("de"=>"Zähltyp", "en"=>"Countingtype"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorAdditions.Disqualified = Disqualifieziert Ja/Nein
 */
define("FLDDISQUALIFIED", 
        array(FLDVALUE => "", 
            FLDNAME => "DISQUALIFIED", 
            FLDTYPE => "INT", 
            FLDLENGTH => "(1)", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Disqualifiert", "en"=>"Disqualified"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorAdditions.ContestTimeGF = Zeit
 */
define("FLDCONTESTTIMEGF",            array(FLDVALUE => "", FLDNAME => "CONTESTTIMEGF", FLDTYPE => "TIME", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Zeit", "en"=>"Time"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorAdditions.ContestTimeMA = Zeit
 */
define("FLDCONTESTTIMEMA",            array(FLDVALUE => "", FLDNAME => "CONTESTTIMEMA", FLDTYPE => "TIME", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Zeit", "en"=>"Time"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorAdditions.TimeKnotsAT = Zeit
 */
define("FLDTIMEKNOTSAT",            array(FLDVALUE => "", FLDNAME => "TIMEKNOTSAT", FLDTYPE => "TIME", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Zeit", "en"=>"Time"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorAdditions.TimeKnotsWT = Zeit
 */
define("FLDTIMEKNOTSWT",            array(FLDVALUE => "", FLDNAME => "TIMEKNOTSWT", FLDTYPE => "TIME", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Zeit", "en"=>"Time"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorImpressions.GFME = ErrorValue for Gruppenführer/Melder
 */
define("FLDGFME", array(FLDVALUE => "", FLDNAME => "GFME", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.MA = ErrorValue for Maschinist
 */
define("FLDMA", array(FLDVALUE => "", FLDNAME => "MA", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorImpressions.AT = ErrorValue for Angriffstrupp
 */
define("FLDAT", array(FLDVALUE => "", FLDNAME => "AT", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.WT = ErrorValue for Wassertrupp
 */
define("FLDWT", array(FLDVALUE => "", FLDNAME => "WT", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.ST = ErrorValue for Schlauchtrupp
 */
define("FLDST", array(FLDVALUE => "", FLDNAME => "ST", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.L1 = ErrorValue for Läufer1
 */
define("FLDL1", array(FLDVALUE => "", FLDNAME => "L1", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.L2 = ErrorValue for Läufer2
 */
define("FLDL2", array(FLDVALUE => "", FLDNAME => "L2", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.L3 = ErrorValue for Läufer3
 */
define("FLDL3", array(FLDVALUE => "", FLDNAME => "L3", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.L4 = ErrorValue for Läufer4
 */
define("FLDL4", array(FLDVALUE => "", FLDNAME => "L4", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.L5 = ErrorValue for Läufer5
 */
define("FLDL5", array(FLDVALUE => "", FLDNAME => "L5", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.L6 = ErrorValue for Läufer6
 */
define("FLDL6", array(FLDVALUE => "", FLDNAME => "L6", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.L7 = ErrorValue for Läufer7
 */
define("FLDL7", array(FLDVALUE => "", FLDNAME => "L7", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.L8 = ErrorValue for Läufer8
 */
define("FLDL8", array(FLDVALUE => "", FLDNAME => "L8", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorImpressions.L9 = ErrorValue for Läufer9
 */
define("FLDL9", array(FLDVALUE => "", FLDNAME => "L9", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte", "en"=>"Errorpoints"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.AveAge = Average Age
 */
define("FLDAVEAGE", array(FLDVALUE => "", FLDNAME => "AVEAGE", FLDTYPE => "DECIMAL", FLDLENGTH => "(5)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Durchschnittsalter", "en"=>"Average age"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorTotals.StartPointsA = Start points
 */
define("FLDSTARTPOINTSA", array(FLDVALUE => "", FLDNAME => "STARTPOINTA", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Startpunkt A-Teil", "en"=>"Start points A-Part"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.StartPointsB = Start points
 */
define("FLDSTARTPOINTSB", array(FLDVALUE => "", FLDNAME => "STARTPOINTB", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Startpunkt B-Teil", "en"=>"Start points B-Part"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.ErrorPointsA = Error points
 */
define("FLDERRORPOINTSA", array(FLDVALUE => "", FLDNAME => "ERRORPOINTA", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte A-Teil", "en"=>"Error points A-Part"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.ErrorPointsB = Error points
 */
define("FLDERRORPOINTSB", array(FLDVALUE => "", FLDNAME => "ERRORPOINTB", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehlerpunkte B-Teil", "en"=>"Error points B-Part"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorTotals.CompetitionTimeA = Competition Time A-Part
 */
define("FLDCOMPETITIONTIMEA", array(FLDVALUE => "", FLDNAME => "COMPETITIONTIMEA", FLDTYPE => "TIME", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Wettbewerbszeit A-Teil", "en"=>"Competitiontime A-Part"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.CompetitionTimeB = Competition Time B-Part
 */
define("FLDCOMPETITIONTIMEB", array(FLDVALUE => "", FLDNAME => "COMPETITIONTIMEB", FLDTYPE => "TIME", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Wettbewerbszeit B-Teil", "en"=>"Competitiontime B-Part"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorTotals.TimeErrorPointsA = Error points
 */
define("FLDTIMEERRORPOINTSA", array(FLDVALUE => "", FLDNAME => "TIMEERRORPOINTA", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Zeitfehlerpunkte A-Teil", "en"=>"Time error points A-Part"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.TimeErrorPointsB = Error points
 */
define("FLDTIMEERRORPOINTSB", array(FLDVALUE => "", FLDNAME => "TIMEERRORPOINTB", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Zeitfehlerpunkte B-Teil", "en"=>"Time error points B-Part"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.Time = Time A-Part | OR Global time
 */
define("FLDTIME", array(FLDVALUE => "", FLDNAME => "TIME", FLDTYPE => "TIME", FLDLENGTH => "", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Zeit", "en"=>"Time"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.TimeErrorPoints = Error points
 */
define("FLDTIMEERRORPOINTS", array(FLDVALUE => "", FLDNAME => "TIMEERRORPOINT", FLDTYPE => "INT", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Zeitfehlerpunkte", "en"=>"Time error points"), FLDDEVDOC => array("de" => "", "en" => "")));


/**
 * Field ErrorTotals.ImpressionsA = Impressiosn A
 */
define("FLDIMPRESSIONA", array(FLDVALUE => "", FLDNAME => "IMPRESSIONA", FLDTYPE => "DECIMAL", FLDLENGTH => "(5)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Eindruck A-Teil", "en"=>"Impression A-Part"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field ErrorTotals.ImpressionB = Impression B
 */
define("FLDIMPRESSIONB", array(FLDVALUE => "", FLDNAME => "IMPRESSIONB", FLDTYPE => "DECIMAL", FLDLENGTH => "(5)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Eindruck B-Teil", "en"=>"Impression B-Part"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.DisqualifiedA = Disqulaified A
 */
define("FLDDISQUALIFIEDA", array(FLDVALUE => "", FLDNAME => "DISQUALIFIEDA", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Disqualifiziert A-Teil", "en"=>"Disqualified A-Part"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field ErrorTotals.Disqualified = Disqulaified B
 */
define("FLDDISQUALIFIEDB", array(FLDVALUE => "", FLDNAME => "DISQUALIFIEDB", FLDTYPE => "INT", FLDLENGTH => "(1)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Disqualifiziert B-Teil", "en"=>"Disqualified B-Part"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.ErrorPointsSumA = Sum A
 */
define("FLDERRORPOINTSSUMA", array(FLDVALUE => "", FLDNAME => "ERRORPOINTSSUMA", FLDTYPE => "DECIMAL", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehler A-Teil", "en"=>"Errors A-Part"), FLDDEVDOC => array("de" => "", "en" => "")));
/**
 * Field ErrorTotals.ErrorpointsSumB = Sum B
 */
define("FLDERRORPOINTSSUMB", array(FLDVALUE => "", FLDNAME => "ERRORPOINTSSUMB", FLDTYPE => "DECIMAL", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Fehler B-Teil", "en"=>"Errors B-Part"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field ErrorTotals.ErrorPointsTotal = ErrorPointsTotal
 */
define("FLDERRORPOINTSTOTAL", array(FLDVALUE => "", FLDNAME => "ERRORPOINTSTOTAL", FLDTYPE => "DECIMAL", FLDLENGTH => "(10)", FLDISMANDATORY => false, FLDLABEL => array("de"=>"Gesamtfehlerpunkte", "en"=>"Error points"), FLDDEVDOC => array("de" => "", "en" => "")));

/**
 * Field SignatureTable.ImageExt = Image Extension
 */
define("FLDIMAGEEXT", 
        array(FLDVALUE => "", 
            FLDNAME => "IMAGEEXT", 
            FLDTYPE => "VARCHAR", 
            FLDLENGTH => "(10)", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Bildendung", "en"=>"Image extension"), 
            FLDDEVDOC => array("de" => "Die Dateiendung des Bildes um es als Roh format wieder auszugeben.", "en" => "The file extension from the image to individual handle for export.")));


/**
 * Field SignatureTable.SigDescription = Description
 */
define("FLDSIGNATUREDESCRIPTION", 
        array(FLDVALUE => "", 
            FLDNAME => "SIGNATUREDESCRIPTION", 
            FLDTYPE => "VARCHAR", 
            FLDLENGTH => "(100)", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Signaturbeschreibung", "en"=>"Signature description"), 
            FLDDEVDOC => array("de" => "Beschreibung der Signatur.", "en" => "DEscription of the signature.")));


/**
 * Field SignatureTable.Function = Function of the Member
 */
define("FLDSIGNATUREFUNCTION", 
        array(FLDVALUE => "", 
            FLDNAME => "FUNCTION", 
            FLDTYPE => "VARCHAR", 
            FLDLENGTH => "(50)", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Funktion", "en"=>"Function"), 
            FLDDEVDOC => array("de" => "Funktion / Amt des Inhabers.", "en" => "Function / position of the member.")));

/**
 * Field SignatureTable.SignatureImage = Image
 */
define("FLDSIGNATUREIMAGE", 
        array(FLDVALUE => "", 
            FLDNAME => "SIGNATUREIMAGE", 
            FLDTYPE => "LONGBLOB", 
            FLDLENGTH => "", 
            FLDISMANDATORY => false, 
            FLDLABEL => array("de"=>"Bild der Unterschrift", "en"=>"Image of the signature"), 
            FLDDEVDOC => array("de" => "", "en" => "")));



?>