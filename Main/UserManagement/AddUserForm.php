<?php
header('Content-Type: text/html; charset=utf-8');
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("User management", true, "user.js");
?>


<br>

<?php
$show = true;
switch(@$_GET['do'])
{
    case 'new':
        require_once("./AddUserNewForm.php");
        break;
    
    case 'save':
        $show = false; // do it by JQuery
        break;
    
    case 'edit':
        require_once("./AddUserEditForm.php");
        break;
    
    case 'delete':
        require_once("./AddUserDeleteForm.php");
        break;
    
    default:
        if($show) {
            require_once("./AddUserFormList.php");
        }
        break;
}
?>


<?php
echo FormRun::createPageFooter(true);
?>
