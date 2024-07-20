<?php
// Define a function to retrieve user data
function getUserData($connections) {
    $acc_id = $_SESSION["acc_id"];
    $fullname = "";

    // Prepare the SQL statement using a parameterized query
    $stmt = $connections->prepare("SELECT * FROM account 
        LEFT JOIN user_address ON account.acc_code = user_address.user_acc_code 
        LEFT JOIN tbl_address ON tbl_address.address_region_code = user_address.user_region_code 
        WHERE account.acc_id = ? 
        AND user_address.user_active_status = '1' 
        AND tbl_address.address_region_code = user_address.user_region_code");

    // Bind the parameter value
    $stmt->bind_param("s", $acc_id);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $db_acc_id = $row["acc_id"];
        $db_acc_fname = $row["acc_fname"];
        $db_acc_lname = $row["acc_lname"];
        $db_emp_image = $row["emp_image"];

        $fullname = ucfirst($db_acc_fname) . " " . $db_acc_lname;
        $db_acc_contact = $row["acc_contact"];

        $db_acc_username = $row["acc_username"];
        $db_acc_password = $row["acc_password"];
        $db_acc_username = $row["acc_username"];
        $db_acc_type = $row["acc_type"];
        $db_acc_email = $row["acc_email"];

        $user_acc_code = $row["user_acc_code"];
        $user_region_name = $row["user_region_name"];

        $address_region_code  = $row["address_region_code"];
        $address_rate  = $row["address_rate"];
        $user_complete_address = $row["user_complete_address"];

        $users_latitude = $row["users_latitude"];
        $users_longitud = $row["users_longitud"];

        // Close the statement
        $stmt->close();

        // Return the retrieved data as an array
        return [
            "db_acc_id" => $db_acc_id,
            "fullname" => $fullname,
            "db_acc_contact" => $db_acc_contact,
            "db_acc_username" => $db_acc_username,
            "db_acc_password" => $db_acc_password,
            "db_acc_type" => $db_acc_type,
            "db_acc_email" => $db_acc_email,
            "user_acc_code" => $user_acc_code,
            "user_region_name" => $user_region_name,
            "address_region_code" => $address_region_code,
            "address_rate" => $address_rate,
            "user_complete_address" => $user_complete_address,
            "users_latitude" => $users_latitude,
            "users_longitud" => $users_longitud,
        ];
    }

    // Return null if no data found
    return null;
}

// Call the function to retrieve user data
$userdata = getUserData($connections);

// Check if data was retrieved successfully
//if ($userdata !== null) {
    // Access data using $userdata array
  //  echo "Full Name: " . $userdata["fullname"];
    // ... access other data fields in a similar manner
//} else {
  //  echo "No user data found.";
//}
?>
