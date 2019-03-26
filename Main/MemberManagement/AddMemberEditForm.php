<fieldset>
    <legend>Mitglieder ändern</legend>
    <span id="IdNewEditDelete" style="display: none">edit</span>
     <table>   
        <tr>
            <td>Suche nach:</td>
            <td><input type="text" id="searchVal" value=""><br> (Es kann nach Ausweisnr., Nachname und Vorname gesucht werden!)</td>
        </tr>
        <tr>
            <td colspan="2"><hr></td>
        </tr>
         
        <tr>
            <td>#ID:</td>
            <td><div id="recId"></div></td>
        </tr>
             
        <tr>
            <td>* Ausweisnummer:</td>
            <td><input type="text" id="identityNum" value=""></td>
        </tr>
        <tr>
            <td>Geschlecht:</td>
            <td>
                <select id="gender">
                    <option value="0">männlich</option>
                    <option value="1">weiblich</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nachname:</td>
            <td><input type="text" id="surname" value=""></td>
        </tr>
        <tr>
            <td>Vorname:</td>
            <td><input type="text" id="forename" value=""></td>
        </tr>
        <tr>
            <td>* Geburtsdatum:</td>
            <td><input type="date" id="birthday" value=""></td>
        </tr>         
        <tr>
            <td>Eintrittsdatum:</td>
            <td><input type="date" id="entryDate" value=""></td>
        </tr>
        <tr>
            <td>Feuerwehr:</td>
            <td>
                <select id="fireDeptId">
                    <option value="0">-</option>                        
                    <?php
                    $FS = new FireDeptTable();
                    $MI = new MapIterator($FS->recIdMap);
                    while($MI->next()) {
                        $T = new FireDeptTable($MI->currentValue());
                        ?>
                        <option value="<?=$T->recId;?>"><?=$T->fireDept();?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
</fieldset>