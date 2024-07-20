<?php
include("../../../../connection.php");



print_r($_FILES);

$sname = mysqli_real_escape_string($connections, preg_replace('/[^0-9a-zA-Z\s]/', '', $_POST["sname"]));
$acc_id = htmlspecialchars($_POST["acc_id"]);
$contact = htmlspecialchars($_POST["contact"]);
$saddress = htmlspecialchars($_POST["saddress"]);
$scontent = htmlspecialchars($_POST["scontent"]);
$tax = htmlspecialchars($_POST["tax"]);


if ($_FILES['img_log']['error'] === UPLOAD_ERR_OK) {
    $imagePath = '../../../../upload_system';
    $fileExtension = pathinfo($_FILES['img_log']['name'], PATHINFO_EXTENSION);
    $uniqueFilename = uniqid() . '.' . $fileExtension;
    $targetFile = $imagePath . '/' . $uniqueFilename;

    if (move_uploaded_file($_FILES['img_log']['tmp_name'], $targetFile)) {
        $img_log = $uniqueFilename;
    }
}

if ($_FILES['sImg_banner']['error'] === UPLOAD_ERR_OK) {
    $imagePath = '../../../../upload_system';
    $fileExtension = pathinfo($_FILES['sImg_banner']['name'], PATHINFO_EXTENSION);
    $uniqueFilename = uniqid() . '.' . $fileExtension;
    $targetFile = $imagePath . '/' . $uniqueFilename;

    if (move_uploaded_file($_FILES['sImg_banner']['tmp_name'], $targetFile)) {
        $sImg_banner = $uniqueFilename;
    }
}


$get_record = mysqli_query($connections, "SELECT * FROM maintinance WHERE system_id = 1");
$row = mysqli_fetch_assoc($get_record);
$db_system_name = $row["system_name"];
$db_system_banner = $row["system_banner"];
$db_system_logo = $row["system_logo"];
$db_system_content = $row["system_content"];
$db_system_address = $row["system_address"];
$db_system_contact = $row["system_contact"];
$db_system_tax = $row["system_tax"];

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

$query = "UPDATE maintinance SET 
            system_name = '$sname',
            system_content = '$scontent',
            system_address = '$saddress',
            system_contact = '$contact',
            system_tax = '$tax',
            system_last_update = '$currentDateTime'";

if ($sImg_banner) {
    $query .= ", system_banner = '$sImg_banner'";
}

if ($img_log) {
    $query .= ", system_logo = '$img_log'";
}

$query .= " WHERE system_id = 1";

if (mysqli_query($connections, $query)) {
    // User log logic
    $get_record = mysqli_query($connections, "SELECT * FROM maintinance WHERE system_id = 1");
    $row = mysqli_fetch_assoc($get_record);

    $updated_db_system_name = $row["system_name"];
    $updated_db_system_banner = $row["system_banner"];
    $updated_db_system_logo = $row["system_logo"];
    $updated_db_system_content = $row["system_content"];
    $updated_db_system_address = $row["system_address"];
    $updated_db_system_contact = $row["system_contact"];
    $updated_db_system_tax = $row["system_tax"];

    if ($db_system_name != $updated_db_system_name) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                    VALUES('$acc_id', 'update system name from $db_system_name changed to $updated_db_system_name', '$currentDateTime', 'maintinance', '1')");
    }

    if ($db_system_banner != $updated_db_system_banner) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                    VALUES('$acc_id', 'update system banner', '$currentDateTime', 'maintinance', '1')");
    }

    if ($db_system_logo != $updated_db_system_logo) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                    VALUES('$acc_id', 'update system logo', '$currentDateTime', 'maintinance', '1')");
    }

    if ($db_system_content != $updated_db_system_content) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                    VALUES('$acc_id', 'update system content', '$currentDateTime', 'maintinance', '1')");
    }

    if ($db_system_address != $updated_db_system_address) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                    VALUES('$acc_id', 'update address from $db_prod_description to $pDescript', '$currentDateTime', 'maintinance', '1')");
    }

    if ($db_system_contact != $updated_db_system_contact) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                    VALUES('$acc_id', 'update system contact from $db_system_contact changed to $updated_db_system_contact', '$currentDateTime', 'maintinance', '1')");
    }

    if ($db_system_tax != $updated_db_system_tax) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                    VALUES('$acc_id', '$db_prod_name update vat from $db_system_tax changed to $updated_db_system_tax', '$currentDateTime', 'maintinance', '1')");
    }
    // End user log
    exit;
} else {
    // Handle the SQL update error
    echo "Error updating : " . mysqli_error($connections);
    exit;
}
?>
