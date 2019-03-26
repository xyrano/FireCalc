<fieldset>
    <legend>Feuerwehr zum Wettbewerb hinzufügen</legend>
    <span id="IdNewEditDelete" style="display: none">new</span>
    <table>
        <tr>
            <th>Wettbewerb:</th>
            <th colspan="3"><?=ContestBaseTable::find($_GET['idx'])->contest();?></th>
        </tr>  
        <tr>
            <th><input type="checkbox" id="toggleCheckboxes" value=""><input type="hidden" id="contestId" value="<?=$_GET['idx'];?>"></td>
            <th>Landkreis</th>
            <th>Gemeinde</th>
            <th>Feuerwehr</th>
        </tr>                                         
            <?php
            $FDS = new FireDeptTable();
            $FDSMI = new MapIterator($FDS->recIdMap);
            while($FDSMI->next())
            {
                $FDT = new FireDeptTable($FDSMI->currentValue());
                ?>
                <tr>
                    <td><input type="checkbox" id="fireDept-<?=$FDT->recId;?>" value="<?=$FDT->recId;?>"></td>
                    <td><?=DistrictTable::find($FDT->districtId())->district();?></td>
                    <td><?=MunicipalTable::find($FDT->municipalId())->municipal();?></td>
                    <td><?=$FDT->fireDept();?></td>
                </tr>
                <?php
            }
            ?>             
    </table>
</fieldset>