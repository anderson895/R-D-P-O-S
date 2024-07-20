<?php
// check_username.php
include '../connection.php'; // Connect to your database

if (!$connections) {
    die("Database connection failed: " . mysqli_connect_error());
}

$username = $_GET['username'];
$query = "SELECT COUNT(*) FROM account WHERE acc_username = '$username'";
$result = mysqli_query($connections, $query);

if ($result) {
    $count = mysqli_fetch_row($result)[0];
    if ($count > 0) {
        echo 'Username already exists';
    } else {
        echo '';
    }
} else {
    echo 'Database query error';
}

// Close the database connection
mysqli_close($connections);
?>
