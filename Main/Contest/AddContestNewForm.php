<script>
    $(document).ready(function() {
       $.fn.TT_New();
       $("#municipalId").chained("#districtId"); // Make a chained select
    });
</script>


<fieldset Create="true">
    <legend>New Contest</legend>
    <table>
        <tr>
            <td>Landkreis:</td>
            <td><?=FormRun::newFld(FormRunFldType::$enum, "districtId", "../Municipal/districtEnum.php", false, true, true, true);?></td>
        </tr>
        <tr>
            <td>Gemeinde</td>
            <td><?=FormRun::newFld(FormRunFldType::$enum, "municipalId", "../Municipal/municipalEnum.php", false, true, true, true);?></td>
        </tr>
        <tr>
            <td>Austragungsort</td>
            <td><?=FormRun::newFld(FormRunFldType::$text, "venue", null, null, true, true, true);?></td>
        </tr>
        <tr>
            <td>Datum:</td>
            <td><?=FormRun::newFld(FormRunFldType::$date, "contestdate", null, false, true, true, true);?></td>
        </tr>
        <tr>
            <td>Wettbewerb:</td>
            <td><?=FormRun::newFld(FormRunFldType::$text, "contest", null, FALSE, true, true, true);?></td>
        </tr>
        <tr>
            <td>KJWFW o. Stv.</td>
            <td><?=FormRun::newFld(FormRunFldType::$enum, "contestLeader", "../KJFGroupSignatures/signatureEnum.php", false, true, true, true);?></td>
        </tr>
        <tr>
            <td>Wettbewerbsleiter</td>
            <td><?=FormRun::newFld(FormRunFldType::$enum, "contestTeamManager", "../KJFGroupSignatures/signatureEnum.php", false, true, true, true);?></td>
        </tr>
        <tr>
            <td>Offenes Gewässer:</td>
            <td><?=FormRun::newFld(FormRunFldType::$checkbox, "openwater", NULL, false, false, true, true);?></td>
        </tr>            
    </table>
</fieldset>