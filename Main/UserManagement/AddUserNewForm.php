<script>
    $(document).ready(function() {
       $.fn.TT_New();
    });
</script>

<fieldset Create="true">
    <legend>New User</legend>   
    <table>
        <tr>
            <td>Benutzername:</td>
            <td><?=FormRun::newFld(FormRunFldType::$text, "username", NULL, false, true, true, true);?></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><?=FormRun::newFld(FormRunFldType::$text, "password", NULL, false, true, true, true);?></td>
        </tr>                
        <tr>
            <td colspan="2"><hr>
            Zuordnung zu Landkreis:<br> Die Zuordnung zu einer Gruppe gewährleistet das ein angemeldeter Benutzer nur die entsprechenden Daten seines
            Landkreises sieht und entsprechend ändern darf! Wählen sie für einen neuen Benutzer eine entsprechende Gruppe als Zuordnung, 
            Name und Password sollten sich dabei nicht, zu anderen schon bestehenden Nutzern, wiederholen!<br>
            Wenn Sie keine Zuordnung auswählen darf der Benutzer, ähnlich wie der Admin alles sehen!<br>
            Der Admin Benutzer darf außerdem nicht geändert oder gelöscht werden!</td>
        </tr>
        <tr>
            <td>Landkreisgruppe:</td>
            <td><?=FormRun::newFld(FormRunFldType::$enum, "groupId", "../KJFGroups/groupEnum.php", false, false, true, true);?></td>
        </tr>   
        <tr>
            <td colspan="2"><hr>
                Zuordnung zu Feuerwehr<br>Die Zuordnung zu einer Feuerwehr sorgt dafür das der Benutzer nur Bereiche seiner eigenen Feuerwehr sehen und verwalten kann.<br>
                Er kann z.B. nur Gruppen anlegen mit den Mitgliedern der auch eine Feuerwehr zugeordnet ist.<br>
                Ändern darf er aber alle Mitglieder (gilt als Workaround falls mal keine Feuerwehr zum Mitglied eingetragen wurden.)
            </td>
        </tr>
        <tr>
            <td>Feuerwehr:</td>
            <td><?=FormRun::newFld(FormRunFldType::$enum, "fireDeptId", "../FireDept/fireDeptEnum.php", false, false, true, true);?></td>
        </tr>
    </table>
</fieldset>