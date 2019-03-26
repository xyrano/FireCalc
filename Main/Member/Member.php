<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Member", true, "member.js");
?>


<br>

<?php
$T = new MemberGroupTable($_GET['idx']);
?>
<fieldset>
    <legend>Mitglieder der Gruppe [<?=$T->fldGroupName[FLDVALUE];?>]</legend>
    <table>
        <thead>
            <tr>
                <th>Num</th>
                <th>Mitglied</th>
                <th>Alter</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $MI = new MapIterator(unserialize(base64_decode($T->fldMemberIdMap[FLDVALUE])));
        while($MI->next())
        {
            $M = new MemberTable($MI->currentValue());
            $age = DateTimeUtil::getAge($M->fldBirthday[FLDVALUE]);
            ?>
            <tr class="select" tableId="<?= MemberTable::tableId();?>" id="<?=$M->fldRecId[FLDVALUE];?>">
                <td><?=$M->fldIdentityNum[FLDVALUE];?></td>
                <td><?=$M->fldForename[FLDVALUE]." ".$M->fldSurname[FLDVALUE];?></td>
                <td><?=$age;?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td><?=$T->getAverageAge(2);?></td>
            </tr>
        </tfoot>
    </table>
</fieldset>


<?php
echo FormRun::createPageFooter(true);
?>