<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Firedeprtment to Contest", true, "firedept2contest.js");
?>


<br>

<?php
$show = true;
switch(@$_GET['do'])
{
    case 'new':
        require_once("./AddFireDept2ContestNewForm.php");
        break;
    
    case 'save':
        $show = false; // do it by JQuery
        break;
    
    case 'edit':
        require_once("./AddFireDept2ContestEditForm.php");
        break;
    
    case 'delete':
        require_once("./AddFireDept2ContestDeleteForm.php");
        break;
    
    default:
        if($show) {
            require_once("./AddFireDept2ContestFormList.php");
        }
        break;
}
?>


<?php
echo FormRun::createPageFooter(true);
?>
