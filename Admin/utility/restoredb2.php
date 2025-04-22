<?php
// require(__DIR__ . "/../../connections/conn.php");

// if (isset($_POST['restore'])) {
//     $file = $_FILES['sql_file']['tmp_name'];

//     // Check if file is uploaded and is a SQL file
//     if ($file && pathinfo($_FILES['sql_file']['name'], PATHINFO_EXTENSION) == 'sql') {
//         $sql_content = file_get_contents($file);

//         // Create a new connection
//         if ($conn->connect_error) {
//             die("Connection failed: " . $conn->connect_error);
//         }

//         // Split SQL statements by semicolons to handle multiple statements
//         $queries = explode(';', $sql_content);

//         $success = true;
//         $log_file = 'restore_log.txt';  // Optional: Log the restoration process

//         // Execute each query one by one
//         foreach ($queries as $query) {
//             $query = trim($query);
//             if (!empty($query)) {
//                 // Check if the query is a CREATE TABLE statement
//                 if (stripos($query, 'CREATE TABLE') !== false) {
//                     // Extract the table name
//                     preg_match('/CREATE TABLE `?([a-zA-Z0-9_]+)`?/i', $query, $matches);
//                     if (isset($matches[1])) {
//                         $table_name = $matches[1];
//                         // Prepare the DROP TABLE statement
//                         $drop_query = "DROP TABLE IF EXISTS `$table_name`;";
//                         // Execute the DROP TABLE statement
//                         if (!$conn->query($drop_query)) {
//                             file_put_contents($log_file, "Error dropping table: " . $conn->error . "\n", FILE_APPEND);
//                             $success = false;
//                         }
//                     }
//                 }

//                 // Now execute the CREATE TABLE or any other SQL statement
//                 if (!$conn->query($query)) {
//                     file_put_contents($log_file, "Error executing query: " . $conn->error . "\n", FILE_APPEND);
//                     $success = false;
//                 } else {
//                     file_put_contents($log_file, "Query executed successfully.\n", FILE_APPEND);
//                 }
//             }
//         }

//         $conn->close();

//         // Provide feedback to the user
//         if ($success) {
//             echo "Success";
//         } else {
//             echo "Failed";
//         }

//     } else {
//         echo "Invalid SQL File";
//     }
// }

if (isset($_POST['restore'])) {
    $file = $_FILES['sql_file']['tmp_name'];

    // Check if file is uploaded and is a SQL file
    if ($file && pathinfo($_FILES['sql_file']['name'], PATHINFO_EXTENSION) == 'sql') {
        $sql_content = file_get_contents($file);

        try {
            // Disable foreign key checks to avoid issues with dependencies during restoration
            $conn->exec("SET FOREIGN_KEY_CHECKS = 0");

            // Split SQL statements by semicolons to handle multiple statements
            $queries = explode(';', $sql_content);

            $success = true;
            $log_file = 'restore_log.txt';  // Optional: Log the restoration process

            // Execute each query one by one
            foreach ($queries as $query) {
                $query = trim($query);
                if (!empty($query)) {
                    // Check if the query is a CREATE TABLE statement
                    if (stripos($query, 'CREATE TABLE') !== false) {
                        // Extract the table name
                        preg_match('/CREATE TABLE `?([a-zA-Z0-9_]+)`?/i', $query, $matches);
                        if (isset($matches[1])) {
                            $table_name = $matches[1];
                            // Prepare the DROP TABLE statement
                            $drop_query = "DROP TABLE IF EXISTS `$table_name`;";
                            // Execute the DROP TABLE statement
                            $conn->exec($drop_query);
                        }
                    }

                    // Now execute the CREATE TABLE or any other SQL statement
                    try {
                        $conn->exec($query); // Execute the query using PDO
                        file_put_contents($log_file, "Query executed successfully.\n", FILE_APPEND);
                    } catch (PDOException $e) {
                        file_put_contents($log_file, "Error executing query: " . $e->getMessage() . "\n", FILE_APPEND);
                        $success = false;
                    }
                }
            }

            // Re-enable foreign key checks
            $conn->exec("SET FOREIGN_KEY_CHECKS = 1");

            // Provide feedback to the user
            if ($success) {
                echo "Success";
            } else {
                echo "Failed";
            }

        } catch (PDOException $e) {
            file_put_contents($log_file, "Connection failed: " . $e->getMessage() . "\n", FILE_APPEND);
            echo "Connection failed: " . $e->getMessage();
        }
    } else {
        echo "Invalid SQL File";
    }
}