<?php
$database = 'u547077750_rdpos';
$user = 'u547077750_rdpos';
$pass = 'Rdpos2024';
$host = 'localhost';
$dir = dirname(__FILE__) . '/dump.sql';

$mysqlDir = '/usr/bin/';  // Adjust according to your hosting environment
$mysqldump = $mysqlDir . 'mysqldump';

$command = "{$mysqldump} --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1";
$output = shell_exec($command);

if ($output === null) {
    echo "<p>Error during backup. Check your server's log files for details.</p>";
} else {
    echo "<p>Database backup successful!</p>";
}
?>
