<?php
// Create a database connection
$connections = mysqli_connect("localhost", "u547077750_rdpos", "Rdpos2024", "u547077750_rdpos");

// Check if the connection is successful
if (!$connections) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Your database operations go here...

// Close the connection after you're done
mysqli_close($connections);
?>

<?php
// Database credentials
$hostname = 'localhost';      // Your database hostname
$username = 'u547077750_rdpos';   // Your database username
$password = 'Rdpos2024';   // Your database password
$database = 'u547077750_rdpos';   // Your database name

// Create a database connection using object-oriented approach
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Your database operations go here...

// Close the connection when done
$conn->close();
?>
