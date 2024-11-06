<?php
include "../../../../connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filename = $database . '-' . date('Y-m-d_H-i-s') . '.sql';

    // Open a file for writing
    $file = fopen($filename, 'w');
    if (!$file) {
        echo "Error: Could not create file.";
        exit;
    }

    // Connect to the database
    $connection = new mysqli($host, $user, $password, $database);
    if ($connection->connect_error) {
        echo "Error: Could not connect to the database.";
        exit;
    }

    // Get all tables
    $tables = $connection->query("SHOW TABLES");
    while ($table = $tables->fetch_array()) {
        $tableName = $table[0];

        // Get CREATE TABLE statement
        $createTableQuery = $connection->query("SHOW CREATE TABLE $tableName")->fetch_array();
        fwrite($file, "\n\n" . $createTableQuery[1] . ";\n\n");

        // Get table data
        $rows = $connection->query("SELECT * FROM $tableName");
        while ($row = $rows->fetch_assoc()) {
            $values = array_map([$connection, 'real_escape_string'], array_values($row));
            $valuesList = "'" . implode("', '", $values) . "'";
            $sql = "INSERT INTO $tableName VALUES ($valuesList);\n";
            fwrite($file, $sql);
        }
    }

    // Close file and connection
    fclose($file);
    $connection->close();

    // Prompt download of the SQL file
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=$filename");
    readfile($filename);
    unlink($filename); // Delete file after download
}
?>
