<?php
// Delete Automatically Member if reached age of AdminSetup
$deletionAge = AdminSetup::findRecId()->fldDeleteMemberAtAgeOf[FLDVALUE];
?>


<fieldset>
    <legend>Mitglieder</legend>
    <input type="text" id="searchInput" placeholder="Search for .." title="Type in a name"><br>
    <div class="AlphabetContainer">
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=A">A</a> 
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=B">B</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=C">C</a> 
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=D">D</a> 
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=E">E</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=F">F</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=G">G</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=H">H</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=I">I</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=J">J</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=K">K</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=L">L</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=M">M</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=N">N</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=O">O</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=P">P</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=Q">Q</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=R">R</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=S">S</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=T">T</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=U">U</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=V">V</a> 
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=W">W</a> 
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=X">X</a> 
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=Y">Y</a> 
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=Z">Z</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=Ä">Ä</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=Ü">Ü</a>  
        <a href="<?=$_SERVER['PHP_SELF'];?>?char=Ö">Ö</a> 
    </div>
    <table>
        <thead>
<!--             <tr>
                <td colspan="6">Zurzeit sind <?php //new MemberTable()->recIdMap->getLength(); ?> Mitglieder eingetragen.</td>
            </tr>-->
            <tr>
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
        <tbody id="fbody">
            <?php    
            /* OLD Behaviour
            $MS = new MemberTable();
            $endpage = $MS->getNumOfPages();
            $MI = new MapIterator($MS->recIdMap);           
            while($MI->next())
            {
                $T = new MemberTable($MI->currentValue());
                $age = DateTimeUtil::getAge($T->birthday());                                
                $deletedStyle = "";
                                                                    // Check if an Member is in an Active Contest/Group - if yes, they cannot be deleted
                if($deletionAge != -1 && $age >= $deletionAge && !MemberGroupTable::existMemberInActiveContestGroup($T->recId))
                {                                        
                    $deletedStyle = ($T->delete() == true) ? " style=\"text-decoration: line-through; \" " : "";                                        
                }                
                ?>
                <tr <?=$deletedStyle;?> class="select" tableId="<?= $T->tableId();?>" id="<?=$T->recId;?>"> <!-- Marked as deleted - reload won´t show this entry -->
                    <td><?=$T->recId;?></td>
                    <td><span type="text" name="identityNum" mandatory="1"><?=  $T->identityNum();?></span></td>
                    <td><span type="enum" enumData="./genderEnum.php" name="gender" mandatory="1"><?= genderId2GenderName($T->gender());?></span></td>
                    <td><span type="text" name="surname"><?=  $T->surname();?></span></td>
                    <td><span type="text" name="forename"><?=  $T->forename();?></span></td>
                    <td><span type="date" name="birthday" mandatory="1"><?=  $T->birthday();?></span></td>
                    <td><?= $age;?></td>
                    <td><span type="date" name="entryDate"><?=$T->entryDate();?></span></td>
                    <td><span type="enum" enumData="../FireDept/fireDeptEnum.php" name="fireDeptId" mandatory="1"><?=$T->fireDeptName();?></span></td>
                </tr>
                <?php
            }
             * 
             */
            $T = new MemberTable();
            $T->getRecords();
            $endpage = $T->getPages();            
            while($T->next()) {
            ?>
                <tr class="select" tableId="<?= $T->tableId();?>" id="<?=$T->fldRecId[FLDVALUE];?>"> <!-- Marked as deleted - reload won´t show this entry -->
                    <td><?=$T->fldRecId[FLDVALUE];?></td>
                    <td><span type="text" name="identityNum" mandatory="1"><?=$T->fldIdentityNum[FLDVALUE];?></span></td>
                    <td><span type="enum" enumData="./genderEnum.php" name="gender" mandatory="1"><?=genderId2GenderName($T->fldGender[FLDVALUE]);?></span></td>
                    <td><span type="text" name="surname"><?=$T->fldSurname[FLDVALUE];?></span></td>
                    <td><span type="text" name="forename"><?=$T->fldForename[FLDVALUE];?></span></td>
                    <td><span type="date" name="birthday" mandatory="1"><?=$T->fldBirthday[FLDVALUE];?></span></td>
                    <td><?= DateTimeUtil::getAge($T->fldBirthday[FLDVALUE]);?></td>
                    <td><span type="date" name="entryDate"><?=$T->fldEntryDate[FLDVALUE];?></span></td>
                    <td><span type="enum" enumData="../FireDept/fireDeptEnum.php" name="fireDeptId" mandatory="1"><?=$T->fldFireDeptName[FLDVALUE];?></span></td>
                </tr>
                <?php    
            }
            
            
            // next logic
            if(isset($_GET['page']) && $_GET['page'] >= 0) 
            {
                $next = @$_GET['page'] + 1;
                if($next >= $endpage) 
                {
                    $next = $endpage;
                }                
            } 
            else 
            {
                $next = 1;
            }
            
            // back Logic
            if($endpage == @$_GET['page'])
            {
                $back = $next-1;
            } 
            else 
            {
                $back = $next-2;            
                if($back <= 0) 
                {
                    $back = 0;
                }
            }
            ?>
            
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <a href="<?= @$_SERVER['PHP_SELF'];?>?do=start&page=<?=$back;?>">Seite zurück</a>
                </td>
                <td colspan="7">
                    <?php
                    for($i=0; $i<=$endpage; $i++) {
                        if($i == @$_GET['page']) {
                            echo "[<b>".$i."</b>]";
                        } else {
                            echo "[<a href=".@$_SERVER['PHP_SELF']."?do=start&page=".$i.">".$i."</a>]";
                        }
                    }
                    ?>
                </td>
                <td>
                    <a href="<?= @$_SERVER['PHP_SELF'];?>?do=start&page=<?=$next;?>">Seite vor</a>
                </td>
            </tr>
        </tfoot>
    </table>
</fieldset>