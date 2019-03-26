<fieldset>
    <legend>Feuerwehren bearbeiten</legend>
    <span id="IdNewEditDelete" style="display: none">edit</span>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Landkreis</th>
                <th>Gemeinde</th>
                <th>Feuerwehr</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            $FDS = new FireDeptTable();
            $MI = new MapIterator($FDS->recIdMap);
            while($MI->next())
            {
                $FDT = new FireDeptTable($MI->currentValue());
                
                $num = MemberTable::numOfMemberOfFireDept($FDT->recId);
                $disabled = ($num > 0) ? "disabled" : "";
                ?>
                <tr>                
                    <td><?=$FDT->recId;?></td>
                    <td>
                        <select id="districtId-<?=$FDT->recId;?>" <?=$disabled;?>>
                            <?php
                            $DS = new DistrictTable();
                            $DI = new MapIterator($DS->recIdMap);
                            $selectedDistricId = "";
                            while($DI->next()) {

                                $T = new DistrictTable($DI->currentValue());
                                if($T->recId == $FDT->districtId())
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
                    <td>
                        <select id="municipalId-<?=$FDT->recId;?>" <?=$disabled;?>>
                            <?php
                            $MS = new MunicipalTable();
                            $MTMI = new MapIterator($MS->recIdMap);
                            $selectedDistricId = "";
                            while($MTMI->next()) {

                                $MT = new MunicipalTable($MTMI->currentValue());
                                if($MT->recId == $FDT->municipalId())
                                {
                                    $selectedDistricId = "selected";
                                }
                                else
                                {
                                    $selectedDistricId = "";
                                }
                                ?>
                                <option value="<?=$MT->recId;?>" <?=@$selectedDistricId;?>><?=$MT->municipal();?></option>
                                <?php
                            }                            
                            ?>
                        </select>
                    </td>
                    <td><input type="text" id="fireDept-<?=$FDT->recId;?>" value="<?=$FDT->fireDept();?>" <?=$disabled;?>></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>

