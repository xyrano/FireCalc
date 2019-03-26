<?php
require_once("../../Functions.php");
require_once(sysGetBaseDir()."/Factory.php");
require_once("../../Plugins/fpdf/fpdf.php");
$border = 0;
try
{
    $Contest = new ContestBaseTable(@$_GET['idx']);
    $SignatureTable1 = new SignatureTable($Contest->fldContestLeader[FLDVALUE]);        // first
    $SignatureTable2 = new SignatureTable($Contest->fldContestTeamManager[FLDVALUE]);   // second
    
    // save img to path    
    header("Content-type: " . $SignatureTable1->fldSigImageExt[FLDVALUE]);
    $im1 = $SignatureTable1->signature(null, null, null, true);
    file_put_contents("first.png", $im1);
    
    header("Content-type: " . $SignatureTable2->fldSigImageExt[FLDVALUE]);
    $im2 = $SignatureTable2->signature(null, null, null, true);
    file_put_contents("second.png", $im2);
    
    
    $pdf = new FPDF();
    
    $i = 1; // Platz
    $ET = new ErrorTotals(null, null, $Contest->fldRecId[FLDVALUE], "ERRORPOINTSTOTAL DESC");    
    while($ET->next())
    {                
        $pdf->AddPage();

        $pdf->SetFont('Times','BI',60);
        $pdf->Cell(0,20,'Urkunde', $border, 1);


        $pdf->SetFont("Times", "", 18);
        $pdf->SetY(60);
        $pdf->Cell(0, 10, 'Miniolympiade '.DateTimeUtil::dateTime($Contest->fldContestDate[FLDVALUE], "d.m.Y"), $border, 1, 'C');
        $pdf->SetY(75);
        $pdf->Cell(0, 10, 'Die Jugendfeuerwehr', $border, 1, 'C');

        $pdf->SetFont("Times", "", 36);
        $pdf->SetY(90);
        $pdf->Cell(0, 13, utf8_decode($ET->fldFireDeptName[FLDVALUE]), $border, 1, 'C');

        $pdf->SetFont("Times", "", 18);
        $pdf->SetY(105);
        $pdf->Cell(0, 10, 'errang beim Kreisentscheid', $border, 1, 'C');
        $pdf->Cell(0, 10, 'im Bundeswettbewerb der Deutschen Jugendfeuerwehr', $border, 1, 'C');  
        $pdf->Cell(0, 10, 'am '.DateTimeUtil::dateTime($Contest->fldContestDate[FLDVALUE], "d.m.Y").' in '.$Contest->municipalTable()->fldMunicipal[FLDVALUE], $border, 1, 'C');
        $pdf->Cell(0, 10, 'den', $border, 1, 'C');

        $pdf->SetFont("Times", "BI", 40);
        $pdf->SetY(150);
        $pdf->Cell(0, 13, $i++.'. Platz', $border, 1, 'C');

        $pdf->SetFont("Times", "", 18);
        $pdf->SetY(180);
        $txt = utf8_decode('Für die erbrachte Leistung verleihen wir diese Urkunde.');
        $pdf->Cell(0, 10, $txt, $border, 1, 'C');  


       
            
        //######  Signatures
        // Bild einfügen (Position x = 0 / y = 0)
        // nur wenn Bild größer 0 bytes und/oder vorhanden
        if(file_exists('./first.png') && filesize('./first.png') > 0)
        {       
            $pdf->Image('./first.png', 10, 200, 60, 30); 
            $pdf->SetFont("Times", "", 12);
            $pdf->SetY(230);
            $pdf->SetX(20);
            $pdf->Cell(40, 10, $SignatureTable1->name(false), $border, 0, 'C');
            $pdf->SetX(150);
            $pdf->Cell(40, 10, $SignatureTable2->name(false), $border, 1, 'C');
        }
        
        if(file_exists('./second.png') && filesize('./first.png') > 0)
        {
            $pdf->Image('./second.png', 140, 200, 60, 30); 
            $pdf->SetY(235);
            $pdf->SetX(20);
            $pdf->Cell(40, 10, $SignatureTable1->signatureFunction(), $border, 0, 'C');
            $pdf->SetX(150);
            $pdf->Cell(40, 10, $SignatureTable2->signatureFunction(), $border, 1, 'C');
        }
    }
    $pdf->Output();
}
catch(Exception $ex)
{
    Obj::getException($ex);
}
    
?>

