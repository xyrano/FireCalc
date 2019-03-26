<?php
$AS = new AdminSetup(AdminSetup::getLastRecId()); // always last recid to prevent user interaction on sql admin layer
?>
<fieldset>
    <legend>Admin Setup</legend>
    <span id="IdNewEditDelete" style="display: none">edit</span>
    <input type="number" id="recId" value="<?=$AS->fldRecId[FLDVALUE];?>" style="visibility: hidden">
    <table>
        <tr>
            <td>Momentan eingestellte Datenbank:</td>
            <td><?= SysConstants::sysDatabaseName;?></td>
        </tr>
        <tr>
            <td>Inaktivit&auml;tszeit:</td>
            <td><input type="number" id="idleTime" value="<?=$AS->fldIdleTime[FLDVALUE];?>" min="1"></td>
        </tr>
        <tr>
            <td>Inaktivit&auml;tszeit Format:</td>
            <td>
                <select id="idleTimeFormat">
                    <option value="S" <?=$AS->fldIdleTimeFormat[FLDVALUE] == "S" ? "selected" : "";?>>seconds</option>
                    <option value="M" <?=$AS->fldIdleTimeFormat[FLDVALUE] == "M" ? "selected" : "";?>>minutes</option>
                    <option value="H" <?=$AS->fldIdleTimeFormat[FLDVALUE] == "H" ? "selected" : "";?>>hours</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Soll ein Neuladen der Seite die Inaktivit&auml;tszeit aktualisieren? </td>
            <td><input type="checkbox" id="pageRefreshUpdatesIdleTime" value="" <?=($AS->fldPageRefreshUpdatesIdleTime[FLDVALUE]) ? "checked" : "";?>></td>
        </tr>   
        <tr>
            <td>Automatischen Löschen von raufgeladenen Mitgliederlisten?</td>
            <td>
                <select id="deleteUploadedMemberFiles">
                    <option value="1" selected>Yes</option>
                    <option value="0">No</option>
                </select><br>
                (Gespeichert im Ordner  <a href="../MemberManagement/uploads" target="_blank">MemberManagement/uploads</a>)
            </td>
        </tr>
        <tr>
            <td>Automatische Ausweisnummer generieren?</td>
            <td>
                <?php
                $selectedAutoMemberIdYes = AdminSetup::findRecId()->fldAutoMemderIdentificationID[FLDVALUE] == 1 ? "selected" : "";
                ?>
                <select id="autoMemberIdentId">
                    <option value="1" <?=$selectedAutoMemberIdYes?>>Yes</option>
                    <option value="0" <?=($selectedAutoMemberIdYes == "selected") ? "" : "selected";?>>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Wettbewerbe ausblenden wenn Wettbewerbsdatum kleiner als das heutige Datum?</td>
            <td><input type="checkbox" id="hideContestAfterToday" value="" <?=($AS->fldHideContestAfterToday[FLDVALUE]) ? "checked" : "";?>></td>
        </tr>
        <tr>
            <td>Lösche Mitglieder automatisch wenn Sie das Alter xx erreicht haben:<br> (-1 wenn keine automatisch gelöscht werden sollten.)</td>
            <td><input type="number" id="deleteMemberAtAgeOf" max="20" min="-1" value="<?=$AS->fldDeleteMemberAtAgeOf[FLDVALUE];?>"></td>
        </tr>
        <tr>
            <td colspan="2"><hr></td>
        </tr>
        <tr>
            <td colspan="2"><b>A-Teil</b></td>
        </tr>
        <tr>
            <td>Fehlerpunkte vorgabe: (Standard 1000 Punkte)</td>
            <td><input type="number" id="errorPointsPerDefault" name="ErrorPointsPerDefault" value="<?=$AS->fldErrorPointsPerDefault[FLDVALUE];?>"></td>
        </tr>
        <tr>
            <td>Wettbewerb [Unterflurhydrant] Gesamtzeit: (Standard 6min)</td>
            <td><input type="time" id="timePerDefault" name="timePerDefault" value="<?=$AS->fldTimePerDefaultUFH[FLDVALUE];?>" step="1"></td>
        </tr>        
        <tr>
            <td>Wettbewerb [Offenes Gewässer] Gesamtzeit: (Standard 7min)</td>
            <td><input type="time" id="timePerDefaultOW" name="timePerDefaultOW" value="<?=$AS->fldTimePerDefaultOW[FLDVALUE];?>" step="1"></td>
        </tr>
        <tr>
            <td colspan="2"><b>B-Teil</b></td>
        </tr>
        <tr>
            <td>Fehlerpunkte vorgabe:  (Standard 400 Punkte)</td>
            <td><input type="number" id="errorPointsPerDefaultBPart" name="ErrorPointsPerDefaultBPart" value="<?=$AS->fldErrorPointsPerDefaultBPart[FLDVALUE];?>"></td>
        </tr>
    </table>
</fieldset>

