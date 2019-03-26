<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Adminsetup", true, "adminsetup.js");
?>


<br>

<?php
$show = true;
switch(@$_GET['do'])
{
//    case 'new':
//        require_once("./AddAdminSetupNewForm.php");
//        break;
    
    case 'save':
        $show = false; // do it by JQuery
        break;
    
    case 'edit':
        require_once("./AddAdminSetupEditForm.php");
        break;
    
//    case 'delete':
//        require_once("./AddAdminSetupDeleteForm.php");
//        break;
    
    default:
        if($show) {
            require_once("./AddAdminSetupEditForm.php");
        }
        break;
}
?>


<?php
echo FormRun::createPageFooter(true);
?>
