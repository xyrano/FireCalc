<!-- ErrorCat07 => Error catalogue Läufer 7

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


<b>Fehlerkatalog: Läufer 7</b><br><br>
<table border="0">
    <tbody>
    <tr>
        <td>1.</td>
        <td colspan="2">Mängel in der persönlichen Ausrüstung</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; kein DJF-Übungsanzug</td>
        <td class="num" id="<?=$groupRecId;?>-1-1-L7">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; kein DJF-Schutzhelm</td>
        <td class="num" id="<?=$groupRecId;?>-1-2-L7">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; keine Sportschuhe gemäß Ausschreibung</td>
        <td class="num" id="<?=$groupRecId;?>-1-3-L7">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; keine Schutzhandschuhe</td>
        <td class="num" id="<?=$groupRecId;?>-1-4-L7">10</td>
    </tr>
    <tr>
        <td></td>
        <td>&bullet; kein Brusttuch Nummer 1</td>
        <td class="num" id="<?=$groupRecId;?>-1-5-L7">5</td>
    </tr>
    <tr>
        <td>2.</td>
        <td>Arbeiten vor Staffelstab-Übergabe</td>
        <td class="num" id="<?=$groupRecId;?>-2-1-L7">50</td>
    </tr>
    <tr>
        <td>3.</td>
        <td>Staffelstab nicht korrekt übernommen</td>
        <td class="num" id="<?=$groupRecId;?>-3-1-L7">10</td>
    </tr>
    <tr>
        <td>4.</td>
        <td>Läufer 7 hat mit Läufer 8 nicht ordnungsgemäß gekuppelt</td>
        <td class="num" id="<?=$groupRecId;?>-4-1-L7">5</td>
    </tr>
    <tr>
        <td>5.</td>
        <td>Beim Kuppeln übergegriffen</td>
        <td class="num" id="<?=$groupRecId;?>-5-1-L7">5</td>
    </tr>
    <tr>
        <td colspan="3"><hr></td>
    </tr>
    <tr>
        <td colspan="2">Fehlerpunkte</td>
        <td id="errorPointsL7">0</td>
    </tr>
    <tr>
        <td colspan="3"><hr></td>
    </tr>    
    <tr>
        <td colspan="2">Eindruck</td>        
        <td>
            <div id="<?=$groupRecId;?>-BP-L7-1" class="impress">1</div>
            <div id="<?=$groupRecId;?>-BP-L7-3" class="impress">3</div>
            <div id="<?=$groupRecId;?>-BP-L7-5" class="impress">5</div>
        </td>
    </tr>
    <tr>
        <td colspan="3"><hr><hr></td>
    </tr>
    </tbody>
</table>

