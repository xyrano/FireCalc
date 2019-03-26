<script>
    $(document).ready(function() {
       $.fn.TT_New();
    });
</script>
<fieldset Create="true">
    <legend>Neue Gruppe</legend>    
    <table>
        <tr>
            <td>Gruppe:</td>
            <td><span id="Create" type="text" name="groupName" mandatory="1"></span></td>
        </tr>
        <tr>
            <td>Beschreibung:</td>
            <td><span id="Create" type="text" name="groupDescription"></span></td>
        </tr>
        <tr>
            <td>Landkreise die dieser Gruppe zugeordnet sind:</td>
            <td><span id="Create" type="enum" enumMultiple="1" enumData="../Municipal/districtEnum.php" name="districtIdArray" mandatory="1"></span></td>
        </tr>
    </table>
</fieldset>