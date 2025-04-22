<?php
// General Journal Report
session_start();
require('tcpdf/tcpdf.php');
require_once(__DIR__ . '/../../connections/connection.php');

$pdf = new TCPDF();
$pdf->SetTitle('General Journal');

// Disable the default header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'Legal');
$pdf->SetFont('Times', 'B', 12);

// Set transparency for the watermark
$pdf->SetAlpha(0.3);

// Add the watermark image (adjust the path and dimensions as needed)
$pdf->Image('./img/bwd_logo2.png', 50, 70, 100, 100, '', '', '', false, 300, '', false, false, 0, false, false, false);

// Reset the alpha to full opacity
$pdf->SetAlpha(1);

$datetoday = date('Y/m/d');

$getValue = $_GET['date_to'];
$date = DateTime::createFromFormat('Y-m-d', $getValue);
$valueDate = $date->format('F, d, Y');
$valueDate2 = $date->format('F Y');

$fiscal_id = $_SESSION['fiscal_id'];

$pdf->SetFont('arialbd', '', 10);
// Header Information
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $sqlCategory = $conn->prepare("SELECT * FROM tbl_journal_category WHERE category_id = :category_id");
    $sqlCategory->bindParam("category_id", $category_id, PDO::PARAM_INT);
    $sqlCategory->execute();
    $resultCategory = $sqlCategory->fetch();
    $category_name = $resultCategory["category_name"];
    if ($category_name == "Miscellaneous"){
        $pdf->Cell(0, 2, "General" . ' Journal', '', 1, 'C', false);
    } else {
        $pdf->Cell(0, 2, $category_name . ' Journal', '', 1, 'C', false);
    }
    
} else {
    $pdf->Cell(0, 2, 'GENERAL JOURNAL', '', 1, 'C', false);
}

$pdf->Cell(0, 2, 'Agency: Balaoan Water District', '', 1, 'C', false);
$pdf->Cell(0, 2, $valueDate2, '', 1, 'C', false);
$pdf->SetFont('arial', '', 10);
$pdf->Cell(0, 6, '', '', 1, 'C', false);

$pdf->Cell(20, 5, 'Date', 'LTR', 0, 'C', false);
$pdf->Cell(20, 5, 'JEV.', 'LTR', 0, 'C', false);
$pdf->Cell(75, 5, 'Particulars', 'LTR', 0, 'C', false);
$pdf->Cell(25, 5, 'Account', 'LTR', 0, 'C', false);
$pdf->Cell(10, 5, 'P', 'LTR', 0, 'C', false);
$pdf->Cell(40, 5, 'Amount', 'LTR', 1, 'C', false);

$pdf->Cell(20, 5, '', 'LRB', 0, 'C', false);
$pdf->Cell(20, 5, 'No.', 'LRB', 0, 'C', false);
$pdf->Cell(75, 5, '', 'LRB', 0, 'C', false);
$pdf->Cell(25, 5, 'Code', 'LRB', 0, 'C', false);
$pdf->Cell(10, 5, '', 'LRB', 0, 'C', false);
$pdf->Cell(20, 5, 'Debit', 'LTRB', 0, 'C', false);
$pdf->Cell(20, 5, 'Credit', 'LTRB', 1, 'C', false);

if (isset($_GET['date_from']) && isset ($_GET['date_to']) &&  isset($_GET['category_id'])){
    $datefrom = $_GET['date_from'];
    $dateto = $_GET['date_to'];
    $category_id = $_GET['category_id'];
    $sql1 = $conn->prepare("SELECT * FROM tbl_journal_entry INNER JOIN tbl_journal_category ON tbl_journal_entry.category_id = tbl_journal_category.category_id WHERE fiscal_id = :fiscal_id AND journal_date BETWEEN :fromDate AND :toDate AND tbl_journal_entry.category_id = :category_id ORDER BY journal_date ASC, journal_voucher_no ASC");
    $sql1->bindParam("fiscal_id", $fiscal_id);
    $sql1->bindParam("fromDate", $datefrom);
    $sql1->bindParam("toDate", $dateto);
    $sql1->bindParam("category_id", $category_id);
    $sql1->execute();
    $data1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
}
 else if  (isset($_GET['date_from']) && isset($_GET['date_to'])){
    $datefrom = $_GET['date_from'];
    $dateto = $_GET['date_to'];
    $sql1 = $conn->prepare("SELECT * FROM tbl_journal_entry WHERE fiscal_id = :fiscal_id AND journal_date BETWEEN :fromDate AND :toDate ORDER BY journal_date ASC, journal_voucher_no ASC");
    $sql1->bindParam("fiscal_id", $fiscal_id);
    $sql1->bindParam("fromDate", $datefrom);
    $sql1->bindParam("toDate", $dateto);
    $sql1->execute();
    $data1 = $sql1->fetchAll(PDO::FETCH_ASSOC);

}  
 else {
    // Query to fetch all journal entries by fiscal_id
$sql1 = $conn->prepare("SELECT * FROM tbl_journal_entry WHERE fiscal_id = :fiscal_id ORDER BY journal_date ASC, journal_voucher_no ASC");
$sql1->bindParam("fiscal_id", $fiscal_id);
$sql1->execute();
$data1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
}


foreach ($data1 as $row1) {
    $pdf->SetFont('arial', '', 9);
    // Print the Date and JEV number for the first entry in the group
    $isFirstEntry = true; // Track if it's the first entry in the group

    // Fetch the journal items (particulars) for each journal voucher
    $jevNO = $row1['journal_voucher_id'];
    $sql2 = $conn->prepare("SELECT * FROM tbl_journal_items INNER JOIN tbl_account_title ON tbl_journal_items.account_code = tbl_account_title.account_code WHERE journal_voucher_id = :jevNO ");
    $sql2->bindParam("jevNO", $jevNO);
    $sql2->execute();
    $data2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data2 as $row2) {
        $pdf->SetFont('arial', '', 9);
        
        // Handle cell borders based on whether it's the first entry
        if ($isFirstEntry) {
            $pdf->Cell(20, 5, $row1['journal_date'], 'LTR', 0, 'C', false);
            $pdf->Cell(20, 5, $row1['journal_voucher_no'], 'LTR', 0, 'C', false);
            $pdf->Cell(75, 5, '', 'LRB', 0, 'C', false);
            $pdf->Cell(25, 5, '', 'LRB', 0, 'C', false);
            $pdf->Cell(10, 5, '', 'LRB', 0, 'C', false);
            $pdf->Cell(20, 5, '', 'LTRB', 0, 'C', false);
            $pdf->Cell(20, 5, '', 'LTRB', 1, 'C', false);
            $isFirstEntry = false; // Set to false after the first entry
        } else {
            // $pdf->Cell(20, 5, '', 'LTR', 0, 'C', false); // Empty cell with left border
            // $pdf->Cell(20, 5, '', 'LTR', 0, 'C', false); // Empty cell with left border
        }
    
        // Calculate the height for account_name
        $rowHeight = $pdf->getStringHeight(75, $row2['account_name']);
    
        if ($row2['journal_adjustment'] === "Debit") {
            $pdf->Cell(20, 8, '', 'LTR', 0, 'C', false); // Empty cell with left border
            $pdf->Cell(20, 8, '', 'LTR', 0, 'C', false); // Empty cell with left border
            $x = $pdf->GetX(); // Get current X position
            $y = $pdf->GetY(); // Get current Y position
            
            
            // MultiCell for account_name
            $pdf->MultiCell(75, $rowHeight, $row2['account_name'], 'LRB', 'L');
            
            // Set the new X and Y position for the remaining cells
            $pdf->SetXY($x + 75, $y); // Reset X position, Y should be adjusted by MultiCell
            
            $pdf->Cell(25, $rowHeight, $row2['account_code'], 'LRB', 0, 'C', false);
            $pdf->Cell(10, $rowHeight, '', 'LRB', 0, 'C', false);
            $pdf->Cell(20, $rowHeight, $row2['journal_amount'], 'LTRB', 0, 'C', false); // Debit amount
            $pdf->Cell(20, $rowHeight, '', 'LTRB', 1, 'C', false); // Empty credit cell
        }  else {
            // For Credit
            $pdf->Cell(20, 10, '', 'LR', 0, 'C', false); // Empty cell with left border
            $pdf->Cell(20, 10, '', 'LR', 0, 'C', false); // Empty cell with left border
            $x = $pdf->GetX(); // Get current X position
            $y = $pdf->GetY(); // Get current Y position
        
            // Set a height for the MultiCell
            $creditRowHeight = $pdf->getStringHeight(70, $row2['account_name']); // Ensure correct height is calculated
            $pdf->Cell(5, $creditRowHeight, '', 'LB', 0, 'C', false);
            $pdf->MultiCell(70, $creditRowHeight, $row2['account_name'], 'RB', 'L');
        
            // Set the new X position after MultiCell and adjust Y position for the height of the account name
            $pdf->SetXY($x + 75, $y); // Reset X position, Y should be adjusted by MultiCell
        
            $pdf->Cell(25, $creditRowHeight, $row2['account_code'], 'LRB', 0, 'C', false);
            $pdf->Cell(10, $creditRowHeight, '', 'LRB', 0, 'C', false);
            $pdf->Cell(20, $creditRowHeight, '', 'LTRB', 0, 'C', false); // Empty debit cell
            $pdf->Cell(20, $creditRowHeight, $row2['journal_amount'], 'LTRB', 1, 'C', false); // Credit amount
        }
    }
    
    $pdf->Cell(20, 5, '', 'LR', 0, 'C', false);
    $pdf->Cell(20, 5, '', 'LR', 0, 'C', false);
    $pdf->Cell(75, 5, '', 'LR', 0, 'C', false);
    $pdf->Cell(25, 5, '', 'LR', 0, 'C', false);
    $pdf->Cell(10, 5, '', 'LR', 0, 'C', false);
    $pdf->Cell(20, 5, '', 'LR', 0, 'C', false);
    $pdf->Cell(20, 5, '', 'LR', 1, 'C', false);
// Print the description for each JEV
$pdf->Cell(20, 9, '', 'LRB', 0, 'C', false); // Empty date cell
$pdf->Cell(20, 9, '', 'LRB', 0, 'C', false); // Empty JEV number cell
$y = $pdf->GetY(); // Get current Y position after all entries


// Store current X position before using MultiCell for description
$xBeforeDescription = $pdf->GetX();
$descriptionHeight = $pdf->getStringHeight(75, $row1['description']); // Get the height based on the string

$pdf->MultiCell(75, $descriptionHeight, $row1['description'], 'LRB', 'L', 0, 'L');

// After description is printed, set the position for the next cells
$pdf->SetXY($xBeforeDescription + 75, $y); // Move X after the description MultiCell

// Now print the rest of the cells after the description
$pdf->Cell(25, $descriptionHeight, '', 'LTRB', 0, 'C', false); // Empty account code
$pdf->Cell(10, $descriptionHeight, '', 'LTRB', 0, 'C', false); // Empty P
$pdf->Cell(20, $descriptionHeight, '', 'LTRB', 0, 'C', false); // Empty debit/credit amount
$pdf->Cell(20, $descriptionHeight,'', 'LTRB', 1, 'C', false); // Empty amount

}
// $sigactive = "Active";
// $sqlsignatory = $conn->prepare('SELECT * FROM tbl_signatories WHERE signatory_status = :sig_status');
// $sqlsignatory->bindParam(":sig_status",$sigactive);
// $sqlsignatory->execute();
// $signame = $sqlsignatory->fetch();
// $sig_fname = $signame['signatory_fname'];
// $sig_mname = $signame['signatory_mname'];
// $sig_lname = $signame['signatory_lname'];
// $sig_position = $signame['signatory_position'];


// $fname = $_SESSION['fname'];
// $lname = $_SESSION['lname'];
// $mname = $_SESSION['mname'];
// $position = $_SESSION['position'];
// // Manually adjust the position if needed
// $pdf->Ln(10); // Add some space before the signatories
// $pdf->Cell(50, 6, 'Prepared By:', '', 0, 'l', false);
// $pdf->Cell(100, 6, '', '', 0, 'l', false);

// $pdf->Cell(50, 6, 'Noted By:', '', 1, 'l', false);
// $pdf->Ln(10); // Add some space before the signatories

// $pdf->SetFont('Times', '', 12);
// $pdf->Cell(50, 6, "$fname $mname $lname", '', 0, 'l', false);
// $pdf->Cell(100, 6, '', '', 0, 'l', false);
// $pdf->Cell(50, 6, "$sig_fname $sig_mname $sig_lname", '', 1, 'l', false);


// $pdf->Cell(50, 6, "$position", '', 0, 'l', false);
// $pdf->Cell(100, 6, '', '', 0, 'l', false);
// $pdf->Cell(50, 6, "$sig_position", '', 1, 'l', false);

$start_time = $_SESSION['sigDate']; 
$sigactive = "Active";

$sqlsignatory = $conn->prepare(
    'SELECT * FROM tbl_signatories 
    WHERE signatory_date <= :start_time
    ORDER BY signatory_date DESC 
     LIMIT 1');
      $sqlsignatory->bindParam(":start_time", $getValue);
      $sqlsignatory->execute();
    $signame = $sqlsignatory->fetch();



// Set variables for the signatory's information if found
$sig_fname = $signame['signatory_fname'] ?? '';
$sig_mname = $signame['signatory_mname'] ?? '';
$sig_lname = $signame['signatory_lname'] ?? '';
$sig_position = $signame['signatory_position'] ?? '';

// Get current session user details
$fname = $_SESSION['fname'];
$mname = $_SESSION['mname'];
$lname = $_SESSION['lname'];
$position = $_SESSION['position'];

// PDF Layout
$pdf->Ln(10); // Add some space before the signatories
$pdf->Cell(50, 6, 'Prepared By:', '', 0, 'l', false);
$pdf->Cell(100, 6, '', '', 0, 'l', false);
$pdf->Cell(50, 6, 'Noted By:', '', 1, 'l', false);

$pdf->Ln(10); // Add more space
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 6, "$fname $mname $lname", '', 0, 'l', false);
$pdf->Cell(100, 6, '', '', 0, 'l', false);
$pdf->Cell(50, 6, "$sig_fname $sig_mname $sig_lname", '', 1, 'l', false);

$pdf->Cell(50, 6, "$position", '', 0, 'l', false);
$pdf->Cell(100, 6, '', '', 0, 'l', false);
$pdf->Cell(50, 6, "$sig_position", '', 1, 'l', false);

// Output the PDF
$pdf->Output('general_journal_' . date('Ymd') . '.pdf', 'I'); // Output as PDF with dynamic filename
?>
