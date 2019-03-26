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
    <legend>District management</legend>
    <table>
        <thead>
            <tr>                
                <th>#ID</th>
                <th>Landkreis</th>
                <th>Anzahl Gemeinden</th>
            </tr>            
        </thead>
        <tbody>
            <?php            
            /* OLD Behaviour
            $DISTRICTS = new DistrictTable();
            $MI = new MapIterator($DISTRICTS->recIdMap);
            while($MI->next())
            {
                $DISTRICT = new DistrictTable($MI->currentValue());
                                
                ?>
            <tr class="select" tableId="<?= DistrictTable::tableId();?>" id="<?=$DISTRICT->recId;?>">                    
                    <td><?=$DISTRICT->recId;?></td>
                    <td><span type="text" name="district" mandatory="1"><?=$DISTRICT->district();?></span></td>
                    <td><?=MunicipalTable::numOfMunicipalsInDistrict($DISTRICT->recId);?></td>                    
                </tr>
                <?php
            }
            */
            $T = new DistrictTable();
            $T->getRecords();
            while($T->next())
            {
                ?>
                <tr class="select" tableId="<?=$T->fldTableId[FLDVALUE];?>" id="<?=$T->fldRecId[FLDVALUE];?>">
                    <td><?=$T->fldRecId[FLDVALUE];?></td>
                    <td><span type="text" name="district" mandatory="1"><?=$T->fldDistrict[FLDVALUE];?></span></td>
                    <td><?=MunicipalTable::numOfMunicipalsInDistrict($T->fldRecId[FLDVALUE]);?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>