<?php

/**
 * Description of LoginLogout
 *
 * @author tanzberg
 */
class LoginLogout extends Obj
{
    private $sessionId;
   
    public function __constrcut() {
        //$this->sessionId = session_id();
        
    }
   
    /**
     * Login of an specific user
     * @param str $username username
     * @param str $passplaintxt password in Plaintext
     * @return boolean true if the user is logged in otherwise false
     */
    public function login($username, $passplaintxt) {
        
        $user = UserTable::find($username);         
        if($user)
        {          
            if(password_verify(base64_decode($passplaintxt), $user->fldPassword[FLDVALUE]))
            {                
                $_SESSION[SysConstants::sysLoggedIn]        = true;
                $_SESSION[SysConstants::sysIp]              = sysGetIpAddress(); //$_SERVER['REMOTE_ADDR'];
                $_SESSION[SysConstants::sysLoggedInTime]    = DateTimeUtil::currentDateTime();
                $_SESSION[SysConstants::sysSessionId]       = session_id();
                $_SESSION[SysConstants::sysUsername]        = $user->fldUsername[FLDVALUE];
                if($username == SysConstants::sysAdminName) {
                    $_SESSION[SysConstants::sysSessionIsAdminSession] = 1;
                } else {
                    $_SESSION[SysConstants::sysSessionIsAdminSession] = 0;
                }
                $_SESSION[SysConstants::sysSessionGroupId]      = $user->fldGroupId[FLDVALUE]; // GroupID
                $_SESSION[SysConstants::sysSessionDistrictMap]  = GroupTable::find($user->fldGroupId[FLDVALUE])->districtMap(); // LandkreisMap für die Zuordnungen
                $_SESSION[SysConstants::sysSessionFireDeptId]   = $user->fldFireDeptId[FLDVALUE];
                $this->sessionId                                = session_id();
                // User Online update
                $userOnline = new UserOnline();
                $userOnline->ttsbegin();
                $userOnline->fldUserName[FLDVALUE]  = $username;
                $userOnline->fldUserRecId[FLDVALUE] = $user->fldRecId[FLDVALUE];
                $userOnline->fldSessionId[FLDVALUE] = session_id();
                $userOnline->insert();
                $userOnline->ttscommit();
                return true;
            }
        }
       
        return false;             
    }
    
    
    public function logout() {
        try
        {
            // Nur aus DB Löschen wenn Eintrag exisitiert, dennoch auf jeden Fall ausloggen           
            if(!$this->isValueEmpty(UserOnline::find()->fldSessionId[FLDVALUE]))
            {
                $U = UserOnline::find();//->doDelete();
                $U->ttsbegin();
                $U->doDelete();
                $U->ttscommit();
            }

            session_unset();
            session_destroy();
            return true;
        }
        catch(Exception $ex)
        {
            Obj::getException($ex);
        }
    }
   
    /**
     * Gets an hash with an salt and a cost from a plaintext password
     * @param string $plainPassword
     * @return string Hash from Password
     */
   public static function getPasswordHash($plainPassword) {
        $options = [
                'cost' => 13,
                //'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
               ];
        $hash = password_hash($plainPassword, PASSWORD_BCRYPT, $options); // The hash goes to DB  
        return $hash;
    }
    
    
}
