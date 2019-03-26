<?php
// Manual Insert all FireDepartments
if(@$_GET['addFireDepartments'] == "1")
{
    try
    {
        /* OLD Behaviour
        $RegFire = new RegistrationTable(null, @$_GET['idx'], true);
        $RegFireIter = new MapIterator($RegFire->recIdMap);
        while($RegFireIter->next())
        {
            $REGISTRATION = new RegistrationTable($RegFireIter->currentValue());
            $FDT = new FireDeptTable($REGISTRATION->fireDeptId());
            $contestId = $_GET['idx'];
            $T = new FireDept2ContestTable();
            $T->contestId($contestId);
            $T->districtId($FDT->districtId());
            $T->municipalId($FDT->municipalId());
            $T->fireDeptId($FDT->recId);
            $ret = $T->insert();
            if($ret)
            {
                $REGISTRATION->closed(true);
                $REGISTRATION->update();
            }
        }
         * 
         */
        $R = new RegistrationTable(null, @$_GET['idx'], true);
        $R->ttsbegin();
        $R->getRecords();
        while($R->next()) {
            $FDT = new FireDeptTable($R->fldFireDeptId[FLDVALUE]);
            
            $T = new FireDept2ContestTable();
            $T->ttsbegin();
            $T->fldContestId[FLDVALUE] = @$_GET['idx'];
            $T->fldDistrictId[FLDVALUE] = $FDT->fldDistrictId[FLDVALUE];
            $T->fldMunicpilaId[FLDVALUE] = $FDT->fldMunicipalId[FLDVALUE];
            $T->fldFireDeptId[FLDVALUE] = $FDT->fldRecId[FLDVALUE];
            if($T->insert()) {
                $T->ttscommit();
                $R->fldClosed[FLDVALUE] = 1;
                $R->doUpdate();
            }
        }
        $R->ttscommit();
        $R = null;
    }
    catch(Exception $ex)
    {
        Obj::getException($ex);
    }
}
?>
<fieldset>
    <legend>Feuerwehren in diesem Wettbewerb [<?=ContestBaseTable::find($_GET['idx'])->fldContest[FLDVALUE];?>]</legend>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Wettbewerb</th>
                <th>Landkreis</th>
                <th>Gemeinde</th>
                <th>Feuerwehr</th>
                <th>Gruppenanzahl</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            try
            {
                /* OLD BEHAVIOUR
                $TS = new FireDept2ContestTable(null, @$_GET['idx']);
                $MI = new MapIterator($TS->recIdMap);

                while($MI->next())
                {
                    $T = new FireDept2ContestTable($MI->currentValue());
                    ?>
                <tr>
                    <td><?=$T->recId;?></td>
                    <td><?=ContestBaseTable::find($T->contestId())->contest();?></td>
                    <td><?=DistrictTable::find($T->districtId())->district();?></td>
                    <td><?=MunicipalTable::find($T->municipalId())->municipal();?></td>
                    <td><?=FireDeptTable::find($T->fireDeptId())->fireDept();?></td>
                    <td><?=MemberGroupTable::numGroupsOfFireDept($T->contestId(), $T->fireDeptId());?></td>
                </tr>
                    <?php
                 * 
                 */
                $T = null; // from above
                $T = new FireDept2ContestTable(null, @$_GET['idx']);
                $T->getRecords();
                while($T->next())
                {
                    ?>
                    <tr class="select" tableId="<?=$T->fldTableId[FLDVALUE];?>" id="<?=$T->fldRecId[FLDVALUE];?>">
                        <td><?=$T->fldRecId[FLDVALUE];?></td>
                        <td><?=$T->contestTable()->fldContest[FLDVALUE];?></td>
                        <td><?=$T->contestTable()->districtTable()->fldDistrict[FLDVALUE];?></td>
                        <td><?=$T->contestTable()->municipalTable()->fldMunicipal[FLDVALUE];?></td>
                        <td><?=$T->fireDeptTable()->fldFireDept[FLDVALUE];?></td>
                        <td><?=MemberGroupTable::numGroupsOfFireDept($T->fldContestId[FLDVALUE], $T->fldFireDeptId[FLDVALUE]);?></td>
                    </tr>
                    <?php
                }
            }
            catch(Exception $ex)
            {
                Obj::getException($ex);
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Ausstehende Anmeldungen: [<?=RegistrationTable::amountOfDisclosedRegistrations($T->fldContestId[FLDVALUE]);?>]</td>
            </tr>
        </tfoot>
    </table>
</fieldset>

<?php
// Wenn ausstehende Registrierungen vorhanden sind sowie Admin Session oder ausschließlich GruppenBenutzer (KJF) dann scahue rein
$amount = RegistrationTable::amountOfDisclosedRegistrations(@$_GET['idx']);
if($amount > 0  && (sysIsUserAdmin() || sysIsUserGroupUser()) )
{
    ?>
    <br>
    <fieldset>
        <legend>Es sind bereits ausstehende Registrierungen vorhanden!</legend>
        <?php
        $R = new RegistrationTable(null, @$_GET['idx'], true);
        $R->getRecords();
        while($R->next())
        {
            ?>
            <li><?= FireDeptTable::findRecId($R->fldFireDeptId[FLDVALUE])->fldFireDept[FLDVALUE];?></li>
            <?php
        }
        ?>
            <a href="<?= sysGetPhpSelf();?>&addFireDepartments=1">hinzufügen</a>
    </fieldset>
    <?php
    
}
?>