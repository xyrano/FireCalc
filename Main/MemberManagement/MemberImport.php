<?php
//When uploading very large files, you have to change 4 configuration variables:
//
// -> upload_max_filesize
// -> post_max_size
// -> memory_limit
// -> time_limit
//Time limit may be increased at runtime with set_time_limit().

set_time_limit(120); // 2 min

require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Member Import", true, "memberExportImport.js");
?>


<?php
$MT = new MemberTable();
$MT->getRecords();
?>


<fieldset>
    <legend>Mitglieder Importieren</legend>
    Zurzeit sind <?=$MT->getNumOfRows();?> Mitglieder eingetragen.
    <br><hr>
    Bei dem Import wird anhand der Ausweisnummer überprüft ob das Mitglied bereits exisitiert,<br>
    falls ja wird der Datensatz mit den Daten der Tabelle aktualisiert, falls das Mitglied<br>
    nicht existiert wird ein neuer Datensatz angelegt!<br>
    <hr>
    <form action="Import.php" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Tabelle zum Importieren auswählen:</td>
                <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
            </tr>
            <tr>
                <td>Ist eine Überschift vorhanden:</td>
                <td>
                    <select name="captionExists">
                        <option value="1" slected>Ja</option>
                        <option value="0">Nein</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Importieren" name="submit"></td>
            </tr>  
        </table>
    </form>
</fieldset>

<?php
echo FormRun::createPageFooter(true);
?>
