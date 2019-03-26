<fieldset>
    <legend>Municipal management</legend>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Landkreis</th>
                <th>Gemeinde</th>
                <th>Anzahl Feuerwehren</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            $MS = new MunicipalTable();
            $MI = new MapIterator($MS->recIdMap);
            while($MI->next())
            {
                $MU = new MunicipalTable($MI->currentValue());
                ?>
                <tr class="select" id="<?=$MU->recId;?>">  
                    <td><?=$MU->recId;?></td>
                    <td contenteditable="true" id="districtRecId-<?=$MU->recId;?>"><?=DistrictTable::find($MU->districtId())->district();?></td>
                    <td contenteditable="true" id="nunicipal-<?=$MU->recId;?>"><?=$MU->municipal();?></td>
                    <td><?=FireDeptTable::numOfFireDeptsInMunicipal($MU->recId);?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>