<fieldset>
    <legend>Übersicht Benutzer</legend>
    Hier sehen Sie die Übersicht der Benutzer mit den dazugehörigen Ausprägungen.<br>
    Sie können Benutzer <a href="AddUserForm.php?do=new">hinzufügen</a>, <a href="AddUserForm.php?do=edit">ändern</a> oder <a href="AddUserForm.php?do=delete">löschen</a>.<br>
    <hr>
    Felder:
    <ol>
        <li><b>ID</b> - Eindeutige ID eines Benutzers.</li>
        <li><b>Name</b> - Name bzw. Anmeldename des Benutzers.</li>
        <li><b>Passwort</b> - nicht sichtbar und zudem Verschlüsselt.</li>
        <li><b>Landkreisgruppe</b> - Landkreisgruppe dem der Benutzer zugeordnet ist.</li>
        <li><b>Feuerwehr</b> - Feuerwehr die dem Benutzer zugeordnet ist.</li>
        <li><b>Online</b> - Berechnetes Feld das anzeigt wer zurzeit im System angemeldet ist.</li>
    </ol>
    <hr>
    Es gibt drei Hierachie Ebenen:
    <ol>
    <li><u>Admin Ebene</u> - Der Benutzer ist keiner Landkreisgruppe zugeordnet - er darf aber einer Feuerwehr zugeordnet sein (optional), dies dient aber nur der Übersicht - Er darf alles sehen.</li>
    <li><u>Gruppen Ebene</u> - Der Benutzer ist einer Landkreisgruppe zugeordnet aber keiner Feuerwehr - Er darf nur Datensätze der Landkreisgruppe sehen. Siehe auch <a href='../KJFGroups/AddGroupForm.php'>KJF Gruppen</a></li>
    <li><u>Benutzer Ebene</u> - Der Benutzer ist einer Landkreisgruppe und einer Feuerwehr zugeordnet - Er darf nur Datensätze seiner eigenen Feuerwehr sehen.</li>
    </ol>   
    <hr>
    <?php
    require_once '../../ApplTree/Classes/SysConstants.php';
    ?>
    <i>Info: Der Benutzer '<?= SysConstants::sysAdminName;?>' wird beim Installieren des Systems automatisch hinterlegt und darf nicht gelöscht werden!<br>Dieser Benutzer gilt als Superuser.</i>
</fieldset>
