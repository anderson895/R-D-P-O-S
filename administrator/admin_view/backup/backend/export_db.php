<?php
include "../../../../connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filename = $database . '-' . date('Y-m-d_H-i-s') . '.sql';

    // Attempt to use `mysqldump` only if on a supported server
    if (function_exists('system')) {
        $command = "mysqldump --opt -h $host -u $user -p$password $database > $filename";
        system($command, $output);

        if ($output === 0) {
            header('Content-Type: application/octet-stream');
            header("Content-Disposition: attachment; filename=$filename");
            readfile($filename);
            unlink($filename);
        } else {
            echo "Error: Could not export database.";
        }
    } else {
        echo "Error: 'system' command not allowed on this server.";
    }
}
?>
