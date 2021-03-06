<!-- ErrorCat01Ufh => Error catalogue Gruppenführer / Melder Unterflurhydrant 

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


<b>Fehlerkatalog: Gruppenführer / Melder (Unterflurhydrant)</b><br><br>
<br>
<table >
    <thead>
        <tr>
            <th colspan="2">Fehlerpunkte</th>            
            <th><!-- je Fall --></th>
            <th>GF</th>
            <th>Me</th>
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
            <td class="num" id="<?=$groupRecId;?>-1-1-ufh-gf">10</td>
            <td class="num" id="<?=$groupRecId;?>-1-1-ufh-me">10</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein DJF-Schutzhelm</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-2-ufh-gf">10</td>
            <td class="num" id="<?=$groupRecId;?>-1-2-ufh-me">10</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein festes Schuhwerk</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-3-ufh-gf">10</td>
            <td class="num" id="<?=$groupRecId;?>-1-3-ufh-me">10</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; keine Schutzhandschuhe</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-4-ufh-gf">10</td>
            <td class="num" id="<?=$groupRecId;?>-1-4-ufh-me">10</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein Brusttuch Gruppenführer / Melder</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-5-ufh-gf">5</td>
            <td class="num" id="<?=$groupRecId;?>-1-5-ufh-me">5</td>
        </tr>
        <tr>
            <td>2.</td>
            <td colspan="4">Im Einsatzbefehl des GF fehlen</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Wasserentnahmestelle</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-2-1-ufh-gf">2</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Lage des Verteilers</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-2-2-ufh-gf">2</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Einheit</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-2-3-ufh-gf">2</td>
            <td class="greyedOut"></td>
            <td id="inCase-<?=$groupRecId;?>-2-3-ufh-gf"></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Auftrag </td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-2-4-ufh-gf">2</td>
            <td class="greyedOut"></td>
            <td id="inCase-<?=$groupRecId;?>-2-4-ufh-gf"></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Mittel </td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-2-5-ufh-gf">2</td>
            <td class="greyedOut"></td>
            <td id="inCase-<?=$groupRecId;?>-2-5-ufh-gf"></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Ziel </td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-2-6-ufh-gf">2</td>
            <td class="greyedOut"></td>
            <td id="inCase-<?=$groupRecId;?>-2-6-ufh-gf"></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Weg </td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-2-7-ufh-gf">2</td>
            <td class="greyedOut"></td>
            <td id="inCase-<?=$groupRecId;?>-2-7-ufh-gf"></td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Einsatzbefehl für Melder nicht, zu früh oder falsch gegeben </td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-3-1-ufh-gf">5</td>
            <td class="greyedOut"></td>
            <td id="inCase-<?=$groupRecId;?>-3-1-ufh-gf"></td>
        </tr>
        <tr>
            <td>4.</td>
            <td colspan="4">Fehlende Ausrüstungsgegenstände</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Handscheinwerfer</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-4-1-ufh-gf">5</td>
            <td class="num" id="<?=$groupRecId;?>-4-1-ufh-me">5</td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Melder nicht mit dem Gruppenführer gemeinsam nach vorn gegangen</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-5-1-ufh-me">2</td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Fehler am Wassergraben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-6-1-ufh-gf">5</td>
            <td class="num" id="<?=$groupRecId;?>-6-1-ufh-me">5</td>
        </tr>
        <tr>
            <td>7.</td>
            <td>Verteiler ohne Befehl übernommen</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-7-1-ufh-me">5</td>
        </tr>
        <tr>
            <td>8.</td>
            <td>Einsatzbefehl nicht oder falsch wiederholt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-8-1-ufh-me">5</td>
        </tr>
        <tr>
            <td>9.</td>
            <td>Verteiler nicht übernommen</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-9-1-ufh-me">5</td>
        </tr>
        <tr>
            <td>10.</td>
            <td>Bei der Übernahme des Verteilers Handscheinwerfer nicht mitgenommen</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-10-1-ufh-me">5</td>
        </tr>
        <tr>
            <td>11.</td>
            <td>C-Druckschlauch vom Schlauchtrupp nicht angekuppelt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-11-1-ufh-me">10</td>
        </tr>
        <tr>
            <td>12.</td>
            <td>Verteiler vor "3. Rohr Wasser marsch" geöffnet</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-12-1-ufh-me">5</td>
        </tr>
        <tr>
            <td>13.</td>
            <td>Verteiler nicht richtig geöffnet</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-13-1-ufh-me">5</td>
        </tr>
        <tr>
            <td>14.</td>
            <td>Verteiler nicht geöffnet</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-14-1-ufh-me">10</td>
        </tr>
        <tr>
            <td>15.</td>
            <td>"Wasser halt!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-15-1-ufh-gf">5</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td>16.</td>
            <td>"Wasser halt!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-16-1-ufh-gf">10</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td>17.</td>
            <td>Nach dem Kommando "... Rohr Wasser halt!" Verteiler nicht ganz geschlossen </td>
            <td>je Fall</td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-17-1-ufh-me">5</td>
            <td id="inCase-<?=$groupRecId;?>-17-1-ufh-me"></td>
        </tr>
        <tr>
            <td>18.</td>
            <td>Nach dem Kommando "... Rohr Wasser halt!" Verteiler nicht geschlossen </td>
            <td>je Fall</td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-18-1-ufh-me">10</td>
            <td id="inCase-<?=$groupRecId;?>-18-1-ufh-me"></td>
        </tr>
        <tr>
            <td>19.</td>
            <td colspan="4">Befehl "Angriffstrupp und Wassertrupp Knoten und Stiche anlegen!"</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-1-ufh-gf">5</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; zu spät gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-2-ufh-gf">10</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; falsch gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-3-ufh-gf">5</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-4-ufh-gf">10</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td>20.</td>
            <td>Kriechtunnel ausgelassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-20-1-ufh-gf">10</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td>21.</td>
            <td>Handscheinwerfer nicht mit zum Knotengestell genommen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-21-1-ufh-gf">5</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td>22.</td>
            <td>"Übung beendet!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-22-1-ufh-gf">5</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td>23.</td>
            <td>"Übung beendet!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-23-1-ufh-gf">10</td>
            <td class="greyedOut"></td>
        </tr>
        <tr>
            <td colspan="5"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Fehlerpunkte</td>
            <td class="num" id="errorPointsGF">0</td>
            <td class="num" id="errorPointsME">0</td>
        </tr>
        <tr>
            <td colspan="5"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Gesamtzeit</td>
            <td colspan="2"><input type="time" class="time" id="<?=$groupRecId;?>-ufh-gf" value="<?=AdminSetup::findRecId()->fldTimePerDefaultUFH[FLDVALUE];?>" step="1"></td>
        </tr>
        <tr>
            <td colspan="5"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Eindruck</td>
            <!--<td><input type="number" id="impression-ufh-gf" min="1" max="5" step="2" value="3"></td>-->
            <td colspan="2">
                <div id="<?=$groupRecId;?>-ufh-gfme-1" class="impress">1</div>
                <div id="<?=$groupRecId;?>-ufh-gfme-3" class="impress">3</div>
                <div id="<?=$groupRecId;?>-ufh-gfme-5" class="impress">5</div>
            </td>
        </tr>
        <tr>
            <td colspan="5"><hr><hr></td>
        </tr>
    </tbody>
</table>

