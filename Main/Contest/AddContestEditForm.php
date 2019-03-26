<!-- Wettbewerbe dürfen nur geändert werden sofern noch keine Feuerwehr hinzugefügt wurde -->
<fieldset>
    <legend>Edit Contest</legend>
    <span id="IdNewEditDelete" style="display: none">edit</span>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Landkreis</th>
                <th>Wettbewerb Datum</th>
                <th>Wettbewerb</th>
                <th>Offenes Gewässer</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            $CONTESTS = new ContestBaseTable();
            $MI = new MapIterator($CONTESTS->recIdMap);
            while($MI->next())
            {
                $CONTEST = new ContestBaseTable($MI->currentValue());
                
                $num = FireDept2ContestTable::numOfFireDepartmentsInContest($CONTEST->recId);
                $disabled = ($num > 0) ? "disabled" : "";
                ?>
            <tr>
                <td><?=$CONTEST->recId;?></td>
                <td>
                    <select id="districtId-<?=$CONTEST->recId;?>" <?=$disabled;?>>
                    <?php
                        if(sysIsUserGroupUser())
                        {
                            ?>
                            <option value="<?=$CONTEST->provideInDistrict();?>"><?=DistrictTable::find($CONTEST->provideInDistrict())->district();?></option>
                            <?php
                        }
                        else
                        {
                            $DTS = new DistrictTable();
                            $DTSMI = new MapIterator($DTS->recIdMap);
                            while($DTSMI->next())
                            {
                                $DT = new DistrictTable($DTSMI->currentValue());
                                $selected = ($DT->recId == $CONTEST->provideInDistrict()) ? "selected" : "";
                                ?>
                                <option value="<?=$DT->recId;?>" <?=$selected;?>><?=$DT->district();?></option>
                                <?php
                            }
                        }
                    ?>
                    </select>
                
                </td>                
                <td><input type="date" id="contestdate-<?=$CONTEST->recId;?>" value="<?=$CONTEST->contestDate();?>" <?=$disabled;?>></td>
                <td><input type="text" id="contest-<?=$CONTEST->recId;?>" value="<?=$CONTEST->contest();?>" <?=$disabled;?>></td>
                <td><input type="checkbox" id="openwater-<?=$CONTEST->recId;?>" value="" <?=($CONTEST->openWater()) ? "checked" : "";?> <?=$disabled;?>></td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>

