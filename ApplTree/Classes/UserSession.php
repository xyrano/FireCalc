<?php
/**
 * Description of UserSession
 *
 * @author tanzberg
 */
class UserSession extends Obj
{
    /**
     * New Object<br>
     * Checks always in initiating if user should be logged out from system
     */
    public function __construct() {  
        try
        {
            if(!isset($_SESSION)) {
                session_start();
            }  

            $this->discoverOldSessions();
        
            if(!$this->isValueEmpty(@$_SESSION[SysConstants::sysLoggedInTime]))
            {
                $parameter = new AdminSetup(AdminSetup::getLastRecId()); // get Last RecId and not only static 1 because to prevent manual interaction on sql admin layer               

                $dateTime = new DateTimeUtil(DateTimeUtil::currentDateTime());        
                $time = $dateTime->add(-$parameter->fldIdleTime[FLDVALUE], $parameter->fldIdleTimeFormat[FLDVALUE]);
                // TODO: Mit Datum Referenzieren: wenn man evtl. früh morgens angemeldet ist und der 
                // IdleTime wert dann zurück über 00 Uhr geht, ist die Uhrzeit 
                // wieder höher als der eingeloggte Wert, dadurch wird man 
                // abgemeldet, dies funktioniert dann nicht mehr ...
                $loginTime = new DateTimeUtil($_SESSION[SysConstants::sysLoggedInTime]);
                //echo $time ." > ". $loginTime->parmTime();
                if($time > $loginTime->parmTime() || UserOnline::find()->fldSessionId[FLDVALUE] == "")
                {
                    $this->forceLogout();                
                }
            }

            if(isset($_SESSION) && (sysGetIpAddress() != @$_SESSION[SysConstants::sysIp]))
            {
                $this->forceLogout();
                echo "Sie wurden vom System abgemldet da ein IP Addresswechsel stattfand!<br>";
                echo "<meta http-equiv=\"refresh\" content=\"2; url=../\" />";
            }
        }
        catch(Exception $ex)
        {
            Obj::getException($ex);
        }
    }
    
    /**
     * Find old sessions (older then one Day) and delete it
     */
    private function discoverOldSessions() {       
        $UO = new UserOnline();
        $UO->initAll()->where($UO->fldCreatedDateTime[FLDNAME]." < DATE_SUB(NOW(), INTERVAL 3 HOUR)")->fetch();
        while($UO->next()) {
            $UO->ttsbegin();
            $UO->delete();
            $UO->ttscommit();
        }
    }
    
    private function forceLogout() {
        $logout = new LoginLogout();        
        if($logout->logout())
        {                                 
            echo "Sie wurden vom System abgemeldet!<br>";
            echo "<meta http-equiv=\"refresh\" content=\"5; url=../\" />";
            exit("Feierabend ;-)");
        }
       
    }
    
    /**
     * Update the SessionLoggedInTime with currentTime
     */
    public function updateTime() {
        // Nur aktualisieren wenn die Seite nicht per F5 Refreshed wurde
        if(!Obj::isPageRefreshed()) {
            $_SESSION[SysConstants::sysLoggedInTime] = DateTimeUtil::currentDateTime();
            
            // Update also Table
            //$UO =  new UserOnline(Obj::user()->fldRecId[FLDVALUE]);
            $UO = UserOnline::find();
            $UO->ttsbegin();
            $UO->fldModifiedDateTime[FLDVALUE] = DateTimeUtil::currentDateTime(DateTimeUtil::dateTimePattern);
            $UO->update();
            $UO->ttscommit();
        }
    }
    
    
    /**
     * Create a Session with Parameters and an session Identifier
     * @param string $sessionIdentifier Key for a session
     * @param Map $parameterMap parameter Map - A Map from a xTable generated values
     */
    public static function saveTempParameter($sessionIdentifier, Map $parameterMap) {
        if(!isset($_SESSION))
        {
            session_start();
        }
        
        $mapIterator = new MapIterator($parameterMap);
        while($mapIterator->next())
        {
            if(@$_SESSION[$sessionIdentifier][$mapIterator->currentValue()[sysFldName]] == "") // Nur leere Felder ausfüllen
            {
                $_SESSION[$sessionIdentifier][$mapIterator->currentValue()[sysFldName]] = $mapIterator->currentValue()[sysFldValue];
            }
        }  
        
    }
}
