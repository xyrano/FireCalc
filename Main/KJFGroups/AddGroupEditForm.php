<fieldset>
    <legend>Gruppe ändern</legend>
    <span id="IdNewEditDelete" style="display: none">edit</span>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Gruppe</th>
                <th>Beschreibung</th>
                <th>Landkreiszuordnung</th>
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
                    <td><?=$GROUP->recId;?></td>
                    <td><input type="text" id="groupName-<?=$GROUP->recId;?>" value="<?=$GROUP->groupName();?>"></td>
                    <td><input type="text" id="groupDescription-<?=$GROUP->recId;?>" value="<?=$GROUP->groupDescription();?>"></td>
                    <td>                    
                       <select id="districtIdArray-<?=$GROUP->recId;?>" multiple="multiple">
                         <?php
                        $DISTRICTS = new DistrictTable();
                        $MIDI = new MapIterator($DISTRICTS->recIdMap);
                        while($MIDI->next())
                        {
                            $DISTRICT = new DistrictTable($MIDI->currentValue());
                            $selected = ($GROUP->districtMap()->valueExists($DISTRICT->recId)) ? "selected" : "";
                            ?>                   
                            <option value="<?=$DISTRICT->recId;?>" <?=$selected;?>><?=$DISTRICT->district();?></option>                  
                            <?php
                        }
                        ?>
                    </select>                
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>

