<?php
require(__DIR__ . "/../../connections/connection.php");

$tables = array();
$query = $conn->query("SHOW TABLES");
while ($row = $query->fetch(PDO::FETCH_NUM)) {
    $tables[] = $row[0];
}

if (empty($tables)) {
    die("No tables found in the database.");
}

$sqlScript = "";

foreach ($tables as $table) {
    
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
