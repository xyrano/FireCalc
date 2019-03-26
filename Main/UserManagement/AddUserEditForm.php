<fieldset>
    <legend>Edit User</legend>
    <span id="IdNewEditDelete" style="display: none">edit</span>
    <table>
        <thead>
            <tr>
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
                // Nur nicht Admin editieren
                if($USER->username() != SysConstants::sysAdminName)
                {
                    ?>
                <tr>
                    <td><?=$USER->recId;?></td>
                    <td><input type="text" id="user-<?=$USER->recId;?>" value="<?=$USER->username();?>"></td>
                    <td>
                        <select id="groupId-<?=$USER->recId;?>">
                            <option value="0">Keine Zuordnung</option>
                            <?php
                            $GS = new GroupTable();
                            
                            $MIGS = new MapIterator($GS->recIdMap);
                            while($MIGS->next()) 
                            {
                                $T = new GroupTable($MIGS->currentValue());
                                $selected = ($T->recId == $USER->groupId()) ? "selected" : "";
                                ?>
                                <option value="<?=$T->recId;?>" <?=$selected;?>><?=$T->groupName();?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>    
                    <td>
                        <select id="fireDeptId-<?=$USER->recId;?>">
                            <option value="0">-</option>
                            <?php
                            $FS = new FireDeptTable();
                            $MIFS = new MapIterator($FS->recIdMap);
                            while($MIFS->next()) {
                                $FDT = new FireDeptTable($MIFS->currentValue());
                                $selectedFD = ($FDT->recId == $USER->fireDeptId()) ? "selected" : "";
                                ?>
                                <option value="<?=$FDT->recId;?>" <?=$selectedFD;?>><?=$FDT->fireDept();?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>                        
                </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</fieldset>

