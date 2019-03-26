<!-- ErrorCat05Ufh => Error catalogue Schlauchtrupp 

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


<b>Fehlerkatalog: Schlauchtrupp (Unterflurhydrant)</b><br><br>
<table border="0">
    <thead>
        <tr>
            <th colspan="2">Fehlerpunkte</th>            
            <th><!-- je Fall --></th>
            <th>STF</th>
            <th><!-- Box zur Anzeige wieviele Clicks ein "je Fall" hat --></th>
            <th>ST</th>
            <th>STM</th>
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
            <td class="num" id="<?=$groupRecId;?>-1-1-ufh-stf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-1-ufh-stm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein DJF-Schutzhelm</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-2-ufh-stf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-2-ufh-stm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein festes Schuhwerk</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-3-ufh-stf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-3-ufh-stm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; keine Schutzhandschuhe</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-4-ufh-stf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-4-ufh-stm">10</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; kein Brusttuch STF / STM</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-1-5-ufh-stf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-1-5-ufh-stm">5</td>
            <td></td>
        </tr>          
        <tr>
            <td>2.</td>
            <td>Fehler am Wassergraben</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-2-1-ufh-stf">5</td>
            <td id="inCase-<?=$groupRecId;?>-2-1-ufh-stf"></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-2-1-ufh-stm">5</td>
            <td id="inCase-<?=$groupRecId;?>-2-1-ufh-stm"></td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Die erforderlichen C-Druckschläuche nicht zum Verteiler gebracht</td>
            <td>je Schlauch</td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-3-1-ufh-st">5</td>            
            <td></td>
            <td id="inCase-<?=$groupRecId;?>-3-1-ufh-st"></td>
        </tr>
        <tr>
            <td>4.</td><td>Niederschraubventil des Verteilers nicht richtig geöffnet</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-4-1-ufh-stf">5</td>
            <td id="inCase-<?=$groupRecId;?>-4-1-ufh-stf"></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>5.</td><td>Niederschraubventil des Verteilers nicht geöffnet</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-5-1-ufh-stf">10</td>
            <td id="inCase-<?=$groupRecId;?>-5-1-ufh-stf"></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Standort vor Einsatzbefehl für den WT verlassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-6-1-ufh-stf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-6-1-ufh-stm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>7.</td>
            <td>Fehler an der Hürde</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-7-1-ufh-stf">5</td>
            <td id="inCase-<?=$groupRecId;?>-7-1-ufh-stf"></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-7-1-ufh-stm">5</td>
            <td id="inCase-<?=$groupRecId;?>-7-1-ufh-stm"></td>
        </tr>
        <tr>
            <td>8.</td>
            <td>Hürde ausgelassen</td>
            <td>je Fall</td>
            <td class="num" id="<?=$groupRecId;?>-8-1-ufh-stf">10</td>
            <td id="inCase-<?=$groupRecId;?>-8-1-ufh-stf"></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-8-1-ufh-stm">10</td>
            <td id="inCase-<?=$groupRecId;?>-8-1-ufh-stm"></td>
        </tr>
        <tr>
            <td>9.</td>
            <td>2. C-Druckschlauch (WT) nicht ausgerollt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-9-1-ufh-st">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>10.</td>
            <td>Standort vor "2. Rohr Wasser marsch" verlassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-10-1-ufh-stf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-10-1-ufh-stm">5</td>
            <td></td>
            </tr>              
        <tr>
            <td>11.</td><td>2. C-Druckschlauch (WT) nicht ganz als Schlauchreserve verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-11-1-ufh-st">5</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>12.</td><td>1. C-Druckschlauch (WT) vor "2. Rohr Wasser marsch" ausgerollt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-12-1-ufh-st">5</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>13.</td><td>1. C-Druckschlauch (WT) nicht unter der Hürde verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-13-1-ufh-st">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>14.</td>
            <td>Schlauchverdrehung im 1. C-Druckschlauch (WT)</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-14-1-ufh-st">5</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>15.</td>
            <td>1. C-Druckschlauch (WT) nicht verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-15-1-ufh-st">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>16.</td>
            <td>C-Druckschlauch am falschen Abgang angekuppelt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-16-1-ufh-stf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>17.</td>
            <td>C-Druckschlauch nicht am Verteiler angekuppelt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-17-1-ufh-stf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>18.</td>
            <td>Standort vor Wiederholung des eigenen Einsatzbefehls verlassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-18-1-ufh-stf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-18-1-ufh-stm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>19.</td>
            <td colspan="7">Einsatzbefehl nicht vollständig wiederholt</td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Einheit fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-1-ufh-stf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Auftrag fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-2-ufh-stf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Mittel fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-3-ufh-stf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
        <td></td>
            <td>&bullet; Ziel fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-4-ufh-stf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&bullet; Weg fehlte</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-19-5-ufh-stf">2</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>20.</td>
            <td colspan="7">Fehlende Ausrüstungsgegenstände</td>
        <tr>
            <td></td>
            <td>&bullet; Handscheinwerfer</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-20-1-ufh-stf">2</td>
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
            <td class="num" id="<?=$groupRecId;?>-20-2-ufh-stm">2</td>
            <td></td>
        </tr>
        <tr>
            <td>21.</td><td>Kriechtunnel ausgelassen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-21-1-ufh-stf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-21-1-ufh-stm">10</td>
            <td></td>
        </tr>
        <tr>
            <td>22.</td>
            <td>1. C-Druckschlauch nicht ausgerollt und durch den Kriechtunnel verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-22-1-ufh-st">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>23.</td><td>Schlauchverdrehung im 1. C-Druckschlauch (ST)</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-23-1-ufh-st">5</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>24.</td><td>2. C-Druckschlauch (ST) nicht ganz als Schlauchreserve verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-24-1-ufh-st">5</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>25.</td>
            <td>2. C-Druckschlauch (ST) nicht als Schlauchreserve verlegt</td>
            <td></td>
            <td class="greyedOut"></td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-25-1-ufh-st">10</td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>26.</td>
            <td>Standort nicht links und rechts der markierten Stelle an der 40-m-Linie</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-26-1-ufh-stf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="num" id="<?=$groupRecId;?>-26-1-ufh-stm">5</td>
            <td></td>
        </tr>
        <tr>
            <td>27.</td>
            <td>"3. Rohr Wasser marsch!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-27-1-ufh-stf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>28.</td>
            <td>"3. Rohr Wasser marsch!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-28-1-ufh-stf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>29.</td>
            <td>Strahlrohr nicht geöffnet</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-29-1-ufh-stf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>30.</td>
            <td>"3. Rohr Wasser halt!" zu früh gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-30-1-ufh-stf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>31.</td>
            <td>"3. Rohr Wasser halt!" nicht gegeben</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-31-1-ufh-stf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>32.</td>
            <td>Strahlrohr vor "Wasser halt!" geschlossen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-32-1-ufh-stf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>33.</td>
            <td>Strahlrohr nicht geschlossen</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-33-1-ufh-stf">10</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        <tr>
            <td>34.</td>
            <td>Strahlrohr vor "Wasser halt!" abgelegt</td>
            <td></td>
            <td class="num" id="<?=$groupRecId;?>-34-1-ufh-stf">5</td>
            <td></td>
            <td class="greyedOut"></td>
            <td class="greyedOut"></td>
            <td></td>
        </tr>
        
        <tr>
            <td colspan="8"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Fehlerpunkte</td>
            <td colspan="2" class="num" id="errorPointsSTF">0</td>
            <td class="num" id="errorPointsST">0</td>
            <td colspan="2" class="num" id="errorPointsSTM">0</td>
        </tr>
         <tr>
            <td colspan="8"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Eindruck</td>
            <td colspan="5">
                <div id="<?=$groupRecId;?>-ufh-st-1" class="impress">1</div>
                <div id="<?=$groupRecId;?>-ufh-st-3" class="impress">3</div>
                <div id="<?=$groupRecId;?>-ufh-st-5" class="impress">5</div>
            </td>
        </tr>
        <tr>
            <td colspan="8"><hr><hr></td>
        </tr>   
    </tbody>
</table>

