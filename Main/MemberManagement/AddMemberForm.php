<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Member management", true, "member.js");
?>



<br>
<div class="Overview" style="overflow-x: auto;">
<?php
$show = true;
switch(@$_GET['do'])
{
    case 'new':
        require_once("./AddMemberNewForm.php");
        break;
    
    case 'save':
        $show = false; // do it by JQuery
        break;
    
    case 'edit':
        require_once("./AddMemberEditForm.php");
        break;
    
    case 'delete':
        require_once("./AddMemberDeleteForm.php");
        break;
    
    default:
        if($show) {
            require_once("./AddMemberFormList.php");
        }
        break;
}
?>
</div>


<div class="ButtonGroup">
    <fieldset>
        <input type="button" class="button" id="MemberImport" value="Importieren"><br> 
        <input type="button" class="button" id="MemberExport" value="Exportieren"><br>    
    </fieldset>        
</div>

<?php
echo FormRun::createPageFooter(true);
?>
