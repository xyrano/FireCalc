<fieldset>
    <legend>Gruppe entfernen</legend>
    <span id="IdNewEditDelete" style="display: none">delete</span>
    <table>
        <thead>
            <tr>
                <th>-</th>
                <th>#ID</th>
                <th>Gruppe</th>
                <th>Beschreibung</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            $GROUPS = new GroupTable();
            $MI = new MapIterator($GROUPS->recIdMap);
            while($MI->next())
            {
                $GROUP = new GroupTable($MI->currentValue());
                ?>
            <tr>
                <td><input type="checkbox" id="groupName-<?=$GROUP->recId;?>"></td>
                <td><?=$GROUP->recId;?></td>
                <td><?=$GROUP->groupName();?></td>
                <td><?=$GROUP->groupDescription();?></td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>