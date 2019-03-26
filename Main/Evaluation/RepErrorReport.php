<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
require_once("../../Plugins/fpdf/fpdf.php");
$border = 1;
try
{
    $Contest = new ContestBaseTable(@$_GET['idx']);

    $pdf = new FPDF();
    

    if(@$_GET['listType'] == "short")
    {                
        $ET = new ErrorTotals(null, null, $Contest->fldRecId[FLDVALUE], "ERRORPOINTSTOTAL DESC");        
        while($ET->next())
        {
            $pdf->AddPage();
            $pdf->SetFont('Times', 'BI', 20);
            $pdf->Cell(0, 10, 'Fehlerkatalog \'kurz\' - ' . $Contest->fldVenue[FLDVALUE] . ' ' . DateTimeUtil::dateTime($Contest->fldContestDate[FLDVALUE], "d.m.Y"), $border, 1);
            $pdf->Cell(0, 10, 'Feuerwehr: ' . utf8_decode($ET->fldFireDeptName[FLDVALUE]), 1, 0, 'L');
            $pdf->SetFont("Times", "", 12);
            $pdf->SetY(30);  
            
            $pdf->Cell(0, 10, 'Gruppe: ' . utf8_decode($ET->memberGroup()->fldGroupName[FLDVALUE]), 1, 1, 'L');
            $pdf->Cell(0, 10, 'Durschnittsalter: ' . $ET->memberGroup()->getAverageAge(1) . ' Jahre', 1, 1, 'L');
            $pdf->Cell(0, 10, 'Mitglieder', 1, 1, 'L');
            $MemberIterator = new MapIterator($ET->memberGroup()->memberIdMap());
            while($MemberIterator->next())
            {
                $MEMBER = new MemberTable($MemberIterator->currentValue());
                $pdf->Cell(20, 10, $MEMBER->fldIdentityNum[FLDVALUE], 1, 0, 'L');
                $pdf->Cell(60, 10, utf8_decode($MEMBER->name()), 1, 0, 'L');
                $pdf->Ln();
                $MEMBER = null;
            }
            $MemberIterator = null; // reset          
        }
    }

    $pdf->Output();
}
catch(Exception $ex)
{
    Obj::getException($ex);
}
    
?>

