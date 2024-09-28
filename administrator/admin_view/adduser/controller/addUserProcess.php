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

$get_record = mysqli_query($connections, "SELECT * FROM account where acc_id='$acc_id'");
$row = mysqli_fetch_assoc($get_record);
$db_acc_username = $row["acc_username"];
$db_acc_fname = $row["acc_fname"];
$db_acc_lname = $row["acc_lname"];
$db_acc_email = $row["acc_email"];
$db_acc_contact = $row["acc_contact"];
$db_emp_image = $row["emp_image"];




// Fetch the JSON data from the API endpoints
$regionData = file_get_contents('../../../../ph-json/region.json');
$provinceData = file_get_contents('../../../../ph-json/province.json');
$cityData = file_get_contents('../../../../ph-json/city.json');
$barangayData = file_get_contents('../../../../ph-json/barangay.json');

// Decode the JSON data
$regionData = json_decode($regionData, true);
$provinceData = json_decode($provinceData, true);
$cityData = json_decode($cityData, true);
$barangayData = json_decode($barangayData, true);


$regionId = $_POST["region"];
$provinceId = $_POST["province"];
$cityId = $_POST["city"];
$barangayId = $_POST["barangay"];
$streetDescription=$_POST["streetDescription"];

// Find the names based on the selected IDs
foreach ($regionData['data'] as $item) {
    if ($item['region_code'] === $regionId) {
        $region_code=$item['region_code'] ;
        $region = $item['region_name'];
    }
}
foreach ($provinceData['data'] as $item) {
    if ($item['province_code'] === $provinceId) {
        $province_code=$item['province_code'] ;
        $province = $item['province_name'];
    }
}
foreach ($cityData['data'] as $item) {
    if ($item['city_code'] === $cityId) {
        $city_code=$item['city_code'] ;
        $city = $item['city_name'];
    }
}
foreach ($barangayData['data'] as $item) {
    if ($item['brgy_code'] === $barangayId) {
        $brgy_code=$item['brgy_code'] ;
        $barangay = $item['brgy_name'];
    }
}
echo $completeAddress= $region." ".$province." ".$city." ".$barangay." ".$streetDescription;




if ($_FILES) {
    if ($_FILES['userImage']['error'] === UPLOAD_ERR_OK) {
        $imagePath = '../../../../upload_img';
        $fileExtension = pathinfo($_FILES['userImage']['name'], PATHINFO_EXTENSION);
        $uniqueFilename = uniqid() . '.' . $fileExtension;
        $targetFile = $imagePath . '/' . $uniqueFilename;

        if (is_uploaded_file($_FILES['userImage']['tmp_name']) && move_uploaded_file($_FILES['userImage']['tmp_name'], $targetFile)) {
            $userImage = mysqli_real_escape_string($connections, $uniqueFilename);

          // Assuming $password is the plain text password entered by the user
            $hashedPassword = hash('sha256', $password);

            $insertQuery = "INSERT INTO account(acc_created, acc_username, acc_password, acc_fname, acc_lname, acc_type, acc_email, acc_contact, emp_image) 
                            VALUES('$currentDateTime', '$username', '$hashedPassword', '$fname', '$lname', '$accountType', '$email', '$phone', '$userImage')";


          


            if (mysqli_query($connections, $insertQuery)) {
                $last_id = mysqli_insert_id($connections);
                if ($last_id) {
                    $code = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
                        //$last_id = $last_id % 100;
                     strlen($acc_code = sprintf("%05d%02d", $code, $last_id));
                    $updateQuery = "UPDATE account SET acc_code = '$acc_code' WHERE acc_id = '$last_id'";
                    $res = mysqli_query($connections, $updateQuery);

                    $insertAddress = "INSERT INTO user_address(user_acc_code, user_address_fullname, user_address_phone, user_address_email, user_region_code, user_region_name, user_complete_address, user_active_status, user_add_display_status,user_add_Default_status) 
                    VALUES('$acc_code', '$fname $lname', '$phone', '$email','$region_code', '$region', '$completeAddress', '1', '1','1')";
                    mysqli_query($connections, $insertAddress);

            
            }

                // Log the activity
                $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                             VALUES('$acc_id', 'Created account: $fname $lname', '$currentDateTime', 'account', '$last_id')";
                mysqli_query($connections, $logQuery);
            } else {
                echo "Error: Failed to insert the user record.";
            }

            
        } else {
            $errorDetails = error_get_last();
            echo "Error: File upload failed - " . $errorDetails['message'];
        }
    }
} else {
    $insertQuery = "INSERT INTO account(acc_created, acc_username, acc_password, acc_fname, acc_lname, acc_type, acc_email, acc_contact) 
                    VALUES('$currentDateTime', '$username', '$password', '$fname', '$lname', '$accountType', '$email', '$phone')";

    if (mysqli_query($connections, $insertQuery)) {
        // Log the activity
        $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                     VALUES('$acc_id', 'Created account: $fname $lname', '$currentDateTime', 'account', '$last_id')";
        mysqli_query($connections, $logQuery);
    } else {
        echo "Error: Failed to insert the user record.";
    }
}

?>