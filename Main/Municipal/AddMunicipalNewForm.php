<script>
    $(document).ready(function() {
       $.fn.TT_New();
    });
</script>
<fieldset Create="true" tableId="<?= MunicipalTable::tableId()?>">
    <legend>New Municipal</legend>
    <table>
        <tr>
            <td>Landkreis:</td>
            <td><span id="Create" type="enum" name="districtId" mandatory="true" enumData="./districtEnum.php"></span></td>
        </tr>
        <tr>
            <td>Gemeinde:</td>
            <td><span id="Create" type="text" name="municipal" mandatory="1"></span></td>
        </tr>
    </table>
</fieldset>