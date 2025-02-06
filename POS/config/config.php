<?php
// $connections = mysqli_connect ("localhost","root","","u547077750_rdpos");
$connections = mysqli_connect ("localhost","u293217990_rdpos","Rdpos2025","u293217990_rdpos");
?>

<?php
// Database credentials
// $hostname = 'localhost';      // Change this to your database hostname
//  $username = 'root';   // Change this to your database username
// $password = '';   // Change this to your database password
// $database = 'u547077750_rdpos';   // Change this to your database name


$hostname = 'localhost';      // Change this to your database hostname
$username = 'u293217990_rdpos';   // Change this to your database username
$password = 'Rdpos2025';   // Change this to your database password
$database = 'u293217990_rdpos';   // Change this to your database name

// Create a database connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


?>