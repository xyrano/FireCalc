<?php
/**
 * Description of SysContants
 *
 * @author tanzberg
 */
final class SysConstants 
{
    /**
     * IP Address Index of the User
     */
    const sysIp = "IP";                                 // User Ip  
    
    /**
     * Define Field Nickname for the User
     */
    const sysUsername = "NICKNAME";                     // nickname
    
    /**
     * Define Field LoggedIn
     */
    const sysLoggedIn = "LOGGEDIN";                     // true or false
    
    /**
     * Define Field LoggedInTime
     */
    const sysLoggedInTime = "LOGGEDINTIME";             // Time where the user is logged in
    
    /**
     * Define default Idle Time - can be overwrite into AdminSetup Form
     */
    const sysLoggedInIdleTimeSec = "60";                // Idle time in sec
    
    /**
     * Define Field SessionId
     */
    const sysSessionId = "SESSIONID";                   // Session ID
    
    /**
     * Define Field IsAdmin to indicate how the user is Admin or not
     */    
    const sysSessionIsAdminSession = "ISADMIN";         // Is the Session a Admin Session?
    
    /**
     * Define Field GroupId
     */
    const sysSessionGroupId = "GROUPID";                // Benutzer gruppenID
    
    /**
     * Define Field DistrictMap to Hold the Districts (Landkreis) per Map in one Field
     */
    const sysSessionDistrictMap = "DISTRICTMAP";        // Benutzer mit GruppenId hat die Zuordnung zu diesen Landkreisen  (Landkreis Benutzer)
    
    /**
     * Define Field FireDepartmentId to hold the FireDeptId in one Field
     */
    const sysSessionFireDeptId = "FIREDEPTID";          // Benutzer mit zuordnung zu einer Feuerwehr die er betreuen darf  (Benutzer)
    
    
    /**
     * Define name for an admin for first time of System use
     */
    const sysAdminName = "admin";                       // Initial username if no one exists
    
    /**
     * Define password for the 'adminNam' for first timte of System use
     */
    const sysAdminPwd = "password";                     // Initial password if no one exists
    
    /**
     * Host of the Database
     */
    const sysDatabaseHost = "localhost";
    
    /**
     * Database Name
     */
    const sysDatabaseName = "";
    
    //const sysDatabaseName = "xxxDemo";
    
    /**
     * Database Username
     */
    const sysDatabaseUser = "";
    
    /**
     * Database password
     */
    const sysDatabasePwd = "";
    
    /**
     * Define Field 'ModifiedDateTime' stores to every modification the DateTime -<br>
     * Don´t change this name after Installation because of data inconsistancy
     */
    const sysSqlModifiedDateTime = "MODIFIEDDATETIME"; // DATETIME
    
    /**
     * Define Field 'CreateDateTime' stores the record created Date Time
     */
    const sysSqlCreatedDateTime = "CREATEDDATETIME"; // DATETIME
    
    /**
     * Define Field Created By to store the Username for every record
     */
    const sysSqlCreatedyBy = "CREATEDBY"; // VARCHAR(10)
    
    /**
     * Define Field ModifiedBy to store the username of every record change
     */
    const sysSqlModifiedBy = "MODIFIEDBY"; // VARCHAR(10)
    
    /**
     * Define which is the System Field Index
     */    
    const sysDbFldIndex = "RECID";      // FieldIndex for Tables
    
    /**
     * Define which is the System TableId name
     */
    const sysDbTableId = "TABLEID";
    
    /**
     * Define which is the System Field Primary Key
     */
    const sysFldPrimaryKey = "RECID";   // PrimaryKey for Tables
    
    /**
     * This Property is the 1. of 3. for FieldNames in a TableClass
     */
    const sysFldName = "FIELDNAME";
    
    /**
     * This Property is the 2. of 3. for FieldNames in a TableClass
     */
    const sysFldValue = "VALUE";
    
    /**
     * This Property is the 3. of 3. for FieldNames in a TableClass
     */
    const sysFldType = "DBTYPE";
    
    /**
     * Constant var of the Date Time "NULL"
     */
    const sysDateNull = "01.01.1900 00:00:00.000";    
}
