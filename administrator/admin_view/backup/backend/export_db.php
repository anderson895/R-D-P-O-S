<?php
include "../../../../connection.php";

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape the filename to prevent special characters causing issues
    $filename = 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';

    // Ensure the command is built securely
    $command = escapeshellcmd("mysqldump --opt -h localhost -u u547077750_rdpos -p'Rdpos2024' u547077750_rdpos > $filename");

    // Execute the command and capture the output
    $output = shell_exec($command);

    // Check if the file was created
    if (file_exists($filename)) {
        // Send headers to trigger file download
        header('Content-Type: application/sql');
        header("Content-Disposition: attachment; filename=" . basename($filename));
        
        // Read and output the file
        readfile($filename);
        
        // Delete the backup file after download
        unlink($filename);
    } else {
        // Handle errors
        echo "Error exporting database!";
    }
}
?>
