<?php
require_once("Factory.php");
require_once("../Functions.php");
?>
<!DOCTYPE html>
<html lang="de">
<head>   
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <?php
    $isOnline = isOnline();
    if($isOnline)
    {
        ?>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <?php
    }
    else
    {        
        ?>
        <script src="../jquery-3.2.1.min.js"></script>
        <script src="../jquery-ui-1.11.4.js"></script>
        <?php
    }
    ?>
    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->    
</head>
<body>
    
    <?php
    
    if($isOnline == false) {
        echo "<fieldset><legend>info</legend><i>Note: you´re not connected with the www so some functions are not working!</i><br>"
                . "<i>You´re using jquery 3.2.1.min local copy version</i><br>"
                . "<i>and jquery UI 1.11.4 local copy version</i></fieldset>";
    }
    
    
    if(@$_POST['lgnSubmit'])
    {
        try
        {
            
            if(UserTable::numOfUser() != 0)
            {                
                $login = new LoginLogout();                 
                if($login->login($_POST['lgnName'], base64_encode($_POST['lgnPwd'])))
                {
                    echo "Angemeldet";
                    echo "<meta http-equiv=\"refresh\" content=\"1; url=Dashboard.php\" />";
                }  
                else
                {
                    echo "Anmeldung falsch ...";
                    echo "<meta http-equiv=\"refresh\" content=\"2; url=../\" />";
                }
            }
            else 
            {               
                echo "<br> - Admin Konto wird angelegt ...";
                $UT = new UserTable();
                $UT->ttsbegin();
                $UT->fldUsername[FLDVALUE] = SysConstants::sysAdminName;
                $UT->fldPassword[FLDVALUE] = LoginLogout::getPasswordHash(SysConstants::sysAdminPwd);
                $UT->fldGroupId[FLDVALUE] = 0;
                $UT->insert();      
                $UT->ttscommit();
                echo "<br> - Admin Konto wurde erstellt, bitte mit <u>". SysConstants::sysAdminName ."</u> und <u>". SysConstants::sysAdminPwd ."</u> anmelden ..."; 
                echo "<br> - Seite wird in 10 Sekunden neugeladen ... <meta http-equiv=\"refresh\" content=\"10; url=../\" />";
            }   
        }
        catch(Exception $e)
        {
            Obj::getException($e, true);
        }
    }
    else
    {        
        ?>
        Welcome in an dead end - please go <a href="../index.htm">back</a>.
        <script>
            window.close();
        </script>
        <?php
    }
    ?>
    
</body>
</html>