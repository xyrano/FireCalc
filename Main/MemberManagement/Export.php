<?php
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/Berlin');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../../Plugins/PHPExcel-1.8/Classes/PHPExcel.php';
// include BaseFiles from System
require_once("../../ExtendedDataTypes.php");
require_once("../../Functions.php");
require_once("../../ApplTree/Classes/SysPropertyDefinition.php");
require_once("../../ApplTree/Classes/SysPropertys.php");
require_once("../../ApplTree/Classes/SysConstants.php");
require_once("../../ApplTree/Classes/FormRun.php");
require_once("../../ApplTree/Classes/Obj.php");
require_once("../../ApplTree/Classes/Map.php");
require_once("../../ApplTree/Classes/MapIterator.php");
//require_once("../../ApplTree/Classes/xTblIface.php");
//require_once("../../ApplTree/Classes/xTable.php");
//require_once("../../ApplTree/Classes/SQLLog.php");
//require_once("../../ApplTree/Classes/Sql.php");
require_once("../../ApplTree/Classes/Base.php");
require_once("../../ApplTree/Classes/UserSession.php");
require_once("../../ApplTree/Classes/Database.php");
require_once("../../ApplTree/Classes/SysTableBase.php");
require_once("../../ApplTree/Classes/SysTable.php");
require_once("../../ApplTree/Classes/UserSession.php");
require_once("../../ApplTree/Classes/SysConstants.php");
require_once("../../ApplTree/Classes/AdminSetup.php");
require_once("../../ApplTree/Classes/SysPropertys.php");
require_once("../../ApplTree/Classes/DateTimeUtil.php");
require_once("../../ApplTree/Classes/UserOnline.php");
require_once("../../ApplTree/Classes/MemberTable.php");
require_once("../../ApplTree/Classes/FireDeptTable.php");


$fileType = @$_POST['fileType'];
$fileName = "FireCalcMemberTable-".uniqid()."-".DateTimeUtil::currentDateTime(DateTimeUtil::dateTimePattern).".".$fileType;

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator(UserOnline::find()->fldUserName[FLDVALUE])
							 ->setLastModifiedBy(UserOnline::find()->fldUserName[FLDVALUE])
							 ->setTitle("Office 2007 XLSX Member Export")
							 ->setSubject("Office 2007 XLSX Member Document")
							 ->setDescription("Member export for edit and re-import.")
							 ->setKeywords("Member Export")
							 ->setCategory("data");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Ausweisnummer')
            ->setCellValue('B1', 'Geschlecht')
            ->setCellValue('C1', 'Nachname')
            ->setCellValue('D1', 'Vorname')
            ->setCellValue('E1', 'Geburtsdatum')
            ->setCellValue('F1', 'Eintrittsdatum')
            ->setCellValue('G1', 'Feuerwehr');



// Set Comment to FireDept because it results only ID´s
// so we have to introduce the user which ID referes to FireDepartment
// TODO: Make it better with another worksheet and table referer (DropDownlist)
/* OLD BEHAVIOUR
$fdts = new FireDeptTable();
$MI = new MapIterator($fdts->recIdMap);
$str = "";
while($MI->next()) 
{
    $FDT = new FireDeptTable($MI->currentValue());
    $str .= $FDT->recId . " = " . $FDT->fireDept() ." \r\n";
}
 * 
 */
$str = "";
$F = new FireDeptTable();
$F->getRecords();
while($F->next()) {
    $str .= $F->fldRecId[FLDVALUE] . " = " . $F->fldFireDept[FLDVALUE] . " \r\n";
}

$objPHPExcel->getActiveSheet()->getComment('G1')->getText()->createTextRun($str); // Comment for Firedepts

$objPHPExcel->getActiveSheet()->getComment('B1')->getText()->createTextRun("Weiblich = 1 \r\n Männlich = 0");
$objPHPExcel->getActiveSheet()->getComment('A1')->getText()->createTextRun("Immer als Text formatieren damit evtl. führende Nullen nicht abgeschnitten werden!");


/* OLD BEHAVIOUR
$MEMBERS = new MemberTable(null, null, $_POST['fireDeptIdFilter']);
$MI = new MapIterator($MEMBERS->recIdMap);
$i = 2; // start in row 2 because 1 is caption row
while($MI->next()) 
{
    $MT = new MemberTable($MI->currentValue());
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $MT->identityNum())
            ->setCellValue('B'.$i, $MT->gender())
            ->setCellValue('C'.$i, $MT->surname())
            ->setCellValue('D'.$i, $MT->forename())
            ->setCellValue('E'.$i, $MT->birthday())
            ->setCellValue('F'.$i, $MT->entryDate())
            ->setCellValue('G'.$i, $MT->fireDeptId());
    $i++;
}
 */

$MEMBER = new MemberTable();
if($_POST['fireDeptIdFilter'] == -1) {
    $MEMBER->initAll()->fetch();
} else {
    $MEMBER->initAll()->where($MEMBER->fldFireDept[FLDNAME]."=".$_POST['fireDeptIdFilter'])->fetch();
}
$i = 2;// start in row 2 because 1 is caption row
while($MEMBER->next()) {
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i,  $MEMBER->fldIdentityNum[FLDVALUE])
            ->setCellValue('B'.$i,  $MEMBER->fldGender[FLDVALUE])
            ->setCellValue('C'.$i,  $MEMBER->fldSurname[FLDVALUE])
            ->setCellValue('D'.$i,  $MEMBER->fldForename[FLDVALUE])
            ->setCellValue('E'.$i,  $MEMBER->fldBirthday[FLDVALUE])
            ->setCellValue('F'.$i,  $MEMBER->fldEntryDate[FLDVALUE])
            ->setCellValue('G'.$i,  $MEMBER->fldFireDept[FLDVALUE]);
    $i++;
}




// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('MemberTable');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


if(@$fileType == "xlsx")
{
    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$fileName.'"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
}


if(@$fileType == "xls")
{
    // Redirect output to a client’s web browser (Excel5)
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$fileName.'"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}


if(@$fileType == "ods")
{
    // Redirect output to a client’s web browser (OpenDocument)
    header('Content-Type: application/vnd.oasis.opendocument.spreadsheet');
    header('Content-Disposition: attachment;filename="'.$fileName.'"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'OpenDocument');
    $objWriter->save('php://output');
    exit;
}
