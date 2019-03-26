<!-- TODO: hat Eine Auswertung für diese Gruppe begonnen, dann darf die Gruppe nciht mehr gelöscht werden, nur noch disqualifizierung möglich -->
<!-- evtl. Kann der KJF Admin Berechtigung dazu erhalten!? -->

<fieldset>
    <legend>Gruppe löschen</legend>
    <span id="IdNewEditDelete" style="display: none">delete</span>
    <table>
        <thead>
            <tr>
                <th>-</th>
                <th>#ID</th>
                <th>Wettbewerb</th>
                <th>Feuerwehr</th>
                <th>Gruppenname</th>
                <th>Anzahl Mitglieder</th>
                <th>Durchschnittsalter</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            $MGTS = new MemberGroupTable(null, $_GET['idx']);
            $MI = new MapIterator($MGTS->recIdMap);
            while($MI->next())
            {
                $T = new MemberGroupTable($MI->currentValue());
                ?>
                <tr>
                    <td><input type="checkbox" id="user-<?=$T->recId;?>"></td>
                    <td><?=$T->recId;?></td>
                    <td><?=  ContestBaseTable::find($T->contestId())->contest();?></td>
                    <td><?=  FireDeptTable::find($T->fireDeptId())->fireDept();?></td>
                    <td><?=$T->groupName();?> <?=$T->groupSuffix();?></td>
                    <td><?=$T->memberIdMap()->getLength();?></td>
                    <td><?=$T->getAverageAge(2);?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>
