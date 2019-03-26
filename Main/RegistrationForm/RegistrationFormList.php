<fieldset>
    <legend>Anmeldungen</legend>
    <table>
        <thead>
            <tr>
                <th>Wettbewerb</th>
                <th>Austragungsort</th>
                <th>Datum</th>
                <th>Feuerwehr</th>                
            </tr>
        </thead>
        <tbody>
        <?php
        // 1. Durchlaufe nächste Wettbewerbe ...
        // 2. Durchlaufe für jeden nächsten Wettbewerb die Anmeldungen ...
        /*
        $CTS = new ContestBaseTable(null, null, true, true);
        $mapIt = new MapIterator($CTS->recIdMap);
        while($mapIt->next())
        {
            $CT = new ContestBaseTable($mapIt->currentValue());
         * 
         */
            $CT = new ContestBaseTable(null, true, true);
            $CT->getRecords();
            while($CT->next())
            {
            ?>
            <tr>
                <td><?=$CT->fldContest[FLDVALUE];?></td>
                <td><?=$CT->fldVenue[FLDVALUE];?></td>
                <td><?=$CT->fldContestDate[FLDVALUE];?></td>
                <td>
                    <?php
                    /* OLD behaviour
                    $REGS = new RegistrationTable(null, $CT->fldRecId[FLDVALUE]);
                    $mapIterator = new MapIterator($REGS->recIdMap);
                    while($mapIterator->next()) {
                        $RT = new RegistrationTable($mapIterator->currentValue());
                        ?>
                        <li><?= FireDeptTable::find($RT->fireDeptId())->fireDept();?> - <?=($RT->closed()) ? "bereits erfasst" : "noch nicht erfasst";?></li>
                        <?php
                    }
                     * 
                     */
                    $RT = new RegistrationTable(null, $CT->fldRecId[FLDVALUE]);
                    $RT->getRecords();
                    while($RT->next()) {
                        ?>
                        <li><?= FireDeptTable::findRecId($RT->fldFireDeptId[FLDVALUE])->fldFireDept[FLDVALUE];?> - <?=($RT->fldClosed[FLDVALUE]) ? "bereits erfasst" : "noch nicht erfasst";?></li>
                        <?php
                    }
                    ?>
                </td>
            </tr>           
            <?php
        }
        
        
        ?>
        </tbody>
    </table>
</fieldset>

