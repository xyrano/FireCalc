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
<style>
    .show {
        display: compact;
    }
    
    edit {
        
    }
    
    .hide {
        display: none;
    }
    
    
</style>
<?php
$DISTRICT = new DistrictTable();
?>

<!--
TD Propertys:
type: text, date, time, datetime, enum, checkbox
name: str (individual name)
editable: true/false 1/0
mandatory: true/false 1/0
enumData: URL to JSON file
enumMultiple: true/false 1/0
-->

<fieldset>
    <legend>Municipal management</legend>
    <input type="text" id="searchInput" placeholder="Search for .." title="Type in a name"><br>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Landkreis</th>
                <th>Gemeinde</th>
                <th>Anzahl Feuerwehren</th>
            </tr>            
        </thead>
        <tbody id="fbody">
            <?php
            /* OLD Behaviour
            $MS = new MunicipalTable();
            $MI = new MapIterator($MS->recIdMap);
            while($MI->next())
            {
                $MU = new MunicipalTable($MI->currentValue());   
                $numOfFireDeptsInMunicipal = FireDeptTable::numOfFireDeptsInMunicipal($MU->recId);
                $editable = ($numOfFireDeptsInMunicipal>0) ? 0 : 1;
                ?>
                <tr class="select" id="<?=$MU->recId;?>" tableId="<?=$MU->tableId();?>">  
                    <td><?=$MU->recId;?></td>
                    <td><span type="enum" name="districtId" enumData="./districtEnum.php" mandatory="true" editable="<?=$editable;?>"><?= DistrictTable::find($MU->districtId())->district();?></span></td>                    
                    <td><span type="text" name="municipal" mandatory="true" editable="<?=$editable;?>"><?=$MU->municipal();?></span></td>
                    <td><?=$numOfFireDeptsInMunicipal;?></td>
                </tr>
                <?php
            }
             */
            $T = new MunicipalTable();
            $T->getRecords();           
            while($T->next()) { 
                $numOfFireDeptsInMunicipal = FireDeptTable::numOfFireDeptsInMunicipal($T->fldRecId[FLDVALUE]);
                $editable = ($numOfFireDeptsInMunicipal>0) ? 0 : 1;
                ?>
                <tr class="select" id="<?=$T->fldRecId[FLDVALUE];?>" tableId="<?=$T->fldTableId[FLDVALUE];?>">  
                    <td><?=$T->fldRecId[FLDVALUE];?></td>
                    <td><span type="enum" name="districtId" enumData="./districtEnum.php" mandatory="true" editable="<?=$editable;?>"><?=$T->DistrictTable()->fldDistrict[FLDVALUE];?></span></td>                    
                    <td><span type="text" name="municipal" mandatory="true" editable="<?=$editable;?>"><?=$T->fldMunicipal[FLDVALUE];?></span></td>
                    <td><?=$numOfFireDeptsInMunicipal;?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>