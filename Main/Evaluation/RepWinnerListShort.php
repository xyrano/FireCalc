<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
require_once("../../Plugins/fpdf/fpdf.php");
$border = 1;
try
{
    $Contest = new ContestBaseTable(@$_GET['idx']);

    $pdf = new FPDF();
    $pdf->AddPage();

    if(@$_GET['listType'] == "short")
    {
        $pdf->SetFont('Times', 'BI', 20);
        $pdf->Cell(0, 10, 'Siegerliste \'kurz\' - ' . $Contest->fldVenue[FLDVALUE] . ' ' . DateTimeUtil::dateTime($Contest->fldContestDate[FLDVALUE], "d.m.Y"), $border, 1);

        $pdf->SetFont("Times", "", 12);
        $pdf->SetY(30);
    
        // Short list without Points
        $pdf->Cell(70, 10, 'Feuerwehr', 1, 0, 'L');
        $pdf->Cell(25, 10, 'Platzierung', 1, 0, 'C');
        $pdf->Ln();
        
        $i = 1;
        $ET = new ErrorTotals(null, null, $Contest->fldRecId[FLDVALUE], "ERRORPOINTSTOTAL DESC");
        while($ET->next())
        {
            $pdf->Cell(70, 10, utf8_decode($ET->fldFireDeptName[FLDVALUE]), 1, 0, 'L');
            $pdf->Cell(25, 10, $i++, 1, 0, 'C');
            $pdf->Ln();
        }
    }
    else
    {
        $pdf->SetFont('Times', 'BI', 20);
        $pdf->Cell(0, 10, 'Siegerliste \'lang\' - ' . $Contest->fldVenue[FLDVALUE] . ' ' . DateTimeUtil::dateTime($Contest->fldContestDate[FLDVALUE], "d.m.Y"), $border, 1);

        $pdf->SetFont("Times", "", 12);
        $pdf->SetY(30);
        
        // Long list with Points
        $pdf->Cell(70, 10, 'Feuerwehr', 1, 0, 'L');
        $pdf->Cell(25, 10, 'Punkte', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Platzierung', 1, 0, 'C');
        $pdf->Ln();
        $i = 1;
        $ET = new ErrorTotals(null, null, $Contest->fldRecId[FLDVALUE], "ERRORPOINTSTOTAL DESC");                
        while($ET->next())
        {
            $pdf->Cell(70, 10, utf8_decode($ET->fldFireDeptName[FLDVALUE]), 1, 0, 'L');
            $pdf->Cell(25, 10, $ET->fldErrorPointsTotal[FLDVALUE], 1, 0, 'C');
            $pdf->Cell(25, 10, $i++, 1, 0, 'C');
            $pdf->Ln();
        }
    }

    $pdf->Output();
}
catch(Exception $ex)
{
    Obj::getException($ex);
}
    
?>

