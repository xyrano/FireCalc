<!-- ErrorCat04Ufh => Error catalogue Wassertrupp 

1. TruppId
2. ufh Kennzeichner
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


<b>Fehlerkatalog: Wassertrupp (Unterflurhydrant)</b><br><br>
<table border="0">
    <thead>
        <tr>
            <th colspan="2">Fehlerpunkte</th>            
            <th><!-- je Fall --></th>
            <th>WTF</th>
            <th><!-- Box zur Anzeige wieviele Clicks ein "je Fall" hat --></th>
            <th>WT</th>
            <th>WTM</th>
            <th><!-- Box zur Anzeige wieviele Clicks ein "je Fall" hat --></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1.</td>
            <td colspan="7">Mängel in der persönlichen Ausrüstung</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein DJF-Übungsanzug</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-1-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-1-ufh-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein DJF-Schutzhelm</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-2-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-2-ufh-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein festes Schuhwerk</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-3-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-3-ufh-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; keine Schutzhandschuhe</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-4-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-4-ufh-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein Brusttuch Maschinist</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-5-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-5-ufh-wtm">5</td>
            <td></td>
        </tr>          
        <tr>
            <td>2.</td>
            <td>Standrohr falsch gesetzt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-2-1-ufh-wt">5</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Standrohr nicht gesetzt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-3-1-ufh-wt">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>4.</td>
            <td>B-Druckschlauch nicht von der TS zum Standrohr verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-4-1-ufh-wt">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>5.</td>
            <td>B-Druckschlauch nicht am Standrohr angekuppelt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-5-1-ufh-wt">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>6.</td>
            <td>B-Druckschlauch nicht von der TS zum Verteiler verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-6-1-ufh-wt">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>7.</td>
            <td>Fehler am Wassergraben</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-7-1-ufh-wtf">5</td>
            <td id="inCase-<?=$groupRecId;?>-7-1-ufh-wtf"></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-7-1-ufh-wtm">5</td>
            <td id="inCase-<?=$groupRecId;?>-7-1-ufh-wtm"></td>
        </tr>
        <tr>
            <td>8.</td>
            <td>Schlauchverdrehung im B-Schlauch zwischen TS und Verteiler</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-8-1-ufh-wt">5</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>9.</td>
            <td>B-Druckschlauch nicht gemeinsam an den Verteiler angekuppelt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-9-1-ufh-wt">5</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>10.</td>
            <td>B-Druckschlauch nicht an den Verteiler angekuppelt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-10-1-ufh-wt">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>11.</td>
            <td>"Wasser marsch!" zum Maschinisten zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-11-1-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>12.</td>
            <td>"Wasser marsch!" zum Maschinisten nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-12-1-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>13.</td>
            <td>"Wassertrupp einsatzbereit!" zum Gruppenführer falsch gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-13-1-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>14.</td>
            <td>"Wassertrupp einsatzbereit!" zum Gruppenführer nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-14-1-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>15.</td>
            <td>Standort vor Wiederholung des Einsatzbefehls verlassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-15-1-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-15-1-ufh-wtm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>16.</td>
            <td colspan="7">Einsatzbefehl nicht vollständig wiederholt</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Einheit fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-16-1-ufh-wtf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Auftrag fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-16-2-ufh-wtf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Mittel fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-16-3-ufh-wtf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Ziel fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-16-4-ufh-wtf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Weg fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-16-5-ufh-wtf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>17.</td>
            <td colspan="7">Fehlende Ausrüstungsgegenstände</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Handscheinwerfer</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-17-1-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Cm-Strahlrohr</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-17-2-ufh-wtm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>18.</td>
            <td>Fehler an der Hürde</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-18-1-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-18-1-ufh-wtm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>19.</td>
            <td>Hürde ausgelassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-1-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-19-1-ufh-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td>20.</td>
            <td>Standort nicht rechts der markierten Stelle an der 40-m-Linie</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-20-1-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-20-1-ufh-wtm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>21.</td>
            <td>"2. Rohr Wasser marsch!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-21-1-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>22.</td>
            <td>"2. Rohr Wasser marsch!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-22-1-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>23.</td>
            <td>Strahlrohr nicht geöffnet</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-23-1-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>24.</td>
            <td>"2. Rohr Wasser halt!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-24-1-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>25.</td>
            <td>"2. Rohr Wasser halt!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-25-1-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>26.</td>
            <td>Strahlrohr vor "Wasser halt!" geschlossen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-26-1-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>27.</td>
            <td>Strahlrohr nicht geschlossen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-27-1-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>28.</td>
            <td>Strahlrohr vor "Wasser halt!" abgelegt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-28-1-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>29.</td>
            <td>Standort an der 40-m-Linie zu früh verlassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-29-1-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-29-1-ufh-wtm">10</td>
            <td></td>
        </tr>
        <tr>
            <td>30.</td>
            <td>Knoten oder Stich am Knotengestell falsch ausgeführt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-30-1-ufh-wtf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-30-1-ufh-wtm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>31.</td>
            <td>Knoten oder Stich am Knotengestellt nicht ausgeführt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-31-1-ufh-wtf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-31-1-ufh-wtm">10</td>
            <td></td>
        </tr>
        
        <tr>
            <td colspan="8"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Fehlerpunkte</td>
            <td colspan="2" class="num" id="errorPointsWTF">0</td>
            <td class="num" id="errorPointsWT">0</td>
            <td colspan="2" class="num" id="errorPointsWTM">0</td>
        </tr>
        <tr>
            <td colspan="8"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Zeittakt 1 (Kontrolle)</td>
            <td colspan="5"><input type="time" class="time" id="<?=$groupRecId;?>-ufh-wt" value="00:00:00" step="1"></td>
        </tr>
        <tr>
            <td colspan="8"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Eindruck</td>
            <!--<td><input type="number" id="impression-ufh-gf" min="1" max="5" step="2" value="3"></td>-->
            <td colspan="5">
                <div id="<?=$groupRecId;?>-ufh-wt-1" class="impress">1</div>
                <div id="<?=$groupRecId;?>-ufh-wt-3" class="impress">3</div>
                <div id="<?=$groupRecId;?>-ufh-wt-5" class="impress">5</div>
            </td>
        </tr>
        <tr>
            <td colspan="8"><hr><hr></td>
        </tr>        
    </tbody>
</table>

