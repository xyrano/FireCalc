<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Member Export", true, "memberExportImport.js");
?>


<?php
$MT = new MemberTable();
$MT->getRecords();
?>


<fieldset>
    <legend>Mitglieder Exportieren</legend>
    Zurzeit sind <?=$MT->getNumOfRows();?> Mitglieder eingetragen.


    <form action="Export.php" method="post">
        Einrschränken auf Feuerwehr: 
        <select name="fireDeptIdFilter">            
        <?php
            if(sysIsUserAdmin())
            {
                ?>
                <option value="-1">Alle</option>
                <?php
            }
            $F = new FireDeptTable();
            $F->getRecords();
            while($F->next())
            {
                ?>
                <option value="<?=$F->fldRecId[FLDVALUE];?>"><?=$F->fldFireDept[FLDVALUE] . " " . $F->getNumOfMemberInFireDept();?></option>
                <?php
            }
        ?>
        </select>
        <br>
        Dateiformat: 
        <select name="fileType">
            <option value="ods">ods</option>
            <option value="xls">xls</option>
            <option value="xlsx" selected>xlsx</option>
        </select>
        <input type="submit" name="downlaod" value="Export">
    </form>
</fieldset>

<?php
echo FormRun::createPageFooter(true);
?>
