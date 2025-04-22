<?php
require(__DIR__ . '/../reports/fpdf186/fpdf.php');
// require(__DIR__ . '/./../reports/fpdf186/fpdfalpha.php');
require_once(__DIR__ . "/../../connections/connection.php");

class PDF extends FPDF
{
    // Page footer
    function Footer()
    {
        // Implement footer if needed
    }
}
$pdf = new PDF();
$pdf->SetTitle('Help');



if (isset($_GET['help_topic_id'])){
    $help_topic_id = $_GET['help_topic_id'];
    $sql1 = $conn->prepare("SELECT * FROM tbl_help WHERE help_id = :help_id");
    $sql1->bindParam(':help_id', $help_topic_id);
    $sql1->execute();
    $help_topic = $sql1->fetch();

    $sql2 = $conn->prepare("SELECT * FROM tbl_help INNER JOIN tbl_help_items ON tbl_help.help_id = tbl_help_items.help_id WHERE tbl_help.help_id = :help_id2");
    $sql2->bindParam(':help_id2', $help_topic_id);
    $sql2->execute();
    $help_items = $sql2->fetchAll();
} 

$pdf->AliasNbPages();
$pdf->AddPage('P', 'Legal');

$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(0, 10, 'Journal Entry Voucher Management System', '', 1, 'C', false);
$pdf->Cell(0, 10, 'User Guide', '', 1, 'C', false);

$pdf->Cell(0, 10,  $help_topic['topic'], '', 1, 'L', false);

$pdf->SetFont('Arial', '', 12);
foreach ($help_items as $help_row){

    $x = $pdf->GetX(); // Get current X position
    $y = $pdf->GetY(); // Get current Y position
    
    // MultiCell for account_name with a width of 25
    $pdf->MultiCell(0, 5, $help_row['help_text'], '', 'L');
    $pdf->SetXY($x + 25, $y);


    
}

$pdf->Output()
?>