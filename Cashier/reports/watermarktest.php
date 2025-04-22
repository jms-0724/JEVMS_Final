<?php
require_once('tcpdf/tcpdf.php');

$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Document with Watermark');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Add a page
$pdf->AddPage();

// Set transparency for the watermark
$pdf->SetAlpha(0.3);

// Add the watermark image (adjust the path and dimensions as needed)
$pdf->Image('./img/bwd_logo2.png', 50, 70, 100, 100, '', '', '', false, 300, '', false, false, 0, false, false, false);

// Reset the alpha to full opacity
$pdf->SetAlpha(1);


// Add some content
$pdf->SetFont('Helvetica', '', 12);
$pdf->Write(0, 'This is the main content of the document.', '', 0, 'L', true, 0, false, false, 0);

// Output PDF
$pdf->Output('example_with_image_watermark.pdf', 'I');

?>
