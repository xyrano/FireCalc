<!-- TODO: Wenn eine Auswertung für diesen Contest begonnen hat, dar fman keine gruppen mehr nachmelden, evtl. Parameteresieren in Einstellungen? -->

<style>   
#targetList, #sourceList {
  border: 1px solid #000;
  width: 185px;
  min-height: 20px;
  list-style-type: none;
  margin: 0;
  padding: 5px 0 20px 0;
  float: left;
  margin-right: 10px;  
}


  
#targetList li, #sourceList li {
  margin: 0 5px 5px 5px;
  padding: 5px;
  font-size: 1.2em;
  width: 165px; 
}
</style>

<?php
// Nur Ausführen wenn bereits die Feuerwehr Registriert wurde
// und Benutzer ist echter Benutzer
if(sysIsUserUser() && !RegistrationTable::existRegistered(@$_GET['idx'], Obj::user()->fldFireDeptId[FLDVALUE]))
{
    echo "<br><h1>Die Feuerwehr [] wurde noch nicht erfasst, daher ist eine Gruppenerstellung noch nicht möglich.</h1>";
}   
else
{
    ?>
    <script>
        $(document).ready(function() {
           $.fn.TT_New();
        });
    </script>

    <fieldset Create='true' tableId="<?= MemberGroupTable::tableId()?>">
        <legend>Neue Gruppe</legend>
        <!--<span id="IdNewEditDelete" style="display: none">new</span>-->
        <table>
            <tr>
                <td>Wettbewerb:</td>
                <td><?=ContestBaseTable::find(@$_GET['idx'])->fldContest[FLDVALUE];?><?=formRun::newFld("text", "contestId", NULL, NULL, TRUE, false, true, false, @$_GET['idx']);?></td>
            </tr>
            <tr>
                <td>Feuerwehr:</td>
                <td><span id="Create" type="enum" name="fireDeptId" mandatory="true" enumData="./fireDeptEnum.php?idx=<?=@$_GET['idx'];?>"></span></td>
            </tr>
            <tr>
                <td>Gruppenname:</td>
                <td><span id="Create" type="text" name="groupName" mandatory="1"></span></td>
            </tr>       
            <tr>
                <td style="vertical-align: top;">Mitglieder:<br>
                <i>Drag & Drop nach Links (max. 10 Mitglieder)<br>
                    Die Sortierung wird berücksichtigt!</i></td>
                <td style="width: 400px"> 


                    <ul id="targetList" class="connectedSortable"></ul>
                    
                    <ul id="sourceList" class="connectedSortable">
                        <?php
                        $T = new MemberTable();
                        //$MI = new MapIterator($MS->recIdMap);
                        $T->getRecords();
                        while($T->next())
                        {
                            //$T = new MemberTable($MI->currentValue());
                            ?>
                            <li id="<?=$T->fldRecId[FLDVALUE];?>" class="ui-state-highlight"><?=$T->fldSurname[FLDVALUE].", ".$T->fldForename[FLDVALUE] . " (".DateTimeUtil::getAge($T->fldBirthday[FLDVALUE]).")";?></li>
                            <?php
                        }
                        ?>                  
                     </ul>

                </td>
            </tr>
        </table>  
    </fieldset>
    <?php
}
?>
