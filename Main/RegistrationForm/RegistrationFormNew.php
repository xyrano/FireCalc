<fieldset>
    <legend>Neue Anmeldung</legend>
    
    <?php
    $valid = true;
    
    
    // Check if an Contest is open (future Date and not posted)
    $num = ContestBaseTable::checkOnContestIsOpen();
    if($num == 0)
    {        
        $valid = false;             
    } 
   
    
    // Check if User is assigend to an FireDept
    if($valid && Obj::user()->fldFireDeptId[FLDVALUE] <= 0)
    {
        $valid = false;
    }
    
    
    // Check if FireDept already exists for this contest:
     // -> can only be checked in save method or on programmatically way by jQuery and a chain select
   
    
    if($valid)
    {
        ?>
        <br>
        Hiermit melde ich (<?=UserOnline::find()->fldUserName[FLDVALUE];?>) die Feuerwehr (<?= FireDeptTable::findFromUser()->fldFireDept[FLDVALUE];?>) verbindlich zum Bundeswettbewerb an. 
        <br>
        Eine spätere Absage ist möglich, könnte aber mit 0 Punkten gewertet werden!
        <br>
        <table>
            <thead>
                <tr>
                    <td>Bundeswettbewerb</td>
                    <td>Feuerwehr</td>
                    <td>Verbindlich bestätigt</td>
                </tr>                   
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select id="contestId" size="1">
                        <?php                        
                        $CTS = new ContestBaseTable(null, true, true);
                        $CTS->getRecords();
                        while($CTS->next()) {
                            ?>
                            <option value="<?=$CTS->fldRecId[FLDVALUE];?>"><?=$CTS->fldContestDate[FLDVALUE];?> - <?=$CTS->fldContest[FLDVALUE];?></option>
                            <?php
                        }
                        
                        $F = FireDeptTable::findFromUser();
                        ?>
                        </select>
                    </td>
                    <td><input type='hidden' id='fireDeptId' value="<?=$F->fldRecId[FLDVALUE];?>">
                        <input type="text" id='fireDeptName' value='<?=$F->fldFireDept[FLDVALUE];?>' disabled="true"></td>
                    <td><input type="checkbox" id="confirmed" value=""></td>
                </tr>                    
            </tbody>
        </table>
        <?php
    }
    else
    {
        ?>
        <fieldset>
        Sie können sich nicht anmelden aus folgenden Gründen:
        <ol>
            <li>Es sind zurzeit keine Wettbewerbe offen oder es wurde bereits ausgewertet!</li>
            <li>Sie sind keiner Feuerwehr zugeordnet daher können Sie mit diesem Benutzer keine anmelden!<br>
            Schauen Sie dazu in die Statusleiste ob bei 'Feuerwehr:' eine zugeordnete Feuerwehr steht.</li>
        </ol>
        </fieldset>
        <?php
    }
    ?>
</fieldset>