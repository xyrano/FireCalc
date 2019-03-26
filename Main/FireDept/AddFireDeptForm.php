<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Firedepartment management", true, "firedept.js");
?>


<br>

<?php
$show = true;
switch(@$_GET['do'])
{
    case 'new':
        require_once("./AddFireDeptNewForm.php");
        break;
    
    case 'save':
        $show = false; // do it by JQuery
        break;
    
    case 'edit':
        require_once("./AddFireDeptEditForm.php");
        break;
    
    case 'delete':
        require_once("./AddFireDeptDeleteForm.php");
        break;
    
    default:
        if($show) {
            require_once("./AddFireDeptFormList.php");
        }
        break;
}
?>


<?php
echo FormRun::createPageFooter(true);
?>
