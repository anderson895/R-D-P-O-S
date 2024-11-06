<?php
include "../../../../connection.php";

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   

    $filename = 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';
    
    // Command to execute mysqldump
    $command = "mysqldump --opt -h localhost -u u547077750_rdpos -p Rdpos2024 u547077750_rdpos > $filename";
    
    // Execute command
    system($command, $output);
    
    // Check for success and prompt download
    if ($output === 0) {
        header('Content-Type: application/sql');
        header("Content-Disposition: attachment; filename=$filename");
        readfile($filename);
        unlink($filename); // Delete file after download
    } else {
        echo "Error exporting database!";
    }
}
?>
