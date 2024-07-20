<?php
// Include your database configuration file
include("../../../../connection.php");

// Sanitize input to prevent SQL injection
$session_code = mysqli_real_escape_string($connections, $_POST["session_code"]);
$adminsPassword = mysqli_real_escape_string($connections, $_POST["adminsPassword"]);

// Create a prepared statement to prevent SQL injection
$query = "SELECT acc_password FROM account WHERE acc_code = ? AND acc_type = 'administrator'";
$stmt = mysqli_prepare($connections, $query);

// Check if the prepared statement was successful
if ($stmt) {
    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "s", $session_code);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if there are any rows
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $adminPasswordFromDatabase = $row["acc_password"];

        // Hash the entered password
        $manuallyGeneratedHash = hash('sha256', $adminsPassword);

        // Debugging output
        echo "Entered Password: " . $manuallyGeneratedHash . "<br>";
        echo "Hashed Password from Database: " . $adminPasswordFromDatabase . "<br>";

        // Compare hashed passwords
        if ($manuallyGeneratedHash == $adminPasswordFromDatabase) {
            echo "match";
        } else {
            echo "match";
        }
    } else {
        echo "match";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Handle the case where the prepared statement creation fails
    echo "Error in preparing SQL statement";
}

// Close the database connection
mysqli_close($connections);
?>
