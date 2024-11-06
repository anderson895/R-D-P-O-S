<?php
include "../../../../connection.php"; // Include your database connection

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Define the backup filename with timestamp
    $filename = 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';
    
    // Open a new file for writing
    $file = fopen($filename, 'w');
    
    if (!$file) {
        echo "Error opening the file for writing.";
        exit;
    }

    // Get the database name from the connection (or hardcode it if necessary)
    $dbName = 'u547077750_rdpos';

    // Get all the tables in the database
    $tablesResult = mysqli_query($connections, "SHOW TABLES");

    if (!$tablesResult) {
        echo "Error fetching tables.";
        exit;
    }

    // Loop through each table and dump its structure and data
    while ($row = mysqli_fetch_row($tablesResult)) {
        $table = $row[0];
        
        // Write the CREATE TABLE statement
        $createTableResult = mysqli_query($connections, "SHOW CREATE TABLE $table");
        $createTableRow = mysqli_fetch_row($createTableResult);
        fwrite($file, $createTableRow[1] . ";\n\n");

        // Write the INSERT INTO statements for each row in the table
        $dataResult = mysqli_query($connections, "SELECT * FROM $table");
        while ($dataRow = mysqli_fetch_assoc($dataResult)) {
            $columns = array_keys($dataRow);
            $values = array_map(function($value) {
                return "'" . mysqli_real_escape_string($GLOBALS['connection'], $value) . "'";
            }, array_values($dataRow));
            fwrite($file, "INSERT INTO $table (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ");\n");
        }
        fwrite($file, "\n\n");
    }

    // Close the file after writing the data
    fclose($file);

    // Check if the file was created and send it as a download
    if (file_exists($filename)) {
        header('Content-Type: application/sql');
        header("Content-Disposition: attachment; filename=" . basename($filename));
        readfile($filename);
        unlink($filename); // Delete the file after download
    } else {
        echo "Error exporting database!";
    }
}
?>
