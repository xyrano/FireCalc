<script>
    $(document).ready(function() {
       $.fn.TT_New();       
    });
</script>
<?php
$disableIdentityNum = 1;
if(AdminSetup::findRecId()->fldAutoMemderIdentificationID[FLDVALUE] > 0)
{
    $newNum = SysNumberSeqTable::newNum("M######");    
    $disableIdentityNum = 0;
}
$T = new MemberTable(); // for label purposes
?>
<fieldset Create="true" tableId="<?= MemberTable::tableId();?>">
    <legend>Neues Mitglied erfassen</legend>     
    <table>
        <tbody>
        <tr>
            <td><?=$T->fldIdentityNum[FLDLABEL]["de"];?></td>
            <td><span id="Create" type="text" name="identityNum" mandatory="1" editable="<?=$disableIdentityNum;?>"><?=($disableIdentityNum == 0) ? $newNum : "";?></span></td>
        </tr>
        <tr>
            <td><?=$T->fldGender[FLDLABEL]["de"];?></td>
            <td><span type="enum" id="Create" enumData="./genderEnum.php" name="gender" mandatory="1"></span></td>
        </tr>
        <tr>
            <td>Nachname:</td>
            <td><span type="text" id="Create" name="surname"></span></td>
        </tr>
        <tr>
            <td>Vorname:</td>
            <td><span type="text" id="Create" name="forename"></span></td>
        </tr>
        <tr>
            <td>Geburtsdatum:</td>
            <td><span type="date" id="Create" name="birthday" mandatory="1"></span></td>
        </tr>         
        <tr>
            <td>Eintrittsdatum:</td>
            <td><span type="date" id="Create" name="entryDate"></span></td>
        </tr>
        <tr>
            <td>Feuerwehr:</td>
            <td><span type="enum" id="Create" enumData="../FireDept/fireDeptEnum.php" name="fireDeptId"></span></td>
        </tr>
        </tbody>        
    </table>    
</fieldset>