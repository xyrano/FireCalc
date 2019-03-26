<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Group management", true, "group.js");
?>


<br>
<div class="Overview">
<?php
$show = true;
switch(@$_GET['do'])
{
    case 'new':
        require_once("./AddGroupNewForm.php");
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
            require_once("./AddGroupFormList.php");
        }
        break;
}
?>
</div>
<div class="ButtonGroup">
    <fieldset>
        <input type="button" class="button" id="KjfGroupSignatures" value="Unterschrift"><br>       
    </fieldset>        
</div>

<?php
echo FormRun::createPageFooter(true);
?>
