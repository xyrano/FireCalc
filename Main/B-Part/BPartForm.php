<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("B-Part", false, "bpart.js");
?>


<style type="text/css">
    /* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal {
    display: block;
}

div.impress
{
    border: 1px solid #000000;
    width: 60px;
    text-align: center;
    cursor: pointer;   
    margin-bottom: 1px;
}
div.impress:hover {
    background-color: white;
}
</style>


<?php
$idx = $_GET['idx']; // ContestId
?>
<span id="contestId" style="display: none;"><?=$idx;?></span>
<br>
<fieldset><legend>Gruppe</legend>
    <form action="<?= sysGetPhpSelf();?>" method="post">
    <select name="group">
        <?php
        $T = new MemberGroupTable(null, $idx);
        $T->getRecords();
        while($T->next()) {
            $selected = (@$_POST['group'] == $T->fldRecId[FLDVALUE]) ? "selected" : "";
            ?>
            <option value="<?=$T->fldRecId[FLDVALUE];?>" <?=$selected;?>><?=$T->fireDeptTable()->fldFireDept[FLDVALUE];?> - <?=$T->fldGroupName[FLDVALUE];?></option>
            <?php
        }
        ?>
        ?>
    </select>
    <input type="submit" name="getGroup" value="Zeigen">
    </form>
</fieldset>

<?php
if(@$_POST['getGroup'] && @$_POST['group'])
{
    $groupRecId = @$_POST['group'];

?>
<script type="text/javascript">
    $(document).ready(function() {                      
        <?php
        $l1Points = 0;
        $l2Points = 0;
        $l3Points = 0;
        $l4Points = 0;
        $l5Points = 0;
        $l6Points = 0;
        $l7Points = 0;
        $l8Points = 0;
        $l9Points = 0;
        
        $ErrorValues = new ErrorValues(null, $groupRecId, "B-Teil");
        while($ErrorValues->next()) 
        {            
            switch($ErrorValues->fldWho[FLDVALUE])
            {
                case 'L1': $l1Points = $l1Points + $ErrorValues->fldErrorValue[FLDVALUE]; break;
                case 'L2': $l2Points = $l2Points + $ErrorValues->fldErrorValue[FLDVALUE]; break;                    
                case 'L3': $l3Points = $l3Points + $ErrorValues->fldErrorValue[FLDVALUE]; break;                
                case 'L4': $l4Points = $l4Points + $ErrorValues->fldErrorValue[FLDVALUE]; break;  
                case 'L5': $l5Points = $l5Points + $ErrorValues->fldErrorValue[FLDVALUE]; break;   
                case 'L6': $l6Points = $l6Points + $ErrorValues->fldErrorValue[FLDVALUE]; break; 
                case 'L7': $l7Points = $l7Points + $ErrorValues->fldErrorValue[FLDVALUE]; break; 
                case 'L8': $l8Points = $l8Points + $ErrorValues->fldErrorValue[FLDVALUE]; break;   
                case 'L9': $l9Points = $l9Points + $ErrorValues->fldErrorValue[FLDVALUE]; break;                  
            }
            $htmlId = $ErrorValues->fldGroupRecId[FLDVALUE]."-".$ErrorValues->fldErrorNum[FLDVALUE]."-".$ErrorValues->fldErrorSubNum[FLDVALUE]."-".$ErrorValues->fldWho[FLDVALUE];
            $htmlErrorNumCount = $ErrorValues->fldErrorNumCount[FLDVALUE];

                  
            echo "  $('#{$htmlId}').addClass('highlightErrorVal');\r\n";
            //echo "  $('td#inCase-{$htmlId}').html('{$htmlErrorNumCount}'); \r\n";             // Je Fall unterscheidung gibt es im B-Teil nicht
        }
        echo "  $('td#errorPointsL1').html('{$l1Points}'); \r\n";
        echo "  $('td#errorPointsL2').html('{$l2Points}'); \r\n";
        echo "  $('td#errorPointsL3').html('{$l3Points}'); \r\n";
        echo "  $('td#errorPointsL4').html('{$l4Points}'); \r\n";
        echo "  $('td#errorPointsL5').html('{$l5Points}'); \r\n";
        echo "  $('td#errorPointsL6').html('{$l6Points}'); \r\n";
        echo "  $('td#errorPointsL7').html('{$l7Points}'); \r\n";
        echo "  $('td#errorPointsL8').html('{$l8Points}'); \r\n";
        echo "  $('td#errorPointsL9').html('{$l9Points}'); \r\n";   
        
        
        function checkTime($time) {
            return Obj::isTimeValueEmpty(new DateTimeUtil($time));
        }
        // Times goes here:      
        // Error Additions
        $EA = new ErrorAdditions(NULL, $groupRecId, "B-Teil");        
        while($EA->next()) 
        {            
            $htmlId = $EA->fldGroupRecId[FLDVALUE]."-".$EA->fldIndicator[FLDVALUE];            
            if(!checkTime($EA->fldContestTimeGF[FLDVALUE])) {
                echo "$('input#{$htmlId}-L1-L1').val('{$EA->fldContestTimeGF[FLDVALUE]}'); \r\n"; 
            }
                
            if(!checkTime($EA->fldContestTimeMA[FLDVALUE])) {
                echo "$('input#{$htmlId}-L2-L2').val('{$EA->fldContestTimeMA[FLDVALUE]}'); \r\n";                 
            }                        
        }
        
        
        
         // Error Impressions
        $EI = new ErrorImpressions(null, $groupRecId, "B-Teil"); 
        while($EI->next()) 
        {
            switch($EI->fldL1[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L1-1"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L1-3"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L1-5"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
            } 
            
            switch($EI->fldL2[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L2-1"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L2-3"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L2-5"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
            }
            
            switch($EI->fldL3[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L3-1"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L3-3"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L3-5"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
            }
            
            switch($EI->fldL4[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L4-1"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L4-3"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L4-5"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
            }
            
            switch($EI->fldL5[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L5-1"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L5-3"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L5-5"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
            }
            
            switch($EI->fldL6[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L6-1"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L6-3"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L6-5"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
            }
            
            switch($EI->fldL7[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L7-1"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L7-3"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L7-5"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
            }         
            
            switch($EI->fldL8[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L8-1"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L8-3"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L8-5"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
            }
            
            switch($EI->fldL9[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L9-1"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L9-3"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-L9-5"; echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; break;
            }
            
        }
        ?>                
    });
</script>

<br>
<fieldset>
    <?php
    $disabledElem = (ErrorTotals::groupExists($groupRecId)) ? "disabledElem" : "";
    
    $checked = ErrorAdditions::find("B-Teil", $groupRecId, "BP")->fldDisqualified[FLDVALUE] ? "checked" : "";
    $disabled = ($disabledElem == "disabledElem") ? "disabled" : "";
    if($checked == "checked")
    {
        $disabled = "disabled";
        echo "Die Gruppe wurde Disqualifiziert und kann daher nicht mehr bearbeitet werden!<br>";
    }
    ?>
    Gruppe Disqualifizieren: <input type="checkbox" class="disqualified" id="disqualified-BP-<?=$groupRecId;?>-<?=$idx;?>" value="" <?=$checked;?> <?=$disabled;?>>
    
</fieldset>

<?php
if($disabled != "disabled")
{    
    ?>
    <br>
    Info: Einfacher Mausklick erhöht die Fehleranzahl um eins, ein Rechtsklick verringert die Fehleranzahl um eins.
    <br>
    <div class="Overview">

        <div id="tabs">
            <ul>
                <li><a href="#tab1">L1</a></li>
                <li><a href="#tab2">L2</a></li>
                <li><a href="#tab3">L3</a></li>
                <li><a href="#tab4">L4</a></li>
                <li><a href="#tab5">L5</a></li>
                <li><a href="#tab6">L6</a></li>
                <li><a href="#tab7">L7</a></li>
                <li><a href="#tab8">L8</a></li>
                <li><a href="#tab9">L9</a></li>
            </ul>
            <div id="tab1">
                <?php           
                    require_once("./ErrorCat01.php");           
                ?>
            </div>
            <div id="tab2">
                <?php            
                    require_once("./ErrorCat02.php");            
                ?>
            </div>
            <div id="tab3">
                <?php          
                    require_once("./ErrorCat03.php");            
                ?>
            </div>
            <div id="tab4">
                <?php           
                    require_once("./ErrorCat04.php");           
                ?>
            </div>
            <div id="tab5">
               <?php    
                    require_once("./ErrorCat05.php");            
                ?>
            </div>
            <div id="tab6">
               <?php    
                    require_once("./ErrorCat06.php");            
                ?>
            </div>
            <div id="tab7">
               <?php    
                    require_once("./ErrorCat07.php");            
                ?>
            </div>
            <div id="tab8">
               <?php    
                    require_once("./ErrorCat08.php");            
                ?>
            </div>
            <div id="tab9">
               <?php    
                    require_once("./ErrorCat09.php");            
                ?>
            </div>
        </div>  
  
    <?php
    } // brace from disabled (disqualified) group
    else
    {
        echo "Die Gruppe wurde bereits ausgewertet, ein Nachträgliches bearbeiten ist nicht möglich!";
    }
} // brace from choosen group
?>


<?php
echo FormRun::createPageFooter(true);
?>
