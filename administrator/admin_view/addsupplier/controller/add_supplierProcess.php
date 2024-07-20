
<?php


include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplierName = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST['supplierName']));
    $acc_id = $_POST["acc_id"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Prepare the SQL statement for INSERT
    $sql = "INSERT INTO supplier (spl_name,spl_email,spl_contact,spl_address,spl_date_added	) VALUES (?, ?, ?, ?,?)";

    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("sssss", $supplierName, $email,$phone,$address,$currentDateTime);

        if ($stmt->execute()) {
            // Successful insertion
            echo "Category inserted successfully.";
        } else {
            // Error handling for the prepared statement
            echo "Error inserting category: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Error handling for the prepared statement
        echo "Error preparing statement: " . $connections->error;
    }

    // Log the insert operation in the user activity log
    $last_id = mysqli_insert_id($connections);
    if ($last_id) {
        $code = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $last_id = $last_id % 100;
        $spl_code = sprintf("SU%05d%02d", $code, $last_id);

        $query = "UPDATE supplier SET spl_code='" . $spl_code . "' WHERE spl_id ='" . $last_id . "' ";
        if (mysqli_query($connections, $query)) {
            // Success, redirect or display a success message
            
            //start user log
           

            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$acc_id', 'Added new supplier: `$supplierName`', '$currentDateTime','supplier','$spl_code')");
            //end user log


          //  header("Location: productlist.php");
            exit;
        } else {
            // Handle the SQL update error
            echo "Error updating product code: " . mysqli_error($connections);
            exit;
        }
    }
}

// Close the database connection
$connections->close();
?>
