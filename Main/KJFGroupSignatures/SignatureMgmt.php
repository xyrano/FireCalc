<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Signature management", true, "signatureMgmt.js");
?>


<br>

<?php
$show = true;
switch(@$_GET['do'])
{
    case 'new':
        require_once("./SignatureMgmtNew.php");
        break;
    
    case 'save':
        $show = false; // do it by JQuery
        break;
    
    case 'edit':
        require_once("./AddGroupEditForm.php");
        break;
    
    case 'delete':
        require_once("./AddGroupDeleteForm.php");
        break;
    
    default:
        if($show) {
            require_once("./SignatureMgmtList.php");
        }
        break;
}
?>



<?php
echo FormRun::createPageFooter(true);
?>
