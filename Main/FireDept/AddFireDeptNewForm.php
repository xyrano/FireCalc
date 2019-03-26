<script>
    $(document).ready(function() {
       $.fn.TT_New();
       $("#municipalId").chained("#districtId"); // Make a chained select
    });
</script>
<fieldset Create="true" tableId="<?=FireDeptTable::tableId();?>">
    <legend>New Firedepartment</legend>  
    <table>
        <tr>
            <td>Landkreis:</td>
            <td><span id="Create" type="enum" enumData="../Municipal/districtEnum.php" name="districtId" mandatory="1"></span></td>
        </tr>
        <tr>
            <td>Gemeinde:</td>
            <td><span id="Create" type="enum" enumData="../Municipal/municipalEnum.php" name="municipalId" mandatory="1"></span></td>
        </tr>
        <tr>
            <td>Feuerwehr:</td>
            <td><span id="Create" type="text" name="fireDepartment" mandatory="1"></span></td>
        </tr>            
    </table>
</fieldset>