<!-- ErrorCat01 => Error catalogue Läufer 1

1. TruppId
2. ow Kennzeichner
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


<b>Fehlerkatalog: Läufer 1</b><br><br>
<table border="0">
    <tbody>
    <tr>
        <td>1.</td>
        <td colspan="2">Mängel in der persönlichen Ausrüstung</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; kein DJF-Übungsanzug</td>
        <td class="num" id="<?=$groupRecId;?>-1-1-L1">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; kein DJF-Schutzhelm</td>
        <td class="num" id="<?=$groupRecId;?>-1-2-L1">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; keine Sportschuhe gemäß Ausschreibung</td>
        <td class="num" id="<?=$groupRecId;?>-1-3-L1">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; keine Schutzhandschuhe</td>
        <td class="num" id="<?=$groupRecId;?>-1-4-L1">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; kein Brusttuch Nummer 1</td>
        <td class="num" id="<?=$groupRecId;?>-1-5-L1">5</td>
    </tr>    
    <tr>
        <td colspan="3"><hr></td>
    </tr>
    <tr>
        <td colspan="2">Fehlerpunkte</td>
        <td id="errorPointsL1">0</td>
    </tr>
    <tr>
        <td colspan="3"><hr></td>
    </tr>
    <tr>
        <td colspan="2">Zeit: (Sollzeit f&uuml;r die Gruppe: <?= ErrorHelper::getToTime4Group(MemberGroupTable::findRecId($groupRecId)->getAverageAge(0));?>) </td>
        <td><input type="time" class="time" id="<?=$groupRecId;?>-BP-L1-L1" value="00:00:00" step="1"></td>
    </tr>
    <tr>
        <td colspan="3"><hr></td>
    </tr>
    <tr>
        <td colspan="2">Eindruck</td>        
        <td>
            <div id="<?=$groupRecId;?>-BP-L1-1" class="impress">1</div>
            <div id="<?=$groupRecId;?>-BP-L1-3" class="impress">3</div>
            <div id="<?=$groupRecId;?>-BP-L1-5" class="impress">5</div>
        </td>
    </tr>
    <tr>
        <td colspan="3"><hr><hr></td>
    </tr>
    </tbody>
</table>

