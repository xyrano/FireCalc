<?php
require_once("../../Factory.php");
require_once("../../Functions.php");
?>
<fieldset>
    <legend>Übersicht über Landkreise</legend>
    Die Übersicht der Landkreise zeigt die Landkreise sowie die Anzahl der dazugehörigen Gemeinden, sofern diese bereits zugeordnet wurden.<br>
    Sie können neue Landkreise <?=(sysIsUserUser()) ? "hinzufügen" : "<a href=\"AddDistrictForm.php?do=new\">hinzufügen</a>"?>, bestehende durch Doppelklick auf den jeweilligen Datensatz verändern oder Landkreise löschen.
    <hr>
    Felder:
    <table style='font-size: 10px;'>
        <thead>
            <tr>
                <th>Feld</th>
                <th>Label 'de'</th>
                <th>Typ</th>
                <th>Obligatorisch</th>
                <th>Länge</th>
                <th>Beschreibung</th>
            </tr>
        </thead>
        <tbody>            
        <?=getFieldsHelpTable(new DistrictTable());?>    
        </tbody>
    </table>
    <!--
    <li><b>ID</b> Eindeutige ID des Landkreises.</li>
    <li><b>Landkreis</b> Der Landkreis.</li>
    <li><b>Anzahl Gemeinden</b> Die Anzahl an Gemeinden zu jedem Landkreis sofern in der Gemeindeverwaltung die zuordnung erstellt wurde.</li>
    -->
    <hr>
    Info: Sofern Sie als Benutzer einer Landkreisgruppierung unterliegen, <i>zu sehen in der Statusleiste jedes Fensters: <b>Landkreisgruppe</b></i>, sehen Sie nur Landkreise die in der entsprechenden Gruppe aufgenommen wurden.<br>    
</fieldset>