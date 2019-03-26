<!-- Wenn bereits Feuerwehren einem Wettbewerb zugeordnet sind darf dieser nicht mehr gelöscht werden! -->
<fieldset>
    <legend>Info</legend>
    Wenn in einem Wettbewerb bereits eine Feuerwehr existiert, kann dieser Wettbewerb nicht mehr entfernt werden!<br>
    Bitte dann entsprechend erst die Feuerwehr aus dem Wettbewerb löschen.
</fieldset>

<fieldset>
    <legend>Wettbewerb/e entfernen</legend>
    <span id="IdNewEditDelete" style="display: none">delete</span>
    <table>
        <thead>
            <tr>
                <th>-</th>
                <th>#ID</th>
                <th>Landkreis</th>
                <th>Wettbewerb Datum</th>
                <th>Wettbewerb</th>
                <th>Offenes Gewässer</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            $CONTESTS = new ContestBaseTable();
            $MI = new MapIterator($CONTESTS->recIdMap);
            while($MI->next())
            {
                $CONTEST = new ContestBaseTable($MI->currentValue());
                
                // Can Contest be deleted?
                $num = FireDept2ContestTable::numOfFireDepartmentsInContest($CONTEST->recId);
                $disabled = ($num > 0) ? "disabled" : "";
                ?>
            <tr>
                <td><input type="checkbox" id="contest-<?=$CONTEST->recId;?>" <?=$disabled;?>></td>
                <td><?=$CONTEST->recId;?></td>
                <td><?=  DistrictTable::find($CONTEST->provideInDistrict())->district();?></td>
                <td><?=$CONTEST->contestDate();?></td>
                <td><?=$CONTEST->contest();?></td>
                <td><?=Obj::num2NoYes($CONTEST->openWater());?></td>
            </tr>
                <?php
            }
            ?>            
        </tbody>
    </table>
</fieldset>