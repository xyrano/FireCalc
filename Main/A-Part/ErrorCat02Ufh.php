<!-- ErrorCat01Ufh => Error catalogue Maschinist 

1. TruppId
2. ufh Kennzeichner
3. Fehlernr.
4. GF oder ME = 1 oder 2 oder 1 und 2

-->



<style type="text/css">
    table > tbody > tr > td.num {
        text-align: center;
        cursor: pointer;
    }
    table > tbody > tr > td.greyedOut {
        background-color: #b3b3b3;
    }
    table > tbody > tr:hover {
        background-color: threedface; 
    }
</style>


<b>Fehlerkatalog: Maschinist (Unterflurhydrant)</b><br><br>
<br>
<table border="0">
    <thead>
        <tr>
            <th colspan="2">Fehlerpunkte</th>            
            <th><!-- je Fall --></th>
            <th>Ma</th>
            <th><!-- Box zur Anzeige wieviele Clicks ein "je Fall" hat --></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1.</td>
            <td colspan="4">Mängel in der persönlichen Ausrüstung</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein DJF-Übungsanzug</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-1-ufh-ma">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein DJF-Schutzhelm</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-2-ufh-ma">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein festes Schuhwerk</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-3-ufh-ma">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; keine Schutzhandschuhe</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-4-ufh-ma">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein Brusttuch Maschinist</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-5-ufh-ma">5</td>
            <td></td>
        </tr>        
        <tr>
            <td>2.</td>
            <td>Druckabgänge waren zu Beginn der Übung offen</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-2-1-ufh-ma">5</td>
            <td id="inCase-<?=$groupRecId;?>-2-1-ufh-ma"></td>
        </tr>  
        <tr>
            <td>3.</td>
            <td>Blindkupplungen waren zu Beginn der Übung nicht angebracht</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-3-1-ufh-ma">5</td>
            <td id="inCase-<?=$groupRecId;?>-3-1-ufh-ma"></td>
        </tr> 
        <tr>
            <td>4.</td>
            <td>Blindkupplungen nur von einem Druckabgang entfernt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-4-1-ufh-ma">5</td>
            <td></td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Sammelstück nicht angeschlossen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-5-1-ufh-ma">10</td>
            <td></td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Sammelstück nicht mit Kupplungsschlüssel angezogen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-6-1-ufh-ma">5</td>
            <td></td>
        </tr>
        <tr>
            <td>7.</td>
            <td>B-Druckschlauch falsch angeschlossen</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-7-1-ufh-ma">5</td>
            <td id="inCase-<?=$groupRecId;?>-7-1-ufh-ma"></td>
        </tr>
        <tr>
            <td>8.</td>
            <td>B-Druckschlauch nicht angeschlossen</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-8-1-ufh-ma">5</td>
            <td id="inCase-<?=$groupRecId;?>-8-1-ufh-ma"></td>
        </tr>
        <tr>
            <td>9.</td>
            <td>Druckabgang vor "Wasser marsch!" des Wassertruppführers geöffnet</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-9-1-ufh-ma">5</td>
            <td></td>
        </tr>
        <tr>
            <td>10.</td>
            <td>Druckabgang nicht richtig geöffnet</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-10-1-ufh-ma">5</td>
            <td></td>
        </tr>
        <tr>
            <td>11.</td>
            <td>Druckabgang nicht geöffnet</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-11-1-ufh-ma">10</td>
            <td></td>
        </tr>    
        <tr>
            <td colspan="5"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Fehlerpunkte</td>
            <td class="num" id="errorPointsMA">0</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Gesamtzeit (Kontrolle)</td>
            <td colspan="2"><input type="time" class="time" id="<?=$groupRecId;?>-ufh-ma" value="<?= AdminSetup::findRecId()->fldTimePerDefaultUFH[FLDVALUE];?>" step="1"></td>
        </tr>
        <tr>
            <td colspan="5"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Eindruck</td>
            <!--<td><input type="number" id="impression-ufh-gf" min="1" max="5" step="2" value="3"></td>-->
            <td colspan="2">
                <div id="<?=$groupRecId;?>-ufh-ma-1" class="impress">1</div>
                <div id="<?=$groupRecId;?>-ufh-ma-3" class="impress">3</div>
                <div id="<?=$groupRecId;?>-ufh-ma-5" class="impress">5</div>
            </td>
        </tr>
        <tr>
            <td colspan="5"><hr><hr></td>
        </tr>        
    </tbody>
</table>

