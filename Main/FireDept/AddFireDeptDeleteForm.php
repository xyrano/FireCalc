<!-- Wenn Mitglieder zur feuerwehr existieren darf diese nicht entfernt werden -->
<fieldset>
    <legend>Feuerwehren entfernen</legend>
    <span id="IdNewEditDelete" style="display: none">delete</span>
    <table>
        <thead>
            <tr>
                <th>-</th>
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
                <td><input type="checkbox" id="fireDept-<?=$FDT->recId;?>" <?=$disabled;?>></td>
                <td><?=$FDT->recId;?></td>
                <td><?=DistrictTable::find($FDT->districtId())->district();?></td>
                <td><?=MunicipalTable::find($FDT->municipalId())->municipal();?></td>
                <td><?=$FDT->fireDept();?></td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>