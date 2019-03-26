<?php
if(@$_POST['print'])
{
    require_once("./fpdf/fpdf.php");
    
    $border = 0;
    
    $curDate = @$_POST['curDate'];
    $curFirebrigade = (@$_POST['curFiredepartment1']) ? @$_POST['curFiredepartment1'] : @$_POST['curFiredepartment2'];
    $curPoints = @$_POST['curPoints'];
    $curCity = @$_POST['curCity'];
    $curPlacement = $_POST['curPlacement'];
    
    if(strlen($curFirebrigade) < 4)
    {
        switch($curFirebrigade)
        {
            case '1': $curFirebrigade = "Ganderkesee"; break;
            case '2': $curFirebrigade = "Bookholzberg"; break;
            case '3': $curFirebrigade = "Falkenburg"; break;
            case '4': $curFirebrigade = "Schierbrok-Schönemoor"; break;
            case '5': $curFirebrigade = "Beckeln"; break;
            case '6': $curFirebrigade = "Prinzhöfte-Horstedt & Klein Henstedt"; break;
            case '7': $curFirebrigade = "Wildeshausen"; break;
            case '8': $curFirebrigade = "Oldenburg-Ofenerdiek"; break;
            case '9': $curFirebrigade = "Oldenburg-Eversten"; break;
            case '10': $curFirebrigade = "Colnrade"; break;
            case '12': $curFirebrigade = "Harpstedt"; break;
            case '13': $curFirebrigade = "Sandkrug"; break;
            case '14': $curFirebrigade = "Kirch- und Klosterseelte"; break;
            case '15': $curFirebrigade = "Wardenburg"; break;
            case '16': $curFirebrigade = "Großenkneten"; break;
        }
        
        $curFirebrigade = utf8_decode($curFirebrigade);
    }
    
    
    $DATE = new DateTime($curDate);
    
    $pdf = new FPDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Times','BI',60);
    $pdf->Cell(40,10,'Urkunde', $border, 1);

    
    $pdf->SetFont("Times", "", 18);
    $pdf->SetY(60);
    $pdf->Cell(0, 10, 'Miniolympiade '.$DATE->format("Y"), $border, 1, 'C');
    $pdf->SetY(75);
    $pdf->Cell(0, 10, 'Die Jugendfeuerwehr', $border, 1, 'C');
    
    $pdf->SetFont("Times", "", 36);
    $pdf->SetY(90);
    $pdf->Cell(0, 10, $curFirebrigade, $border, 1, 'C');
    
    $pdf->SetFont("Times", "", 18);
    $pdf->SetY(105);
    $pdf->Cell(0, 10, 'errang beim Kreisentscheid', $border, 1, 'C');
    $pdf->Cell(0, 10, 'im Bundeswettbewerb der Deutschen Jugendfeuerwehr', $border, 1, 'C');  
    $pdf->Cell(0, 10, 'am '.$curDate.' in '.$curCity, $border, 1, 'C');
    $pdf->Cell(0, 10, 'den', $border, 1, 'C');
    
    $pdf->SetFont("Times", "BI", 40);
    $pdf->SetY(150);
    $pdf->Cell(0, 10, $curPlacement.'. Platz', $border, 1, 'C');
    
    $pdf->SetFont("Times", "", 18);
    $pdf->SetY(180);
    $txt = utf8_decode('Für die erbrachte Leistung verleihen wir diese Urkunde.');
    $pdf->Cell(0, 10, $txt, $border, 1, 'C');  
    
    
    
    //######  Signatures
    // Bild einfügen (Position x = 0 / y = 0)
    $pdf->Image('./signatures/sig_wmietzon.jpg', 15, 220); 
    $pdf->Image('./signatures/sig_smeister.jpg', 135, 220); 
    
    
    
    $pdf->SetFont("Times", "", 12);
    $pdf->SetY(230);
    $pdf->SetX(20);
    $pdf->Cell(40, 10, 'Werner Mietzon', $border, 0, 'C');
    $pdf->SetX(150);
    $pdf->Cell(40, 10, 'Sascha Meister', $border, 1, 'C');
    
    $pdf->SetY(235);
    $pdf->SetX(20);
    $pdf->Cell(40, 10, 'Kreisjugendfeuerwehrwart', $border, 0, 'C');
    $pdf->SetX(150);
    $pdf->Cell(40, 10, 'Fachbereichsleiter Wettbewerbe', $border, 1, 'C');
    
    
    
    $pdf->Output();   
    
}

?>

