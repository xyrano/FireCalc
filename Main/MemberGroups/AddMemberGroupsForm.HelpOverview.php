<?php
require_once '../../ExtendedDataTypes.php';
require_once("../../Functions.php");
require_once("../../ApplTree/Classes/Base.php");
require_once("../../ApplTree/Classes/Database.php");
require_once("../../ApplTree/Classes/SysTableBase.php");
?>
<fieldset>
    <legend>Gruppen</legend>
    Hier können Sie neue Gruppen zu einem Wettbewerb erstellen, ändern oder löschen.<br>  
    Um eine neue Gruppe zu erstellen müssen Sie zuvor vom Admin oder Auswertungsteam zum Wettbewerb zugelassen 'erfasst' worden sein.<br>
    
    <hr>
    Felder:
    <ol>
    <li><b>Wettbewerb</b> - Name des Wettbewerbs, dieser wird durch den Referenzierenden Wettbewerb vorgegeben.</li>
    <li><b>Feuerwehr</b> - Hier kann die Feuerwehr ausgewählt werden zu der eine Gruppe erstellt werden soll. Bei dem Benutzertyp: 'Benutzer' kann die Feuerwehr nicht geändert werden, da diese mit dem Benutzer zusammenhängt.</li>
    <li><b>Gruppenname</b> - Hier kann der Gruppenname mit einer Länge von '<?= fieldLength(FLDGROUPNAME);?>' Zeichen eingegeben werden.</li>
    <li><b>Anzahl Mitglieder</b> - Die Anzahl der Mitglieder wird automatisch gezählt je nachdem wieviele zur Gruppen hinzugefügt wurden.</li>
    <li><b>Durchschnittsalter</b> - Das Durchschnittsalter der Gruppe berechnet sich aus den Geburtsdaten eines jeden Mitglieds durch die Anzahl an Mitglieder.</li>    
    </ol>
    <hr>
    Weitere Funktionen:
    <ol>
        <li><b>Mitglieder</b> - Klicken Sie auf einen Datensatz und dann auf den Button 'Mitglieder' um sich alle Mitglieder der Gruppe anzusehen.</li>
    </ol>
</fieldset>