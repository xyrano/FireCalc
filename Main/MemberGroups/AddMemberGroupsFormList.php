<script>
    $(document).ready(function() {                      
        // Wenn die Auswertung beendet ist, darf hier nichts mehr geändert werden
        // darf dieser keine Gruppen anlegen, ändern oder entfernen
        <?php
        if(ContestBaseTable::find(@$_GET['idx'])->fldContestIsCalculated[FLDVALUE])
        {
            echo "$('a#new').hide('fast').removeAttr('href');";
            echo "$('a#save').hide('fast').removeAttr('href');";
            echo "$('a#update').hide('fast').removeAttr('href');";
            echo "$('a#delete').hide('fast').removeAttr('href');";
        }
        ?>
    });
</script>
<fieldset>
    <legend>Gruppen</legend>
    <table>
        <thead>
            <tr>
                <th>Wettbewerb</th>
                <th>Feuerwehr</th>
                <th>Gruppenname</th>
                <th>Anzahl Mitglieder</th>
                <th>Durschnittsalter</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $T = new MemberGroupTable(null, @$_GET['idx']); // Contest is resolved to district for filtering            
            $T->getRecords();
            while($T->next())
            {
                ?>
            <tr class="select" tableId="<?= MemberGroupTable::tableId();?>" id="<?=$T->fldRecId[FLDVALUE];?>">
                <td><?=ContestBaseTable::find($T->fldContestId[FLDVALUE])->fldContest[FLDVALUE];?></td>
                <td><?=FireDeptTable::findRecId($T->fldFireDeptId[FLDVALUE])->fldFireDept[FLDVALUE];?></td>
                <td><?=$T->fldGroupName[FLDVALUE];?></td>
                <td><?= unserialize(base64_decode($T->fldMemberIdMap[FLDVALUE]))->getLength();?></td>
                <td><?=$T->getAverageAge(2);?></td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>