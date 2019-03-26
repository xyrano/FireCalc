<fieldset>
    <legend>Gruppen</legend>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Gruppe</th>
                <th>Beschreibung</th>
                <th>Zuordnung zu Landkreis</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            /* OLD Beahaviour
            $GROUPS = new GroupTable();
            $MI = new MapIterator($GROUPS->recIdMap);
            while($MI->next())
            {
                $GROUP = new GroupTable($MI->currentValue());
                ?>
            <tr class="select" id="<?=$GROUP->recId;?>" tableId="<?=$GROUP->tableId();?>">
                <td><?=$GROUP->recId;?></td>
                <td><span type="text" name="groupName" mandatory="1"><?=$GROUP->groupName();?></span></td>
                <td><span type="text" name="groupDescription"><?=$GROUP->groupDescription();?></span></td>
                <td>
                    <span type="enum" name="districtIdArray" enumMultiple="1" enumData="../Municipal/districtEnum.php" mandatory="1">
                        
                            <?php
                            $GI = new MapIterator($GROUP->districtMap());
                            while($GI->next()) {
                                echo "<li>".DistrictTable::find($GI->currentValue())->fldDistrict[FLDVALUE]."</li>";
                            }
                            ?>
                    </span>                  
                </td>
            </tr>
                <?php
            }
             * 
             */
            $T =  new GroupTable();
            $T->initAll()->fetch();
            while($T->next()) {
                ?>
                <tr class="select" id="<?=$T->fldRecId[FLDVALUE];?>" tableId="<?=$T->tableId();?>">
                    <td><?=$T->fldRecId[FLDVALUE];?></td>
                    <td><span type="text" name="groupName" mandatory="1"><?=$T->fldGroupName[FLDVALUE];?></span></td>
                    <td><span type="text" name="groupDescription"><?=$T->fldGroupDescription[FLDVALUE];?></span></td>
                    <td>
                    <span type="enum" name="districtIdArray" enumMultiple="1" enumData="../Municipal/districtEnum.php" mandatory="1">
                        
                            <?php
                            $GI = new MapIterator($T->districtMap());
                            while($GI->next()) {
                                echo "<li>".DistrictTable::find($GI->currentValue())->fldDistrict[FLDVALUE]."</li>";
                            }
                            ?>
                    </span>                  
                </td>
                </tr>            
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>