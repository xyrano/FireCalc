<script>
    $(document).ready(function() {
        // Wenn Benutzer ein Normaler Benutzer ist also weder Admin noch Auswertung
        // darf dieser keine BWB´s anlegen, ändern oder entfernen
        <?php
        if(sysIsUserUser())
        {
            echo "$('a#new').hide('fast').removeAttr('href');";
            echo "$('a#save').hide('fast').removeAttr('href');";
            echo "$('a#delete').hide('fast').removeAttr('href');";
        }
        ?>
    });
</script>
<fieldset>
    <legend>Feuerwehren</legend>
    <input type="text" id="searchInput" placeholder="Search for .." title="Type in a name"><br>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Landkreis</th>
                <th>Gemeinde</th>
                <th>Feuerwehr</th>
                <!--<th>Mitglieder</th>--> <!-- because of performance issues -->
            </tr>            
        </thead>
        <tbody id="fbody">
            <?php
            /* OLD Behaviour
            $FDS = new FireDeptTable();
            $MI = new MapIterator($FDS->recIdMap);
            while($MI->next())
            {
                $FDT = new FireDeptTable($MI->currentValue());
                //$numOfMemberInFireDept = MemberTable::numOfMemberOfFireDept($FDT->recId);
                //$editable = ($numOfMemberInFireDept>0) ? 0 : 1;
                ?>
                <tr class="select" tableId="<?=FireDeptTable::tableId();?>" id="<?=$FDT->recId;?>">
                    <td><?=$FDT->recId;?></td>
                    <td><span type="enum" enumData="../Municipal/districtEnum.php" name="districtId" mandatory="1"><?=DistrictTable::find($FDT->districtId())->district();?></span></td>
                    <td><span type="enum" enumData="../Municipal/municipalEnum.php" name="municipalId" mandatory="1"><?=MunicipalTable::find($FDT->municipalId())->municipal();?></span></td>
                    <td><span type="text" name="fireDepartment" mandatory="1"><?=$FDT->fireDept();?></span></td>
                    <!--<td><?//=$numOfMemberInFireDept;?></td>--> <!-- because of performance issues -->
                </tr>
                <?php
            }
             */
            $T = new FireDeptTable();
            $T->getRecords();            
            while($T->next()) {
                ?>
                <tr class="select" tableId="<?=FireDeptTable::tableId();?>" id="<?=$T->fldRecId[FLDVALUE];?>">
                    <td><?=$T->fldRecId[FLDVALUE];?></td>
                    <td><span type="enum" enumData="../Municipal/districtEnum.php" name="districtId" mandatory="1"><?=$T->districtTable()->fldDistrict[FLDVALUE];?></span></td>
                    <td><span type="enum" enumData="../Municipal/municipalEnum.php" name="municipalId" mandatory="1"><?=$T->municipalTable()->fldMunicipal[FLDVALUE];?></span></td>
                    <td><span type="text" name="fireDepartment" mandatory="1"><?=$T->fldFireDept[FLDVALUE];?></span></td>
                    <!--<td><?//=$numOfMemberInFireDept;?></td>--> <!-- because of performance issues -->
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>