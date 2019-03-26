<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Member Groups", true, "membergroups.js");
?>


<br>

<div class="Overview">
<?php
$show = true;
switch(@$_GET['do'])
{
    case 'new':
        require_once("./AddMemberGroupsNewForm.php");
        break;
    
    case 'save':
        $show = false; // do it by JQuery
        break;
    
    case 'edit':
        require_once("./AddMemberGroupsEditForm.php");
        break;
    
    case 'delete':
        require_once("./AddMemberGroupsDeleteForm.php");
        break;
    
    default:
        if($show) {
            require_once("./AddMemberGroupsFormList.php");
        }
        break;
}
?>
</div>

<div class="ButtonGroup">
    <fieldset>
        <input type="button" class="button" id="Member" value="Mitglieder"><br>        
    </fieldset>        
</div>


<?php
echo FormRun::createPageFooter(true);
?>
