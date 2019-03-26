<fieldset>
    <legend>Edit District</legend>
    <span id="IdNewEditDelete" style="display: none">edit</span>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Landkreis</th>
                <th>Gemeinde</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            $MS = new MunicipalTable();
            $MI = new MapIterator($MS->recIdMap);
            while($MI->next())
            {
                $MU = new MunicipalTable($MI->currentValue());
                
                $num = FireDeptTable::numOfFireDeptsInMunicipal($MU->recId);
                $disabled = ($num > 0) ? "disabled" : "";
                ?>
                <tr>
                    <td><?=$MU->recId;?></td>
                    <td>
                        <select id="districtId-<?=$MU->recId;?>" <?=$disabled;?>>
                            <option value="0">Keine Zuordnung</option>
                            <?php
                            $DS = new DistrictTable();
                            $DI = new MapIterator($DS->recIdMap);
                            $selectedDistricId = "";
                            while($DI->next()) {

                                $T = new DistrictTable($DI->currentValue());
                                if($T->recId == $MU->districtId())
                                {
                                    $selectedDistricId = "selected";
                                }
                                else
                                {
                                    $selectedDistricId = "";
                                }
                                ?>
                                <option value="<?=$T->recId;?>" <?=@$selectedDistricId;?>><?=$T->district();?></option>
                                <?php
                            }                            
                            ?>
                        </select>
                    </td>
                    <td><input type="text" id="municipal-<?=$MU->recId;?>" value="<?=$MU->municipal();?>" <?=$disabled;?>></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>

