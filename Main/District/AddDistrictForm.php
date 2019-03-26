<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
echo FormRun::createPageHeader("District management", true, "district.js");
?>


<br>

<?php
switch(@$_GET['do'])
{
    case 'new': require_once("./AddDistrictNewForm.php");
    
}
require_once("./AddDistrictFormList.php");
?>


<?php
echo FormRun::createPageFooter(true);
?>
