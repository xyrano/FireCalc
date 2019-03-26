<!-- ErrorCat04Ufh => Error catalogue Wassertrupp 

1. TruppId
2. ow Kennzeichner
3. Fehlernr.
4. WTF oder WTM = 1 oder 2 oder 1 und 2

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


<b>Fehlerkatalog: Wassertrupp (Offenes Gewässer)</b><br><br>
<table border="0">
    <thead>
        <tr>
            <th colspan="2">Fehlerpunkte</th>            
            <th><!-- je Fall --></th>
            <th>WTF</th>
            <th><!-- Box zur Anzeige wieviele Clicks ein "je Fall" hat --></th>
            <th>WT</th>
            <th><!-- Box zur Anzeige wieviele Clicks ein "je Fall" hat --></th>
            <th>WTM</th>
            <th><!-- Box zur Anzeige wieviele Clicks ein "je Fall" hat --></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1.</td>
            <td colspan="8">Mängel in der persönlichen Ausrüstung</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein DJF-Übungsanzug</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-1-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-1-ow-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein DJF-Schutzhelm</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-2-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-2-ow-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein festes Schuhwerk</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-3-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-3-ow-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; keine Schutzhandschuhe</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-4-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-4-ow-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein Brusttuch Maschinist</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-5-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-5-ow-wtm">5</td>
            <td></td>
        </tr>          
        <tr>
            <td>2.</td>
            <td>Anzahl der A-Saugschläuche nicht bestimmt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-2-1-ow-wtf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>3.</td>
            <td>A-Saugschläcuhe nicht ausgelegt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-3-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-3-1-ow-wtm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Saugkorb ohne Kupplungsschlüssel angekuppelt (nicht bei Schnellkupplungsgriffen)</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-4-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-4-1-ow-wtm">5</td>
            <td></td>
        </tr>                      
        <tr>
            <td>5.</td>
            <td>Saugkorb nicht angekuppelt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-5-1-ow-wt">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>6.</td>
            <td>A-Saugschläuche ohne Kupplungsschlüssel gekuppelt (nicht bei Schnellkupplungsgriffen)</td>
            <td>je Fall</td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-6-1-ow-wt">5</td>
            <td id="inCase-<?=$groupRecId;?>-6-1-ow-wt"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>7.</td>
            <td>A-Saugschläuche nicht gekuppelt</td>
            <td>je Fall</td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-7-1-ow-wt">5</td>
            <td id="inCase-<?=$groupRecId;?>-7-1-ow-wt"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>8.</td>
            <td>Knoten am Saugkorb falsch ausgeführt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-8-1-ow-wt">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>9.</td>
            <td>Knoten am Saugkorb nicht ausgeführt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-9-1-ow-wt">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>10.</td>
            <td>Nicht ausreichend Halbschläge angebracht (3 Stück)</td>
            <td>je Fall</td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-10-1-ow-wt">5</td>
            <td id="inCase-<?=$groupRecId;?>-10-1-ow-wt"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>11.</td>
            <td>Halbschläge der Halteleine falsch angebracht (nicht vor der Kupplung)</td>
            <td>je Fall</td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-11-1-ow-wt">5</td>
            <td id="inCase-<?=$groupRecId;?>-11-1-ow-wt"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>12.</td>
            <td>Ventilleine nicht angebracht</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-12-1-ow-wt">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>13.</td>
            <td>"Saugleitung hoch!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-13-1-ow-wt">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>14.</td>
            <td>"Saugleitung hoch!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-14-1-ow-wt">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>15.</td>
            <td>"Saugleitung zu Wasser!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-15-1-ow-wt">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>16.</td>
            <td>"Saugleitung zu Wasser!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-16-1-ow-wt">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>17.</td>
            <td>Saugleitung nicht zu Wasser gebracht</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-17-1-ow-wt">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>                    
        <tr>
            <td>18.</td>
            <td>B-Druckschlauch nicht von der TS zum Verteiler verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-18-1-ow-wt">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>19.</td>
            <td>Fehler am Wassergraben</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-19-1-ow-wtf">5</td>
            <td id="inCase-<?=$groupRecId;?>-19-1-ow-wtf"></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-1-ow-wtm">5</td>
            <td id="inCase-<?=$groupRecId;?>-19-1-ow-wtm"></td>
        </tr>
        <tr>
            <td>20.</td>
            <td>Schlauchverdrehung im B-Schlauch zwischen TS und Verteiler</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-20-1-ow-wt">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>21.</td>
            <td>B-Druckschlauch nicht gemeinsam an den Verteiler angekuppelt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-21-1-ow-wt">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>22.</td>
            <td>B-Druckschlauch nicht an den Verteiler angekuppelt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-22-1-ow-wt">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>23.</td>
            <td>"Wasser marsch!" zum Maschinisten zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-23-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>24.</td>
            <td>"Wasser marsch!" zum Maschinisten nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-24-1-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>25.</td>
            <td>"Wassertrupp einsatzbereit!" zum Gruppenführer falsch gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-25-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>26.</td>
            <td>"Wassertrupp einsatzbereit!" zum Gruppenführer nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-26-1-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>27.</td>
            <td>Standort vor Wiederholung des Einsatzbefehls verlassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-27-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-27-1-ow-wtm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>28.</td>
            <td colspan="8">Einsatzbefehl nicht vollständig wiederholt</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Einheit fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-28-1-ow-wtf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Auftrag fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-28-2-ow-wtf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Mittel fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-28-3-ow-wtf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Ziel fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-28-4-ow-wtf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Weg fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-28-5-ow-wtf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>29.</td>
            <td colspan="8">Fehlende Ausrüstungsgegenstände</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Handscheinwerfer</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-29-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; CM-Strahlrohr</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-29-2-ow-wtm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>30.</td>
            <td>Fehler an der Hürde</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-30-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-30-1-ow-wtm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>31.</td>
            <td>Hürde ausgelassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-31-1-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-31-1-ow-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td>32.</td>
            <td>Standort nicht rechts der markierten Stelle an der 40-m-Linie</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-32-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-32-1-ow-wtm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>33.</td>
            <td>"2. Rohr Wasser marsch!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-33-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>34.</td>
            <td>"2. Rohr Wasser marsch!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-34-1-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>35.</td>
            <td>Strahlrohr nicht geöffnet</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-35-1-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>36.</td>
            <td>"2. Rohr Wasser halt!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-36-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>37.</td>
            <td>"2. Rohr Wasser halt!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-37-1-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>38.</td>
            <td>Strahlrohr vor "Wasser halt!" geschlossen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-38-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>39.</td>
            <td>Strahlrohr nicht geschlossen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-39-1-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>40.</td>
            <td>Strahlrohr vor "Wasser halt!" abgelegt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-40-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>41.</td>
            <td>Standort an der 40-m-Linie zu früh verlassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-41-1-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-41-1-ow-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td>42.</td>
            <td>Knoten oder Stich am Knotengestell falsch ausgeführt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-42-1-ow-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-42-1-ow-wtm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>43.</td>
            <td>Knoten oder Stich am Knotengestellt nicht ausgeführt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-43-1-ow-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-43-1-ow-wtm">10</td>
            <td></td>
        </tr>
        
        <tr>
            <td colspan="9"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Fehlerpunkte</td>
            <td colspan="2" class="num" id="errorPointsWTF">0</td>
            <td colspan="2" class="num" id="errorPointsWT">0</td>
            <td colspan="2" class="num" id="errorPointsWTM">0</td>
        </tr>
        <tr>
            <td colspan="8"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Zeittakt 1 (Kontrolle)</td>
            <td colspan="5"><input type="time" class="time" id="<?=$groupRecId;?>-ow-wt" value="00:00:00" step="1"></td>
        </tr>
        <tr>
            <td colspan="8"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Eindruck</td>
            <!--<td><input type="number" id="impression-ufh-gf" min="1" max="5" step="2" value="3"></td>-->
            <td colspan="5">
                <div id="<?=$groupRecId;?>-ow-wt-1" class="impress">1</div>
                <div id="<?=$groupRecId;?>-ow-wt-3" class="impress">3</div>
                <div id="<?=$groupRecId;?>-ow-wt-5" class="impress">5</div>
            </td>
        </tr>
        <tr>
            <td colspan="8"><hr><hr></td>
        </tr>        
    </tbody>
</table>

