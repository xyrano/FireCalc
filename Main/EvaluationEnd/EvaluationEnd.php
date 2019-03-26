<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Auswertung Ende", false, "evaluationEnd.js");
?>

<br>

<fieldset>
    <legend>Auswertung beenden</legend>
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
            $T = new MemberGroupTable(null, @$_GET['idx']);            
            $T->getRecords();
            // Iterate thorugh Groups                
            while($T->next()) 
            {
                //set_time_limit(30); // set time limit in every loop to 30 - hsould be enough
                $ErrHelp = new ErrorHelper($T->fldRecId[FLDVALUE], true); // Here it goes to DB and to the END

                ?>
                <tr>
                    <td rowspan="2"><?= FireDeptTable::findRecId($ErrHelp->memberGroupTable()->fldFireDeptId[FLDVALUE])->fldFireDept[FLDVALUE];?></td> <!-- Feuerwehr -->                    
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
                    <td>-<?=$ErrHelp->competitionTimeErrorBPart();?></td>
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
        <tfoot>
            <tr>
                <td colspan="13"><b>Auswertung wurde für diese Gruppen erfolgreich abgeschlossen!<br>Eine Nachträgliche Änderung dieser Gruppen ist nunmehr nicht möglich!<br>Sind weitere Gruppen in diesem Wettbewerb, können diese noch Ausgewertet werden.</b></td>
            </tr>
        </tfoot>
    </table>
</fieldset>

<?php
echo FormRun::createPageFooter(true);
?>