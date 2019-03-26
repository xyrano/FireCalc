<!-- Wenn feuerwehren einer Gemeinde zugeordnet sind darf die Gemeinde nicht mehr entfernt werden -->
<fieldset>
    <legend>District management</legend>
    <span id="IdNewEditDelete" style="display: none">delete</span>
    <table>
        <thead>
            <tr>
                <th>-</th>
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
                <td><input type="checkbox" id="municipal-<?=$MU->recId;?>" <?=$disabled;?>></td>
                <td><?=$MU->recId;?></td>
                <td><?=DistrictTable::find($MU->districtId())->district();?></td>
                <td><?=$MU->municipal();?></td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>