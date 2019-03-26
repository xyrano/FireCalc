<fieldset>
    <legend>Neuen Benutzer anlegen</legend>
    Hier können Sie einen neuen Benutzer in das System aufnehmen.<br>
    Vergeben Sie im Feld <b>Benutzername</b> einen entsprechenden Namen und im Feld <b>Password</b> ein entsprechendes Passwort.<br>
    Sie können den Benutzer zudem einer Landkreisgruppe zuordnen damit dieser nur Datensätze seines Landkreises sehen und ggf. ändern darf.<br>
    Sie können den Benutzer auch einer Feuerwehr zuordnen. Siehe auch 'Hierachie Ebenen'.<br>
    Klicken Sie nach eingabe der Daten auf <u>Speichern</u> um den neuen Datensatz zu erzeugen.
    <hr>
    Felder:
    <ol>
        <li><b>Benutzername</b> - Textfeld um einen Benutzernamen zu hinterlegen.</li>
        <li><b>Password</b> - Textfeld um ein Passwort zu hinterlegen. (Merken Sie sich das Passwort)</li>
        <li><b>Landkreisgruppe</b> - DropDown Liste zur Auswahl einer Landkreisgruppe. Siehe auch <a href='../KJFGroups/AddGroupForm.php'>KJF Gruppen</a></li>
        <li><b>Feuerwehr</b> - DropDown Liste zur Auswahl einer Feuerwehr. Siehe auch <a href='../FireDept/AddFireDeptForm.php'>Feuerwehren</a></li>
    </ol>
    <hr>
    Es gibt drei Hierachie Ebenen:
    <ol>
    <li><u>Admin Ebene</u> - Der Benutzer ist keiner Landkreisgruppe zugeordnet - er darf aber einer Feuerwehr zugeordnet sein (optional), dies dient aber nur der Übersicht - Er darf alles sehen.</li>
    <li><u>Gruppen Ebene</u> - Der Benutzer ist einer Landkreisgruppe zugeordnet aber keiner Feuerwehr - Er darf nur Datensätze der Landkreisgruppe sehen. Siehe auch <a href='../KJFGroups/AddGroupForm.php'>KJF Gruppen</a></li>
    <li><u>Benutzer Ebene</u> - Der Benutzer ist einer Landkreisgruppe und einer Feuerwehr zugeordnet - Er darf nur Datensätze seiner eigenen Feuerwehr sehen.</li>
    </ol>
</fieldset>
