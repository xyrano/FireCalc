<fieldset>
    <legend>Mitglieder entfernen</legend>
    <span id="IdNewEditDelete" style="display: none">delete</span>
    <table>
        <thead>
            <tr>
                <th>-</th>
                <th>#ID</th>
                <th>Ausweisnummer</th>
                <th>Geschlecht</th>
                <th>Nachname</th>
                <th>Vorname</th>
                <th>Geburtsdatum</th>
                <th>Alter</th>
                <th>Eintrittsdatum</th>
                <th>Feuerwehr</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            $MEMBERS = new MemberTable();
            $endpage = $MEMBERS->getNumOfPages();
            $MI = new MapIterator($MEMBERS->recIdMap);
            while($MI->next())
            {
                $MEMBER = new MemberTable($MI->currentValue());
                ?>
            <tr>
                <td><input type="checkbox" id="member-<?=$MEMBER->recId;?>"></td>
                <td><?=$MEMBER->recId;?></td>
                <td><?=$MEMBER->identityNum();?></td>
                <td><?=$MEMBER->gender();?></td>
                <td><?=$MEMBER->surname();?></td>
                <td><?=$MEMBER->forename();?></td>
                <td><?=$MEMBER->birthday();?></td>
                <td><?= DateTimeUtil::getAge($MEMBER->birthday());?></td>
                <td><?=$MEMBER->entryDate();?></td>
                <td><?=  FireDeptTable::find($MEMBER->fireDeptId())->fireDept();?></td>
            </tr>
                <?php
            }
            
            
            // next logic
            if(isset($_GET['page'])) {
                $next = $_GET['page'] + 1;
                if($next >= $endpage) {
                    $next = $endpage;
                }
            } else {
                $next = 1;
            }
            
            // back Logic
            if($endpage == @$_GET['page'])
            {
                $back = $next-1;
            } else {
                $back = $next-2;            
                if($back <= 0) {
                    $back = 0;
                }
            }                        
            ?>              
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9"><a href="<?= @$_SERVER['PHP_SELF'];?>?do=delete&page=<?=$back;?>">Seite zurück</a> | <a href="<?= @$_SERVER['PHP_SELF'];?>?do=delete&page=<?=$next;?>">Seite vor</a></td>
            </tr>
        </tfoot>
    </table>
</fieldset>