<?php
include "../../../../connection.php";

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape the filename to prevent special characters causing issues
    $filename = 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';

    // Ensure the command is built securely
    $command = escapeshellcmd("mysqldump --opt -h localhost -u u547077750_rdpos -p'Rdpos2024' u547077750_rdpos > $filename");

    // Execute the command and capture any error output
    $output = null;
    $resultCode = null;
    exec($command, $output, $resultCode);

    // Check for success
    if ($resultCode === 0) {
        // Send headers to trigger file download
        header('Content-Type: application/sql');
        header("Content-Disposition: attachment; filename=" . basename($filename));
        
        // Read and output the file
        readfile($filename);
        
        // Delete the backup file after download
        unlink($filename);
    } else {
        // Handle errors and display them
        echo "Error exporting database! Command output: " . implode("\n", $output);
    }
}
?>
