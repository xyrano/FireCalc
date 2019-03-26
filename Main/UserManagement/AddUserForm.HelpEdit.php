<fieldset>
    <legend>Benutzer ändern</legend>
    In diesem Formular können Sie einen oder mehrere Benutzer ändern.<br>
    Ändern Sie entsprechend die Daten ab und klicken danach auf <u>Speichern</u> um die Änderungen zu übernehmen.
    <hr>
    Felder:
    <ol>
        <li><b>ID</b> - Eindeutige ID eines Benutzers, diese kann nicht verändert werden.</li>
        <li><b>Benutzername</b> - Textfeld um einen Benutzernamen zu hinterlegen.</li>
        <li><i><u>Password</u></i> - Das Passwort kann nicht verändert werden. (wird nicht angezeigt)</li>
        <li><b>Landkreisgruppe</b> - DropDown Liste zur Auswahl einer Landkreisgruppe. Siehe auch <a href='../KJFGroups/AddGroupForm.php'>KJF Gruppen</a></li>
        <li><b>Feuerwehr</b> - DropDown Liste zur Auswahl einer Feuerwehr. Siehe auch <a href='../FireDept/AddFireDeptForm.php'>Feuerwehren</a></li>
    </ol>
    <hr>
    Info - Es gibt drei Hierachie Ebenen:
    <ol>
    <li><u>Admin Ebene</u> - Der Benutzer ist keiner Landkreisgruppe zugeordnet - er darf aber einer Feuerwehr zugeordnet sein (optional), dies dient aber nur der Übersicht - Er darf alles sehen.</li>
    <li><u>Gruppen Ebene</u> - Der Benutzer ist einer Landkreisgruppe zugeordnet aber keiner Feuerwehr - Er darf nur Datensätze der Landkreisgruppe sehen. Siehe auch <a href='../KJFGroups/AddGroupForm.php'>KJF Gruppen</a></li>
    <li><u>Benutzer Ebene</u> - Der Benutzer ist einer Landkreisgruppe und einer Feuerwehr zugeordnet - Er darf nur Datensätze seiner eigenen Feuerwehr sehen.</li>
    </ol>
</fieldset>

