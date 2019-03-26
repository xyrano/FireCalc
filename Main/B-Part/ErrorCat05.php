<!-- ErrorCat05 => Error catalogue Läufer 5

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


<b>Fehlerkatalog: Läufer 5</b><br><br>
<table border="0">
    <tbody>
    <tr>
        <td>1.</td>
        <td colspan="2">Mängel in der persönlichen Ausrüstung</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; kein DJF-Übungsanzug</td>
        <td class="num" id="<?=$groupRecId;?>-1-1-L5">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; kein DJF-Schutzhelm</td>
        <td class="num" id="<?=$groupRecId;?>-1-2-L5">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; keine Sportschuhe gemäß Ausschreibung</td>
        <td class="num" id="<?=$groupRecId;?>-1-3-L5">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; keine Schutzhandschuhe</td>
        <td class="num" id="<?=$groupRecId;?>-1-4-L5">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; kein Brusttuch Nummer 1</td>
        <td class="num" id="<?=$groupRecId;?>-1-5-L5">5</td>
    </tr>
    <tr>
        <td>2.</td>
        <td>Läufer 5 liegt nicht ordnungsgemäß auf der Krankentrage</td>
        <td class="num" id="<?=$groupRecId;?>-2-1-L5">10</td>
    </tr>
    <tr>
        <td>3.</td>
        <td>Arbeiten vor Ablage des Staffelstabes</td>
        <td class="num" id="<?=$groupRecId;?>-3-1-L5">50</td>
    </tr>
    <tr>
        <td>4.</td>
        <td>Staffelstab von Läufer 4 nicht auf die Schutzhadschuhe von Läufer 5 gelegt</td>
        <td class="num" id="<?=$groupRecId;?>-4-1-L5">10</td>
    </tr>
    <tr>
        <td>5.</td>
        <td>Läufer 5 verlässt ohne vollständig angelegte Schutzausrüstung den markierten Bereich</td>
        <td class="num" id="<?=$groupRecId;?>-5-1-L5">20</td>
    </tr>
    <tr>
        <td>6.</td>
        <td>Läufer 5 verlässt ohne angelegte Schutzausrüstung den markierten Bereich</td>
        <td class="num" id="<?=$groupRecId;?>-6-1-L5">50</td>
    </tr>
    <tr>
        <td colspan="3"><hr></td>
    </tr>
    <tr>
        <td colspan="2">Fehlerpunkte</td>
        <td id="errorPointsL5">0</td>
    </tr>
    <tr>
        <td colspan="3"><hr></td>
    </tr>    
    <tr>
        <td colspan="2">Eindruck</td>        
        <td>
            <div id="<?=$groupRecId;?>-BP-L5-1" class="impress">1</div>
            <div id="<?=$groupRecId;?>-BP-L5-3" class="impress">3</div>
            <div id="<?=$groupRecId;?>-BP-L5-5" class="impress">5</div>
        </td>
    </tr>
    <tr>
        <td colspan="3"><hr><hr></td>
    </tr>
    </tbody>
</table>

