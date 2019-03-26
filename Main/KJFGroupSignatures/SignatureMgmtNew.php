<!--<script>
    $(document).ready(function() {
       $.fn.TT_New();
    });
</script>
-->
<!--<script src="../../Plugins/Dropzone/dropzone.js"></script> - try it later -->

<?php
if(isset($_POST) && @$_POST['submit'])
{
    
    $groupRecId     = @$_GET['idx'];
    $sigFunction    = @$_POST['sigFunction'];
    $sigDescription = @$_POST['sigDescription'];
    $forename       = @$_POST['forename'];
    $surname        = @$_POST['surname'];
    
    if (array_key_exists('sigFile',$_FILES)) {
        $tmpname    = $_FILES['sigFile']['tmp_name'];
        $type       = $_FILES['sigFile']['type'];
        $extension  = $type;
        $hndFile    = fopen($tmpname, "r");
        $data       = addslashes(fread($hndFile, filesize($tmpname)));
        $imageData  = $data;
    }
    
    if(!$imageData)
        throw new Exception("Bild konnte nicht hochgeladen werden!");
    
    $SG = new SignatureTable();
    $SG->ttsbegin();
    $SG->fldGroupRecId[FLDVALUE]        = $groupRecId;
    $SG->fldFunction[FLDVALUE]          = $sigFunction;
    $SG->fldSigDescription[FLDVALUE]    = $sigDescription;
    $SG->signature($imageData);
    $SG->fldSigImageExt[FLDVALUE]       = $extension;
    $SG->fldForename[FLDVALUE]          = $forename;
    $SG->fldSurname[FLDVALUE]           = $surname;
    $SG->doInsert();
    $SG->ttscommit();
    
}
?>

<fieldset Create="true">
    <legend>Neue Unterschrift</legend>    
    <form method="post" action="<?=$_SERVER['PHP_SELF'];?>?do=new&idx=<?=$_GET['idx'];?>" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Funktion:</td>
            <td><input class="mandatoryField"  type="text" name="sigFunction" value=""></span></td>
        </tr>
        <tr>
            <td>Beschreibung:</td>
            <td><input type="text" name="sigDescription" value=""></span></td>
        </tr>
        <tr>
            <td>Vorname:</td>
            <td><input type="text" name="forename" value=""></td>
        </tr>
        <tr>
            <td>Nachname:</td>
            <td><input type="text" name="surname" value=""></td>
        </tr>            
        <tr>
            <td>Unterschrift:</td>
            <td><input class="mandatoryField"  type="file" name="sigFile"></span></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Hochladen/Speichern"></td>
        </tr>
    </table>
    </form>
</fieldset>


