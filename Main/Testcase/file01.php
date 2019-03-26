<?php
session_start();
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("Municipal management", true, "file01Ext.js");


?>

<!--
TD Propertys:
type: text, date, time, datetime, enum, checkbox
name: str (individual name)
editable: true/false 1/0
mandatory: true/false 1/0
enumData: URL to JSON file
enumMultiple: true/false 1/0
-->

<br><br>
<fieldset>
    <input type="text" id="searchInput" placeholder="Search for .." title="Type in a name"><br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Datum</th>
                <th>Zeit</th>
                <th>Datum - Zeit</th>
                <th>Enum</th>
                <th>Enum2</th>
                <th>Checked</th>
            </tr>
            <!--
            <tr>
                <th></th>
                <th><input type="text" name="" value=""></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr> -->
        </thead>
        <tbody id="fbody">
            <tr class="select" id="1" tableId="10">
                <td>1</td>
                <td><span type="text" name="forename" editable="true" mandatory="1">Timo</span></td>
                <td><span type="date" name="birthdate" mandatory="1">2014-03-24</span></td>
                <td><span type="time" name="appointmentTime" editable="false" mandatory="1">17:00:00</span></td>
                <td><span type="datetime" name="startDateTime" mandatory="1">24.02.2017 14:30:33</span></td>
                <td><span type="enum" enumData="../Municipal/districtEnum.php" name="district" editable="false" mandatory="1">Verden</span></td>
                <td><span type="enum" enumData="../Municipal/districtEnum.php" name="district2" editable="1" mandatory="1">Verden</span></td>
                <td><span type="checkbox" name="inUse" mandatory="1">Nein</span></td>
            </tr>
            <tr class="select" id="2" tableId="10">
                <td>2</td>
                <td><span type="text" name="forename">Jana</span></td>
                <td><span type="date" name="birthdate">2014-03-24</span></td>
                <td><span type="time" name="appointmentTime">17:00:00</span></td>
                <td><span type="datetime" name="startDateTime">24.02.2017 14:30:33</span></td>
                <td><span type="enum" enumMultiple="true" enumData="../Municipal/districtEnum.php" name="district">Delmenhorst</span></td>
                <td><span type="enum" enumData="../Municipal/districtEnum.php" name="district2" editable="1">Verden</span></td>
                <td><span type="checkbox" name="inUse">Ja</span></td>
            </tr>
            <tr class="select" id="3" tableId="10">
                <td>3</td>
                <td><span type="text" name="forename">test</span></td>
                <td><span type="date" name="birthdate">2014-03-24</span></td>
                <td><span type="time" name="appointmentTime">17:00:00</span></td>
                <td><span type="datetime" name="startDateTime">24.02.2017 14:30:33</span></td>
                <td><span type="enum" enumData="../Municipal/districtEnum.php" name="district">Oldenburg</span></td>
                <td><span type="enum" enumData="../Municipal/districtEnum.php" name="district2" editable="1">Verden</span></td>
                <td><span type="checkbox" name="inUse">Nein</span></td>
            </tr>
            <tr class="select" id="4" tableId="10">
                <td colspan="8">
                    <ul>
                        <li>Parameter</li>
                        <li>Forename: </li><span type="text" name="param1" mandatory="1"></span>
                        <li>Birthdate:</li><span type="date" name="birthdate"></span>
                        <li>appoint:</li> <span type="time" name="appTime"></span>
                        <li>datetime: <span type="datetime" name="startDateTime"></span></li>
                        <li>Toller text welchen Landkreis haben Sie: <span type="enum" enumData="../Municipal/districtEnum.php" name="district">Oldenburg</span> Danke!</li>
                        <li><span type="enum" enumData="../Municipal/districtEnum.php" name="district2" editable="1">Verden</span></li>
                        <li><span type="checkbox" name="inUse">Nein</span></li>
                    </ul>
                </td>
            </tr>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</fieldset>





