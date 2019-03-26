<fieldset>
    <legend>User management</legend>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Landkreisgruppe</th>  
                <th>Feuerwehr</th>
                <th>Online</th>
            </tr>
        </thead>
        <tbody id="fbody">
            <?php
            /* OLD Behaviour
            $USERS = new UserTable();
            $MI = new MapIterator($USERS->recIdMap);

            while($MI->next())
            {
                $USER = new UserTable($MI->currentValue());
                ?>
                <tr class="select" tableId="<?= UserTable::tableId();?>" id="<?=$USER->recId;?>">
                    <td><?=$USER->recId;?></td>
                    <?php
                    // Der "admin" User darf nicht umbenannt werden!
                    if($USER->username() == SysConstants::sysAdminName)
                    {
                        ?>
                        <td><?=$USER->username();?></td>
                        <?php
                    }
                    else
                    {
                        ?>
                        <td><span type="text" name="username" mandatory="1"><?=$USER->username();?></span></td>
                        <?php
                    }
                    ?>
                    <td><span type="enum" enumData="../KJFGroups/groupEnum.php" name="groupId"><?=GroupTable::find($USER->groupId())->groupName();?></span></td>
                    <td><span type="enum" enumData="../FireDept/fireDeptEnum.php" name="fireDeptId"><?=FireDeptTable::findRecId($USER->fireDeptId())->fldFireDept[FLDVALUE];?></span></td>
                    <td>
                        <?php
                        $UOS = new UserOnline();
                        $UOMI = new MapIterator($UOS->recIdMap);
                        while($UOMI->next())
                        {
                            $UO = new UserOnline($UOMI->currentValue());
                            if($UO->userRecId() == $USER->recId) {
                                echo "Online";
                            }
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
             * 
             */
            
            $T = new UserTable();
            $T->initAll()->fetch();
            while($T->next()) {
               
                // und auch nicht gelöscht werden
                if($T->fldUsername[FLDVALUE] == SysConstants::sysAdminName)
                { 
                    ?>
                    <tr class="select" tableId="-1" id="-1">
                    <?php
                }
                else
                {
                    ?>
                    <tr class="select" tableId="<?= UserTable::tableId();?>" id="<?=$T->fldRecId[FLDVALUE];?>">
                    <?php
                }
                ?>                
                    <td><?=$T->fldRecId[FLDVALUE];?></td>
                    <?php
                    // Der "admin" User darf nicht umbenannt werden!
                    // und auch nicht gelöscht werden
                    if($T->fldUsername[FLDVALUE] == SysConstants::sysAdminName)
                    {
                        ?>
                        <td><?=$T->fldUsername[FLDVALUE];?></td>
                        <?php
                    }
                    else
                    {
                        ?>
                        <td><span type="text" name="username" mandatory="1"><?=$T->fldUsername[FLDVALUE];?></span></td>
                        <?php
                    }
                    ?>
                    <td><span type="enum" enumData="../KJFGroups/groupEnum.php" name="groupId"><?=GroupTable::find($T->fldGroupId[FLDVALUE])->fldGroupName[FLDVALUE];?></span></td>
                    <td><span type="enum" enumData="../FireDept/fireDeptEnum.php" name="fireDeptId"><?=FireDeptTable::findRecId($T->fldFireDeptId[FLDVALUE])->fldFireDept[FLDVALUE];?></span></td>
                    <td>
                        <?php
                        /* OLD Behaviour
                        $UOS = new UserOnline();
                        $UOMI = new MapIterator($UOS->recIdMap);
                        while($UOMI->next())
                        {
                            $UO = new UserOnline($UOMI->currentValue());
                            if($UO->userRecId() == $T->fldRecId[FLDVALUE]) {
                                echo "Online";
                            }
                        }
                         * 
                         */
                        $UOS = new UserOnline();
                        $UOS->initAll()->fetch();
                        while($UOS->next()) {
                            if($UOS->fldUserRecId[FLDVALUE] == $T->fldRecId[FLDVALUE]) {
                                echo "Online";
                            }
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>

