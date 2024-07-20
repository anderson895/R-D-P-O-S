<?php

include("../../../../connection.php");


$acc_id=$_POST["account_id"];

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

if ($_FILES['backgroundimage']['error'] === UPLOAD_ERR_OK) {
    $imagePath = '../../../../upload_img';
    $fileExtension = pathinfo($_FILES['backgroundimage']['name'], PATHINFO_EXTENSION);
    $uniqueFilename = uniqid() . '.' . $fileExtension;

    $targetFile = $imagePath . '/' . $uniqueFilename;

    if (is_uploaded_file($_FILES['backgroundimage']['tmp_name']) && move_uploaded_file($_FILES['backgroundimage']['tmp_name'], $targetFile)) {
        $backgroundimage = mysqli_real_escape_string($connections, $uniqueFilename);


mysqli_query($connections,"UPDATE account SET acc_cover_img='$backgroundimage',acc_lastEdit='$currentDateTime' WHERE acc_id='$acc_id'");

mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
VALUES('$acc_id', 'Update cover photo $uniqueFilename', '$currentDateTime','account','$acc_id')");
// End user log
		
} else {
    $errorDetails = error_get_last();
    echo "Error: File upload failed - " . $errorDetails['message'];
    exit;
}
}


//header("Location: index.php");

?>