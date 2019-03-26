<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Anmeldebogen", true, "registration.js");
?>

<br>

<?php
$show = true;
switch(@$_GET['do'])
{
    case 'new':
        require_once("./RegistrationFormNew.php");
        break;
    
    case 'save':
        $show = false; // do it by JQuery
        break;
    
    case 'edit':
        require_once("./RegistrationFormEdit.php");
        break;
    
    case 'delete':
        require_once("./RegistrationFormDelete.php");
        break;
    
    default:
        if($show) {
            require_once("./RegistrationFormList.php");
        }
        break;
}
?>

<?php
echo FormRun::createPageFooter(true);
?>

