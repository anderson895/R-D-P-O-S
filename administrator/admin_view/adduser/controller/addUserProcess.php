<?php
include("../../../../connection.php");

$acc_id = $_POST["account_id"];

print_r($_POST);

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$username = $_POST["username"];
$password = $_POST["password"];
$accountType = $_POST["accountType"];

$get_record = mysqli_query($connections, "SELECT * FROM account WHERE acc_id='$acc_id'");
$row = mysqli_fetch_assoc($get_record);

if (!$row) {
    echo "Error: Account not found.";
    exit;
}

$db_acc_username = $row["acc_username"];
$db_acc_fname = $row["acc_fname"];
$db_acc_lname = $row["acc_lname"];
$db_acc_email = $row["acc_email"];
$db_acc_contact = $row["acc_contact"];
$db_emp_image = $row["emp_image"];

// Fetch the JSON data from the API endpoints
$regionData = json_decode(file_get_contents('../../../../ph-json/region.json'), true);
$provinceData = json_decode(file_get_contents('../../../../ph-json/province.json'), true);
$cityData = json_decode(file_get_contents('../../../../ph-json/city.json'), true);
$barangayData = json_decode(file_get_contents('../../../../ph-json/barangay.json'), true);

$regionId = $_POST["region"];
$provinceId = $_POST["province"];
$cityId = $_POST["city"];
$barangayId = $_POST["barangay"];
$streetDescription = $_POST["streetDescription"];

// Find the names based on the selected IDs
$region = array_column($regionData['data'], 'region_name', 'region_code')[$regionId] ?? '';
$province = array_column($provinceData['data'], 'province_name', 'province_code')[$provinceId] ?? '';
$city = array_column($cityData['data'], 'city_name', 'city_code')[$cityId] ?? '';
$barangay = array_column($barangayData['data'], 'brgy_name', 'brgy_code')[$barangayId] ?? '';

$completeAddress = "$region $province $city $barangay $streetDescription";

$userImage = null;

// Handle file upload if provided
if ($_FILES && $_FILES['userImage']['error'] === UPLOAD_ERR_OK) {
    $imagePath = '../../../../upload_img';
    $fileExtension = strtolower(pathinfo($_FILES['userImage']['name'], PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Define allowed file types

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Error: Invalid file type.";
        exit;
    }

    $uniqueFilename = uniqid() . '.' . $fileExtension;
    $targetFile = $imagePath . '/' . $uniqueFilename;

    if (is_uploaded_file($_FILES['userImage']['tmp_name']) && move_uploaded_file($_FILES['userImage']['tmp_name'], $targetFile)) {
        $userImage = mysqli_real_escape_string($connections, $uniqueFilename);
    } else {
        $errorDetails = error_get_last();
        echo "Error: File upload failed - " . $errorDetails['message'];
        exit; // Exit if file upload fails
    }
}

// Hash the password securely
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Prepare the insert query
$insertQuery = "INSERT INTO account (acc_created, acc_username, acc_password, acc_fname, acc_lname, acc_type, acc_email, acc_contact, emp_image) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($connections, $insertQuery);
mysqli_stmt_bind_param($stmt, 'sssssisss', $currentDateTime, $username, $hashedPassword, $fname, $lname, $accountType, $email, $phone, $userImage);

if (mysqli_stmt_execute($stmt)) {
    $last_id = mysqli_insert_id($connections);
    $code = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
    $acc_code = sprintf("%05d%02d", $code, $last_id);
    
    // Update account code
    $updateQuery = "UPDATE account SET acc_code = ? WHERE acc_id = ?";
    $stmtUpdate = mysqli_prepare($connections, $updateQuery);
    mysqli_stmt_bind_param($stmtUpdate, 'si', $acc_code, $last_id);
    mysqli_stmt_execute($stmtUpdate);

    // Insert address
    $insertAddress = "INSERT INTO user_address (user_acc_code, user_address_fullname, user_address_phone, user_address_email, user_region_code, user_region_name, user_complete_address, user_active_status, user_add_display_status, user_add_Default_status) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, '1', '1', '1')";
    
    $stmtAddress = mysqli_prepare($connections, $insertAddress);
    mysqli_stmt_bind_param($stmtAddress, 'sssssss', $acc_code, "$fname $lname", $phone, $email, $regionId, $region, $completeAddress);
    mysqli_stmt_execute($stmtAddress);

    // Log the activity
    $logQuery = "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                 VALUES (?, 'Created account: $fname $lname', ?, 'account', ?)";
    
    $stmtLog = mysqli_prepare($connections, $logQuery);
    mysqli_stmt_bind_param($stmtLog, 'isi', $acc_id, $currentDateTime, $last_id);
    mysqli_stmt_execute($stmtLog);
    
    echo "Account created successfully.";
} else {
    echo "Error: Failed to insert the user record.";
}

mysqli_stmt_close($stmt);
mysqli_close($connections);
?>
