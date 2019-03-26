<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Municipal management", true, "municipal.js");
?>


<br>

<?php
//$show = true;
//switch(@$_GET['do'])
//{
//    case 'new':
//        require_once("./AddMunicipalNewForm.php");
//        break;
//    
//    case 'save':
//        $show = false; // do it by JQuery
//        break;
//    
//    case 'edit':
//        require_once("./AddMunicipalEditForm.php");
//        break;
//    
//    case 'delete':
//        require_once("./AddMunicipalDeleteForm.php");
//        break;
//    
//    default:
//        if($show) {
//            require_once("./AddMunicipalFormList.php");
//        }
//        break;
//}
switch(@$_GET['do'])
{
    case 'new': require_once("./AddMunicipalNewForm.php");
}
require_once("./MunicipalFormList.php");
?>


<?php
echo FormRun::createPageFooter(true);
?>
