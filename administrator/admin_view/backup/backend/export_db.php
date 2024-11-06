<?php
include "../../../../connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);

$database = 'u547077750_rdpos';
$user = 'u547077750_rdpos';
$pass = 'Rdpos2024';
$host = 'localhost';
$dir = dirname(__FILE__) . DS . 'dump.sql';

$mysqlDir = 'D:' . DS . 'wamp64' . DS . 'bin' . DS . 'mysql' . DS . 'mysql8.0.18' . DS . 'bin'; // Adjust path if necessary
$mysqldump = $mysqlDir . DS . 'mysqldump';

echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";

$command = "{$mysqldump} --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1";
exec($command, $output, $return_var);

if ($return_var === 0) {
    echo "<p>Database backup successful!</p>";
} else {
    echo "<p>Error during backup.</p>";
    file_put_contents('error_log.txt', implode("\n", $output), FILE_APPEND); // Log output to file
}

var_dump($output); // Optional, you can remove this or redirect to log file
?>
