<!-- Wenn bereits Gruppen zur FF angelegt sind darf die FF nicht mehr gelöscht werden! -->


<fieldset>
    <legend>Info</legend>
    Wenn in einem Wettbewerb Gruppen zur zugehörigen Feuerwehr existieren, können diese nicht mehr entfernt werden!<br>
    Bitte dann entsprechend erst die Gruppen auflösen.
</fieldset>
<fieldset>
    <legend>Feuerwehren in diesem Wettbewerb [<?=ContestBaseTable::find($_GET['idx'])->fldContest[FLDVALUE];?>] entfernen</legend>
    <span id="IdNewEditDelete" style="display: none">delete</span>
    <div id="idx" style="display: none;"><?=@$_GET['idx'];?></div>
    <table>
         <thead>
            <tr>
                <th>-</th>
                <th>Wettbewerb</th>
                <th>Landkreis</th>
                <th>Gemeinde</th>
                <th>Feuerwehr</th>
                <th>Gruppenanzahl</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            $TS = new FireDept2ContestTable(null, @$_GET['idx']);
            $TS->getRecords();           
            while($TS->next())
            {                
                $numOfgroups = MemberGroupTable::numGroupsOfFireDept($TS->fldContestId[FLDVALUE], $TS->fldFireDeptId[FLDVALUE]);
                $disabled = ($numOfgroups > 0) ? "disabled" : "";
                
                ?>
            <tr>
                <td><input type="checkbox" id="fireDept2ContestTable-<?=$TS->fldRecId[FLDVALUE];?>" <?=$disabled;?>></td>
                <td><?=  ContestBaseTable::find($TS->fldContestId[FLDVALUE])->fldContest[FLDVALUE];?></td>
                <td><?=  DistrictTable::find($TS->fldDistrictId[FLDVALUE])->fldDistrict[FLDVALUE];?></td>
                <td><?=  MunicipalTable::findRecId($TS->fldMunicpilaId[FLDVALUE])->fldMunicipal[FLDVALUE];?></td>
                <td><?=  FireDeptTable::findRecId($TS->fldFireDeptId[FLDVALUE])->fldFireDept[FLDVALUE];?></td>
                <td><?=$numOfgroups;?></td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>