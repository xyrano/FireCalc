<script>
    $(document).ready(function() {
       $.fn.TT_New();       
    });
</script>
<fieldset Create="true" tableId="<?= DistrictTable::tableId()?>">
    <legend>New District</legend>    
    <table>
        <tr>
            <td>Landkreis:</td>
            <td><span id="Create" type="text" name="district" mandatory="1"></span></td>
        </tr>
    </table>
</fieldset>