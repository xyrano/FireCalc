<?php
require_once("./Factory.php");
require_once("./Functions.php");

$tableId = $_GET['TableId'];
$recId = $_GET['RecId'];

if($recId && $tableId)
{
    $row = getRecord($tableId, $recId);
    if($row && $row->tableName)
    {        
        ?>
        <fieldset>
            <legend>Eigenschaften für den Datensatz in Tabelle: <?=$row->tableName;?></legend>
            <table style='font-size: 11px;'>
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Label 'de'</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($row as $field => $value)
                    {
                        $sysFieldName = strtoupper($field);                
                        if(SysTableBase::isField($sysFieldName))
                        {
                            //$fieldVal = (strlen($value > 20)) ? substr($value, 0, 20)." ..." : $value;
                            if(substr($sysFieldName, 3) != "PASSWORD" && substr($sysFieldName, 3) != "SIGIMAGE")
                            {
                                echo "<tr>";
                                echo "<td>" . substr($sysFieldName, 3) . "</td>";
                                echo "<td>" . $value[FLDLABEL]["de"] . "</td>";
                                echo "<td>" . $value[FLDVALUE] . "</td>";
                                echo "</tr>";
                            }
                            else
                            {
                                echo "<tr>";
                                echo "<td>" . substr($sysFieldName, 3) . "</td>";
                                echo "<td>" . $value[FLDLABEL]["de"] . "</td>";
                                echo "<td><b>Kann nicht angezeigt werden!</b></td>";
                                echo "</tr>";
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </fieldset>
        <?php
    }
    else
    {
        ?>
        Es konnte kein Tabellenname ermittelt werden!<br>
        Oder dieser Datensatz ist explizit gesch&uuml;tzt!<br>
        <?php
    }
}
?>
