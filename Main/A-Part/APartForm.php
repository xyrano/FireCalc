<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("A-Part", false, "apart.js");
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
        /*
        $MGTS = new MemberGroupTable(null, $idx);
        $MGTSMI = new MapIterator($MGTS->recIdMap);
        while($MGTSMI->next()) {
            $MGT = new MemberGroupTable($MGTSMI->currentValue());
            $selected = (@$_POST['group'] == $MGT->recId) ? "selected" : "";
            ?>
        <option value="<?=$MGT->recId;?>" <?=$selected;?>><?= FireDeptTable::find($MGT->fireDeptId())->fireDept()." - ".$MGT->groupName()." ". $MGT->groupSuffix();?></option>        
            <?php
        }
         * 
         */
        $T = new MemberGroupTable(null, $idx);
        $T->getRecords();
        while($T->next()) {
            $selected = (@$_POST['group'] == $T->fldRecId[FLDVALUE]) ? "selected" : "";
            ?>
            <option value="<?=$T->fldRecId[FLDVALUE];?>" <?=$selected;?>><?=$T->fireDeptTable()->fldFireDept[FLDVALUE];?> - <?=$T->fldGroupName[FLDVALUE];?></option>
            <?php
        }
        ?>
    </select>
    <input type="submit" name="getGroup" value="Zeigen">
    </form>
</fieldset>

<?php
if(@$_POST['getGroup'] && @$_POST['group'])
{
    $groupRecId = @$_POST['group'];

    $idx = $_GET['idx']; // Contest RecId
    if(ContestBaseTable::find($idx)->fldIsOpenWater[FLDVALUE])
    {
        $openWater = "ow";
    }
    else
    {
        $openWater = "ufh";
    }
?>
<script type="text/javascript">
    $(document).ready(function() {                      
        <?php
        $gfPoints   = 0;
        $mePoints   = 0;
        $maPoints   = 0;
        $atfPoints  = 0;
        $atPoints   = 0;
        $atmPoints  = 0;
        $wtfPoints  = 0;
        $wtPoints   = 0;
        $wtmPoints  = 0;
        $stfPoints  = 0;
        $stPoints   = 0;
        $stmPoints  = 0;
        
        $ErrorValues = new ErrorValues(null, $groupRecId, "A-Teil");
        while($ErrorValues->next()) 
        {            
            switch($ErrorValues->fldWho[FLDVALUE])
            {
                case 'gf':  $gfPoints = $gfPoints + $ErrorValues->fldErrorValue[FLDVALUE];    break;
                case 'me':  $mePoints = $mePoints + $ErrorValues->fldErrorValue[FLDVALUE];    break;                  
                case 'ma':  $maPoints = $maPoints + $ErrorValues->fldErrorValue[FLDVALUE];    break;                
                case 'atf': $atfPoints = $atfPoints + $ErrorValues->fldErrorValue[FLDVALUE];  break;  
                case 'at':  $atPoints = $atPoints + $ErrorValues->fldErrorValue[FLDVALUE];    break;   
                case 'atm': $atmPoints = $atmPoints + $ErrorValues->fldErrorValue[FLDVALUE];  break; 
                case 'wtf': $wtfPoints = $wtfPoints + $ErrorValues->fldErrorValue[FLDVALUE];  break; 
                case 'wt':  $wtPoints = $wtPoints + $ErrorValues->fldErrorValue[FLDVALUE];    break;   
                case 'wtm': $wtmPoints = $wtmPoints + $ErrorValues->fldErrorValue[FLDVALUE];  break; 
                case 'stf': $stfPoints = $stfPoints + $ErrorValues->fldErrorValue[FLDVALUE];  break;   
                case 'st':  $stPoints = $stPoints + $ErrorValues->fldErrorValue[FLDVALUE];    break;   
                case 'stm': $stmPoints = $stmPoints + $ErrorValues->fldErrorValue[FLDVALUE];  break;   
            }
            $htmlId = $ErrorValues->fldGroupRecId[FLDVALUE]."-".$ErrorValues->fldErrorNum[FLDVALUE]."-".$ErrorValues->fldErrorSubNum[FLDVALUE]."-".$ErrorValues->fldIndicator[FLDVALUE]."-".$ErrorValues->fldWho[FLDVALUE];
            $htmlErrorNumCount = $ErrorValues->fldErrorNumCount[FLDVALUE];
                  
            echo "  $('#{$htmlId}').addClass('highlightErrorVal');\r\n";
            echo "  $('td#inCase-{$htmlId}').html('{$htmlErrorNumCount}'); \r\n";            
        }
        
        echo "  $('td#errorPointsGF').html('{$gfPoints}'); \r\n";
        echo "  $('td#errorPointsME').html('{$mePoints}'); \r\n";
        echo "  $('td#errorPointsMA').html('{$maPoints}'); \r\n";
        echo "  $('td#errorPointsATF').html('{$atfPoints}'); \r\n";
        echo "  $('td#errorPointsAT').html('{$atPoints}'); \r\n";
        echo "  $('td#errorPointsATM').html('{$atmPoints}'); \r\n";
        echo "  $('td#errorPointsWTF').html('{$wtfPoints}'); \r\n";
        echo "  $('td#errorPointsWT').html('{$wtPoints}'); \r\n";
        echo "  $('td#errorPointsWTM').html('{$wtmPoints}'); \r\n";
        echo "  $('td#errorPointsSTF').html('{$stfPoints}'); \r\n";
        echo "  $('td#errorPointsST').html('{$stPoints}'); \r\n";
        echo "  $('td#errorPointsSTM').html('{$stmPoints}'); \r\n";
         
        /**
         * Checks if a time value is empty
         * @param time $time
         * @return boolean true if it's empty
         */
        function checkTime($time) {
            return Obj::isTimeValueEmpty(new DateTimeUtil($time));
        }
        // Times goes here:      
        // Error Additions
        $EA = new ErrorAdditions(NULL, $groupRecId, "A-Teil");        
        while($EA->next()) 
        {            
            $htmlId = $EA->fldGroupRecId[FLDVALUE]."-".$EA->fldIndicator[FLDVALUE];            
            if(!checkTime($EA->fldContestTimeGF[FLDVALUE])) {
                echo "$('input#{$htmlId}-gf').val('{$EA->fldContestTimeGF[FLDVALUE]}'); \r\n"; 
            }
                
            if(!checkTime($EA->fldContestTimeMA[FLDVALUE])) {
                echo "$('input#{$htmlId}-ma').val('{$EA->fldContestTimeMA[FLDVALUE]}'); \r\n";                 
            }
            
            if(!checkTime($EA->fldTimeKnotsAT[FLDVALUE])) {
                echo "$('input#{$htmlId}-at').val('{$EA->fldTimeKnotsAT[FLDVALUE]}'); \r\n";                 
            }
            
            if(!checkTime($EA->fldTimeKnotsWT[FLDVALUE])) {
                echo "$('input#{$htmlId}-wt').val('{$EA->fldTimeKnotsWT[FLDVALUE]}'); \r\n";                          
            }
        }
        
        // Error Impressions
        $EI = new ErrorImpressions(null, $groupRecId, "A-Teil"); 
        while($EI->next()) 
        {
            switch($EI->fldGFME[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-gfme-1"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-gfme-3"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-gfme-5"; break;
            }
            echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; 
            
            switch($EI->fldMA[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-ma-1"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-ma-3"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-ma-5"; break;
            }
            echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; 
            
            switch($EI->fldAT[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-at-1"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-at-3"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-at-5"; break;
            }
            echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; 
            
            switch($EI->fldWT[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-wt-1"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-wt-3"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-wt-5"; break;
            }
            echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; 
            
            switch($EI->fldST[FLDVALUE])
            {
                case 1: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-st-1"; break;
                case 3: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-st-3"; break;
                case 5: $htmlId = $EI->fldGroupRecId[FLDVALUE]."-".$EI->fldIndicator[FLDVALUE]."-st-5"; break;
            }
            echo "$('div#{$htmlId}').addClass('highlightErrorVal'); \r\n"; 
        }
        ?>
                
    });
</script>


<br>
<br>
<fieldset>
    <?php
    
    // Wenn uswertung gelaufen ist, dann deaktiviere alle Elemente
    $disabledElem = (ErrorTotals::groupExists($groupRecId)) ? "disabledElem" : "";
    
    $checked = ErrorAdditions::find("A-Teil", $groupRecId, $openWater)->fldDisqualified[FLDVALUE] ? "checked" : "";
    
    $disabled = ($disabledElem == "disabledElem") ? "disabled" : "";
    if($checked == "checked")
    {
        $disabled = "disabled";
        echo "Die Gruppe wurde Disqualifiziert und kann daher nicht mehr bearbeitet werden!<br>";
    }
    
    ?>
    Gruppe Disqualifizieren: <input type="checkbox" class="disqualified" id="disqualified-<?=$openWater;?>-<?=$groupRecId;?>-<?=$idx;?>" value="" <?=$checked;?> <?=$disabled;?>>
    
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
                <li><a href="#tab1">GF/ME</a></li>
                <li><a href="#tab2">MA</a></li>
                <li><a href="#tab3">ATR</a></li>
                <li><a href="#tab4">WTR</a></li>
                <li><a href="#tab5">STR</a></li>
            </ul>
            <div id="tab1">
                <?php
                if($openWater == "ufh") {
                    require_once("./ErrorCat01Ufh.php");
                } else {
                    require_once("./ErrorCat01Ow.php");
                }
                ?>
            </div>
            <div id="tab2">
                <?php
                if($openWater == "ufh") {
                    require_once("./ErrorCat02Ufh.php");
                } else {
                    require_once("./ErrorCat02Ow.php");
                }
                ?>
            </div>
            <div id="tab3">
                <?php
                if($openWater == "ufh") {
                    require_once("./ErrorCat03Ufh.php");
                } else {
                    require_once("./ErrorCat03Ow.php");
                }
                ?>
            </div>
            <div id="tab4">
                <?php
                if($openWater == "ufh") {
                    require_once("./ErrorCat04Ufh.php");
                } else {
                    require_once("./ErrorCat04Ow.php");
                }
                ?>
            </div>
            <div id="tab5">
               <?php
                if($openWater == "ufh") {
                    require_once("./ErrorCat05Ufh.php");
                } else {
                    require_once("./ErrorCat05Ow.php");
                }
                ?>
            </div>
        </div>  

    <?php
    } // brace from disabled (disqualified) group
    else
    {
        echo "Die Gruppe wurde bereits ausgewertet oder Disqualifiziert, ein Nachträgliches bearbeiten ist nicht möglich!";
    }
} // brace from choosen group
?>

<?php
echo FormRun::createPageFooter(true);
?>
