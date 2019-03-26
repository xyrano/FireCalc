<?php
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/Berlin');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
//include("/../../Plugins/PHPExcel-1.8/Classes/PHPExcel.php");
require_once dirname(__FILE__) . '/../../Plugins/PHPExcel-1.8/Classes/PHPExcel.php';


require_once dirname(__FILE__) . '/../../Plugins/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

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
require_once("../../ApplTree/Classes/SysTableIdReference.php");
require_once("../../ApplTree/Classes/UserSession.php");
require_once("../../ApplTree/Classes/SysConstants.php");
require_once("../../ApplTree/Classes/AdminSetup.php");
require_once("../../ApplTree/Classes/SysPropertys.php");
require_once("../../ApplTree/Classes/DateTimeUtil.php");
require_once("../../ApplTree/Classes/UserOnline.php");
require_once("../../ApplTree/Classes/MemberTable.php");
require_once("../../ApplTree/Classes/FireDeptTable.php");

/// BASE DATA END


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 0;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$captionExists = false;


if(isset($_POST["submit"])) 
{
    $captionExists = @$_POST['captionExists'];
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) 
    {        
        $uploadOk = 1;
    } 
    else 
    {
        echo "File could not be uploaded!";
        $uploadOk = 0;
    }
}


try
{
    if($uploadOk == 1)
    {
        $fileName = $_FILES["fileToUpload"]["name"];
        $fileType = $_FILES["fileToUpload"]["type"];
        $fileExtension = pathinfo("uploads/".$fileName, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);


        $objPHPExcel = PHPExcel_IOFactory::load("uploads/".$fileName);
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) 
        {
            $worksheetTitle     = $worksheet->getTitle();
            $highestRow         = $worksheet->getHighestRow(); // e.g. 10
            $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            $nrColumns = ord($highestColumn) - 64;
            echo "<br>Das Arbeitsblatt ".$worksheetTitle." hat ";
            echo $nrColumns . ' Spalten (A-' . $highestColumn . ') ';
            echo ' und ' . $highestRow . ' Zeilen.';
            echo ($captionExists) ? ' (Zzgl. &Uuml;berschriftzeile)' : '';
            echo '<br>Data: <table border="1" style="border-collapse:collapse"><tr>';

            $rowStart = ($captionExists) ? 2 : 1;  // Wenn eine Überschrift existiert erst ab der zweiten Zeile anfangen

            // loop rows
            for ($row = $rowStart; $row <= $highestRow; ++ $row) 
            {
                echo '<tr>';
                // loop cells
                $cellNum = 1;
                for ($col = 0; $col < $highestColumnIndex; ++ $col) 
                {
                    set_time_limit(5); // increase time limit at loading time
                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                    $val = $cell->getValue();
                    $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                    //echo '<td>' . $val . '<hr>'.$cellNum.'</td>';
                    echo '<td>' . $val . '</td>';
                    switch($cellNum)
                    {
                        case 1: // Ausweisnummer
                            $MT = MemberTable::findFromIdentityNum($val);
                            $MT->ttsbegin();
                            $MT->fldIdentityNum[FLDVALUE] = $val;
                            break;
                        case 2: // Geschlecht
                            $MT->fldGender[FLDVALUE] = $val;
                            break;
                        case 3: // Nachname
                            $MT->fldSurname[FLDVALUE] = $val;
                            break;
                        case 4: // Vorname
                            $MT->fldForename[FLDVALUE] = $val;
                            break;
                        case 5: // Geburtstag
                            if(DateTimeUtil::validateDate($val))
                            {
                                $MT->fldBirthday[FLDVALUE] = $val;
                            }
                            else
                            {
                                throw new Exception("Das Datumformat des Geburtsdatum stimmt nicht mit dem Erwartenden Format überein: 'YYYY-MM-DD'");
                            }
                            break;
                        case 6: // Eintrittsdatum
                            if(DateTimeUtil::validateDate($val))
                            {
                                $MT->fldEntryDate[FLDVALUE] = $val;
                            }
                            else
                            {
                                throw new Exception("Das Datumformat des Eintrittdatum stimmt nicht mit dem Erwartenden Format überein: 'YYYY-MM-DD'");
                            }
                            break;
                        case 7: // Feuerwehr
                            $MT->fldFireDept[FLDVALUE] = $val;
                            $MT->fldFireDeptName[FLDVALUE] = FireDeptTable::findRecId($val)->fldFireDept[FLDVALUE];
                            $MT->insertOrUpdate();
                            $MT->ttscommit();
                            break;
                    }                               
                    $cellNum++;
                }
                echo '</tr>';
            }
            echo '</table>';
        }     
    }
}
catch(Exception $ex)
{
    Obj::getException($ex);
}


?>