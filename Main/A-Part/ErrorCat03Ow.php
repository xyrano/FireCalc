<!-- ErrorCat01Ufh => Error catalogue Angriffstrupp 

1. TruppId
2. ow Kennzeichner
3. Fehlernr.
4. ATF oder ATM = 1 oder 2 oder 1 und 2

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


<b>Fehlerkatalog: Angriffstrupp (Offenes Gewässer)</b><br><br>
<table border="0">
    <thead>
        <tr>
            <th colspan="2">Fehlerpunkte</th>            
            <th><!-- je Fall --></th>
            <th>ATF</th>
            <th><!-- Box zur Anzeige wieviele Clicks ein "je Fall" hat --></th>
            <th>AT</th>
            <th>ATM</th>
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
            <td class="num" id="<?=$groupRecId;?>-1-1-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-1-ow-atm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein DJF-Schutzhelm</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-2-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-2-ow-atm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein festes Schuhwerk</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-3-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-3-ow-atm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; keine Schutzhandschuhe</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-4-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-4-ow-atm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein Brusttuch Maschinist</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-5-ow-atf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-5-ow-atm">5</td>
            <td></td>
        </tr>  
        <tr>
            <td>2.</td>
            <td colspan="7">Einsatzbefehl nicht vollständig widerholt</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Einheit fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-2-1-ow-atf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>  
        <tr>
            <td></td>
            <td>&bullet; Auftrag fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-2-2-ow-atf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr> 
        <tr>
            <td></td>
            <td>&bullet; Mittel fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-2-3-ow-atf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr> 
        <tr>
            <td></td>
            <td>&bullet; Ziel fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-2-4-ow-atf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr> 
        <tr>
            <td></td>
            <td>&bullet; Weg fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-2-5-ow-atf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr> 
        <tr>
            <td>3.</td>
            <td colspan="7">Fehlende Ausrüstungsgegenstände</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Handscheinwerfer</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-3-1-ow-atf">5</td>
            <td></td>
            <td class="greyedOut"></td>
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
            <td class="num" id="<?=$groupRecId;?>-3-2-ow-atm">5</td>
            <td></td>
        </tr> 
        <tr>
            <td>4.</td>
            <td>Fehler am Wassergraben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-4-1-ow-atf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-4-1-ow-atm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Verteiler nicht gesetzt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-5-1-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Die erforderlichen C-Druckschläuche nicht zum Verteiler gebracht</td>
            <td>je Schlauch</td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-6-1-ow-atm">5</td>
            <td id="inCase-<?=$groupRecId;?>-6-1-ow-atm"></td>
        </tr>
        <tr>
            <td>7.</td>
            <td>C-Druckschlauch am falschen Abgang angekuppelt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-7-1-ow-atf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>8.</td>
            <td>C-Druckschlauch nicht am Verteiler angekuppelt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-8-1-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>9.</td>
            <td>1. C-Druckschlauch nicht unter der Leiterwand verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-9-1-ow-at">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>10.</td>
            <td>Leiterwand ausgelassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-10-1-ow-atf">40</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-10-1-ow-atm">40</td>
            <td></td>
        </tr>
        <tr>
            <td>11.</td>
            <td>Leiterwand nicht leitermäßig begangen (beidseitig)</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-11-1-ow-atf">5</td>
            <td id="inCase-<?=$groupRecId;?>-11-1-ow-atf"></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-11-1-ow-atm">5</td>
            <td id="inCase-<?=$groupRecId;?>-11-1-ow-atm"></td>
        </tr>
        <tr>
            <td>12.</td>
            <td>Gerät nicht unter der Leiterwand durchgeschoben</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-12-1-ow-atf">10</td>
            <td id="inCase-<?=$groupRecId;?>-12-1-ow-atf"></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-12-1-ow-atm">10</td>
            <td id="inCase-<?=$groupRecId;?>-12-1-ow-atm"></td>
        </tr>
        <tr>
            <td>13.</td>
            <td>Schlauchverdrehung im 1. C-Druckschlauch</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-13-1-ow-at">5</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>14.</td>
            <td>2. C-Druckschlauch nicht ganz als Schlauchreserve verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-14-1-ow-at">5</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>15.</td>
            <td>2. C-Druckschlauch nicht als Schlauchreserve verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-15-1-ow-at">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>16.</td>
            <td>Standort nicht links der markierten Stelle an der 40-m-Linie</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-16-1-ow-atf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-16-1-ow-atm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>17.</td>
            <td>"1. Rohr Wasser marsch!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-17-1-ow-atf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>18.</td>
            <td>"1. Rohr Wasser marsch!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-18-1-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>19.</td>
            <td>Strahlrohr nicht geöffnet</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-1-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>20.</td>
            <td>"1. Rohr Wasser halt!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-20-1-ow-atf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>21.</td>
            <td>"1. Rohr Wasser halt!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-21-1-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>22.</td>
            <td>Strahlrohr vor "Wasser halt" geschlossen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-22-1-ow-atf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>23.</td>
            <td>Strahlrohr nicht geschlossen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-23-1-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>24.</td>
            <td>Strahlrohr vor "Wasser halt" abgelegt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-24-1-ow-atf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>25.</td>
            <td>Standort an der 40-m-Linie zu früh verlassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-25-1-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-25-1-ow-atm">10</td>
            <td></td>
        </tr>
        <tr>
            <td>26.</td>
            <td>Knoten oder Stich am Knotegestell falsch ausgeführt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-26-1-ow-atf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-26-1-ow-atm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>27.</td>
            <td>Knoten oder Stich am Knotengestell nicht ausgeführt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-27-1-ow-atf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-27-1-ow-atm">10</td>
            <td></td>
        </tr>        
        <tr>
            <td colspan="8"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Fehlerpunkte</td>
            <td colspan="2" class="num" id="errorPointsATF">0</td>
            <td class="num" id="errorPointsAT">0</td>
            <td colspan="2" class="num" id="errorPointsATM">0</td>
        </tr>
        <tr>
            <td colspan="8"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Zeittakt 1</td>
            <td colspan="5"><input type="time" class="time" id="<?=$groupRecId;?>-ow-at" value="00:00:00" step="1"></td>
        </tr>
        <tr>
            <td colspan="8"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Eindruck</td>
            <!--<td><input type="number" id="impression-ufh-gf" min="1" max="5" step="2" value="3"></td>-->
            <td colspan="5">
                <div id="<?=$groupRecId;?>-ow-at-1" class="impress">1</div>
                <div id="<?=$groupRecId;?>-ow-at-3" class="impress">3</div>
                <div id="<?=$groupRecId;?>-ow-at-5" class="impress">5</div>
            </td>
        </tr>
        <tr>
            <td colspan="8"><hr><hr></td>
        </tr>        
    </tbody>
</table>

