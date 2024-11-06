<?php
include "../../../../connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $filename = $database."_" . date('Y-m-d_H-i-s') . '.sql';
    
    // Open file for writing
    $backupFile = fopen($filename, 'w');
    if (!$backupFile) {
        die("Error creating backup file!");
    }

    // Connect to the database
    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch all tables
    $tables = $conn->query("SHOW TABLES");
    if (!$tables) {
        die("Error fetching tables: " . $conn->error);
    }

    while ($tableRow = $tables->fetch_array()) {
        $tableName = $tableRow[0];
        
        // Get CREATE TABLE statement
        $createTableQuery = $conn->query("SHOW CREATE TABLE `$tableName`")->fetch_array()[1] . ";\n\n";
        fwrite($backupFile, $createTableQuery);

        // Get table data
        $rows = $conn->query("SELECT * FROM `$tableName`");
        if ($rows->num_rows > 0) {
            while ($row = $rows->fetch_assoc()) {
                $rowValues = array_map([$conn, 'real_escape_string'], array_values($row));
                $rowData = "INSERT INTO `$tableName` VALUES ('" . implode("','", $rowValues) . "');\n";
                fwrite($backupFile, $rowData);
            }
        }
        fwrite($backupFile, "\n\n"); // Separate tables
    }

    fclose($backupFile);

    // Force download of the backup file
    header('Content-Type: application/sql');
    header("Content-Disposition: attachment; filename=$filename");
    readfile($filename);

    // Delete the file after download
    unlink($filename);
}
?>
