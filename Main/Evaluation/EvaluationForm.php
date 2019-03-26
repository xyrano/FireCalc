<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Auswertung", true, "evaluation.js");
?>


<?php
$Contest = new ContestBaseTable(@$_GET['idx']);
//$SuffixMap = MemberGroupTable::getSuffixGroups($Contest->recId);
//$mapIterator = new MapIterator($SuffixMap);
$enabled = ($Contest->fldContestIsCalculated[FLDVALUE]) ? "enabled" : "";
if($enabled != "enabled")
{
    // if no record is available the button posting should be disabled
    //$enabled = $SuffixMap->getLength() > 0 ? "" : "enabled";
}
?>
<br>

<div class="Overview" style="overflow-x: auto;">
    <fieldset>
        <legend>Auswertung Übersicht</legend>
        <table border="1">
            <thead>                
                <tr>
                    <th>Feuerwehr</th>
                    <th>Gruppe</th>
                    <th>Übung</th>
                    <th>Starttpunkte</th>   
                    <th>Fehlerpunkte</th>
                    <th>Übungszeit</th>
                    <th>Zeitfehler</th>
                    <th>Zeittakt</th>
                    <th>Zeitfehler</th>
                    <th>Eindruck</th>
                    <th>Disqualifiziert</th>
                    <th>Fehlerpunkte</th>
                    <th>Gesamt Fehlerpunkte</th>
                </tr>
            </thead>
            <tbody>
                <?php                          
                $GROUPS = new MemberGroupTable(null, @$_GET['idx']);      
                $GROUPS->getRecords();
                // Iterate thorugh Groups                
                while($GROUPS->next()) 
                {
                    $ErrHelp = new ErrorHelper($GROUPS->fldRecId[FLDVALUE]); 
                    
                    ?>
                    <tr>
                        <td rowspan="2"><?=$ErrHelp->memberGroupTable()->fireDeptTable()->fldFireDept[FLDVALUE];?></td> <!-- Feuerwehr -->                    
                        <td rowspan="2"><?=$ErrHelp->memberGroupTable()->fldGroupName[FLDVALUE];?><br>&Oslash;-Alter: <?=$ErrHelp->memberGroupTable()->getAverageAge(0);?></td>            <!-- Gruppe inkls. Suffix und Durchschnittsalter-->
                        <td>A-Teil</td>                                         <!-- Übung -->
                        <td><?=$ErrHelp->defaultErrorPointsA();?></td>          <!-- Starfehlerpunkte -->
                        <td>-<?=$ErrHelp->cumulatedErrorPointsAPart();?></td>   <!-- Fehler A-Teil -->
                        <td><?=$ErrHelp->competitionTimeAPart();?></td>         <!-- Übungszeit -->
                        <td>-<?=$ErrHelp->competitionTimeErrorAPart();?></td>   <!-- Übungszeitfehler -->
                        <td><?=$ErrHelp->timing();?></td>                       <!-- Zeittakt -->
                        <td>-<?=$ErrHelp->timingError();?></td>                 <!-- Zeittaktfehler -->
                        <td>-<?=$ErrHelp->impressionAPart();?></td>             <!-- Eindruck -->
                        <td><?=$ErrHelp->disqualifiedAPart();?></td>            <!-- Disqualifiziert -->
                        <td><?=$ErrHelp->summaryAPart();?></td>
                        <td rowspan="2"><?=$ErrHelp->summary();?></td>
                    </tr>
                    <tr>
                        <td>B-Teil</td>
                        <td><?=$ErrHelp->defaultErrorPointsB();?></td>
                        <td>-<?=$ErrHelp->cumulatedErrorPointsBPart();?></td>
                        <td><?=$ErrHelp->competitionTimeBPart();?></td>
                        <td>
                            <?php
                            if($ErrHelp->competitionTimeBPart() > ErrorHelper::getToTime4Group($ErrHelp->memberGroupTable()->getAverageAge(0))) 
                            {
                                echo "-" . $ErrHelp->competitionTimeErrorBPart();
                            }
                            else
                            {
                                echo "+" . $ErrHelp->competitionTimeErrorBPart();
                            }
                            ?>
                        </td>
                        <td>n.A.</td>
                        <td>n.A.</td>                    
                        <td>-<?=$ErrHelp->impressionBPart();?></td>
                        <td><?=$ErrHelp->disqualifiedBPart();?></td>            <!-- Disqualifiziert -->
                        <td><?=$ErrHelp->summaryBPart();?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>               
        </table><br>
    </fieldset>
</div>
<div class="ButtonGroup">
    <fieldset>
        <input type="button" class="button" id="EvaluationEnd" value="Buchen" <?=($enabled == "enabled") ? "disabled" : ""?>><br> 
        <input type="button" class="button" id="RepWinnerListShort" value="Siegerliste"><br>
        <input type="button" class="button" id="RepWinnersCertificate" value="Urkunden"><br>
        <input type="button" class="button" id="RepErrorReport" value="Fehlerbogen"><br>
    </fieldset>        
</div>

<?php
echo FormRun::createPageFooter(true);
?>
