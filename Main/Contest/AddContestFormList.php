<script>
    $(document).ready(function() {              
        // Wenn Benutzer ein Normaler Benutzer ist also weder Admin noch Auswertung
        // darf dieser keine BWB´s anlegen, ändern oder entfernen
        <?php
        if(sysIsUserUser())
        {
            echo "$('a#new').removeAttr('id').removeAttr('href');";            
            echo "$('a#save').removeAttr('id').removeAttr('href');";
            echo "$('a#delete').removeAttr('id').removeAttr('href');";
        }
        ?>
    });
</script>
<fieldset>
    <legend>Contest management</legend>
    
    <?php
   // OLD BEHAVIOUR if(AdminSetup::find()->hideContestAfterToday()) {
    if(AdminSetup::findRecId()->fldHideContestAfterToday[FLDVALUE]) {
        echo "Info: Wettbewerbe die in der Vergangenheit liegen werden nicht angezeigt!<br>";
    }        
    ?>
    
    
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Landkreis</th>
                <th>Gemeinde</th>
                <th>Austragungsort</th>
                <th>Wettbewerb Datum</th>
                <th>Wettbewerb</th>
                <th>KJFW o. Stv.</th>
                <th>Wettbewerbsleiter</th>
                <th>Offenes Gewässer</th>
                <th>Ausgewertet</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            /* OLD Behaviour
            $CONTESTS = new ContestBaseTable();
            $MI = new MapIterator($CONTESTS->recIdMap);
            while($MI->next())
            {
                $CONTEST = new ContestBaseTable($MI->currentValue());        
                $editable = ($CONTEST->contestIsCalculated()) ? false : true; // wenn contest ausgewertet stelle editable auf false ;-)
                ?>
                <tr class="select" tableId="<?= ContestBaseTable::tableId();?>" id="<?=$CONTEST->recId;?>">
                    <td><?=$CONTEST->recId;?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$enum, "districtId", "../Municipal/districtEnum.php", false, true, $editable, null, $CONTEST->districtTable()->district() );?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$enum, "municipalId", "../Municipal/municipalEnum.php", false, true, $editable, null, $CONTEST->municipalTable()->municipal());?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$text, "venue", null, null, true, $editable, null, $CONTEST->provideInVenue());?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$date, "contestdate", null, false, true, $editable, null, $CONTEST->contestDate());?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$text, "contest", null, false, true, $editable, null, $CONTEST->contest());?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$enum, "contestLeader", "../KJFGroupSignatures/signatureEnum.php", false, true, $editable, null, SignatureTable::find($CONTEST->contestLeader())->signatureFunction());?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$enum, "contestTeamManager", "../KJFGroupSignatures/signatureEnum.php", false, true, $editable, null, SignatureTable::find($CONTEST->contestTeamManager())->signatureFunction());?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$checkbox, "openwater", null, false, false, $editable, null, Obj::num2NoYes($CONTEST->openWater()));?></td>
                    <td><?=Obj::num2NoYes($CONTEST->contestIsCalculated());?></td>
                </tr>
                <?php
            }
             * 
             */
            $CONTEST = new ContestBaseTable();
            $CONTEST->getRecords();
            while($CONTEST->next())
            {
                $editable = ($CONTEST->fldContestIsCalculated[FLDVALUE]) ? false : true; // wenn contest ausgewertet stelle editable auf false ;-)
                ?>
                <tr class="select" tableId="<?= ContestBaseTable::tableId();?>" id="<?=$CONTEST->fldRecId[FLDVALUE];?>">
                    <td><?=$CONTEST->fldRecId[FLDVALUE];?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$enum, "districtId", "../Municipal/districtEnum.php", false, true, $editable, null, true, $CONTEST->districtTable()->fldDistrict[FLDVALUE] );?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$enum, "municipalId", "../Municipal/municipalEnum.php", false, true, $editable, null, true, $CONTEST->municipalTable()->fldMunicipal[FLDVALUE]);?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$text, "venue", null, null, true, $editable, null, true, $CONTEST->fldVenue[FLDVALUE]);?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$date, "contestdate", null, false, true, $editable, null, true, $CONTEST->fldContestDate[FLDVALUE]);?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$text, "contest", null, false, true, $editable, null, true, $CONTEST->fldContest[FLDVALUE]);?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$enum, "contestLeader", "../KJFGroupSignatures/signatureEnum.php", false, true, $editable, null, true, SignatureTable::find($CONTEST->fldContestLeader[FLDVALUE])->fldFunction[FLDVALUE]);?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$enum, "contestTeamManager", "../KJFGroupSignatures/signatureEnum.php", false, true, $editable, null, true, SignatureTable::find($CONTEST->fldContestTeamManager[FLDVALUE])->fldFunction[FLDVALUE]);?></td>
                    <td><?=FormRun::newFld(FormRunFldType::$checkbox, "openwater", null, false, false, $editable, null, true, Obj::num2NoYes($CONTEST->fldIsOpenWater[FLDVALUE]));?></td>
                    <td><?=Obj::num2NoYes($CONTEST->fldContestIsCalculated[FLDVALUE]);?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>