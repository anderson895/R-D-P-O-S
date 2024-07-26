<?php
// Connect to your database
include("../../../../connection.php");

if (!$connections) {
    die("Database connection failed: " . mysqli_connect_error());
}

$account_id = $_GET["account_id"];
$enteredPassword = $_GET['Oldpassword'];

// Hash the entered password using SHA-256
$hashedEnteredPassword = hash('sha256', $enteredPassword);

$query = "SELECT acc_password FROM account WHERE acc_id = $account_id";
$result = mysqli_query($connections, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $storedPassword = $row['acc_password'];

    // Compare the hashed entered password with the stored hashed password
    if ($hashedEnteredPassword == $storedPassword) {
        echo '';
    } else {
        echo 'Enter Correct Password';
    }
} else {
    echo 'Database query error';
}

// Close the database connection
mysqli_close($connections);
?>
