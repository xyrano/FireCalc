<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Member Groups", true, "membergroupsChooser.js");
?>


<br>
<fieldset>
    <legend>Bundeswettbewerb wählen</legend>
    <table>
            <thead>
                <tr>
                    <th>Bundeswettbewerb</th>
                    <th>Feuerwehr</th>
                </tr>                   
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select id="contestId" size="1">
                        <?php                       
                        $CBT = new ContestBaseTable(null, null, true);
                        $CBT->getRecords();
                        while($CBT->next()) 
                        {
                            if(FireDept2ContestTable::exist($CBT->fldRecId[FLDVALUE], Obj::user()->fldFireDeptId[FLDVALUE]))
                            {
                                ?>
                                <option value="<?=$CBT->fldRecId[FLDVALUE];?>"><?=$CBT->fldContestDate[FLDVALUE]."-".$CBT->fldContest[FLDVALUE];?></option>
                                <?php
                            }
                        }
                        ?>
                        </select>
                    </td>
                    <td>
                        <input type='hidden' id='fireDeptId' value="<?=Obj::user()->fldFireDeptId[FLDVALUE];?>">
                        <input type="text" id='fireDeptName' value='<?= FireDeptTable::findRecId(Obj::user()->fldFireDeptId[FLDVALUE])->fldFireDept[FLDVALUE];?>' disabled="true">
                        <input type="button" id="MemberGroups" value="Gruppen verwalten">
                    </td>                    
                </tr>                    
            </tbody>
        </table>
</fieldset>



<?php
echo FormRun::createPageFooter(true);
?>
