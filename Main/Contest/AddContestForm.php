<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Wettbewerbe", true, "contest.js");
?>


<br>
<div class="Overview" style="overflow-x: auto;">
<?php
$show = true;
switch(@$_GET['do'])
{
    case 'new':
        require_once("./AddContestNewForm.php");
        break;
    
    case 'save':
        $show = false; // do it by JQuery
        break;
    
    case 'edit':
        require_once("./AddContestEditForm.php");
        break;
    
    case 'delete':
        require_once("./AddContestDeleteForm.php");
        break;
    
    default:
        if($show) {
            require_once("./AddContestFormList.php");
        }
        break;
}

// Wenn ein Benutzer angemeldet ist der nur Feuerwehren sehen darf muss 
// A-TEIL, B-TEIL und Auswertung ausgeblendet werden
if(sysIsUserUser())
{
    //$restrictAccess = true;
    // Buttons ausgrauen
    $disabled = "disabled";
}   
?>
</div>

<div class="ButtonGroup">
    <fieldset>
        <input type="button" class="button" id="FireDept2Contest" value="Feuerwehren"><br>
        <input type="button" class="button" id="MemberGroups" value="Gruppen"><br>        
        <input type="button" class="button" id="APart" value="A-Teil" <?=@$disabled;?>><br>
        <input type="button" class="button" id="BPart" value="B-Teil" <?=@$disabled;?>><br>
        <input type="button" class="button" id="Evaluation" value="Auswertung ..." <?=@$disabled;?>>
    </fieldset>        
</div>


<?php
echo FormRun::createPageFooter(true);
?>
