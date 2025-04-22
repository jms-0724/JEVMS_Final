<?php
require(__DIR__ . "/../../connections/connection.php");

// Check if tables are selected
$selectedTables = $_POST['tables']; // Get selected tables from the form
if (empty($selectedTables)) {
    die("No tables selected.");
}

$sqlScript = "";

foreach ($selectedTables as $table) {
    // Prepare SQL script for creating table structure
    $query = "SHOW CREATE TABLE `$table`";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $sqlScript .= "\n\n" . $row['Create Table'] . ";\n\n";
    
    // Prepare SQL script for dumping data for each table
    $query = "SELECT * FROM `$table`";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $columnCount = $stmt->columnCount();
    
    foreach ($rows as $row) {
        $sqlScript .= "INSERT INTO `$table` VALUES(";
        $j = 0;
        foreach ($row as $value) {
            if (is_null($value)) {
                $sqlScript .= "NULL";
            } else {
                $sqlScript .= $conn->quote($value);
            }
            
            if ($j < ($columnCount - 1)) {
                $sqlScript .= ',';
            }
            $j++;
        }
        $sqlScript .= ");\n";
    }
    
    $sqlScript .= "\n"; 
}

if (!empty($sqlScript)) {
    // Save the SQL script to a backup file
    $backup_file_name = 'backup_' . time() . '.sql'; // Ensure $database_name is defined or replace with a static name
    file_put_contents($backup_file_name, $sqlScript); 

    // Output the file for download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file_name));
    ob_clean();
    flush();
    readfile($backup_file_name);

    // Remove the backup file from the server
    unlink($backup_file_name);
}
?>
