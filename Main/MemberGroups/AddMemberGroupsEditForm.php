<!-- TODO: Wenn eine Auswertung in irgendeinerart für diese Gruppe erfolgt ist, darf diese Gruppe nicht mehr geändert werden!!!  -->


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

<fieldset>
    <legend>Gruppe ändern</legend>
    <span id="IdNewEditDelete" style="display: none">edit</span>
    <form action="<?=  sysGetPhpSelf();?>" method="POST">
        Gruppe zeigen:
        <select name="groupRecId">
            <?php
            $M = new MemberGroupTable(null, $_GET['idx']);
            $M->getRecords();
            while($M->next())
            {
                $selected = (@$_POST['groupRecId'] == $M->fldRecId[FLDVALUE]) ? "selected" : "";
                ?>
                <option value="<?=$M->fldRecId[FLDVALUE];?>" <?=$selected;?>><?=$M->fldGroupName[FLDVALUE];?></option>
                <?php
            }
            ?>
        </select>
        <input type="submit" value="Zeigen" name="post">
    </form>
    <br>
    <hr>
    
    
    
<script>
    $(document).ready(function() {
       $.fn.TT_New();
    });
</script>  
    
    <?php
    if(@$_POST['post'] && @$_POST['groupRecId']) 
    {
        $T = new MemberGroupTable($_POST['groupRecId']);        
        ?>
<fieldset id='Update' class='selected'  tableId="<?= MemberGroupTable::tableId()?>">
     <table>
        <tr>
            <td>Wettbewerb:</td>
            <td>
                <?=ContestBaseTable::find(@$_GET['idx'])->fldContest[FLDVALUE];?>
                <?=FormRun::newFld("text", "recId", NULL, false, true, false, true, false, @$_POST['groupRecId']);?>                
            </td>
        </tr>
        <tr>
            <td>Feuerwehr:</td>
            <td><span id="Create" type="enum" name="fireDeptId" mandatory="true" enumData="./fireDeptEnum.php?idx=<?=@$_GET['idx'];?>&recId=<?=@$_POST['groupRecId'];?>"></span></td>
        </tr>
        <tr>
            <td>Gruppenname:</td>
            <td><?= FormRun::newFld("text", "groupName", NULL, NULL, true, true, true, true, $T->fldGroupName[FLDVALUE]);?></td>
        </tr>         
        <tr>
            <td style="vertical-align: top;">Mitglieder:<br>
             <i>Drag & Drop nach Links (max. 10 Mitglieder)<br>
                 Die Sortierung wird berücksichtigt!</i></td>
            <td style="width: 400px">               
                <ul id="targetList" class="connectedSortable">
                    <?php
                    $MiOfMember = new MapIterator(unserialize(base64_decode($M->fldMemberIdMap[FLDVALUE])));
                    while($MiOfMember->next()) {
                        $T1 = new MemberTable($MiOfMember->currentValue());
                        ?>
                        <li id="<?=$T1->fldRecId[FLDVALUE];?>" class="ui-state-highlight"><?=$T1->fldSurname[FLDVALUE].", ".$T1->fldForename[FLDVALUE] . " (".DateTimeUtil::getAge($T1->fldBirthday[FLDVALUE]).")";?></li>
                        <?php
                    }
                    
                    ?>
                </ul>

                <ul id="sourceList" class="connectedSortable">
                    <?php
                    $MS = new MemberTable();
                    $MS->getRecords();
                    while($MS->next())
                    {
                        if(!unserialize(base64_decode($M->fldMemberIdMap[FLDVALUE]))->valueExists($MS->fldRecId[FLDVALUE]))
                        {
                            ?>
                            <li id="<?=$MS->fldRecId[FLDVALUE];?>" class="ui-state-highlight"><?=$MS->fldSurname[FLDVALUE].", ".$MS->fldForename[FLDVALUE] . " (".DateTimeUtil::getAge($MS->fldBirthday[FLDVALUE]).")";?></li>
                            <?php
                        }
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
</fieldset>

