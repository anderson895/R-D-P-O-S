<?php

include "../../../../connection.php";


/**
 
 $host = "localhost";
$user = "u547077750_rdpos";
$password = "Rdpos2024";
$database = "u547077750_rdpos"; 
 */

date_default_timezone_set('Asia/Manila');

// Get today's date in the format YYYY-MM-DD
$dateToday = date('Y-m-d');


// Update the $dir variable with the formatted date
$dir = dirname(__FILE__) . "/u547077750_rdpos_{$dateToday}.sql";

// Connect to MySQL
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Open file for writing
$fp = fopen($dir, 'w');

// Export the database structure and data for each table
$query = "SHOW TABLES";
$tables = $conn->query($query);

while ($table = $tables->fetch_row()) {
    $tableName = $table[0];

    // Write table structure (CREATE TABLE)
    $createQuery = "SHOW CREATE TABLE `$tableName`";
    $createResult = $conn->query($createQuery);
    $createRow = $createResult->fetch_row();
    fwrite($fp, $createRow[1] . ";\n\n");

    // Write table data (INSERT INTO)
    $dataQuery = "SELECT * FROM `$tableName`";
    $dataResult = $conn->query($dataQuery);
    
    while ($row = $dataResult->fetch_assoc()) {
        $columns = array_keys($row);
        $values = array_values($row);
        $columnsList = implode("`, `", $columns);
        $valuesList = implode("', '", array_map([$conn, 'real_escape_string'], $values));
        $insertQuery = "INSERT INTO `$tableName` (`$columnsList`) VALUES ('$valuesList');\n";
        fwrite($fp, $insertQuery);
    }

    fwrite($fp, "\n\n");
}

fclose($fp);
$conn->close();

// Force file download
if (file_exists($dir)) {
    // Set headers to force download
    header('Content-Description: File Transfer');
    header('Content-Type: application/sql');
    header('Content-Disposition: attachment; filename="' . basename($dir) . '"');
    header('Content-Length: ' . filesize($dir));
    readfile($dir);
    exit;
} else {
    echo "<p>Error: Backup file not found.</p>";
}
?>
