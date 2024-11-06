<?php
$database = 'u547077750_rdpos';
$user = 'u547077750_rdpos';
$pass = 'Rdpos2024';
$host = 'localhost';
$dir = dirname(__FILE__) . '/dump.sql';

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $database);

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
echo "<p>Database backup successful!</p>";

$conn->close();
?>
