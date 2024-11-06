<?php
include "../../../../connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   

    $filename = 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';
    
    // Command to execute mysqldump
    $command = "mysqldump --opt -h $host -u $user -p$password $database > $filename";
    
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
