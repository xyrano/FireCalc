<fieldset>
    <legend>Delete User</legend>
    <span id="IdNewEditDelete" style="display: none">delete</span>
    <table>
        <thead>
            <tr>
                <th>-</th>
                <th>#ID</th>
                <th>Benutzername</th>
                <th>Landkreisgruppe</th>
                <th>Feuerwehr</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            $USERS = new UserTable();
            $MI = new MapIterator($USERS->recIdMap);
            while($MI->next())
            {
                $USER = new UserTable($MI->currentValue());
                if($USER->username() != SysConstants::sysAdminName)
                {
                    ?>
                <tr>
                    <td><input type="checkbox" id="user-<?=$USER->recId;?>"></td>
                    <td><?=$USER->recId;?></td>
                    <td><?=$USER->username();?></td>
                    <td><?=GroupTable::find($USER->groupId())->groupName();?></td>
                    <td><?= FireDeptTable::find($USER->fireDeptId())->fireDept();?></td>
                </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</fieldset>