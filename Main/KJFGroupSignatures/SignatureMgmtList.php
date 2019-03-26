
<fieldset>
    <legend>Unterschriften Übersicht</legend>
    <table>
        <thead>
            <tr>
                <th>LK-Gruppe</th>
                <th>Funktion</th>
                <th>Beschreibung</th>
                <th>Name</th>                
                <th><?=FLDSIGNATUREIMAGE[FLDLABEL]["de"];?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            try
            {      
                /**
                 * Oldbeaviour
                $SI = new SignatureTable(null, @$_GET['idx']);
                $mi = new MapIterator($SI->recIdMap);
                while($mi->next())
                {
                    $ST = new SignatureTable($mi->currentValue());
                    ?>
                <tr class="select" id="<?=$ST->recId;?>" tableId="<?=$ST->tableId();?>">
                    <td><?=GroupTable::find($ST->groupRecId())->groupName();?></td>
                    <td><?=$ST->signatureFunction();?></td>
                    <td><?=$ST->signatureDescription();?></td>
                    <td><?=$ST->surname().", ".$ST->forename();?></td>                    
                    <td><?=$ST->signature(null, 100, 50);?></td>
                </tr>
                    <?php
                }
                 * 
                 */
                $SIG = new SignatureTable(null, @$_GET['idx']);
                while($SIG->next()) {
                    ?>
                    <tr class="select" id="<?=$SIG->fldRecId[FLDVALUE];?>" tableId="<?=$SIG->tableId();?>">
                        <td><?=GroupTable::find($SIG->fldGroupRecId[FLDVALUE])->fldGroupName[FLDVALUE];?></td>
                        <td><?=$SIG->fldFunction[FLDVALUE];?></td>
                        <td><?=$SIG->fldSigDescription[FLDVALUE];?></td>
                        <td><?=$SIG->fldSurname[FLDVALUE].", ".$SIG->fldForename[FLDVALUE];?></td>                    
                        <td><?=$SIG->signature(null, 100, 50);?></td>
                    </tr>
                    <?php
                }
                
            }
            catch(Exception $ex)
            {
                Obj::getException($ex);
            }
            ?>
        </tbody>
    </table>
</fieldset>
